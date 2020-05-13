<?php

namespace App\DataTables;

use App\Models\Activemember;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ActivememberDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('activeMember', 'admin.status.active.btn.active')
            ->addColumn('Hits', 'admin.status.active.btn.hits')
            ->rawColumns([
                'activeMember',
                'Hits',
            ]);
    }

    public function query()
    {
        return User::query()->where('guard','!=','admin');
    }
    public static function lang()
    {
        $langJson = [
            "sProcessing" => _i('Processing'),
            "sZeroRecords" => _i('Zero Records'),
            "sEmptyTable" => _i('Empty Table'),
            "sInfoFiltered" => _i('Info Filtered'),
            "sSearch" => _i('Search'),
            "sUrl" => _i('Url'),
            "sInfoThousands" => _i('Info Thousands'),
            "sLoadingRecords" => _i('Loading Records'),
            "oPaginate" => [
                "sFirst" => _i('First'),
                "sLast" => _i('Last'),
                "sNext" => _i('Next'),
                "sPrevious" => _i('Previous')
            ],
            "oAria" => [
                "sSortAscending" => _i('Sort Ascending'),
                "sSortDescending" => _i('Sort Descending')
            ]
        ];
//        dd($langJson);
        return $langJson;
    }

    public function html()
    {
        return $this->builder()
//                    ->setTableId('bestmember-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            ['name'=>'username',
                'data'=>'username',
                'title'=> _i('User name')
            ],

            ['name'=>'email',
                'data'=>'email',
                'title'=> _i('email')
            ],

            ['name'=>'activeMember',
                'data'=>'activeMember',
                'title'=> _i('ActiveMember'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],

            ['name'=>'Hits',
                'data'=>'Hits',
                'title'=> _i('hits'),
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
        return 'Activemember_' . date('YmdHis');
    }
}
