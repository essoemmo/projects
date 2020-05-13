<?php

namespace App\DataTables;

use App\Models\User;
use function foo\func;
use Yajra\DataTables\Services\DataTable;

class memberDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('edit', function ($query) {
                if (auth()->user()->can('member-Edit')) {
                    return '<a href="members/' . $query->id . '/edit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>';
                }else{
                    return '<a href="#" class="btn btn-sm btn-success disabled"><i class="fa fa-edit"></i></a>';

                }
            })
            ->addColumn('delete', 'admin.members.btn.delete')
            ->addColumn('nationalty', 'admin.members.btn.national')

            ->addColumn('message', function ($query) {
                if (auth()->user()->can('send_massege_member')){
                    return '<button  data-username="'.$query->username.'" data-to="'.$query->id.'" data-from="'.auth()->user()->id.'" class="btn btn-sm btn-info" id="comment"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope"></i> </button>';

                }else{
                    return '<button  class="btn btn-sm btn-info disabled"><i class="fa fa-envelope"></i> </button>';

                }
            })
            ->addColumn('shomessage', function ($query) {
                if (auth()->user()->can('show_massege_member')){
                    return '<a href="massege/memebr/' . $query->id . '"  class="btn btn-sm btn-warning"><i class="fa fa-eye"></i> </button>';
            }else{
                    return '<a href="#"  class="btn btn-sm btn-warning disabled"><i class="fa fa-eye"></i> </button>';

                }
            })
            ->addColumn('memberactivation','admin.members.btn.memberactivation')
            ->rawColumns([
                'edit',
                'delete',
                'nationalty',
                'message',
                'shomessage',
                'memberactivation',
//                'branches',
            ]);
    }


    public function query()
    {
        return User::query()->where('guard','!=','admin');
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
//                    ->parameters($this->getBuilderParameters());
                    ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100],[10,25,50, _i('all_record')]
                ],
                'buttons' => [

//                    [
//
//
//                        'text' => '<i class="fa fa-plus"></i> ' . _i('create Members'),
//                        'className' => 'btn btn-sm btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                                     window.location = "members/create";
//                                 }',
//                    ],
//                            [
//                                'text' => '<i class="fa fa-flag"></i> ' . _i('Roles'),
//                                'className' => 'btn btn-sm btn-primary',
//                                'action' => 'function( e, dt, button, config){
//                                     window.location = "roles";
//                                 }',
//                            ],
//                            [
//                                'text' => '<i class="fa fa-flag"></i> ' . _i('Permissions'),
//                                'className' => 'btn btn-sm btn-primary',
//                                'action' => 'function( e, dt, button, config){
//                                     window.location = "permissions";
//                                 }',
//                            ],
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
            ['name'=>'username',
                'data'=>'username',
                'title'=> _i('User name')
            ],
            ['name'=>'email',
                'data'=>'email',
                'title'=> _i('email')
            ],
//            ['name'=>'nationalty_id',
//                'data'=>'nationalty_id',
//                'title'=> _i('nationalty')
//            ],
            ['name'=>'nationalty',
                'data'=>'nationalty',
                'title'=> _i('nationalty'),
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

            ['name'=>'message',
                'data'=>'message',
                'title'=> _i('message'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
            ['name'=>'shomessage',
                'data'=>'shomessage',
                'title'=> _i('showMassege'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
            ['name'=>'memberactivation',
                'data'=>'memberactivation',
                'title'=> _i('memberactivation'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],

        ];
    }


    protected function filename()
    {
        return 'memberDataTable' . date('YmdHis');
    }
}
