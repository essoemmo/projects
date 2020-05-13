<?php

namespace App\DataTables;

use App\Bll\Utility;
use App\Models\Category;
use App\Models\product\product_details;
use App\Models\product\products;
use App\Models\Product_type;
use App\Store;
use App\User;
use function foo\func;
use Yajra\DataTables\Services\DataTable;

class productTableDataTable extends DataTable
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
            ->addColumn('edit', function($query){
                return '<a href="../product/'.$query->prod_id.'/edit" class="btn btn-success"><i class="ti-pencil-alt"></i> '._i('edit').'</a>';
            })
            ->addColumn('delete', 'admin.products.product.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(product_details $product_details)
    {
            return product_details::query()->select('product_details.id as id','products.id as prod_id','product_details.title as title','product_details.description as description','products.max_count as max_count','products.price as price','products.discount as discount','products.sku as sku','product_details.created_at as created_at')
                ->join('products','products.id','=','product_details.product_id')
                ->where('products.store_id',Utility::getStoreId());
        
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
                        'text' => '<i class="ti-plus"></i> Add Product',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "../product";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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
            ['name'=>'id','data'=>'id','title'=> _i('id')],
            ['name'=>'title','data'=>'title','title'=> _i('title')],
            ['name'=>'description','data'=>'description','title'=> _i('product description')],
            ['name'=>'sku','data'=>'sku','title'=> _i('sku')],
            ['name'=>'max_count','data'=>'max_count','title'=> _i('max_count')],
            ['name'=>'price','data'=>'price','title'=> _i('price')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('create time')],
            ['name'=>'edit','data'=>'edit','title'=> _i('show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=> _i('delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productTable_' . date('YmdHis');
    }
}
