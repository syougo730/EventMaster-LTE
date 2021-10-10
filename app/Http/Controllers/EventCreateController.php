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
     * INDEX
     */
    public function index()
    {
        return view('event/create/index');
    }



    /**
     * DATA SET
     */
    public function set(Request $request)
    {
        ###試合形式セット未実装
        ###団体判定未実装
        ###男子のみ

        function get_sheet_id($url){
            //URLをディレクトリ毎に分けて返す
            $pattern="#(?<=/).+?(?=/)#";
            preg_match_all($pattern,$url,$result);
            return $result[0][3];
        }

        $validatedData = $request->validate([
            'config' => 'required|url',
        ]);

        $user_id = Auth::id();//login_user

        $config_url = get_sheet_id($request->config);

        //2度登録を防ぐ
        $sheet_check = Event::where('sheet_id',$config_url)->exists();
        if($sheet_check) return redirect()->route('event.index');

        $config = $this->googleDrive->getSpreadSheet($config_url,'config!A5:N');

        $fx_id = get_sheet_id($config[3][1]);
        $ph_id = get_sheet_id($config[4][1]);
        $sr_id = get_sheet_id($config[5][1]);
        $vt_id = get_sheet_id($config[6][1]);
        $pb_id = get_sheet_id($config[7][1]);
        $hb_id = get_sheet_id($config[8][1]);

        //大会情報の登録
        $event = new Event;
        $event->event_name = $config[0][1];
        $event->user_id = $user_id;
        $event->rule_id = 1;
        $event->sheet_id = $config_url;
        $event->save();

        $eid = $event->id;

        $lists = [
            ['fx',$fx_id],
            ['ph',$ph_id],
            ['sr',$sr_id],
            ['vt',$vt_id],
            ['pb',$pb_id],
            ['hb',$hb_id]
        ];

        foreach ($lists as $list) {

            $ev = $list[0];//table名を取得
            //SpreadSheetの情報を取得する
            $datas = $this->googleDrive->getSpreadSheet($list[1]);

            //dd($datas);

            if(!$datas){
                //IDが間違っていた場合
                continue;
            }

            foreach ($datas as $data) {
                

                //所属登録
                $team_check = Team::where('team_name',$data[2])->exists();
                if(!$team_check){
                    if($data[2]){
                        $team = new Team;
                        $team->team_name = $data[2];
                        $team->save();

                        $team_id = Team::select('id')->where('team_name',$data[2])->first()->id;
                    }else{
                        $team_id = 0;
                    }
                }else{
                    $team_id = Team::select('id')->where('team_name',$data[2])->first()->id;
                }

                //アスリート登録
                $athlete_check = Athlete::where('event_id',$eid)->where('athlete_number',$data[0])->exists();
                if(!$athlete_check && $data[1]){
                    $athlete = new Athlete;
                    $athlete->athlete_name = $data[1];
                    $athlete->athlete_number = $data[0];
                    $athlete->event_id = $eid;
                    $athlete->team_id = $team_id;
                    $athlete->save();
                }
                $athlete_id = $data[0];

                if(!$athlete_id) continue;

                switch ($ev) {
                    case 'fx':
                        $fx = new FxScore;
                        $fx->event_id = $eid;
                        $fx->athlete_id = $athlete_id;
                        $fx->team_id = $team_id;
                        $fx->member_flag = 0;//団体フラグ未実装
                        $fx->d_score = trim($data[4]) ?: 0;
                        $fx->e_score = trim($data[9]) ?: 0;
                        $fx->nd_score = trim($data[12]) ?: 0;
                        $fx->save();
                        break;
                    
                    case 'ph':
                        $ph = new PhScore;
                        $ph->event_id = $eid;
                        $ph->athlete_id = $athlete_id;
                        $ph->team_id = $team_id;
                        $ph->member_flag = 0;//団体フラグ未実装
                        $ph->d_score = trim($data[4]) ?: 0;
                        $ph->e_score = trim($data[9]) ?: 0;
                        $ph->nd_score = trim($data[12]) ?: 0;
                        $ph->save();
                        break;
                    
                    case 'sr':
                        $sr = new SrScore;
                        $sr->event_id = $eid;
                        $sr->athlete_id = $athlete_id;
                        $sr->team_id = $team_id;
                        $sr->member_flag = 0;//団体フラグ未実装
                        $sr->d_score = trim($data[4]) ?: 0;
                        $sr->e_score = trim($data[9]) ?: 0;
                        $sr->nd_score = trim($data[12]) ?: 0;
                        $sr->save();
                        break;
            
                    case 'vt':
                        $vt = new VtScore;
                        $vt->event_id = $eid;
                        $vt->athlete_id = $athlete_id;
                        $vt->team_id = $team_id;
                        $vt->member_flag = 0;//団体フラグ未実装
                        $vt->d_score = trim($data[4]) ?: 0;
                        $vt->e_score = trim($data[9]) ?: 0;
                        $vt->nd_score = trim($data[12]) ?: 0;
                        $vt->save();
                        break;

                    case 'pb':
                        $pb = new PbScore;
                        $pb->event_id = $eid;
                        $pb->athlete_id = $athlete_id;
                        $pb->team_id = $team_id;
                        $pb->member_flag = 0;//団体フラグ未実装
                        $pb->d_score = trim($data[4]) ?: 0;
                        $pb->e_score = trim($data[9]) ?: 0;
                        $pb->nd_score = trim($data[12]) ?: 0;
                        $pb->save();
                        break;

                    case 'hb':
                        $hb = new HbScore;
                        $hb->event_id = $eid;
                        $hb->athlete_id = $athlete_id;
                        $hb->team_id = $team_id;
                        $hb->member_flag = 0;//団体フラグ未実装
                        $hb->d_score = trim($data[4]) ?: 0;
                        $hb->e_score = trim($data[9]) ?: 0;
                        $hb->nd_score = trim($data[12]) ?: 0;
                        $hb->save();
                        break;
                }

            }

        }


        return redirect()->route('dash.index');
        
    }



}
