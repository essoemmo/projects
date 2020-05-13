<?php


namespace App\DataTables;


use App\Models\Platform;
use App\Models\PlatformTranslation;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class PlatFormDataTable extends DataTable
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
            ->addColumn('delete', 'admin.platform.btn.delete')
            ->editColumn('image', function($query){
                if($query->image == null) {
                    return _i('No Icon');
                } else {
                    return '<img class="img-fluid"  style="max-height: 150px; max-height: 70px; !important; align="center" src="'.asset($query->image).'">';
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
    public function query(Platform $model )
    {
        return $model->query()->select('platforms_translations.title as title' ,'platforms.id as id' ,'platforms.created_at','platforms.image')
            ->leftJoin('platforms_translations','platforms_translations.platform_id','=','platforms.id')->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new platform'),
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
            ['name'=>'platforms.id','data'=>'id','title'=>_i('id')],
            ['name'=>'platforms_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'platforms.image','data'=>'image','title'=>_i('image')],
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
        return 'platforms_' . date('YmdHis');
    }
}
