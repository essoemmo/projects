<?php


namespace App\DataTables;


use App\Models\GameDetail;
use Illuminate\Support\Facades\App;
use App\Models\GameDetailTranslation;
use Yajra\DataTables\Services\DataTable;

class GameDetailsDataTable extends DataTable
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
            ->addColumn('delete', 'admin.game_details.btn.delete')
            ->editColumn('image', function($query){
                if($query->image == null) {
                    return _i('No Icon');
                } else {
                    return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px;!important;" align="center" src="'.asset($query->image).'">';
                }
            })
            ->rawColumns([
                'delete',
                'image',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GameDetail $model )
    {
        return $model->query()->select('game_details_translations.title as title' ,'game_details.id as id' ,'game_details.image' )
            ->leftJoin('game_details_translations','game_details_translations.game_detail_id','=','game_details.id')->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new game details'),
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
            ['name'=>'game_details.id','data'=>'id','title'=>_i('id')],
            ['name'=>'game_details_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'game_details.image','data'=>'image','title'=>_i('image')],
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
        return 'game_details_' . date('YmdHis');
    }
}
