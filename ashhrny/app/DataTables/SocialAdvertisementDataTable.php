<?php

namespace App\DataTables;

use App\Models\SocialAdvertisement;;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class SocialAdvertisementDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('delete', 'admin.social_advert.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SocialAdvertisement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SocialAdvertisement $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $social_advert = SocialAdvertisement::all();
        if(count($social_advert) < 2) {
            return $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom' => 'Blfrtip',
                    'lengthMenu' => [
                        [10,25,50,100,-1],[10,25,50,_i('all record')]
                    ],
                    'buttons' =>
                        [
                            [
                                'text' => '<i class="ti-plus"></i> ' . _i('create new Social Advertisement Data'),
                                'className' => 'btn btn-primary create',
                            ],
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
        } else {
            return $this->builder()
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom' => 'Blfrtip',
                    'lengthMenu' => [
                        [10,25,50,100,-1],[10,25,50,_i('all record')]
                    ],
                    'buttons' =>
                        [
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
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'id','data'=>'id','title'=>_i('id')],
            ['name'=>'type','data'=>'type','title'=>_i('type')],
            ['name'=>'price','data'=>'price','title'=>_i('price')],
            ['name'=>'delete','data'=>'delete','title'=>_i('edit/delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SocialAdvertisement_' . date('YmdHis');
    }
}
