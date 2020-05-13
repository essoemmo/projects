<?php

namespace App\DataTables;

use App\Models\product\features;
use App\Models\product\product_details;
use App\Models\product\product_features;
use App\Models\product\products;
use App\User;
use Yajra\DataTables\Services\DataTable;

class FeaturesDataTable extends DataTable
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
            ->editColumn('product_id', function($query) {
                $product_details = product_details::select(['title'])->where('product_id','=',$query->product_id)
                    ->first();
                return $product_details->title;
            })

            ->editColumn('feature_id', function($query) {
                $feature = features::select(['title'])->where('id', '=', $query->feature_id)->first();
                return $feature->title;
            })
            ->addColumn('edit', function($query){
                return '<a href="../features/'.$query->id.'/show" class="btn btn-success"><i class="ti-eye"></i> '._i('Shows').' </a>';
            })
            ->addColumn('delete', 'admin.products.features.btn.delete')
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
    public function query(product_features $model)
    {
//        $model = product_features::select(['product_id', 'feature_id','features.title','features.store_id','products.currency_code',
//            'products.category_id','products.product_type','products.sku','products.max_count','products.weight','products.price',
//            'products.net','products.stock','products.discount','products.discount_type'])
//            ->leftjoin("features", "product_features.feature_id", "=", "features.id")
//            ->leftjoin("products", "product_features.feature_id", "=", "products.id")->get();
        return $model->query();
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
//                        'text' => '<i class="fa fa-plus"></i> '._i('Add Article').' ',
//                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                                                             window.location = "../article/create";
//                                                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
                    //                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
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
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'feature_id','data'=>'feature_id','title'=>_i('Feature Name')],
            ['name'=>'product_id','data'=>'product_id','title'=>_i('Product Name')],
            ['name'=>'edit','data'=>'edit','title'=>_i('Show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>_i('Delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Features_' . date('YmdHis');
    }
}
