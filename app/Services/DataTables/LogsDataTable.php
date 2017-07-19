<?php

namespace App\Services\DataTables;

use App\Entities\Log;
use Yajra\Datatables\Services\DataTable;

/**
 * Class LogsDataTable
 *
 * @author  Bruno Tomé
 * @package TARS\Services\DataTables
 */
class LogsDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @return \Yajra\Datatables\Engines\BaseEngine
	 */
	public function dataTable() {
		return $this->datatables
			->eloquent($this->query())->editColumn('created_at', function (Log $model) {
				return date('d/m/Y H:i:s', strtotime($model->created_at));
			})->editColumn('type', function (Log $model) {
				switch ($model->type) {
					case 0:
						return '<span class="label label-sm label-danger center-block">Exception</span>';
					case 1:
						return '<span class="label label-sm label-warning center-block">Alerta de recursos</span>';
					case 2:
						return '<span class="label label-sm label-success center-block">Novo jogador adicionado</span>';
					case 3:
						return '<span class="label label-sm label-info center-block">Créditos insuficientes</span>';
					case 4:
						return '<span class="label label-sm label-warning center-block">Permissão negada</span>';
					default:
						return '<span class="label label-sm label-info center-block">Erro desconhecido</span>';
				}
			})->editColumn('visualized', function (Log $model) {
				if (!$model->visualized) {
					return '<a href="/admin/logs/' . $model->id . '/mark-as-seen" style="color: black" class="btn btn-outline dark center-block"><i class="fa fa-eye" aria-hidden="true"></i></a> <br>Marcar como visualizado';
				}

				return '<div style="text-align: center;"><span class="label label-sm label-success center-block">Sim</span></div>';
			})->escapeColumns([0]);
	}

	/**
	 * Get the query object to be processed by dataTables.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query() {
		$query = Log::query()->with('user');

		return $this->applyScopes($query);
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\Datatables\Html\Builder
	 */
	public function html() {
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
	protected function getColumns() {
		return [
			'id',
			'user.name'   => ['title' => 'Usuário'],
			'visualized'  => ['title' => 'Vizualizado'],
			'type'        => ['title' => 'Tipo'],
			'description' => ['title' => 'Descrição'],
			'created_at'  => ['title' => 'Data']
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'logs_' . time();
	}
}
