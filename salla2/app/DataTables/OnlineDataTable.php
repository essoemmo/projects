<?php


namespace App\DataTables;


use App\Bll\Utility;
use App\Models\product\bank_transfer;
use App\Models\product\orders;
use App\Models\product\transaction_types;
use App\Transaction;
use App\User;
use Yajra\DataTables\Services\DataTable;

class OnlineDataTable extends DataTable
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
            ->addColumn('user' , function($query){
                $order = orders::where('id' , $query->order_id)->where('store_id' , Utility::getStoreId())->first();
                $user = User::where('id' , $order->user_id)->where('store_id' , Utility::getStoreId())->first();
                return $user["name"]." ".$user["lastname"];
            })
            ->addColumn('transaction_type' , function($query){
                $transaction_type = transaction_types::where('id' , $query->type_id)->where('store_id' , Utility::getStoreId())->first();
                return $transaction_type["title"];
            })
            ->editColumn('total' , function($query){
                return $query["total"] ." ". $query["currency"];
            })
//            ->editColumn('type' , function($query){
//                if($query->type == "bank"){
//                    return _i('Bank');
//                }elseif($query->type == "delivery"){
//                    return _i('Cache on delivery');
//                }else{
//                    return _('Online');
//                }
//            })
            ->addColumn('delete', 'admin.transaction.online.btn.delete')
            ->rawColumns([
                'user',
                'bank',
                'delete',
            ]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Transaction::query()->orderByDesc('id')->where('type_id' ,"!=", null)
            ->where('type' , "online")->where('store_id' , Utility::getStoreId());
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
//                    ->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' =>  _i('Online Transactions'),
                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "../user/add";
//                         }',
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
            ['name'=>'id','data'=>'id','title'=>_i('id')],
            ['name'=>'user','data'=>'user','title'=> _i('user')],
            ['name'=>'transaction_type','data'=>'transaction_type','title'=> _i('transaction type')],
            ['name'=>'total','data'=>'total','title'=> _i('total')],
            ['name'=>'status','data'=>'status','title'=> _i('status')],
           // ['name'=>'type','data'=>'type','title'=> _i('type')],
            ['name'=>'delete','data'=>'delete','title'=> _i('controll'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactions' . date('YmdHis');
    }


}
