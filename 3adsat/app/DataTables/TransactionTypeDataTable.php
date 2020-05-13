<?php

namespace App\DataTables;

use App\Models\transaction_types;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class TransactionTypeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('delete', 'admin.transactionType.btn.delete')
        ->editColumn('main', function ($query){
            if ($query->main == 0){
                return 'backend';
            }elseif ($query->main == 1){
                return 'fronend';
            }
        })
        ->rawColumns([
            'delete',
        ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\TransactionType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(transaction_types $model)
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
                    [10,25,50,100,-1],[10,25,50, _i('all records')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . _i('add new Transaction Type'),
                        'className' => 'btn btn-lg  btn-success create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "transactionType/create";
                                 }',
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
            ['name'=>'title','data'=>'title','title'=>_i('title')],
            ['name'=>'code','data'=>'code','title'=>_i('code')],
            ['name'=>'main','data'=>'main','title'=>_i('main')],
            ['name'=>'status','data'=>'status','title'=>_i('transaction status')],
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
        return 'TransactionType_' . date('YmdHis');
    }
}
