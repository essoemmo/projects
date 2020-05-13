<?php

namespace App\DataTables;


use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
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
                return '<a href="users/'.$query->id.'/edit" class="btn btn-sm btn-success"><i class="ti-pencil-alt"></i> ' . _i('edit') .'</a>';
            })
            ->addColumn('delete', 'admin.admins.btn.delete')
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
        $user = User::query();
           return $user->orderByDesc('id')->where('guard','admin');
    }
    public static function lang(){
        $langJson = [
            "sProcessing"=> _i('Processing'),
            "sZeroRecords"=> _i('Zero Records'),
            "sEmptyTable"=> _i('Empty Table'),
            "sInfoFiltered"=> _i('Info Filtered'),
            "sSearch"=> _i('Search'),
//            "sUrl"=> _i('Url'),
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
//                    ->addAction(['width' => '80px'])
//                    ->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'lengthMenu' => [
                            [10,25,50,100],[10,25,50, _i('all Record')]
                        ],
                        'buttons' => [

                            [
                                'text' => '<i class="ti-plus"></i> ' . _i('Create New User'),
                                'className' => 'btn btn-lg  btn-success create',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "users/create";
                                 }',
                            ],
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'id','data'=>'id','title'=> _i('id')],
            ['name'=>'name','data'=>'name','title'=> _i('username')],
            ['name'=>'email','data'=>'email','title'=> _i('email')],
            ['name'=>'guard','data'=>'guard','title'=> _i('type')],
//            ['name'=>'created_at','data'=>'created_at','title'=>_i('created_at')],
//            ['name'=>'updated_at','data'=>'updated_at','title'=>_i('updated_at')],
//            ['name'=>'permission','data'=>'permission','title'=>_i('permission') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'AdminDataable_' . date('YmdHis');
    }
}
