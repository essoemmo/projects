<?php

namespace App\DataTables;

use App\Models\Slider;
use App\User;
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
            ->order(function ($query) {
                $query->orderBy('sort', 'asc');
            })
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
            ->editColumn('sort', function($query){
                $html = ' <div class="inline"> <div class="pull-left "> '.$query['sort'].'</div>
                    <div class="pull-right"><a href="javascript:void(0)" class="btn btn-icon btn-sm sort_hight " data-id="'.$query['id'].'"   title="' . _i("Edit") . '">
                   <i class="fa fa-arrow-up "></i></a> 
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm sort_bottom" data-id="'.$query['id'].'" title="' . _i("Edit") . '">
                   <span class="text-red" style="color: red;"><i class="fa  fa-arrow-down "></i></span></a> </div> </div>
                    ';
                return $html;
            })
            ->editColumn('user_id', function($query){
                $user = User::where('id' , $query->user_id)->first();
                return  $user['first_name']." ".$user['last_name'];
            })
            ->rawColumns([
                'delete',
                'user_id',
                'sort',
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
        return $model->query()->select('sliders_translations.title as title','sliders.alt_image as alt_image','sliders.id as id',
            'sliders.user_id as user_id','sliders.sort as sort' ,'sliders.publish as publish')
            ->leftJoin('sliders_translations','sliders_translations.slider_id','=','sliders.id')
            ->where('locale',App::getLocale());
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
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'sliders_translations.title','data'=>'title','title'=>_i('Title')],
            ['name'=>'sliders.user_id','data'=>'user_id','title'=>_i('User')],
            ['name'=>'sliders.sort','data'=>'sort','title'=>_i('Sort')],
            ['name'=>'publish','data'=>'publish','title'=>_i('Status')],
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
