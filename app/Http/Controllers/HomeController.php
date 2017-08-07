<?php

namespace App\Http\Controllers;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return redirect('profile');
    }
}
