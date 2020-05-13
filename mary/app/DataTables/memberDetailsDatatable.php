<?php

namespace App\DataTables;

//use App\memberDetailsDatatable;
use App\Models\Membership_data_type;
use App\Models\Membership_type;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class memberDetailsDatatable extends DataTable
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
            ->addColumn('edit', function ($query) {
                    return '<a href="'.route('memberships-details.edit',$query->id).'" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>';

            })
//            ->addColumn('delete', 'admin.memberShip.details.btn.delete')
            ->rawColumns([
                'edit',
//                'delete',
            ]);
    }

    public function query()
    {
        return Membership_type::query()
            ->select(['membership_types.*',
                'membership_data_types.name',
                'membership_data_types.description',
                'membership_data_types.lang_id',
                'membership_data_types.source_id',])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_data_types.lang_id','=',getLang());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public static function lang(){
        $langJson = [
            "sProcessing"=> _i('Processing'),
            "sZeroRecords"=> _i('Zero Records'),
            "sEmptyTable"=> _i('Empty Table'),
            "sInfoFiltered"=> _i('Info Filtered'),
            "sSearch"=> _i('Search'),
            "sUrl"=> _i('Url'),
            "sInfoThousands"=> _i('Info Thousands'),
            "sLoadingRecords"=> _i('Loading Records'),
            "oPaginate"=> [
                "sFirst"=> _i('First'),
                "sLast"=> _i('Last'),
                "sNext"=> _i('Next'),
                "sPrevious"=> _i('Previous')
            ],
            "oAria"=> [
                "sSortAscending"=> _i('Sort Ascending'),
                "sSortDescending"=> _i('Sort Descending')
            ]
        ];
//        dd($langJson);
        return $langJson;
    }
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
//                    ->addAction(['width' => '80px'])
////                    ->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100],[10,25,50, _i('all_record')]
                ],
                'buttons' => [
//                    [
//                        'text' => '<i class="fa fa-plus"></i> ' . _i('Create New memebrs'),
//                        'className' => 'btn btn-sm btn-primary create',
////                        'action' => 'function( e, dt, button, config){
////                                 }',
//                    ],

                ],
                "initComplete" => "function () {
                            this.api().columns([1,2]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                
                                    column.search(val ? val : '', true, false).draw();
                                });
                            });
                        }",
                "language" =>  self::lang(),
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
            ['name'=>'id',
                'data'=>'id',
                'title'=> _i('id')
            ],
            ['name'=>'name',
                'data'=>'name',
                'title'=> _i('Member Ship')
            ],

            ['name'=>'price',
                'data'=>'price',
                'title'=> _i('price')
            ],
            ['name'=>'end_data',
                'data'=>'expire_date',
                'title'=> _i('expire_date')
            ],
            ['name'=>'edit',
                'data'=>'edit',
                'title'=> _i('edit'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
//            ['name'=>'delete',
//                'data'=>'delete',
//                'title'=> _i('delete'),
//                'printable'=>false,
//                'exportable'=>false,
//                'orderable'=>false,
//                'searchable'=>false
//            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'memberDetails_' . date('YmdHis');
    }
}
