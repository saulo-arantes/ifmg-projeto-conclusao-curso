<?php

namespace App\Services\DataTables;

use App\Entities\Schedule;
use App\Entities\User;
use Yajra\Datatables\Services\DataTable;

/**
 * Class SchedulesDataTable
 *
 * @author  Saulo Vinícius
 * @package App\DataTables
 */
class SchedulesDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @return \Yajra\Datatables\Engines\BaseEngine
	 */
	public function dataTable() {
		return $this->datatables
			->eloquent($this->query())->editColumn('doctor.name', function (Schedule $model) {
				return $model->doctor->user->name ?? '<div style="text-align: center">-</div>';
			})->editColumn('patient.name', function (Schedule $model) {
				return $model->patient->name ?? '<div style="text-align: center">-</div>';
			})->editColumn('patient.contacts', function (Schedule $model) {

				if (!empty($model->patient->contacts)) {
					$contactString = '';
					foreach ($model->patient->contacts as $contact) {
						$contactString .= $contact->contactType->name . ' => ' . $contact->description . '<br>';
					}
				}

				return '<div style="text-align: center">-</div>';
			})->editColumn('start_at', function (Schedule $model) {
				return date('d/m/Y H:i', strtotime($model->start_at));
			})->editColumn('finish_at', function (Schedule $model) {
				return date('d/m/Y H:i', strtotime($model->finish_at));
			})->setRowAttr([
				'href' =>
					function (Schedule $model) {
						return '/' . User::getUserMiddleware() . '/schedules/' . $model->id;
					},
			])->escapeColumns([0]);
	}

	/**
	 * Get the query object to be processed by dataTables.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query() {
		$query = Schedule::query();

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
			            'class' => 'table table-bordered table-hover nowrap',
			            'style' => 'width: 100%;'
		            ])->parameters($this->getBuilderParameters())->parameters([
				'dom'          => 'Bfrtlip',
				'responsive'   => true,
				'language'     => ['url' => '/assets/global/plugins/datatables/DataTables-1.10.12/portuguese-brasil.json'],
				'lengthMenu'   => [
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
				'pageLength'   => 10,
				'buttons'      => [
					'export',
					'print',
					'reload',
				],
				'drawCallback' => "function () {
                    var table = $('#dataTableBuilder');
                    
                    $('#dataTableBuilder tbody tr').click(function () {
                        window.location = $(this).attr('href');
                        return false;
                    })
                }"
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			'description'      => [
				'title'     => 'Descrição',
				'orderable' => false,
			],
			'doctor.name'      => [
				'title'     => 'Médico',
				'orderable' => false,
			],
			'patient.name'     => [
				'title'     => 'Paciente',
				'orderable' => false,
			],
			'patient.contacts' => [
				'title'      => 'Contato',
				'orderable'  => false,
				'searchable' => false,
			],
			'start_at'         => [
				'title'     => 'Início',
				'orderable' => false,
			],
			'finish_at'        => [
				'title'     => 'Fim',
				'orderable' => false,
			],
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