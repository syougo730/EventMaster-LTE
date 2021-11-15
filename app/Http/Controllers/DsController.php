<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DsController extends Controller
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
        $version = '2.0';
        return view('dscore.index',compact('version'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function open()
    { 
        $version = '2.0';
        return view('dscore.open',compact('version'));
    }
}
