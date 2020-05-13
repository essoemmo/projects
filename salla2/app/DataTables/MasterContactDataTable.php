<?php


namespace App\DataTables;


use App\Help\Utility;
use App\Models\Contact;
use App\Models\countries;
use Yajra\DataTables\Services\DataTable;

class MasterContactDataTable  extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        if (auth()->user()->guard == Utility::Admin){
            return datatables($query)
                ->editColumn('country_id', function($query) {
                    if($query->country_id == null){
                        return _i('No Country');
                    }else{
                        $country = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
                            ->select('countries.id as id','countries_data.title as title','countries_data.lang_id')
                            ->where('countries_data.source_id' , null)
                            //->where('countries_data.lang_id' , getLang(session('MasterLang')))
                            ->where('countries.id' , $query->country_id)
                            ->first();
                        return $country['title'];
                    }
                })
                ->addColumn('delete', 'master.contact.btn.delete')
                ->rawColumns([
                    'delete',
                ]);
        }else{
            return datatables($query)
                ->editColumn('country_id', function($query) {
                    if($query->country_id == null){
                        return _i('No Country');
                    }else{
                        $country = countries::leftJoin('countries_data','countries_data.country_id','countries.id')
                            ->select('countries.id as id','countries_data.title as title','countries_data.lang_id')
                            ->where('countries_data.source_id' , null)
                            //->where('countries_data.lang_id' , getLang(session('lang')))
                            ->where('countries.id' , $query->country_id)
                            ->first();
                        return $country['title'];
                    }
                })
                ->addColumn('delete', 'admin.contact.btn.delete')
                ->rawColumns([
                    'delete',
                ]);
        }

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
    {

        if (auth()->guard('store')){
            return $model->query()->where('store_id', \App\Bll\Utility::getStoreId());
        }else{
            return $model->query()->where('store_id',null);
        }

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
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
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
            ['name'=>'name','data'=>'name','title'=>_i('Name')],
            ['name'=>'email','data'=>'email','title'=>_i('E-mail')],
            ['name'=>'phone','data'=>'phone','title'=>_i('Phone')],
            ['name'=>'country_id','data'=>'country_id','title'=> _i(_i('Country'))],
            ['name'=>'created_at','data'=>'created_at','title'=>_i('created_at')],
            ['name'=>'delete','data'=>'delete','title'=> _i('Show/Delete') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Contact_' . date('YmdHis');
    }
}
