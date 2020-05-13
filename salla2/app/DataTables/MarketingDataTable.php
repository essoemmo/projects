<?php


namespace App\DataTables;

use App\Bll\Utility;
use App\Models\Marketing;
use Yajra\DataTables\Services\DataTable;

class MarketingDataTable extends  DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('delete', 'admin.marketing.btn.delete')

            ->editColumn('is_draft', function($query) {
                if ($query->is_draft == 0){
                    return '<div class="badge badge-info">'. _i('Published') .'</div>';
                }else {
                    return '<div class="badge badge-warning">'. _i('Draft') .'</div>';
                }
            })   ->editColumn('campaign_target', function($query) {
                if ($query->campaign_target == "store"){
                    return '<div class="badge badge-inverse-primary">'. _i('Buy from store') .'</div>';
                }else {
                    return '<div class="badge badge-inverse-info">'. _i('Buy from product') .'</div>';
                }
            })
//            ->editColumn('discount', function($query) {
//                if ($query->discount == null){
//                    return '<div class="badge badge-inverse-info">'._i('discount on products') .'</div>';
//                }else {
//                    return '<div class="badge badge-inverse-primary">'.$query->discount ." %" .'</div>';
//                }
//            })
            ->addColumn('created_at', function ($query) {
                return date('d M y h:i A', strtotime($query->created_at));
            })
            ->rawColumns([
                'delete',
                'is_draft',
                'campaign_target',
                'created_at',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\DiscountCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Marketing $model)
    {
        return $model->query()->where('store_id',Utility::getStoreId());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('add new campaign'),
                        'className' => 'btn btn-lg  btn-success create',
                        'action' => 'function( e, dt, button, config){
                                                             window.location = "'. url('adminpanel/campaign/create') .'";
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
            ['name'=>'name','data'=>'name','title'=>_i('Campaign Name')],
            ['name'=>'type','data'=>'type','title'=> _i('Campaign Type')],
            ['name'=>'campaign_target','data'=>'campaign_target','title'=> _i('Campaign Target')],
            ['name'=>'is_draft','data'=>'is_draft','title'=>_i('Is Draft')],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('created time')],
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
        return 'marketing_' . date('YmdHis');
    }
}