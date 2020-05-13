<?php

namespace App\DataTables;

use App\Models\Newletters;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class newletterDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('delete', 'admin.newletter.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }


    public function query()
    {
        return Newletters::query();
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
//                    ->setTableId('newletter-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100],[10,25,50, _i('all_record')]
                ],
                'buttons' => [
//                ['extend' => 'csv', 'className' => 'btn btn-info' , 'text' => _i('csv export')]

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

            ['name'=>'created_at',
                'data'=>'created_at',
                'title'=> _i('created_at'),
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
        return 'newletter_' . date('YmdHis');
    }
}
