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
        // dd($events);


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

        $events = Event::get();
        
        //dd関数で変数の中身が見れるよ！
        
        
        
        //dd($events);
        $event = Event::find($request_id);
        $athletes = Athlete::where('event_id',$request_id)->get();
        return view('event.list.index',compact('request_id', 'events', 'athletes'));

        // $events = Event::with(['event.athlete'])
        // $athletes = App\Event::find(1)->athletes;
        // return view('event.list.index',compact('request_id', 'event', 'athletes'));

    }
     //本間くん参考(https://www.yoheim.net/blog.php?q=20181104)
    //  $books = Book::with(['room','room.hotel','room.hotel.subgroup','roster'])

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
