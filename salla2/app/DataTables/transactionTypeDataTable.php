<?php

namespace App\DataTables;

use App\Models\product\transaction_types;
use App\User;
use Yajra\DataTables\Services\DataTable;

class transactionTypeDataTable extends DataTable
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
            ->addColumn('delete', 'admin.transaction.transactionType.btn.delete')
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
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
//        if (auth()->user()->hasRole( \App\Help\Utility::Store)){
            return transaction_types::query()->orderByDesc('id')->where('store_id',session('StoreId'));
//        }else{
//            return transaction_types::query()->orderByDesc('id')->where('store_id',null);
//        }
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
                        'text' => '<i class="ti-plus"></i> ' . 'add new transactionType',
                        'className' => 'btn btn-primary create',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
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
        return 'transactionType_' . date('YmdHis');
    }
}
