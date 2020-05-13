<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class SliderDataTable extends DataTable
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
            ->addColumn('delete', 'admin.slider.btn.delete')
            ->editColumn('publish', function($query){
                if ($query->publish == 0){
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-danger btn-outline-danger">' . _i('Not Published') . '
                        <input type="hidden" id="slider_id" name="slider_id" value="'. $query->id .'">
                     </a>';
                }else{
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-primary btn-outline-primary">' . _i('Publish') . '
                        <input type="hidden" id="slider_id" name="slider_id" value="'. $query->id .'">
                    </a>';
                }
            })
            ->editColumn('image', function($query){
                return '<img class="img-fluid"  style="max-height: 150px; max-height: 70px; !important; align="center" src="'.asset($query->image).'">';
            })
            ->rawColumns([
                'delete',
                'image',
                'publish',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {
        return $model->query()->select('sliders_translations.title as title','sliders_translations.description as description','sliders.image as image','sliders.publish as publish','sliders.id as id','sliders.url as url')
            ->leftJoin('sliders_translations','sliders_translations.slider_id','=','sliders.id')->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new slider'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "sliders/create";
                         }',
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
            ['name'=>'id','data'=>'id','title'=>_i('id')],
            ['name'=>'sliders_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'sliders_translations.description','data'=>'description','title'=>_i('description')],
            ['name'=>'image','data'=>'image','title'=>_i('image')],
            ['name'=>'publish','data'=>'publish','title'=>_i('Publish')],
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
        return 'Slider_' . date('YmdHis');
    }
}
