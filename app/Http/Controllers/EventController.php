<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Team;
use App\Athlete;
use App\FxScore;
use App\PhScore;
use App\SrScore;
use App\VtScore;
use App\PbScore;
use App\HbScore;

use Log;

class EventController extends Controller
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

        $events = Event::get();
        
        //dd関数で変数の中身が見れるよ！
        //dd($events);


        return view('event.index',compact('events'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function event()
    {

        $events = Event::get();
        
        //dd関数で変数の中身が見れるよ！
        //dd($events);


        return view('event.list',compact('events'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function athlete()
    {

        $events = Event::get();
        
        //dd関数で変数の中身が見れるよ！
        //dd($events);


        return view('event.athlete',compact('events'));
    }



}
