<?php
namespace App\DataTables;
use App\Admin;
use App\User;
use Yajra\DataTables\Services\DataTable;
class AdminsDataTable extends DataTable
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
            ->addColumn('name', function ($query) {
                return $query['first_name'] .' '.$query['last_name'] ;
            })
            ->addColumn('edit', function ($query) {
                return '<a href="../user/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' ._i('Edit') .'</a>';
            })
            ->addColumn('delete', 'security.users.btn.delete')
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
    public function query()
    {
        return Admin::query()->orderByDesc('id');
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
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . _i('add new admin'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "../user/add";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
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
            ['name'=>'name','data'=>'name','title'=>'name'],
            ['name'=>'email','data'=>'email','title'=>'email'],
            ['name'=>'created_at','data'=>'created_at','title'=>'created_at'],
            ['name'=>'updated_at','data'=>'updated_at','title'=>'updated_at'],
            ['name'=>'edit','data'=>'edit','title'=>'edit','printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>'delete','printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admins_' . date('YmdHis');
    }
}
