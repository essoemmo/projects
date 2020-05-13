<?php

namespace App\DataTables;

use App\Models\Settings\homepage;
use Yajra\DataTables\Services\DataTable;

class homepageDataTable extends DataTable
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
                return '<button data-template="'.$query->template.'" data-category="'.$query->category_id.'" data-sort="'.$query->sort.'" data-id="'.$query->id.'" class="btn btn-success" id="edit" data-target="#modal-edit" data-toggle="modal"><i class="ti-pencil-alt"></i></button>';
            })
            ->editColumn('template', function($query){
                if ($query->template == 0){
                    return _i('first');
                }elseif($query->template == 1){
                    return _('second');
                }else{
                    return null;
                }
            })
            ->addColumn('delete', 'admin.settings.homepage.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\homepage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(homepage $model)
    {
        $homepage = homepage::query()->select('store_homepages.id as id','store_homepages.category_id as category_id','categories.title as category','store_homepages.sort as sort','store_homepages.template as template','store_homepages.store_id as store_id')
        ->leftJoin('categories','categories.id','=','store_homepages.category_id')->where('store_homepages.store_id',session('StoreId'));
        return $homepage;
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
                        'text' => '<i class="ti-plus"></i> ' . _i('add new homepage'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
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
            ['name'=>'id','data'=>'id','title'=> _i('id')],
            ['name'=>'category','data'=>'category','title'=> _i('category')],
            ['name'=>'sort','data'=>'sort','title'=> _i('sort')],
            ['name'=>'template','data'=>'template','title'=> _i('template')],
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
        return 'homepage_' . date('YmdHis');
    }
}
