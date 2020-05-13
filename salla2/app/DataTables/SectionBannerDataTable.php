<?php


namespace App\DataTables;


use App\Bll\Utility;
use App\Models\ContentSectionBanner;
use Yajra\DataTables\Services\DataTable;

class SectionBannerDataTable extends  DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('delete', 'admin.section_banner.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SectionProduct $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContentSectionBanner $model )
    {
        return $model->newQuery()
            ->leftJoin('content_sections','content_sections.id','=','content_section_banners.content_section_id')
            ->leftJoin('content_section_titles','content_sections.id','=','content_section_titles.section_id')
            ->select('content_section_titles.title','content_sections.id as id','content_sections.order as order')
            ->where('content_sections.store_id',Utility::getStoreId())
            ->where('content_section_titles.source_id', null)
            ->groupBy('content_section_banners.content_section_id'); // to get one row if iteration content_section_id;
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
                        'text' => '<i class="ti-plus"></i> ' . _i('add new HomePage Section'),
                        'className' => 'btn btn-lg  btn-success create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "section_products/create";
                                 }',
                    ],
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
            ['name'=>'order','data'=>'order','title'=> _i('order')],
            ['name'=>'delete','data'=>'delete','title'=> _i('Show') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SectionProduct_' . date('YmdHis');
    }
}