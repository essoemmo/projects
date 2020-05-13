<?php


namespace App\DataTables;


use App\Models\Article\ArticleCategory;
use App\Models\Language;
use Yajra\DataTables\Services\DataTable;

class BlogsCatDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('edit', function ($query) {

                $html = '<a href="' . url('adminpanel/article_cat/' . $query->id . '/edit') . '" id="item_id_' . $query->id . '" class="btn btn-primary"  title="' . _i("Edit") . '">
                   <i class="ti-pencil-alt"></i></a>  &nbsp;' . '
                   <form class=" delete"  action="' . url("adminpanel/article_cat/" . $query->id) . '"  method="POST" id="deleteRow"
                   style="display: inline-block; right: 50px;" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" ' . _i('Delete') . ' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $query->lang_id) {
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="' . $query->id . '" data-lang="' . $lang->id . '"
                    style="display: block; padding: 5px 10px 10px;">' . $lang->title . '</a></li>';
                    }
                }
                $html = $html . '
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" ' . _i('Translation') . ' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    ' . $options . '
                  </ul>
                </div> ';

                return $html;
                // return '<a href="../article_cat/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> '._i('Edit').' </a>';
            })
            ->editColumn('published', function ($query) {
                return $query->published == 1 ? _i('Published') : _i('Not Published');
            })
            ->addColumn('img', function ($query) {
                // $url = asset('uploads/artcl_category/'.$query->id.'/'.$query->img_url);
                $url = asset($query->img_url);
                return '<img src="' . $url . '" style="max-width:80px; max-height:50px;" class="img-responsive img-rounded" align="center" />';
            })
            // ->addColumn('delete', 'master.article_management.category.btn.delete')
            ->rawColumns([
                'img',
                'edit',
                //'delete',
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
        $query = ArticleCategory::leftJoin('article_category_data', 'article_category_data.category_id', 'article_category.id')
            ->select('article_category.*', 'article_category_data.category_id', 'article_category_data.lang_id', 'article_category_data.source_id',
                'article_category_data.title')->where('article_category_data.source_id', null);

        return $query->where('store_id', \App\Bll\Utility::getStoreId());
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
                    [10, 25, 50, 100, -1], [10, 25, 50, trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . _i('Add Article Category') . ' ',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                                             window.location = "' . url('adminpanel/article_cat/create') . '";
                                                         }',
                    ],
//                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
//                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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
            ['name' => 'id', 'data' => 'id', 'title' => _i('ID')],
            ['name' => 'title', 'data' => 'title', 'title' => _i('Category Name')],
            ['name' => 'published', 'data' => 'published', 'title' => _i('Status')],
            ['name' => 'img', 'data' => 'img', 'title' => _i('Image')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => _i('Create Time')],
            ['name' => 'edit', 'data' => 'edit', 'title' => _i('Controll'), 'printable' => false, 'exportable' => false, 'orderable' => false, 'searchable' => false],
            //['name'=>'delete','data'=>'delete','title'=>_i('Controll'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
