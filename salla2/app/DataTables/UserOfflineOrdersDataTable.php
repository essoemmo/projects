<?php


namespace App\DataTables;


use App\Bll\Utility;
use App\Models\product\order_products;
use App\Models\product\transactions;
use Yajra\DataTables\Services\DataTable;

class UserOfflineOrdersDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('ordernumber', function($query) {
                return '<a href="'.route('myorders.show',$query->order->id).'">'.$query->order->ordernumber.'</a>';
            })
            ->editColumn('total', function($query) {
                return $query->order->total;
            })
//            ->editColumn('shipping_cost', function($query) {
//                return $query->order->shipping_cost;
//            })
            ->editColumn('status', function($query) {
                    return '<div class="badge badge-warning">'.$query->status.'</div>';
            })
            ->rawColumns([
                'status',
                'ordernumber',
            ]);
    }

    public function query(transactions $model)
    {
        return $model->query()->where('status',"pending")->where('bank_id',"!=", null)->where('store_id',Utility::getStoreId())
            ->orderByDesc('id')->whereHas('order',function ($query){
                $query->where('user_id',auth()->id());
            });
    }

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
            ]);
    }


    protected function getColumns()
    {
        return [
            ['name'=>'ordernumber','data'=>'ordernumber','title'=>_i('Order No')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('Created time')],
            ['name'=>'total','data'=>'total','title'=>_i('Total')],
            ['name'=>'holder_name','data'=>'holder_name','title'=>_i('Holder Name')],
            ['name'=>'status','data'=>'status','title'=>_i('Status')],
        ];
    }

    protected function filename()
    {
        return 'transactions_' . date('YmdHis');
    }
}