<?php

namespace App\DataTables;

use App\Models\product\orders;
use App\User;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('user_id', function($query) {
                $user = User::select(['name'])->where('id', '=', $query->user_id)->first();
                return $user->name;
            })
            ->addColumn('cost', function($query) {
                $pay = 0;
                foreach ($query->orderProducts as $cost){
                    $pay += $cost->price * $cost->count;
                }
                return $pay;
            })
            ->addColumn('user_email', function($query) {
                $user = User::select(['email'])->where('id', '=', $query->user_id)->first();
                return $user->email;
            })
            ->editColumn('user_id', function($query) {
                $user = User::select(['name'])->where('id', '=', $query->user_id)->first();
                return $user->name;
            })
//            ->addColumn('edit', function ($query) {
//                return '<a href="../orders/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i>  '._i('Edit').' </a>';
//            })
            ->addColumn('delete', 'admin.orders.btn.delete')
            ->rawColumns([
                'cost',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(orders $model)
    {
       
        if (auth()->user()->hasRole( \App\Help\Utility::Store)){
            return $model->query()->orderByDesc('id')->where('store_id',session('StoreId'))->with('orderProducts');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'lengthMenu' => [
                            [10,25,50,100,-1],[10,25,50,_i('all record')]
                        ],

                        'buttons' => [
                            [
                                'text' => '<i class="ti-plus"></i> ' . 'add new order',
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "../orders";
                                 }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                        ],
                        "initComplete" => "function () {
                            this.api().columns([]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                
                                    column.search(val ? val : '', true, false).draw();
                                });
                            });
                            }",
        //                "language" =>  self::lang(),
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'user_id','data'=>'user_id','title'=>_i('User Name')],
            ['name'=>'user_email','data'=>'user_email','title'=>_i('User Email')],
            ['name'=>'cost','data'=>'cost','title'=>_i('cost')],
            ['name'=>'shipping_cost','data'=>'shipping_cost','title'=>_i('shipping cost')],
            ['name'=>'ordernumber','data'=>'ordernumber','title'=>_i('Order Number')],
            ['name'=>'delete','data'=>'delete','title'=>_i('Edit & Delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
