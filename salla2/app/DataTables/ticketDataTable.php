<?php

namespace App\DataTables;

use App\Enums\StatusType;
use App\ticket;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ticketDataTable extends DataTable
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
                return '<a href="ticket/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i>Edit</a>';
            })
            ->addColumn('subject', function ($query) {
                return '<a href="ticket/'.$query->id.'">'.$query->subject.'</a>';
            })
            ->addColumn('status', function ($query){
                if ($query->status == '2'){
                    return '<span style="color: orange">pending</span>';
                }elseif ($query->status == '3'){
                    return '<span style="color: orangered;">bugs</span>';
                }
            })
            ->addColumn('admin', function ($query){
                return $query->admin['name'];
            })
            ->addColumn('user', function ($query){
                return User::findORFail($query->agent_id)['name'];
            })
            ->addColumn('category', function ($query){
                return '<span style="color:'.$query->category['color'].'">'.$query->category['name'].'</span>';
            })
            ->addColumn('priority', function ($query){
                return '<span style="color:'.$query->priority['color'].'">'.$query->priority['name'].'</span>';
            })
            ->addColumn('updated_at', function ($query){
                return $query->updated_at ? $query->updated_at->diffforhumans() : null;
            })
            ->rawColumns([
                'edit',
                'subject',
                'admin',
                'status',
                'user',
                'category',
                'updated_at',
                'priority',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ticket $ticket)
    {
        return $ticket->query()->with('admin','user','category','priority')->where('status','!=','1');
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
                                'text' => '<i class="ti-plus"></i> create new ticket',
                                'className' => 'btn btn-primary',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "ticket/create";
                                 }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i>'],
        //                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
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
            ['name'=>'id','data'=>'id','title'=> _i('id')],
            ['name'=>'subject','data'=>'subject','title'=> _i('subject')],
            ['name'=>'status','data'=>'status','title'=> _i('status')],
            ['name'=>'admin','data'=>'admin','title'=> _i('admin')],
            ['name'=>'user','data'=>'user','title'=> _i('agent')],
            ['name'=>'category','data'=>'category','title'=> _i('category')],
            ['name'=>'priority','data'=>'priority','title'=> _i('priority')],
            ['name'=>'updated_at','data'=>'updated_at','title'=> _i('last update')],
            ['name'=>'edit','data'=>'edit','title'=> _i('edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ticket_' . date('YmdHis');
    }
}
