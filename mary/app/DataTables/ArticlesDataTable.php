<?php

namespace App\DataTables;

use App\Models\Article;
use App\Models\Article_data;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ArticlesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)


            ->addColumn('img_url', function ($query) {
                $url = asset('uploads/articles/'.$query->img_url);
                return '<img src='.$url.' border="0" class="img-responsive img-rounded" align="center" style="width:200px;" />';
            })

            ->editColumn('category_id', function (Article $article) {
                    return $article->catArt->title;
            })
            ->editColumn('title', function($query) {

                $art = Article_data::select(['title'])->where('article_id', '=', $query->id)->first();
                return $art['title'];
            })
            ->editColumn('published', function($query) {
                return $query->publishe === 'true' ? _i('Yes') : _i('No');
            })
        ->addColumn('edit', function ($query) {
            $url = asset('uploads/articles/'.$query->img_url);

            $art = Article_data::select(['title','content'])->where('article_id', '=', $query->id)->first();
            if (auth()->user()->can('Article-Edit')){
                return '<button data-title="'.$art['title'].'" data-lang="'.$query->lang_id.'" data-content="'.$art['content'].'" data-id ="'.$query->id.'" data-category ="'.$query->category_id.'"  data-img="'.$url.'"  data-published="'.$query->publishe.'"  data-created ="'.date('m/d/Y',strtotime($query->created)).'"    data-toggle="modal" data-target="#edit"  class="btn btn-sm btn-success edit"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';

            }else{
                return '<button class="btn btn-sm btn-success disabled"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';

            }
    })
        ->addColumn('delete', 'admin.articles.btn.delete')
        ->rawColumns([
            'img_url',
            'edit',
            'delete',
        ]);
    }


    public function query()
    {
        return Article::query();
    }
    public static function lang()
    {
        $langJson = [
            "sProcessing" => _i('Processing'),
            "sZeroRecords" => _i('Zero Records'),
            "sEmptyTable" => _i('Empty Table'),
            "sInfoFiltered" => _i('Info Filtered'),
            "sSearch" => _i('Search'),
            "sUrl" => _i('Url'),
            "sInfoThousands" => _i('Info Thousands'),
            "sLoadingRecords" => _i('Loading Records'),
            "oPaginate" => [
                "sFirst" => _i('First'),
                "sLast" => _i('Last'),
                "sNext" => _i('Next'),
                "sPrevious" => _i('Previous')
            ],
            "oAria" => [
                "sSortAscending" => _i('Sort Ascending'),
                "sSortDescending" => _i('Sort Descending')
            ]
        ];
//        dd($langJson);
        return $langJson;
    }
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
//                    ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100],[10,25,50, _i('all_record')]
                ],
                'buttons' => [
//                    [
//                        'text' => '<i class="fa fa-plus"></i> ' . _i('Create New memebrs'),
//                        'className' => 'btn btn-sm btn-primary create',
////                        'action' => 'function( e, dt, button, config){
////                                 }',
//                    ],

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
            ]);    }


    protected function getColumns()
    {
        return [
            ['name'=>'id',
                'data'=>'id',
                'title'=> _i('id')
            ],
            ['name'=>'img_url',
                'data'=>'img_url',
                'title'=> _i('image')
            ],
            ['name'=>'category_id',
                'data'=>'category_id',
                'title'=> _i('Category')
            ],
            ['name'=>'title',
                'data'=>'title',
                'title'=> _i('title')
            ],
            ['name'=>'published',
                'data'=>'published',
                'title'=> _i('published')
            ],


            ['name'=>'edit',
                'data'=>'edit',
                'title'=> _i('edit'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
            ['name'=>'delete',
                'data'=>'delete',
                'title'=> _i('delete'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
            ],
        ];
    }


    protected function filename()
    {
        return 'Articles_' . date('YmdHis');
    }
}
