<?php

namespace App\Http\Controllers;

use App\Services\DataTables\NotificationsDataTable;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Http\Controllers
 */
class NotificationsController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @param NotificationsDataTable $dataTable
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function index(NotificationsDataTable $dataTable)
	{
		return $dataTable->render('admin.notifications.list');
	}

	/**
	 * Set the visualized attribute to true for all non visualized messages.
	 */
	public function visualizeAll()
	{
		Auth::user()->unreadNotifications->markAsRead();
		return redirect('admin/notifications');
	}

}
