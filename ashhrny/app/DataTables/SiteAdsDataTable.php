<?php

namespace App\DataTables;

use App\Models\FeaturedAdUser;
use App\User;
use Yajra\DataTables\Services\DataTable;

class SiteAdsDataTable extends DataTable
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
            ->editColumn('user_id', function ($query) {
                $user = User::findOrFail($query->user_id);
                if ($user->first_name != null && $user->last_name != null) {
                    return $user->first_name . ' ' . $user->last_name;
                }
                return $user->email;
            })
            ->editColumn('total', function ($query) {
                return $query->total;
            })
            ->editColumn('orderNumber', function ($query) {
                return '<a href="' . aUrl('site_ads/' . $query->id) . '">' . $query->orderNumber . '
                        <input type="hidden" id="orderNumber" name="orderNumber" value="' . $query->id . '">
                     </a>';
            })
            ->editColumn('publish', function ($query) {
                if ($query->publish == 0) {
                    return _i('Awaiting Approval');
                } else {
                    return _i('Approved');
                }
            })
            ->editColumn('featured_type', function ($query) {
                if ($query->featured_type == 'featured') {
                    return _i('Featured Members');
                } else {
                    return _i('Slider Members');
                }
            })
//            ->addColumn('delete', 'admin.site_ads.btn.delete')
            ->rawColumns([
                'delete',
                'user_id',
                'total',
                'publish',
                'featured_type',
                'orderNumber',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SiteAd $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FeaturedAdUser $model)
    {
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
                    [10, 25, 50, 100, -1], [10, 25, 50, _i('all records')]
                ],
                'buttons' => [
//                    [
//                        'text' => '<i class="ti-plus"></i> ' . _i('add new Shipping Company'),
//                        'className' => 'btn btn-lg  btn-success create',
//                        'action' => 'function( e, dt, button, config){
//                                     window.location = "shipping_option/create";
//                                 }',
//                    ],
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
            ['name' => 'orderNumber', 'data' => 'orderNumber', 'title' => _i('Order Number')],
            ['name' => 'user_id', 'data' => 'user_id', 'title' => _i('Customer')],
            ['name' => 'total', 'data' => 'total', 'title' => _i('Total')],
            ['name' => 'featured_type', 'data' => 'featured_type', 'title' => _i('Ad Type')],
            ['name' => 'publish', 'data' => 'publish', 'title' => _i('Approval')],
//            ['name'=>'code_status','data'=>'code_status','title'=> _i('Code Status')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => _i('Created At')],
//            ['name'=>'delete','data'=>'delete','title'=> _i('Edit/Delete') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SiteAds_' . date('YmdHis');
    }
}
