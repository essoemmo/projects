<?php

namespace App\DataTables;

use App\Models\Country;
use App\Models\CountryDescription;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class CountryDataTable extends DataTable
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
            ->editColumn('code', function ($query) {
                if (!empty( $query->iso_code)) {
                    return $query->iso_code;
                } else {
                    return "-";
                }
            })->editColumn('created_at', function ($query) {
                return $query->created_at;
            })->editColumn('status', function ($query) {
                if ($query->status == 0) {
                    return '<span class="label label-success">'._i('Enabled').'</span>';
                }
                return '<span class="label label-danger">'._i('Disabled').'</span>';
            })
            ->addColumn('delete', 'admin.countries.btn.delete')
            ->rawColumns([
                'delete',
                'created_at',
                'code',
                'status',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Country $model)
    {
        return $model->newQuery()->leftJoin('country_descriptions','country_descriptions.country_id','countries.id')->where('country_descriptions.language_id', checknotsessionlang())->select('countries.*','country_descriptions.name');
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
                    [10,25,50,100,-1],[10,25,50, _i('all records')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . _i('add new Country'),
                        'className' => 'btn btn-lg  btn-success create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "countries/create";
                                 }',
                    ],
//                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
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
            ['name'=>'name','data'=>'name','title'=> _i('Name')],
            ['name'=>'code','data'=>'code','title'=> _i('Code')],
            ['name'=>'status','data'=>'status','title'=> _i('Status')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('Created At')],
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
        return 'Country_' . date('YmdHis');
    }
}
