<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user_id = Auth::id();//login_user
        $events = Event::where('user_id', $user_id)->get();
        
        //dd関数で変数の中身が見れるよ！
        //dd($events);


        return view('event.index',compact('events'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request)
    {
        $request_id = $request->event_id;
        //dd関数で変数の中身が見れるよ！
        // dd($eid);

        $event = Event::find($request_id);
        return view('event.list.index',compact('request_id', 'event'));
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
