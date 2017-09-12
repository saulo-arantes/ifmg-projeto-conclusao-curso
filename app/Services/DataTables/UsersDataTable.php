<?php

namespace App\Services\DataTables;

use App\Entities\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class UsersDataTable
 *
 * @author  Saulo Vinícius
 * @package App\Services\DataTables
 */
class UsersDataTable extends DataTable
{

	public function dataTable()
	{
		return (new EloquentDataTable($this->query()))
			->editColumn('created_at', function (User $model) {
				return date('d/m/Y H:i:s', strtotime($model->created_at));
			}
			)
			->addColumn('edit', function (User $model) {
				return '<a href="users/' . $model->id . '/edit" 
                           class="btn btn-xs btn-primary center-block"> 
                            <i class="fa fa-pencil-square-o" 
                               aria-hidden="true"></i>
                        </a>';
			}
			)
			->editColumn('role', function (User $model) {
				switch ($model->role) {
					case User::ADMIN:
						return '<label class="label label-sm label-danger center-block">Admin</label>';
					case User::DOCTOR:
						return '<label class="label label-sm label-info center-block">Médico</label>';
					case User::SECRETARY:
						return '<label class="label label-sm label-warning center-block">Secretário</label>';
					default:
						return '<label class="label label-sm label-default center-block">Desconhecido</label>';
				}
			}
			)
			->escapeColumns([]);
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
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
		            ->columns($this->getColumns())
		            ->setTableAttributes([
				            'class' => 'table table-bordered table-hover table-responsive table-full-width',
			            ]
		            )
		            ->parameters($this->getBuilderParameters())
		            ->parameters([
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
			            ]
		            );
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
			'role'         => ['title' => 'Nível'],
			'created_at'   => ['title' => 'Data'],
			'edit'         => [
				'title'      => 'Editar',
				'searchable' => false,
				'orderable'  => false
			]
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'users_' . time();
	}
}
