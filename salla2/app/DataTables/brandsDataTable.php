<?php

namespace App\DataTables;

use App\Models\Brand;
use Yajra\DataTables\Services\DataTable;

class brandsDataTable extends DataTable
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
   
            ->addColumn('image', function ($query) {
                $url = asset('uploads/brands/'.$query->id.'/'.$query->image);
                return '<img src='.$url.' border="0" class="img-responsive" style="width:150px" align="center" />';
            })

            ->addColumn('action', function ($query) {
                return '<a href="brands/'.$query->id.'/edit" target="_blank"
                                class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}">
                                <i class="ti-pencil-alt"></i>
                            </a>' . "&nbsp;&nbsp;&nbsp;" .
                '<a href="brands/' . $query->id . '/delete" class="btn waves-effect waves-light btn btn-danger text-center" title="' . _i("Delete") . '"><i class="ti-trash center"></i> </a>';
            })
        ->rawColumns([
     
            'image',
            'action',
        ])
        
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Brand $model)
    {
        return $model->query()->orderByDesc('id')->where('store_id',session('StoreId'));
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
//                'lengthMenu' => [
//                    [10,25,50,100,-1],[10,25,50,_i('admin.all_record')]
//                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . _i('add new brand'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                             window.location = "brands/create";
                                         }',
                    ],
//                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                ],
//                "initComplete" => "function () {
//                                    this.api().columns([]).every(function () {
//                                        var column = this;
//                                        var input = document.createElement(\"input\");
//                                        $(input).appendTo($(column.footer()).empty())
//                                        .on('keyup', function () {
//                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
//
//                                            column.search(val ? val : '', true, false).draw();
//                                        });
//                                    });
//                                    }",
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
            ['name'=>'name','data'=>'name','title'=>_i('Name')],
            ['name'=>'image','data'=>'image','title'=> _i('Brand Image')],
            ['name'=>'created_at','data'=>'created_at','title'=>'created_at'],
            ['name'=>'edit','data'=>'edit','title'=> _i('Edit/Delete') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'brands_' . date('YmdHis');
    }
}
