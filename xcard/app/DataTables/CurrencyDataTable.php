<?php


namespace App\DataTables;


use App\Models\Country;
use App\Models\CountryTranslations;
use App\Models\Currency;
use App\Models\CurrencyTranslation;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;

class CurrencyDataTable extends DataTable
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
            ->addColumn('country_name' , function($query){
                $country = Country::where('id' , $query['country_id'])->first();
                $country_translation = CountryTranslations::where('country_id' , $country['id'])->where('locale',App::getLocale())->first();
                return $country_translation['title'];

            })
            ->addColumn('country_code' , function($query){
                $country = Country::where('id' , $query['country_id'])->first();
                return $country['code'];
            })
            ->addColumn('delete', 'admin.currency.btn.delete')
            ->rawColumns([
                'delete',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Currency $model )
    {
        return $model->query()->select('currencies_translation.title as title' ,'currencies.id as id','currencies.country_id as country_id')
            ->leftJoin('currencies_translation','currencies_translation.currency_id','=','currencies.id')
            ->where('locale',App::getLocale());
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
                        'text' => '<i class="ti-plus"></i> ' . _i('create new currency'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "currency/create" ;

                         }',
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
            ['name'=>'currencies.id','data'=>'id','title'=>_i('id')],
            ['name'=>'currencies_translation.title','data'=>'title','title'=>_i('title')],
            ['name'=>'country_name','data'=>'country_name','title'=>_i('country')],
            ['name'=>'country_code','data'=>'country_code','title'=>_i('code')],
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
        return 'currencies_' . date('YmdHis');
    }



}
