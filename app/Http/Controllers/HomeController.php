<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* Datos que se van a entregar a la vista */
        $params = (object) array(
            'page' => 'home',
            'title' => 'Prácticas en primeras empresas del sector tecnológico'
        );

        return view('home', compact('params'));
    }

    /**
     * Show the application dashboard for administrators.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        return view('home');
    }
}
