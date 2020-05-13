<?php


namespace App\DataTables;


use App\Models\Rating;
use App\Models\RatingTranslation;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class RatingDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('delete', 'admin.ratings.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }


    public function query(Rating $model)
    {
        return $model->query()->select('ratings_translations.title as title' ,'ratings.id as id','ratings.created_at')
            ->leftJoin('ratings_translations','ratings_translations.rating_id','=','ratings.id')
            ->where('locale',App::getLocale());
    }


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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new rating level'),
                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "genres/create";
//                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary btn-outline-primary' , 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success btn-outline-success' , 'text' => '<i class="ti-clipboard"></i>'],
                    ['extend' => 'pdf','className' => 'btn btn-info btn-outline-info' , 'text' => '<i class="ti-file"></i>']
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


    protected function getColumns()
    {
        return [
            ['name'=>'ratings.id','data'=>'id','title'=>_i('id')],
            ['name'=>'ratings_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'ratings.created_at','data'=>'created_at','title'=>_i('created at')],
            ['name'=>'delete','data'=>'delete','title'=>_i('edit/delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    protected function filename()
    {
        return 'Ratings_' . date('YmdHis');
    }


}