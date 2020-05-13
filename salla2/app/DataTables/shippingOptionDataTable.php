<?php

namespace App\DataTables;

use App\Models\Shipping\Shipping_option;
use App\Models\Shipping\shippingCompanies;
use App\User;
use Yajra\DataTables\Services\DataTable;

class shippingOptionDataTable extends DataTable
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
            ->editColumn('company_id', function($query) {
                $company = shippingCompanies::select(['title'])->where('id', '=', $query->company_id)->first();
                return $company->title;
            })
            ->addColumn('delete', 'admin.shipping.shipping_option.btn.delete')
            ->rawColumns([
//                'logo',
//                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shipping_option $model)
    {
//        if (auth()->user()->hasRole( \App\Help\Utility::Store)) {
            return $model->query()->where('store_id', session('StoreId'));
//        }else{
//            return $model->query()->where('store_id', null);
//        }
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
                        'text' => '<i class="ti-plus"></i> ' . _i('add new shipping option company'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "../shipping_option/create";
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
            ['name'=>'company_id','data'=>'company_id','title'=> _i('Company Name')],
            ['name'=>'delay','data'=>'delay','title'=> _i('Delay')],
            ['name'=>'cash_delivery_commission','data'=>'cash_delivery_commission','title'=> _i('Cash Delivery Commission')],
            ['name'=>'cost','data'=>'cost','title'=> _i('Cost')],
            ['name'=>'created_at','data'=>'created_at','title'=>'created_at'],
            ['name'=>'delete','data'=>'delete','title'=> _i('Edit/Delete') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'shippingOption_' . date('YmdHis');
    }
}
