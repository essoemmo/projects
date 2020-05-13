<?php

namespace App\DataTables;

use App\Bll\Utility;
use App\Models\product\order_products;
use Xinax\LaravelGettext\Facades\LaravelGettext;
use Yajra\DataTables\Services\DataTable;

class userOrderDataTable extends DataTable
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
            ->addColumn('ordernumber', function ($query) {
                return '<a href="' . route('myorders.show', ['locale' => LaravelGettext::getLocale(), 'id' => $query->order->id]) . '">' . $query->order->ordernumber . '</a>';
            })
            ->editColumn('total', function ($query) {
                return $query->order->total;
            })
            ->editColumn('shipping_cost', function ($query) {
                return $query->order->shipping_cost;
            })
            ->editColumn('discount', function ($query) {
                if ($query->order->discount != null) {
                    return $query->order->discount;
                } else {
                    return 0;
                }
            })
            ->editColumn('status', function ($query) {
                if ($query->order->status == 'wait') {
                    return '<div class="badge badge-warning">' . $query->order->status . '</div>';
                } elseif ($query->order->status == 'accepted') {
                    return '<div class="badge badge-primary ">' . $query->order->status . '</div>';
                } elseif ($query->order->status == 'refused') {
                    return '<div class="badge badge-danger">' . $query->order->status . '</div>';
                } elseif ($query->order->status == 'complete') {
                    return '<div class="badge badge-success">' . $query->order->status . '</div>';
                } elseif ($query->order->status == 'shipped') {
                    return '<div class="badge badge-info">' . $query->order->status . '</div>';
                }
            })
            ->rawColumns([
                'status',
                'ordernumber',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(order_products $model)
    {
        return $model->query()->orderByDesc('id')->whereHas('order', function ($query) {
            $query->where('user_id', auth()->id());
            $query->where('store_id', Utility::getStoreId());
        })->groupBy('order_id');
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
                    [10, 25, 50, 100, -1], [10, 25, 50, trans('admin.all_record')]
                ],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
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
            ['name' => 'ordernumber', 'data' => 'ordernumber', 'title' => _i('Order Number')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => _i('created_at')],
            ['name' => 'total', 'data' => 'total', 'title' => _i('total')],
            ['name' => 'shipping_cost', 'data' => 'shipping_cost', 'title' => _i('shipping')],
            ['name' => 'discount', 'data' => 'discount', 'title' => _i('Discount')],
            ['name' => 'status', 'data' => 'status', 'title' => _i('status')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userOrder_' . date('YmdHis');
    }
}
