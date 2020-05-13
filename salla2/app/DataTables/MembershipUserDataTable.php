<?php

namespace App\DataTables;

use App\membershipUser;
use App\User;
use Yajra\DataTables\Services\DataTable;

class MembershipUserDataTable extends DataTable
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
                return '<a href="../membership/user_membership/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> edit</a>';
            })
            ->addColumn('duration',function ($query){
                 return $query->membership->duration .' year';
            })
            ->addColumn('delete', 'security.membership.user_membership.btn.delete')
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
    public function query(membershipUser $membershipUser)
    {
        return $membershipUser->query()->with('membership','user');
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
                                'text' => '<i class="ti-plus"></i> Add User membership',
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "../../membership/user_membership/create";
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
            ['name'=>'id','data'=>'id','title'=> _i('id')],
            ['name'=>'user','data'=>'user.name','title'=> _i('user')],
            ['name'=>'membership','data'=>'membership.title','title'=> _i('membership')],
            ['name'=>'price','data'=>'price','title'=> _i('price')],
            ['name'=>'created','data'=>'created','title'=> _i('created')],
            ['name'=>'expire_at','data'=>'expire_at','title'=> _i('expire_at')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MembershipUser_' . date('YmdHis');
    }
}
