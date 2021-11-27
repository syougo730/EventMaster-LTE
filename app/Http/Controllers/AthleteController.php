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

class AthleteController extends Controller
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
    public function index(Request $request)
    {
        $event_id = $request->event_id;
        $athlete_id = $request->athlete_id;

        $event = Event::find($event_id);

        $athlete = Athlete::where('id',$athlete_id)->first();
        $data = $athlete->event_data();

        return view('event.athlete.index',compact('event_id','event','athlete','data'));
    }



}
