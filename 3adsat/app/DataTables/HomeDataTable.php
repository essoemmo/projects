<?php

namespace App\DataTables;

//use App\HomeDataTable;
use App\Models\homepage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class HomeDataTable extends DataTable
{

    public function dataTable($query)
    {
//        dd(checknotsessionlang());
        return datatables($query)
            ->addColumn('category', function($query){
                $category = DB::table('category_descriptions')->
                where('category_id',$query->category_id)
                    ->where('language_id',checknotsessionlang())
                    ->first();
                return $category->name;
            })
            ->addColumn('edit', function($query){
                return '<button data-template="'.$query->template.'" data-category="'.$query->category_id.'" data-sort="'.$query->sort.'" data-id="'.$query->id.'" class="btn btn-success" id="edit" data-target="#modal-edit" data-toggle="modal"><i class="ti-pencil-alt"></i></button>';
            })
            ->editColumn('template', function($query){
                if ($query->template == 0){
                    return _i('first');
                }elseif($query->template == 1){
                    return _('second');
                }elseif($query->template == 2){
                    return _('third');
                }elseif($query->template == 3){
                    return _('fouth');
                }else{
                    return null;
                }
            })
            ->addColumn('delete', 'admin.setting.homepage.btn.delete')
            ->rawColumns([
                'category',
                'edit',
                'delete',
            ]);
    }


    public function query()
    {
//        $homepage = homepage::query()->select('store_homepages.id as id','store_homepages.category_id as category_id','categories.title as category','store_homepages.sort as sort','store_homepages.template as template')
//            ->leftJoin('categories','categories.id','=','store_homepages.category_id');
        return homepage::query();
    }


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
//                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
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
        return 'home_' . date('YmdHis');
    }
}
