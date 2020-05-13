<?php

namespace App\DataTables;

use App\Models\Contact;
use App\User;
use Yajra\DataTables\Services\DataTable;

class contactdatatables extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('show', function ($query){
                return '<a href="#" id="show" data-toggle="modal" data-target="#exampleModal" data-id="'.$query->id.'" data-title="'.$query->title.'" data-email="'.$query->email.'" data-content="'.$query->content.'"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('delete', 'admin.setting.contact.delete')
            ->rawColumns([
                'show',
                'delete',
            ]);
    }


    public function query()
    {
            return Contact::query();
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
            ['name'=>'email',
                'data'=>'email',
                'title'=> _i('email')
            ],
            ['name'=>'title',
                'data'=>'title',
                'title'=> _i('title')
            ],
            ['name'=>'content',
                'data'=>'content',
                'title'=> _i('UserMassege')
            ],
            ['name'=>'show',
                'data'=>'show',
                'title'=> _i('show'),
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
        return 'contactdatatables_' . date('YmdHis');
    }
}
