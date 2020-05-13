<?php

namespace App\DataTables;

use App\membership;
use App\User;
use Yajra\DataTables\Services\DataTable;

class MembershipDataTable extends DataTable
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
               return '<a href="../membership/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> edit</a>';
           })
           ->editColumn('is_active' ,function ($membership){
               return $membership->is_active == 1 ? 'yes' : 'no';
           })
           ->editColumn('duration' ,function ($membership){
               return $membership->duration ." " .  'Year';
           })
           ->addColumn('delete', 'security.membership.memberships.btn.delete')
           ->rawColumns([
               'edit',
               'delete',
           ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(membership $membership)
    {
        return $membership->query();
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
                                'text' => '<i class="ti-plus"></i>'._i('Add membership'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "../membership/create";
                                 }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . _i('admin.EXCEL')],
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
            ['name'=>'title','data'=>'title','title'=> _i('title')],
            ['name'=>'is_active','data'=>'is_active','title'=> _i('is_active')],
            ['name'=>'price','data'=>'price','title'=> _i('price')],
            ['name'=>'duration','data'=>'duration','title'=> _i('duration')],
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
        return 'Membership_' . date('YmdHis');
    }
}
