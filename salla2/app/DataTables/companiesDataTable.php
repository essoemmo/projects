<?php

namespace App\DataTables;

use App\Models\Shipping\shippingCompanies;
use App\User;
use Yajra\DataTables\Services\DataTable;

class companiesDataTable extends DataTable
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
        ->addColumn('logo', function($query){
            if ($query->logo){
                return '<img src="'.asset($query->logo).'" style="width:150px" class="img-responsive" />';
            }
        })
        ->addColumn('delete', 'admin.shipping.companies.btn.delete')
        ->rawColumns([
            'logo',
            'delete',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(shippingCompanies $model)
    {
//        if (auth()->user()->hasRole( \App\Help\Utility::Store)){
            return $model->query()->orderByDesc('id')->where('store_id',session('StoreId'));
//        }else{
//            return $model->query()->orderByDesc('id')->where('store_id',null);
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
                                'text' => '<i class="ti-plus"></i> ' . _i('add new company'),
                                'className' => 'btn btn-primary create',
//                                'action' => 'function( e, dt, button, config){
//                                                     window.location = "../companies/create";
//                                                 }',
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
            ['name'=>'title','data'=>'title','title'=> _i('title')],
            ['name'=>'description','data'=>'description','title'=> _i('description')],
            ['name'=>'logo','data'=>'logo','title'=> _i('logo')],
            ['name'=>'created_at','data'=>'created_at','title'=> _i('created_at')],
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
        return 'companies_' . date('YmdHis');
    }
}
