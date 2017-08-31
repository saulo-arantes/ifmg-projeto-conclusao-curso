<?php

namespace App\Services\DataTables;

use App\Entities\Audit;
use Yajra\Datatables\Services\DataTable;

/**
 * Class AuditsDataTable
 *
 * @author  Saulo Vinícius
 * @since 07/08/2017
 * @package App\Services\DataTables
 */
class AuditsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query()->with('user'))
            ->editColumn('user.name', function(Audit $model) {
                return $model->user->name ?? '';
            })
            ->editColumn('created_at', function(Audit $model) {
                return date('d/m/Y H:i:s', strtotime($model->created_at));
            })
            ->editColumn('old_values', function(Audit $model){
                $beautified = '<ul>';

                foreach (json_decode($model->old_values) as $key => $value) {
                    if($key == 'reports') {
                        continue;
                    }

                    #$key = Translate::PTBR[$key];
                    $beautified .= '<li><b>' . $key . ':</b>' . $value;
                }

                $beautified .= '</ul>';

                return $beautified;
            })
            ->editColumn('new_values', function(Audit $model){
                $beautified = '<ul>';

                foreach (json_decode($model->new_values) as $key => $value) {
                    if($key == 'reports') {
                        continue;
                    }

                    #$key = Translate::PTBR['$key'];
                    $beautified .= '<li><b>' . $key . ':</b>' . $value;
                }

                $beautified .= '</ul>';

                return $beautified;
            })
            ->escapeColumns([0]);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Audit::query();
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
            'user.name'      => ['title' => 'Usuário'],
            'event'          => ['title' => 'Título'],
            'auditable_type' => ['title' => 'Entidade'],
            'old_values'     => ['title' => 'Antes'],
            'new_values'     => ['title' => 'Depois'],
            'url',
            'ip_address'     => ['title' => 'IP'],
            'user_agent',
            'created_at'     => ['title' => 'Criado em']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'audits_' . time();
    }
}
