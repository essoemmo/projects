<?php

namespace App\DataTables;

use App\bank;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class bankDataTable extends DataTable
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
            ->addColumn('delete', 'admin.banks.btn.delete')
            ->editColumn('edit', function ($query){
                $img = asset('uploads/banks/'.$query->image);
                return '<a href="#" data-id="'.$query->id.'"  data-name="'.$query->name.'" data-code="'.$query->code.'" data-image="'.$img.'" data-lang="'.$query->lang_id.'" data-toggle="modal" data-target="#exampleModal" class="btn btn-info btn-sm edit"><i class="fa fa-edit"></i></a>';
            })
            ->editColumn('image', function($query){
                if($query->image == null) {
                    return _i('No image');
                } else {
                    return '<img class="img-fluid" style="width: 150px" src="'.asset('uploads/banks/'.$query->image).'">';
                }
            })
            ->rawColumns([
                'edit',
                'delete',
                'image',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\bank $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return \App\Models\Bank::
            leftJoin('bank_data','banks.id','=','bank_data.bank_id')->
            select(['banks.*','bank_data.name','bank_data.lang_id','bank_data.source_id'])
            ->where('bank_data.source_id',null)
            ;
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new Bank'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                         
                         }',
                    ],
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
            ['name'=>'id','data'=>'id','title'=>_i('id')],
            ['name'=>'name','data'=>'name','title'=>_i('name')],
            ['name'=>'image','data'=>'image','title'=>_i('image')],
            ['name'=>'edit','data'=>'edit','title'=>_i('edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>_i('delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'bank_' . date('YmdHis');
    }
}
