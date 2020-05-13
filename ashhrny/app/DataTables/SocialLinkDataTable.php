<?php

namespace App\DataTables;

use App\Models\Social_link;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class SocialLinkDataTable extends DataTable
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
            ->addColumn('delete', 'admin.social_link.btn.delete')
            ->editColumn('icon', function($query){
                if($query->icon == null) {
                    return _i('No Icon');
                } else {
                   // return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="'.asset($query->icon).'">';
                    return '<i class="fa '.$query->icon.'"></i>';
                }
            })
            ->rawColumns([
                'delete',
                'icon',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SocialLinkDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Social_link $model)
    {
        return $model->query()->select('social_links_translations.title as title' ,'social_links.id as id' ,'social_links.icon')
            ->leftJoin('social_links_translations','social_links_translations.social_id','=','social_links.id')
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new social link'),
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
            ['name'=>'social_links.id','data'=>'id','title'=>_i('id')],
            ['name'=>'social_links_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'social_links.icon','data'=>'icon','title'=>_i('icon')],
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
        return 'SocialLink_' . date('YmdHis');
    }
}
