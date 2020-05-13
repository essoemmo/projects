<?php

namespace App\DataTables;

use App\Models\Article\Artcl_category;
use App\Models\Article\Article;
use App\Models\Article\Article_category;
use App\Models\Category;
use App\Store;
use App\User;
use Yajra\DataTables\Services\DataTable;

class articleDataTable extends DataTable
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
//            ->editColumn('store_id', function($query) {
//                $store = Store::select(['name'])->where('id', '=', $query->store_id)->first();
//                return $store->name;
//            })
            ->editColumn('category_id', function($query) {
                $category = Artcl_category::select(['title'])->where('id', '=', $query->category_id)->first();
                return $category->title;
            })
            ->editColumn('published', function($query) {
                return $query->published == 1 ? _i('Yes') : _i('No');
            })
            ->addColumn('edit', function($query){
                return '<a href="../article/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i> '._i('Edit').' </a>';
            })
            ->addColumn('img_url', function ($query) {
//                $url = public_path("uploads/artcl_category/$query->img_url");
                $url = asset('uploads/articles/'.$query->id.'/'.$query->img_url);
                return '<img src='.$url.' border="0" class="img-responsive img-rounded" align="center" />';
            })
            ->addColumn('delete', 'admin.articles.article.btn.delete')
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
    public function query(Article $model)
    {
        return $model->query()->where('lang_id'  ,1);
    }


//    public static function lang(){
//        $langJson = [
//            "title"=> _i('title'),
//            "sZeroRecords"=> trans('admin.sZeroRecords'),
//            "sEmptyTable"=> trans('admin.sEmptyTable'),
//            "sInfoFiltered"=> trans('admin.sInfoFiltered'),
//            "sSearch"=> trans('admin.sSearch'),
//            "sUrl"=> trans('admin.sUrl'),
//            "sInfoThousands"=> trans('admin.sInfoThousands'),
//            "sLoadingRecords"=> trans('admin.sLoadingRecords'),
//            "oPaginate"=> [
//                "sFirst"=> trans('admin.sFirst'),
//                "sLast"=> trans('admin.sLast'),
//                "sNext"=> trans('admin.sNext'),
//                "sPrevious"=> trans('admin.sPrevious')
//            ],
//            "oAria"=> [
//                "sSortAscending"=> trans('admin.sSortAscending'),
//                "sSortDescending"=> trans('admin.sSortDescending')
//            ]
//        ];
//        return $langJson;
//    }



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
                        'text' => '<i class="fa fa-plus"></i> '._i('Add Article').' ',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                                             window.location = "../article/create";
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
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'title','data'=>'title','title'=>_i('Title')],
            ['name'=>'img_url','data'=>'img_url','title'=>_i('Image')],
//            ['name'=>'store_id','data'=>'store_id','title'=>_i('store Name')],
            ['name'=>'category_id','data'=>'category_id','title'=>_i('Category Name')],
            ['name'=>'published','data'=>'published','title'=>_i('Published')],
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
        return 'article_' . date('YmdHis');
    }
}
