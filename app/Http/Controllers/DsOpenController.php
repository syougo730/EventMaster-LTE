<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DsOpenController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $version = '2.0';
        return view('dscore.open',compact('version'));
    }

}
