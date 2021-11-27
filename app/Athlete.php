<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Event;
use App\Athlete;
use App\FxScore;
use App\PhScore;
use App\SrScore;
use App\VtScore;
use App\PbScore;
use App\HbScore;

class Athlete extends Model
{
    // １人の選手は複数の試合に出場
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    /**
     * 全ての種目のスコアを返す
     * @return {Json} 
     */
    public function event_data(){

        $athlete_id = $this->id;
        $event_id = $this->event_id;

        //FX
        $fx_score = FxScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $fx['ds'] = $fx_score->d_score;
        $fx['es'] = $fx_score->e_score;
        $fx['nd'] = $fx_score->nd_score;
        $fx['ts'] = $fx_score->d_score + $fx_score->e_score - $fx_score->nd_score;
        //PH
        $ph_score = PhScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $ph['ds'] = $ph_score->d_score;
        $ph['es'] = $ph_score->e_score;
        $ph['nd'] = $ph_score->nd_score;
        $ph['ts'] = $ph_score->d_score + $ph_score->e_score - $ph_score->nd_score;
        //SR
        $sr_score = SrScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $sr['ds'] = $sr_score->d_score;
        $sr['es'] = $sr_score->e_score;
        $sr['nd'] = $sr_score->nd_score;
        $sr['ts'] = $sr_score->d_score + $sr_score->e_score - $sr_score->nd_score;
        //VT
        $vt_score = VtScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $vt['ds'] = $vt_score->d_score;
        $vt['es'] = $vt_score->e_score;
        $vt['nd'] = $vt_score->nd_score;
        $vt['ts'] = $vt_score->d_score + $vt_score->e_score - $vt_score->nd_score;
        //PB
        $pb_score = PbScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $pb['ds'] = $pb_score->d_score;
        $pb['es'] = $pb_score->e_score;
        $pb['nd'] = $pb_score->nd_score;
        $pb['ts'] = $pb_score->d_score + $pb_score->e_score - $pb_score->nd_score;
        //HB
        $hb_score = HbScore::where("event_id",$event_id)->where("athlete_id",$athlete_id)->first();
        $hb['ds'] = $hb_score->d_score;
        $hb['es'] = $hb_score->e_score;
        $hb['nd'] = $hb_score->nd_score;
        $hb['ts'] = $hb_score->d_score + $hb_score->e_score - $hb_score->nd_score;

        $result['fx'] = $fx;
        $result['ph'] = $ph;
        $result['sr'] = $sr;
        $result['vt'] = $vt;
        $result['pb'] = $pb;
        $result['hb'] = $hb;
        //6種目合計
        $result['ts'] = $fx['ts']+$ph['ts']+$sr['ts']+$vt['ts']+$pb['ts']+$hb['ts'];

        return $result;

    }


    /**
     * 所属名を返す
     * @return {String} Team_name
     */
    public function team_name(){
        $team_id = $this->team_id;
        $team_name = Team::where('id',$team_id)->first()->team_name;

        return $team_name;
    }
}