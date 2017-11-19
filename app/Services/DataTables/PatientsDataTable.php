<?php

namespace App\Services\DataTables;

use App\Entities\Patient;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class PatientsDataTable
 *
 * @author  Saulo Vinícius
 * @package App\Services\DataTables
 */
class PatientsDataTable extends DataTable
{

	public function dataTable()
	{
		return (new EloquentDataTable($this->query()))
			->editColumn('created_at', function (Patient $model) {
				return date('d/m/Y H:i:s', strtotime($model->created_at));
			})
			->addColumn('edit', function (Patient $model) {
				return '<a href="patients/' . $model->id . '/edit" 
                           class="btn btn-xs btn-primary center-block"> 
                            <i class="fa fa-pencil-square-o" 
                               aria-hidden="true"></i>
                        </a>';
			})
			->addColumn('doctors', function (Patient $model) {
				$doctors = '';
				foreach ($model->doctors as $doctor) {
					$doctors .= $doctor->doctor->user->name . '<br>';
				}

				return $doctors;
			})
			->editColumn('patient.contacts', function (Patient $model) {
				
				if (!empty($model->contacts)) {
					$contactString = '';
					foreach ($model->contacts as $contact) {
						$contactString .= $contact->contactType->name . ' => ' . $contact->description . '<br>';
					}
				
						return $contactString;
				}
				
				return '<div style="text-align: center">-</div>';
			})->escapeColumns([]);
	}

	/**
	 * Get the query object to be processed by dataTables.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query()
	{
		$query = Patient::query();

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
			'doctors'      => [
				'title'     => 'Médicos',
				'orderable' => false
			],
			'address'      => ['title' => 'Endereço'],
			'neighborhood' => ['title' => 'Bairro'],
			'number'       => ['title' => 'Número'],
			'patient.contacts' => [
				'title'      => 'Contato',
				'orderable'  => false,
				'searchable' => false,
			],
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
		return 'patients_' . time();
	}
}
