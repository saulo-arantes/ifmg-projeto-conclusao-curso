<?php

namespace App\Services\DataTables;

use App\Entities\Notification;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class NotificationsDataTable
 *
 * @author  Saulo Vinícius
 * @since 07/06/2017
 * @package App\Services\DataTables
 */
class NotificationsDataTable extends DataTable
{
	/**
	 * Build DataTable class.
	 */
	public function dataTable()
	{
		return (new EloquentDataTable($this->query()))
			->editColumn('type', function (Notification $model) {
				switch ($model->type) {
					case Notification::VALIDATOR:
						return '<span class="label label-warning label-xs center-block">Validator</span>';
					case Notification::ERROR:
						return '<span class="label label-danger label-xs center-block">Exception</span>';
					case Notification::DENIED:
						return '<span class="label label-warning label-xs center-block">Denied</span>';
					case Notification::INFO:
						return '<span class="label label-info label-xs center-block">Info</span>';
					default:
						return '<span class="label label-danger label-xs center-block">Erro desconhecido</span>';
				}
			})->editColumn('data', function (Notification $model) {

				return json_decode($model->data)->message;
			})->editColumn('read_at', function (Notification $model) {
				if (empty($model->read_at)) {
					return '<div style="text-align: center;"><a href="' . route('visualizeAll') . '" style="color: black" class="btn btn-xs"><i class="fa fa-eye"></i></a><br>Visualizar todas</div>';
				}

				return date('d/m/Y H:i:s', strtotime($model->read_at));
			})->editColumn('created_at', function (Notification $model) {
				return date('d/m/Y H:i:s', strtotime($model->created_at));
			})->escapeColumns([0]);
	}

	/**
	 * Get the query object to be processed by dataTables.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query()
	{
		$query = Notification::query()
		                     ->where('notifiable_id', Auth::user()->id)
		                     ->orderByDesc('created_at');

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
			            'class' => 'table table-bordered table-hover table-responsive table-full-width nowrap',
			            'style' => 'width: 100%;'
		            ])
		            ->parameters($this->getBuilderParameters())->parameters([
				'dom'        => 'Bfrtlip',
				'responsive' => true,
				'scrollX'    => true,
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
			'type'       => [
				'title'     => 'Tipo',
				'orderable' => false
			],
			'data'       => [
				'title'     => 'Mensagem',
				'orderable' => false
			],
			'read_at'    => [
				'title'     => 'Lido',
				'style'     => 'white-space: nowrap',
				'orderable' => false
			],
			'created_at' => [
				'title'     => 'Adicionado em',
				'style'     => 'white-space: nowrap',
				'orderable' => false
			],
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'notifications_' . time();
	}
}
