<?php

namespace App\DataTables;

use App\Models\NotifyTemplate;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class NotifyTemplateDataTable extends DataTable
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
            ->addColumn('edit', 'admin.notify_setup.btn.delete')
            ->rawColumns([
                'edit',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\NotifyTemplate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NotifyTemplate $model)
    {
        return $model->query()->select('notify_templates_translations.title as title' ,'notify_templates.id as id','notify_templates.code as code')
            ->leftJoin('notify_templates_translations','notify_templates_translations.notify_template_id','=','notify_templates.id')
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
//                    [
//                        'text' => '<i class="ti-plus"></i> ' . _i('create new currency'),
//                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "currency/create" ;
//
//                         }',
//                    ],
//                    ['extend' => 'print','className' => 'btn btn-primary btn-outline-primary' , 'text' => '<i class="ti-printer"></i>'],
//                    ['extend' => 'excel','className' => 'btn btn-success btn-outline-success' , 'text' => '<i class="ti-clipboard"></i>'],
//                    ['extend' => 'pdf','className' => 'btn btn-info btn-outline-info' , 'text' => '<i class="ti-file"></i>']
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
            ['name'=>'notify_templates.id','data'=>'id','title'=>_i('id')],
            ['name'=>'notify_templates_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'notify_templates.code','data'=>'code','title'=>_i('Code')],
            ['name'=>'edit','data'=>'edit','title'=>_i('Edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'NotifyTemplate_' . date('YmdHis');
    }
}
