<?php

namespace App\DataTables;

use App\Models\product\stores;
use App\User;
use Yajra\DataTables\Services\DataTable;

class storesDataTable extends DataTable
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
                return '<a href="store/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' .'Edit' .'</a>';
            })
            ->addColumn('delete', 'admin.stores.btn.delete')
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
    public function query(stores $stores)
    {
        $stores = stores::query()
            ->join('users','users.id','=','stores.owner_id')
            ->join('memberships','memberships.id','=','stores.membership_id')
            ->select('stores.id as id','stores.title as title','stores.domain as domain','stores.image as image','users.name as owner_id','memberships.title as membership_id','stores.created_at as created_at');
        return $stores;
//        return $stores->query()->orderByDesc('id')->with('user','membership','language','parent');
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
                    [10,25,50,100,-1],[10,25,50,_i('all record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . 'add new stores',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "store/create";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
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
            ['name'=>'title','data'=>'title','title'=> _i('title')],
            ['name'=>'domain','data'=>'domain','title'=> _i('domain')],
            ['name'=>'owner_id','data'=>'owner_id','title'=> _i('user')],
            ['name'=>'membership_id','data'=>'membership_id','title'=> _i('membership')],
            ['name'=>'created_at','data'=>'created_at','title'=> _i('created_at')],
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
        return 'stores_' . date('YmdHis');
    }
}
