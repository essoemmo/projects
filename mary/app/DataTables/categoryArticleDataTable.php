<?php

namespace App\DataTables;

use App\Models\Artcl_category;
use App\User;
use Yajra\DataTables\Services\DataTable;

class categoryArticleDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('img_url', function ($query) {
                $url = asset('uploads/articles/'.$query->img_url);
                return '<img src='.$url.' border="0" class="img-responsive img-rounded" align="center" style="width:200px;" />';
            })
            ->addColumn('edit', function ($query) {
                $url = asset('uploads/articles/' . $query->img_url);
                if (auth()->user()->can('ArticleCategory-Edit')){
                    return '<button  data-id ="' . $query->id . '" data-lang= "' . $query->lang_id . '" data-published="' . $query->publishe . '" data-title ="' . $query->title . '"  data-image="' . $url . '"  data-toggle="modal" data-target="#edit"  class="btn btn-sm btn-success edit"><i class="fa fa-edit"></i> ' . _i('edit') . '</button>';
            }else{
                    return '<button class="btn btn-sm btn-success disabled"><i class="fa fa-edit"></i> ' . _i('edit') . '</button>';

                }
            })
            ->addColumn('delete', 'admin.articles.category.btn.delete')
            ->rawColumns([
                'img_url',
                'edit',
                'delete',
            ]);
    }


    public function query()
    {
        return Artcl_category::query()->where('source_id','=',null);

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
            ]);
    }


    protected function getColumns()
    {
        return [
            ['name'=>'id',
                'data'=>'id',
                'title'=> _i('id')
            ],
            ['name'=>'title',
                'data'=>'title',
                'title'=> _i('title')
            ],
            ['name'=>'img_url',
                'data'=>'img_url',
                'title'=> _i('image')
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categoryArticleController_' . date('YmdHis');
    }
}
