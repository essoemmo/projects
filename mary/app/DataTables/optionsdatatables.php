<?php

namespace App\DataTables;

use App\Models\Option;
use Yajra\DataTables\Services\DataTable;

class optionsdatatables extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)

            ->addColumn('edit', function ($query) {
               //$option_group = \App\Models\Option_group::where('id','=',$option->group_id)->first();
//                dd($option_group);
                if (auth()->user()->can('option-edit')){
                    return '<button  data-id ="'.$query->id.'" data-reuired="'.$query->require.'" data-name ="'.$query->title.'"  data-group="'.$query->option_group->id.'" data-grId="'.$query->group_id.'" data-lang="'.$query->lang_id.'"  data-toggle="modal" data-target="#edit"  class="btn btn-sm btn-success edit"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';

                }else{
                    return '<button  class="btn btn-sm btn-success disabled"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';

                }

            })
            ->addColumn('group', 'admin.features.option.group')
            ->addColumn('delete', 'admin.features.option.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'group',
            ]);      }


    public function query()
    {
        return Option::query()->where('source_id','=',null);
    }

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

    protected function getColumns()
    {
        return [
            ['name'=>'id',
                'data'=>'id',
                'title'=> _i('id')
            ],
            ['name'=>'title',
                'data'=>'title',
                'title'=> _i('Features')
            ],
              ['name'=>'group',
                'data'=>'group',
                'title'=> _i('group'),
                  'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
              ],


            ['name'=>'edit',
                'data'=>'edit',
                'title'=> _i('edit'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
            ['name'=>'delete',
                'data'=>'delete',
                'title'=> _i('delete'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'optionsdatatables_' . date('YmdHis');
    }
}
