<?php

namespace App\Services\DataTables;

use App\Entities\User;
use Yajra\Datatables\Services\DataTable;

/**
 * Class UsersDataTable
 *
 * @author  Saulo Vinícius
 * @package App\Services\DataTables
 */
class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())->editColumn('created_at', function (User $model) {
                return date('d/m/Y H:i:s', strtotime($model->created_at));
            });
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->setTableAttributes([
                        'class' => 'table table-bordered table-hover table-responsive table-full-width',
                    ])
                    ->parameters($this->getBuilderParameters())->parameters([
                'dom'        => 'Blfrtip',
                'responsive' => true,
                'language'   => ['url' => '/assets/global/plugins/datatables/DataTables-1.10.12/portuguese-brasil.json'],
                'lengthMenu' => [
                    [
                        5,
                        10,
                        15,
                        20,
                        100
                    ],
                    [
                        5,
                        10,
                        15,
                        20,
                        100
                    ]
                ],
                'pageLength' => 10,
                'buttons'    => [
                    'create',
                    'export',
                    'print',
                    'reload',
                ],
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
            'id',
            'name'         => ['title' => 'Nome'],
            'email'        => ['title' => 'E-mail'],
            'address'      => ['title' => 'Endereço'],
            'neighborhood' => ['title' => 'Bairro'],
            'number'       => ['title' => 'Número'],
            'created_at'   => ['title' => 'Data']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'logs_' . time();
    }
}