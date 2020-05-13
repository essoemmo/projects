<?php


namespace App\DataTables;


use App\Models\Country;
use App\Models\CountryTranslations;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
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
            ->addColumn('delete', 'admin.country.btn.delete')
            ->editColumn('logo', function($query){
                if($query->logo == null) {
                    return _i('No Icon');
                } else {
                    return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="'.asset($query->logo).'">';
                }
            })
            ->rawColumns([
                'delete',
                'logo',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Country $model)
    {
        return $model->query()->select('countries_translations.title as title' ,'countries.id as id' ,'countries.logo' ,'countries.code','countries.call_code')
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new country'),
                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "genres/create";
//                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary btn-outline-primary' , 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success btn-outline-success' , 'text' => '<i class="ti-clipboard"></i>'],
                    ['extend' => 'pdf','className' => 'btn btn-info btn-outline-info' , 'text' => '<i class="ti-file"></i>']
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
            ['name'=>'countries.id','data'=>'id','title'=>_i('id')],
            ['name'=>'countries_translations.title','data'=>'title','title'=>_i('title')],
            ['name'=>'countries.code','data'=>'code','title'=>_i('code')],
            ['name'=>'countries.call_code','data'=>'call_code','title'=>_i('Phone Code')],
            ['name'=>'countries.logo','data'=>'logo','title'=>_i('logo')],
            ['name'=>'delete','data'=>'delete','title'=>_i('edit/delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'countries_' . date('YmdHis');
    }

}
