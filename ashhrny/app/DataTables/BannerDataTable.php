<?php

namespace App\DataTables;

use App\Models\Banner;
use Yajra\DataTables\Services\DataTable;

class BannerDataTable extends DataTable
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
            ->addColumn('delete', 'admin.banner.btn.delete')
            ->editColumn('publish', function($query){
                if ($query->publish == 0){
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-danger btn-outline-danger">' . _i('Not Published') . '
                        <input type="hidden" id="banner_id" name="banner_id" value="'. $query->id .'">
                     </a>';
                }else{
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-primary btn-outline-primary">' . _i('Publish') . '
                        <input type="hidden" id="banner_id" name="banner_id" value="'. $query->id .'">
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
            ->editColumn('image', function($query){
                return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="'.asset($query->image).'">';
            })
            ->rawColumns([
                'delete',
                'image',
                'sort',
                'publish',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\BannerDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Banner $model)
    {
        return $model->query();
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new banner'),
                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "sliders/create";
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
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'sort','data'=>'sort','title'=>_i('Sort')],
            ['name'=>'image','data'=>'image','title'=>_i('Image')],
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
        return 'Banner_' . date('YmdHis');
    }
}
