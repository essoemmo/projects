<?php

namespace App\DataTables;

use App\Models\orders;
use App\User;
use Yajra\DataTables\Services\DataTable;

class userOrderDataTable extends DataTable
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
            ->addColumn('ordernumber', function($query) {
                return '<a href="'.url('orderDetails/'.$query->orderId).'">' . $query->ordernumber . '
                        <input type="hidden" id="ordernumber" name="ordernumber" value="'. $query->id .'">
                     </a>';
            })
            ->editColumn('total', function($query) {
                return $query->total;
            })
            ->editColumn('shipping_cost', function($query) {
                return $query->shipping_cost;
            })
            ->editColumn('status', function($query) {
                if ($query->status == 'wait'){
                    return '<div class="badge badge-warning">'.$query->status.'</div>';
                }elseif ($query->status == 'accepted'){
                    return '<div class="badge badge-primary">'.$query->status.'</div>';
                }elseif ($query->status == 'refused'){
                    return '<div class="badge badge-danger">'.$query->status.'</div>';
                }elseif ($query->status == 'complete'){
                    return '<div class="badge badge-success">'.$query->status.'</div>';
                }elseif ($query->status == 'shipped'){
                    return '<div class="badge badge-info">'.$query->status.'</div>';
                }
            })
            ->rawColumns([
                'status',
                'ordernumber',
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
        return $model->query()
            ->leftJoin('order_items','order_items.order_id','orders.id')
            ->select('orders.*','order_items.type','order_items.type_id' ,'order_items.order_id as orderId')
            ->where('orders.user_id', auth()->id())
            ->groupBy('orders.ordernumber');
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
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
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
            ['name'=>'ordernumber','data'=>'ordernumber','title'=>_i('Order Number')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('created_at')],
            ['name'=>'total','data'=>'total','title'=>_i('total')],
            ['name'=>'shipping_cost','data'=>'shipping_cost','title'=>_i('shipping')],
            ['name'=>'status','data'=>'status','title'=>_i('status')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userOrder_' . date('YmdHis');
    }
}
