<?php

namespace App\DataTables;

use App\Store;
use App\User;
use Yajra\DataTables\Services\DataTable;

class agentDataTable extends DataTable
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
            ->addColumn('edit', function($query){
                return '<a href="agent/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> edit</a>';
            })
            ->addColumn('delete', 'admin.ticket.agents.btn.delete')
            ->addColumn('name', function($query){
                return '<span style="color: '.$query->color.';">'.$query->name.'</span>';
            })
            ->rawColumns([
                'edit',
                'delete',
                'name',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Store $agent)
    {
        return $agent->query()->where('ticket_agent','!=',0)->where('guard','store');
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
                                'text' => '<i class="ti-plus"></i> Add Agent',
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                                     window.location = "agent/create";
                                                 }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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
            ['name'=>'id','data'=>'id','title'=> _i('ID')],
            ['name'=>'name','data'=>'name','title'=> _i('name')],
            ['name'=>'edit','data'=>'edit','title'=> _i('edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=> _i('delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'agent_' . date('YmdHis');
    }
}
