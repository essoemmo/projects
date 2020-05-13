<?php

namespace App\DataTables;

use App\Models\OpenTicket;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class OpenTicketDataTable extends DataTable
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
            ->addColumn('delete', 'admin.openTicket.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\OpenTicket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OpenTicket $model)
    {
        return $model->query()->select('open_ticket_translations.title as title','open_ticket.id as id')
            ->leftJoin('open_ticket_translations','open_ticket_translations.open_ticket_id','=','open_ticket.id')->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new Open Ticket'),
                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "blog/create";
//                         }',
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
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'open_ticket.id','data'=>'id','title'=>_i('id')],
            ['name'=>'open_ticket_translations.title','data'=>'title','title'=>_i('title')],
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
        return 'OpenTicket_' . date('YmdHis');
    }
}
