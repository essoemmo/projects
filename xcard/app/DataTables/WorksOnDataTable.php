<?php


namespace App\DataTables;


use App\Models\WorkOn;
use Yajra\DataTables\Services\DataTable;

class WorksOnDataTable extends DataTable
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
            ->addColumn('delete', 'admin.works_on.btn.delete')
            ->editColumn('icon', function($query){
                if($query->icon == null) {
                    return _i('No Icon');
                } else {
                    return '<img class="img-fluid"  style="max-height: 150px; max-height: 70px; !important; align="center" src="'.asset($query->icon).'">';
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
     * @param \App\SiteLanguage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WorkOn $model)
    {
        return $model->newQuery();
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new work on'),
                        'className' => 'btn btn-primary create',
                    ],
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
            ['name'=>'title','data'=>'title','title'=>_i('title')],
            ['name'=>'icon','data'=>'icon','title'=>_i('Icon')],
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
        return 'works_on_' . date('YmdHis');
    }
}