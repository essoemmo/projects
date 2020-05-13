<?php

namespace App\DataTables;

use App\Models\countries;
use App\Models\Language;
use App\User;
use Yajra\DataTables\Services\DataTable;

class countriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
       //dd(request()->segment(1));
        if(request()->segment(1) == 'master'){
            return datatables($query)
                ->addColumn('logo', function ($query) {
                    $url = asset('uploads/countries/'.$query->id.'/'.$query->logo);
                    return '<img src='.$url.' border="0" class="img-responsive img-rounded" align="center" />';
                })
            ->addColumn('action', function ($query) {
                $html = '<a href ='. $query->id . '/edit'.' target="blank"
                class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                   <form class=" delete"  action="'.route("country.destroy",$query->id) .'"  method="POST" id="deleteRow"  
                   style="display: inline-block; right: 50px;" > 
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';
                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $query->lang_id){
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$query->id.'" data-lang="'.$lang->id.'"
                    style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                    }
                }
                $html = $html.'
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    '.$options.'
                  </ul>
                </div> ';
       
                return $html;
            })
            ->rawColumns([
                'action',
                'logo',

            ])
            ->make(true);
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(countries $model)
    {
        return $model->query()->leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select('countries.id as id', 'countries.code as code', 'countries_data.title as title','countries.created_at as created_at','countries.logo as logo','countries_data.lang_id as lang_id')
        ->where('countries_data.source_id' , null)
        ->orderByDesc('countries.id');
//        return countries::query()->orderByDesc('id');
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
                            [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                        ],
                        'buttons' => [
                            [
                                'text' => '<i class="ti-plus"></i> ' . _i('add new country'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){
                                             window.location = "../country/create";
                                         }',
                            ],
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
            ['name'=>'countries_data.Country','data'=>'title','title'=> _i('title')],
            ['name'=>'code','data'=>'code','title'=> _i('code')],
            ['name'=>'logo','data'=>'logo','title'=> _i('logo')],
            ['name'=>'created_at','data'=>'created_at','title'=> _i('created_at')],
            ['name'=>'action','data'=>'action','title'=> _i('action') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
