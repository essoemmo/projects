<?php

namespace App\DataTables;

use App\Models\Story;

use Yajra\DataTables\Services\DataTable;

class StoriesDataTabelsDataTable extends DataTable
{

    public function dataTable($query)
    {

        return datatables($query)

            ->editColumn('title',function ($query){
                return $query->title;
            })
            ->editColumn('type',function ($query){
                if ($query->type == 'inside'){
                    return _i('inside on web');

                }else{
                    return _i('outside on web');
                }
            })
            ->addColumn('edit', function ($query) {
                if (auth()->user()->can('stories-edit')){
                    return '<a href="'.route('Stories.edit',$query->id).'"  data-id ="'.$query->id.'" data-title ="'.$query->title.'"  data-lang="'.$query->lang_id.'" data-content="'.$query->content.'" data-user="'.$query->user_id.'" data-publish="'.$query->published.'"  class="btn btn-sm btn-success"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';
                }else{
                    return '<button class="btn btn-sm btn-success disabled"><i class="fa fa-edit"></i> ' . _i('edit') .'</button>';

                }

            })
            ->addColumn('view', function ($query) {
                return '<button  data-id ="'.$query->id.'" data-title ="'.$query->title.'"  data-lang="'.$query->lang_id.'" data-content="'.$query->content.'" data-user="'.$query->user->username.'" data-create = "'.$query->created_at->toFormattedDateString().'" data-publish="'.$query->published.'"   data-toggle="modal" data-target="#view"  class="btn btn-sm btn-warning view"><i class="fa fa-search"></i> ' . _i('view') .'</button>';
            })
            ->addColumn('delete', 'admin.stories.btn.delete')
            ->rawColumns([
                'title',
                'view',
                'edit',
                'delete',

            ]);
    }

    public function query()
    {

        $story =  Story::
            leftJoin('story_datas','stories.id','=','story_datas.stories_id')->
            leftJoin('user_story','stories.id','=','user_story.store_id')
            ->select(['stories.*',
                'story_datas.title',
                'story_datas.content',
                'story_datas.lang_id',
                'user_story.type'
            ])
            ->where('story_datas.lang_id',getLang())
            ;

        return $story;


    }

    public static function lang(){
        $langJson = [
            "sProcessing"=> _i('Processing'),
            "sZeroRecords"=> _i('Zero Records'),
            "sEmptyTable"=> _i('Empty Table'),
            "sInfoFiltered"=> _i('Info Filtered'),
            "sSearch"=> _i('Search'),
            "sUrl"=> _i('Url'),
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

            [

                'data'=>'title',
                'title'=> _i('title')
            ],

            [
                'name'=>'published',
                'data'=>'published',
                'title'=> _i('published')
            ],

            [
                'name'=>'type',
                'data'=>'type',
                'title'=> _i('type')
            ],



            ['name'=>'view',
                'data'=>'view',
                'title'=> _i('show'),
                'printable'=>false,
                'exportable'=>false,
                'orderable'=>false,
                'searchable'=>false
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
        return 'StoriesDataTabels_' . date('YmdHis');
    }
}
