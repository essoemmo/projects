<?php

namespace App\DataTables;

use App\Models\product\bank_transfer;
use App\User;
use Yajra\DataTables\Services\DataTable;

class BankTransferDataTable extends DataTable
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
            ->addColumn('edit', function ($query) {
                return '<a href="transferBank/'.$query->id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> ' ._i('Edit') .'</a>';
            })
            ->addColumn('logo', function ($query) {
                $url = asset($query->logo);
                return '<img src='.$url.' border="0" class="img-responsive" style="max-width:100px; max-height:100px;" align="center" />';
            })
            ->addColumn('delete', 'admin.bank.btn.delete')
            ->rawColumns([
                'edit',
                'logo',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(bank_transfer $model)
    {
//        if (auth()->user()->hasRole( \App\Help\Utility::Store)){
            return $model->query()->orderByDesc('id')->where('store_id',session('StoreId'));
//        }else{
//            return $model->query()->orderByDesc('id')->where('store_id',null);
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
                                'text' => '<i class="ti-plus"></i> ' . _i('add new bank'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){
                                     window.location = "transferBank/create";
                                 }',
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
            ['name'=>'title','data'=>'title','title'=>_i('Title')],
            ['name'=>'holder_name','data'=>'holder_name','title'=>_i('holder name')],
            ['name'=>'iban','data'=>'iban','title'=> _i('iban')],
            ['name'=>'holder_number','data'=>'holder_number','title'=>_i('holder number')],
            ['name'=>'logo','data'=>'logo','title'=> _i('logo')],
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
        return 'BankTransfer_' . date('YmdHis');
    }
}
