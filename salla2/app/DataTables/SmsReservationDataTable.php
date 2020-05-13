<?php

namespace App\DataTables;

use App\Models\Settings\SmsReservation;
use Yajra\DataTables\Services\DataTable;

class SmsReservationDataTable extends DataTable
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
            ->addColumn('show', 'master.sms.btn.show')
            ->editColumn('title', function ($query) {
                return $query->store->title;
            })
            ->editColumn('status', function ($query) {
                if ($query->status == 0) {
                    return '<span class="badge badge-danger">' . _i('Not Approved') . '</span>';
                } else {
                    return '<span class="badge badge-success">' . _i('Approved') . '</span>';
                }
            })
            ->rawColumns([
                'show',
                'title',
                'status',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SmsReservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SmsReservation $model)
    {
        return $model->query()->with('store');
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
//                    ->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10, 25, 50, 100, -1], [10, 25, 50, _i('all record')]
                ],
                'buttons' => [
//                    [
//                        'text' => '<i class="ti-plus"></i> ' . 'add new store',
//                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "store/create";
//                         }',
//                    ],
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
            ['name' => 'sender_name', 'data' => 'sender_name', 'title' => _i('Sender Name')],
            ['name' => 'sender_ad_name', 'data' => 'sender_ad_name', 'title' => _i('Sender Ad Name')],
            ['name' => 'store.title', 'data' => 'title', 'title' => _i('Store Name')],
            ['name' => 'status', 'data' => 'status', 'title' => _i('Status')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => _i('created_at')],
            ['name' => 'show', 'data' => 'show', 'title' => _i('Show'), 'printable' => false, 'exportable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SmsReservation_' . date('YmdHis');
    }
}
