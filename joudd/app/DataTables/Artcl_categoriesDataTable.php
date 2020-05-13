<?php

namespace App\DataTables;

use App\Models\Article\Artcl_category;
use App\User;
use Yajra\DataTables\Services\DataTable;

class Artcl_categoriesDataTable extends DataTable
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
                return '<a href="../artcle_category/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i> '._i('Edit').' </a>';
            })
            ->addColumn('img_url', function ($query) {
//                $url = public_path("uploads/artcl_category/$query->img_url");
                $url = asset('uploads/artcl_category/'.$query->id.'/'.$query->img_url);
                return '<img src='.$url.' border="0" class="img-responsive img-rounded" align="center" />';
            })
            ->addColumn('delete', 'admin.articles.artcl_category.btn.delete')
            ->rawColumns([
                'img_url',
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
    public function query(Artcl_category $model)
    {
        return $model->query()->where('lang_id'  ,1);
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
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> '._i('Add Article Category').' ',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                                             window.location = "../artcle_category/create";
                                                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>' ." ".  _i('Export PDF')],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file-text"></i> ' . _i('Export EXCEL')],
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
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'title','data'=>'title','title'=>_i('Category Name')],
            ['name'=>'img_url','data'=>'img_url','title'=>_i('Image')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('Create Time')],
            ['name'=>'edit','data'=>'edit','title'=>_i('Edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>_i('Delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Artcl_categories_' . date('YmdHis');
    }
}
