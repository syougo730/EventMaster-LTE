<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Libs\GoogleDrive;
use App\Libs\Functions;

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


class EventCreateController extends Controller
{
    
    public $googleDrive;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GoogleDrive $googleDrive)
    {
        //login認証
        $this->middleware('auth');
        
        //Google認証
        //parent::__construct();
        $this->googleDrive = $googleDrive;
    }

    /**
     *
     */
    public function index()
    {
        return view('event/create/index');
    }



    /**
     *
     */
    public function set(Request $request)
    {

        $user_id = Auth::id();//login_user

        //大会情報の登録
        $event = new Event;
        $event->event_name = 'TEST';
        $event->user_id = $user_id;
        $event->rule_id = 1;
        $event->save();

        $eid = $event->id;

        $lists = [
            ['fx',$request->fx],
            //$request->ph,
            //$request->sr,
            //$request->vt,
            //$request->pb,
            //$request->hb
        ];

        foreach ($lists as $list) {

                    
            //SpreadSheetの情報を取得する
            $datas = $this->googleDrive->getSpreadSheet($list[1]);

            dd($datas);

            foreach ($datas as $data) {
                
                //db登録

                

            }

        }


        return redirect()->route('event.end');
    }


    public function end()
    {
        return view('event/create/end');
    }


}
