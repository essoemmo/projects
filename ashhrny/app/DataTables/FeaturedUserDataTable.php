<?php


namespace App\DataTables;

use App\Models\FeaturedAdUser;
use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;

class FeaturedUserDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
//            ->order(function ($query) {
//                $query->orderBy('sort', 'asc');
//            })
            ->addColumn('delete', 'admin.featured_users.btn.delete')
            ->editColumn('user_id', function ($query) {
                $user = User::where('id', $query->user_id)->first();
                return $user['first_name'] . " " . $user['last_name'];
            })
            ->editColumn('featured_type', function ($query) {
                if ($query->featured_type == "slider")
                    return _i('Slider');
                return _i('Featured Members');
            })
            ->addColumn('user_image', function ($query) {
                $user = User::where('id', $query->user_id)->first();
                return '<img class="img-fluid"  style="max-height: 100px; max-height: 60px; !important;" align="center" src="' . asset($user['image']) . '">';

            })
            ->editColumn('publish', function ($query) {
                if ($query->publish == 0) {
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-danger btn-outline-danger">' . _i('Not Published') . '
                        <input type="hidden" id="row_id" name="row_id" value="' . $query->id . '">
                     </a>';
                } else {
                    return '<a href="javascript:void(0)"  class="change_status waves-effect btn btn-primary btn-outline-primary">' . _i('Publish') . '
                        <input type="hidden" id="row_id" name="row_id" value="' . $query->id . '">
                    </a>';
                }
            })
            ->rawColumns([
                'delete',
                'user_id',
                'user_image',
                'featured_type',
                'publish',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SpecialMembersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FeaturedAdUser $model)
    {
        return $model->query()->where('publish', 1)->whereDate('to', ">", Carbon::now())->orWhere('to', null);
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
                    [5, 10, 25, 40, 50, 100, -1], [5, 10, 25, 40, 50, _i('all record')]
                ],
                'buttons' => [
                    [
//                        'text' => '<i class="ti-plus"></i> ' . _i('create new special member'),
//                        'className' => 'btn btn-primary create',
//                        'action' => 'function( e, dt, button, config){
//                             window.location = "sliders/create";
//                         }',
                    ],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-outline-primary', 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-success btn-outline-success', 'text' => '<i class="ti-clipboard"></i>'],
                    ['extend' => 'pdf', 'className' => 'btn btn-info btn-outline-info', 'text' => '<i class="ti-file"></i>']
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
            ['name' => 'id', 'data' => 'id', 'title' => _i('ID')],
            ['name' => 'featured_type', 'data' => 'featured_type', 'title' => _i('Place')],
            ['name' => 'user_id', 'data' => 'user_id', 'title' => _i('User')],
            ['name' => 'user_image', 'data' => 'user_image', 'title' => _i('User Image')],
            ['name' => 'publish', 'data' => 'publish', 'title' => _i('Status')],
            ['name' => 'delete', 'data' => 'delete', 'title' => _i('edit/delete'), 'printable' => false, 'exportable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'featured_ads_users' . date('YmdHis');
    }
}
