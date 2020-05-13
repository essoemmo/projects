<?php


namespace App\DataTables;


use App\Bll\Utility;
use App\Models\product\discount_code;
use Yajra\DataTables\Services\DataTable;

class DiscountCodeTargetDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('delete', 'admin.discount_code.target.btn.delete')
//            ->editColumn('status', function($query) {
//                if ($query->status == 0){
//                    return '<div class="badge badge-warning">'. _i('Disabled') .'</div>';
//                }else {
//                    return '<div class="badge badge-info">'. _i('Enabled') .'</div>';
//                }
//            })
            ->editColumn('type', function ($query) {
                if ($query->type == "perc") {
                    return '<div class="badge badge-inverse-primary">' . _i('Percentage') . '</div>';
                } else {
                    return '<div class="badge badge-inverse-info">' . _i('Products') . '</div>';
                }
            })
            ->editColumn('discount', function ($query) {
                if ($query->discount == null) {
                    return '<div class="badge badge-inverse-info">' . _i('discount on products') . '</div>';
                } else {
                    return '<div class="badge badge-inverse-primary">' . $query->discount . " %" . '</div>';
                }
            })
            ->addColumn('created_at', function ($query) {
                return date('d M y h:i A', strtotime($query->created_at));
            })
            ->rawColumns([
                'delete',
                'type',
                'discount',
                'created_at',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\DiscountCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(discount_code $model)
    {
        return $model->query()
            ->leftJoin('discount_codes_data', 'discount_codes_data.discount_code_id', 'discount_codes.id')
            ->where('discount_codes.store_id', Utility::getStoreId())
            ->where('discount_codes_data.source_id', null)
            ->where('discount_codes.code', '')
            ->select('discount_codes.id as id', 'discount_codes.expire_date', 'discount_codes.discount as discount',
                'discount_codes.status as status', 'discount_codes_data.title as title', 'discount_codes.created_at as created_at',
                'discount_codes.type as type');
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
                    [10, 25, 50, 100, -1], [10, 25, 50, _i('all records')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> ' . _i('add new offer'),
                        'className' => 'btn btn-lg  btn-success create',
                        'action' => 'function( e, dt, button, config){
                                                             window.location = "' . url('adminpanel/settings/offer/create') . '";
                                                         }',
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
            ['name' => 'discount_codes_data.title', 'data' => 'title', 'title' => _i('Title')],
            ['name' => 'type', 'data' => 'type', 'title' => _i('offer')],
            ['name' => 'discount', 'data' => 'discount', 'title' => _i('discount')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => _i('created time')],
            ['name' => 'expire_date', 'data' => 'expire_date', 'title' => _i('expire date')],
            ['name' => 'delete', 'data' => 'delete', 'title' => _i('Edit/Delete'), 'printable' => false, 'exportable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DiscountCode_' . date('YmdHis');
    }
}
