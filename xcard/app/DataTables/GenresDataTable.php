<?php


namespace App\DataTables;


use App\Models\Genre;
use App\Models\GenreTranslation;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class GenresDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('delete', 'admin.genres.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Genre $model )
    {
        return $model->query()->select('genre_translations.title as title' ,'genre.id as id' ,'genre.created_at')
            ->leftJoin('genre_translations','genre_translations.genre_id','=','genre.id')->where('locale',App::getLocale());
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
                    [10,25,50,100,-1],[10,25,50,_i('all record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . _i('create new genre'),
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'genre.id','data'=>'id','title'=>_i('id')],
            ['name'=>'genre_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'genre.created_at','data'=>'created_at','title'=>_i('created at')],
            ['name'=>'delete','data'=>'delete','title'=>_i('edit/delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'genre_' . date('YmdHis');
    }


}
