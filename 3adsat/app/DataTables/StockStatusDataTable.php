<?php


namespace App\DataTables;


use App\Models\Language;
use App\Models\stockStatus;
use Yajra\DataTables\Services\DataTable;

class StockStatusDataTable extends DataTable
{

    public $lang = "en_US";
    public $language_id;

    public function __construct() {
        $this->language_id = checknotsessionlang();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('language_id' , function($query){
                $language = Language::select(['name'])->where('id' , $query->language_id)->first();
                return _i($language->name) ;
            })
            ->addColumn('delete', 'admin.stock_status.btn.delete')
            ->rawColumns([
                'language_id',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $stockStatuses = StockStatus::getByLanguage($this->language_id);
        return $stockStatuses;
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
                    [10,25,50,100,-1],[10,25,50, _i('all records')]
                ],
                'buttons' => [
                    [
//                        'text' => '<i class="ti-plus"></i> ' . _i('add new bank'),
//                        'className' => 'btn btn-lg  btn-success create',
//                        'action' => 'function( e, dt, button, config){
//                                     window.location = "transferBank/create";
//                                 }',
                    ],
//                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
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
                //                "language" =>  self::lang(),
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
            ['name'=>'name','data'=>'name','title'=>_i('Title')],
            ['name'=>'language_id','data'=>'language_id','title'=>_i('Language')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('created_at')],
            ['name'=>'delete','data'=>'delete','title'=> _i('Edit/Delete') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_statuses' . date('YmdHis');
    }

}