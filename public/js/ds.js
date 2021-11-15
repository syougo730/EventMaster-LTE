/** *****************************************
 *
 * @file Ds.Creator
 * 
 * **************************************** */

const EVENTS = ['fx','ph','sr','vt','pb','hb'];

// 日付をYYYYMMDDHHMMSSの書式で返す
function formatDate(dt) {
    let y = dt.getFullYear();
    let m = ('00' + (dt.getMonth()+1)).slice(-2);
    let d = ('00' + dt.getDate()).slice(-2);
    let hh = ('00' + dt.getHours()).slice(-2);
    let mm = ('00' + dt.getMinutes()).slice(-2);
    let ss = ('00' + dt.getSeconds()).slice(-2);
    return (y +  m  + d + hh + mm + ss);
}

/** データリセット
 * 全ては無に帰す
 * 
 * @param {*} data 
 * @param {*} event 
 */
function data_resets(event=''){

    //種目未選択時は全て削除
    if(!event){ 
        $.each(EVENTS, function(idx,val){
            set_storage(val);
            data_set(val);
            dscore_calc(val);
            set_notice("Info","データを削除しました。",val);
        });
        console.log("STORAGE CLEAR [ALL]");
        exit;
    }

    set_storage(event);
    data_set(event);
    dscore_calc(event);
    set_notice("Info","データを削除しました。");
    console.log("STORAGE CLEAR ["+event+"]");

}

/**
    データ反映
*/ 
function data_set(event){

    let cv = 'CV';
    if(event == 'fx') cv = 'GroupⅣ / CV';

    let json = get_storage(event);
    $.each(json,function(idx,val){
        
        let elm = $(".tab-content."+event+" .elements-wrap .elm[data-key="+(idx+1)+"]");
        elm.find(".group-score").text(val['group']);
        elm.find(".def-score").text(val['def']);
        elm.find(".content .ja").text(val['ja']);
        elm.find(".content .en").text(val['en']);
        elm.find(".cv").text((val['cv'] || cv));

    });

}
/**
 * 値を少数付きFLOAT型で返す 0.1
 * @param {*} num 
 * @param {*} decimal_point 
 * @returns 
 */
function fix_float(num,decimal_point=1){
    return Number.parseFloat(num).toFixed(decimal_point);
}

/** 
 *   D SCORE 計算
 */
 function dscore_calc(event){

    let groups = [];
    let total_group = 0;
    let total_def = 0;
    let total_cv = 0;
    let cv_group = ['Ⅳa','Ⅳb','Ⅳc','Ⅳ'];
    let cv_value = ['0.1','0.2'];
    let dscore = 0;

    let json = get_storage(event);
    if(json){

        $.each(json,function(idx,val){
            //difficult 
            total_def += def_to_val(val['def']);            
            //groups
            if(cv_group.indexOf(val['cv']) !== -1 ){
                //CVにグループⅣが選択されている場合はⅣを優先する
                groups[idx] = val['cv'];
            }else{
                groups[idx] = val['group'];
            }
            if(cv_value.indexOf(val['cv']) !== -1 ){
                console.log("CV:value");
                total_cv += Number.parseFloat(val['cv']);
            }
        });
        console.log(total_cv);
        total_group = group_calc(groups,event);
        dscore = Number.parseFloat(total_group) + Number.parseFloat(total_def) + Number.parseFloat(total_cv);

        console.log( "TOTAL_DEF："+Number.parseFloat(total_def).toFixed(1));
        console.log("TOTAL_GROUP："+Number.parseFloat(total_group).toFixed(1));

        $(".total-scores ."+event+" .difficult span:last-child").text(Number.parseFloat(total_def).toFixed(1));
        $(".total-scores ."+event+" .exp span:last-child").text(Number.parseFloat(total_group).toFixed(1));
        $(".total-scores ."+event+" .cv span:last-child").text(Number.parseFloat(total_cv).toFixed(1));
        $(".total-scores ."+event+" .dscore span:last-child").text(Number.parseFloat(dscore).toFixed(1));

        if(event === active_event()){
            $(".total-scores .score-header .score-header-content").text(Number.parseFloat(dscore).toFixed(1));
        }

        return Number.parseFloat(dscore).toFixed(1);

    }else{ 
        console.log("ERROR：データが見つかりません ["+event+"]");
    }

}

/** 
 *   TOTAL SCORE 計算
 */
 function total_calc(){
}

/**
  * 
  *  グループ要求を点数化
  * 
  * @type {float}
  * @param {group} [str] Ⅰ～Ⅳ
  * @return {float} Group要求の得点を返す
  * 
*/
function group_calc(groups,event=active_event()){

    const MAX = 5; //グループ上限
    const GROUP_SCORE = [
        {group:'I' , val:0.5},
        {group:'Ⅱ' , val:0.5},
        {group:'Ⅲ' , val:0.5},
        {group:'Ⅳa' , val:0.1},
        {group:'Ⅳb' , val:0.2},
        {group:'Ⅳc' , val:0.3},
        {group:'Ⅳ' , val:0.5},
    ];
    let group1_cnt = 0;
    let group2_cnt = 0;
    let group3_cnt = 0;
    let group4_cnt = 0;
    let group4 = 0;
    let group_score = 0;

    $.each(groups, function(idx,val){
        switch (val) {
            case 'I':
                group1_cnt++;
                break;
            case 'Ⅱ':
                group2_cnt++;
                break;
            case 'Ⅲ':
                group3_cnt++;
                break;                
            case 'Ⅳa':
                group4 = 0.1;
                group4_cnt++;
                break;                
            case 'Ⅳb':
                group4 = 0.2;
                group4_cnt++;
                break;                
            case 'Ⅳc':
                group4 = 0.3;
                group4_cnt++;
                break;                
            case 'Ⅳ':
                group4 = 0.5;
                group4_cnt++;
                break;
        }
    });

    set_notice("Info","Group I："+group1_cnt+" , Ⅱ："+group2_cnt+" , Ⅲ："+group3_cnt+" , Ⅳ："+group4_cnt,event);

    if(group1_cnt > MAX) set_notice('Danger','グループIが上限数を超えています');
    if(group2_cnt > MAX) set_notice('Danger','グループⅡが上限数を超えています');
    if(group3_cnt > MAX) set_notice('Danger','グループⅢが上限数を超えています');
    if(group4_cnt > 1) set_notice('Danger','終末技が複数セットされています');


    if(group1_cnt) group_score = group_score + 0.5;
    if(group2_cnt) group_score = group_score + 0.5;
    if(group3_cnt) group_score = group_score + 0.5;
    if(group4) group_score = group_score + group4;

    return group_score;
}


/**
  * 
  *  難度から得点へ
  * 
  * @type {float}
  * @param {def} [str] A ~ J
  * @return {float} defに応じて0.1 ~ 1.0の値を返す
  * 
*/
function def_to_val(def=""){

    if(!def) return 0;

    const DEF_VALUE = [
        {def:'A', val:0.1},
        {def:'B', val:0.2},
        {def:'C', val:0.3},
        {def:'D', val:0.4},
        {def:'E', val:0.5},
        {def:'F', val:0.6},
        {def:'G', val:0.7},
        {def:'H', val:0.8},
        {def:'I', val:0.9},
        {def:'J', val:1.0},
    ];

    let result = $.grep(DEF_VALUE,function(obj,idx){
        return (obj.def == def);
    });
    
    return result[0]['val'];

}

/*------------------------------
    CSV 出入力処理
--------------------------------*/
/**
 * FILE API が対応しているかチェック
 * @returns Boolean
 */
function checkFileReader() {
    var isUse = false;
    if (window.File && window.FileReader && window.FileList && window.Blob) {
      isUse = true;
    }
    return isUse;
}

/**
 * jsonをcsv文字列に編集する
 * @param {*} json 
 * @param {*} delimiter 
 * @returns 
 */
function jsonToCsv(json, delimiter) {
    let header = Object.keys(json[0]).join(delimiter) + "\n";
    let body = json.map(function(d){
        return Object.keys(d).map(function(key) {
            return d[key];
        }).join(delimiter);
    }).join("\n");
    return header + body;
}

/**
 * csvをjsonへ変換
 * @param {*} csvArray 
 * @returns 
 */
function csvToJson(csv){
    let json = [];

    $.each(csv,function(idx,val){
        if(!idx) return true;
        json[idx-1] = { ja:val[0],en:val[1],def:val[2],group:val[3],cv:val[4] };
    });
    return json;
}

/**
 * CSV取り込み
 * @param {*} csv 
 * @param {*} event 
 */
function csv_encode(csv,event=active_event()){

    console.log("CSV ENCODE START");

    let json = csvToJson(csv);

    set_storage(event,json);
    data_set(event);
    dscore_calc(event);

    console.log("CSV ENCODE END");

}

/**
 * CSV出力
 * 
 * @param {*} event 
 * @returns CSV_DATA DOWNLOAD
 */
function csv_decode( delimiter=",",event=active_event()){

    let json = get_storage(event);
    
    let date = new Date();
    let now = formatDate(date);
    let filename = event + '_' + now;

    let csv = jsonToCsv(json,',',filename);

    //拡張子
    let extention = delimiter==","?"csv":"tsv";

    //出力ファイル名
    let exportedFilenmae = (filename  || 'export') + '.' + extention;

    //BLOBに変換
    let blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });

    if (navigator.msSaveBlob) { // for IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        //anchorを生成してclickイベントを呼び出す。
        let link = document.createElement("a");
        if (link.download !== undefined) {
            let url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }

}


/*------------------------------
    STORAGE SAVE & LOAD
--------------------------------*/

/**
 * 以前保存したローカルストレージから技構成データを読み込む
 * @param {*} event 
 * @returns Json
 */ 
 function get_storage(event){

    let setName = event+'_storage';
    let data = localStorage.getItem(setName);
    let setJson = JSON.parse(data);

    console.log(setJson);

    return setJson;

}

/**
 * 種目のデータをJSON形式で保存する
 * @param {*} event 
 * @param {*} json 
 */
 function set_storage(event,json=''){

    if(!json){
        json = [
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' },
            { ja:'"TOUCH" to SELECT ELEMENTS',en:'',def:'',group:'',cv:'' }
        ];
    }

    let setName = event+'_storage';
    let setJson = JSON.stringify(json);
    
    console.log(event+" SET STORAGE");
    localStorage.setItem(setName,setJson);

}



/** 通知欄の表示処理
 * 
 */
function set_notice(type='Info',text,event=active_event()){

    let date = new Date();
    let now = date.toLocaleString();

    if(type == 'allclear'){
        console.log("NOTICE : ALL CLEAR");
        $(".tab-content."+event+" .notice-box .notices").text("");
        exit;
    }
    let color = '';
    if(type == "Danger") color = 'style="color:red;"';

    let h = '<p '+color+'><span class="notive-type">'+type+'</span><span class="notice-text">'+text+' <span class="date">['+now+']</span></span></p>';
    $(".tab-content."+event+" .notice-box .notices").prepend(h);
    
}

/**
 * 
 * 技情報の取得
 * 技データの反映
 * 
 * @param {unset} 設定するとその種目をスルーする
 */
function set_elements(unsets=''){
    
    let events = ['fx','ph','sr','vt','pb','hb'];

    if(unsets){
        $.each(unsets,function(idx,val){
            let index = events.indexOf(val);
            events.splice(index,1);
            console.log('ELEMENT UNSET：'+val);
        })
    };

    $.each(events, function(idx,val){
        
        let event = val;
        let json_file = val+'.json';

        $.ajax({
            type:'GET',
            url:'/json/'+json_file,
            dataType:'json'
        })
        .then(function(json){
            
            console.log(json);

            let val_count = [
                {'A':0},
                {'B':0},
                {'C':0},
                {'D':0},
                {'E':0},
                {'F':0},
                {'G':0},
                {'H':0},
                {'I':0},
                {'J':0}
            ];//[A~J]
            let group_count = [
                {'Ⅰ':0},
                {'Ⅱ':0},
                {'Ⅲ':0},
                {'Ⅳ':0}
            ];//[Ⅰ,Ⅱ,Ⅲ,Ⅳ]

            $.each(json['element'],function(idx,val){
                let h = '<div class="element" data-key="'+val['key']+'" data-group="'+val['group']+'" data-val="'+val['vv']+'">'+'<span class="ja">'+val['name']+'</span>'+'<span class="en">'+val['name_en']+'</span>'+'</div>';
                $(".level-event[data-event="+event+"]").append(h);
                val_count[val['vv']]++;
                group_count[val['group']]++;
            });

        },function(e){
            alert('error');
            console.log(e);
        });

        //セーブデータロード
        data_set(event);
        dscore_calc(event);

    });
}

/**
 * グループ選択モーダル
 */
function select_group(event){

    const EVENT_GROUPS = [
        {event:'fx',groups:["I","Ⅱ","Ⅲ"]},
        {event:'ph',groups:["I","Ⅱ","Ⅲ","Ⅳ"]},
        {event:'sr',groups:["I","Ⅱ","Ⅲ","Ⅳ"]},
        {event:'vt',groups:["I","Ⅱ","Ⅲ","Ⅳ"]},
        {event:'pb',groups:["I","Ⅱ","Ⅲ","Ⅳ"]},
        {event:'hb',groups:["I","Ⅱ","Ⅲ","Ⅳ"]}
    ];

    let set_event = $.grep(EVENT_GROUPS,function(obj,idx){
        return (obj.event == event);
    });

    console.log(set_event);

    $(".level-group").hide();
    $.each(set_event[0]['groups'],function(idx,val){
        $(".level-group[data-group="+val+"]").show();
    });


}

/** 難度選択モーダル
 * 
 */
function select_value(){

    select_element(active_event());
    $(".values").show();

}

/** 技選択モーダル
 * 
 */
function select_element(event=""){

    let active_group = $(".level-group.active").attr("data-group");
    let active_value = $(".level-value.active").attr("data-value");

    console.log("active_group：" + active_group);
    console.log("active_value：" + active_value);
    
    $(".level-event").hide();
    $(".level-event[data-event='"+event+"']").show();
    $(".level-event[data-event='"+event+"'] .element").hide();
    $(".level-event[data-event='"+event+"'] .element[data-group='"+active_group+"'][data-val='"+active_value+"']").show();

}


/** アクティブな情報を拾ってモーダルにセットする
 * 
 * @param {*} this $(".elm")
 */
function modal_init(group="",def=""){

    let event = active_event();

    $(".level").removeClass("active");

    if(!group){
        
        $(".values").hide();
        $(".level-event").hide();
        
    }else{

        $(".level-group[data-group="+group+"]").addClass("active");
        $(".level-value[data-value="+def+"]").addClass("active");
        $(".values").show();
        
        select_element(event);
    }

}


/** アクティブな種目を返す
 * 
 * @returns EVENTS fx ~ hb
 * 
 */
function active_event(){
    return $(".js-tab>div.active").attr("data-event");
}

/** モーダル表示スイッチ
 * 
 * 
 * @param {string} set 'remove' => remove the moldal.
 */
function modal_toggle(set="",modal="select-modal",data=""){

    modal_init(data[0],data[1]);

    if($(".darklayer").hasClass("active") || set == 'remove'){
        $(".darklayer").removeClass("active");
        $(".modal").removeClass("active");
    }else{
        $(".darklayer").addClass("active");
        $(".modal."+modal).addClass("active");
    }
}

/**
 * 選択した値を当て込む
 * @param {array} data [Group,value,id,name,name_en]
 */
function active_set_data(active_num,data){
    let event = active_event();
    let elm = $('.tab-content.'+event+' .elm[data-key="'+active_num+'"]');

    let active_group = elm.find(".group-score");
    let active_value = elm.find(".def-score");
    let active_content = elm.find(".content");

    let group = data[0];
    let value = data[1];
    let content_ja = data[2];
    let content_en = data[3];
    
    active_group.text(group);
    active_value.text(value);
    active_content.html('<span class="ja">'+content_ja+'</span><span class="en">'+content_en+'</span>');

    let json = get_storage(active_event());
    json[active_num-1] = {ja:content_ja,en:content_en,def:value,group:group,cv:''};
    set_storage(event,json);
}

/**
 * CVをセットする
 */
function cv_set(active_num,data){

    let event = active_event();

    let json = get_storage(active_event());
    json[active_num-1]['cv'] = data;
    set_storage(event,json);
    data_set(event);
    dscore_calc(event);

}

$(function(){

    var active_num;

    //初期設定
    //データがStorageに保存されていなければ初期値を設定する。
    if(!get_storage('fx')){
        console.log("INIT STORAGE SET");
        
        let events = ['fx','ph','sr','vt','pb','hb'];
        $.each(events, function(idx,val){
            set_storage(val);
        });
    }
    
    //技をセットする
    let unsets = ['vt','hb',];
    set_elements(unsets);
    
    //モーダルの暗幕クリック処理
    $(".darklayer").on("click",function(){
        modal_toggle("remove");
    });

    //欄選択時
    $(".elm .content").on("click",function(){
        let event = active_event();
        select_group(event);

        let parent = $(this).parents(".elm");
        let set_group = parent.find(".group-score").text();
        let set_def = parent.find(".def-score").text();

        active_num = parent.attr("data-key");
        
        $(".score-body").slideUp();//スコア一覧を閉じる
        modal_toggle("","select-modal",[set_group,set_def]);
    });

    //グループ選択時処理
    $(".level-group").on("click",function(){
        $(".level-group").removeClass("active");
        $(this).addClass("active");

        select_value();
    });

    //難度選択時処理
    $(".level-value").on("click",function(){
        let event = active_event();

        $(".level-value").removeClass("active");
        $(this).addClass("active");

        select_element(event);
        $(".elements").show();

    });

    //技選択時処理
    $(".select-modal").on("click",".element",function(){

        let event = active_event();

        let data = [];//[group,value,ja,en]
        data[0] = $(".level-group.active").attr("data-group");
        data[1] = $(".level-value.active").attr("data-value");
        data[2] = $(this).find(".ja").text();
        data[3] = $(this).find(".en").text();

        active_set_data(active_num,data);
        dscore_calc(event);

        modal_toggle();
    });

    //CV欄押下時 モーダル展開
    $(".elm .cv").on("click",function(){
        modal_toggle("","cv-modal");
        active_num = $(this).parents(".elm").attr("data-key");
    });

    //CVモーダル　クリア選択時
    $(".cv-modal .clear-btn").on("click",function(){
        cv_set(active_num,"");
        modal_toggle();
    });
    //CVモーダル　項目選択時
    $(".cv-modal .level").on("click",function(){
        
        let data;
        
        if($(this).hasClass("level-cv")){
            data = $(this).attr("data-cv");
        }
        if($(this).hasClass("level-group4")){
            data = $(this).attr("data-group");
        }
        console.log(active_num,data);
        cv_set(active_num,data);

        modal_toggle();

    });

    //データ削除ボタン押下処理
    $(".delete-btn").on("click",function(){
        let event = active_event();
        if(confirm(event+"の技情報をリセットします")){
            data_resets(event);
        }
    });

    //CSVファイル取り込み
    $('input[name="csv_file"]').on("change",function(e){

        // 2：FileAPIがブラウザに対応してるか
        if (!checkFileReader()) {
            alert("エラー：FileAPI非対応のブラウザです。");
            return;
        }
        // ファイル情報を取得
        let fileData = e.target.files[0];
        //console.log(fileData);

        // CSVファイル以外は処理を止める
        if(!fileData.name.match('.csv$')) {
            alert('CSVファイルを選択してください');
            return;
        }
        // FileReaderオブジェクトを使ってファイル読み込み
        let reader = new FileReader();
        reader.onload = function() {
            let cols = reader.result.split('\n');
            let data = [];
            for (let i = 0; i < cols.length; i++) {
                data[i] = cols[i].split(',');
            }
            console.log(data);
            csv_encode(data);
        }
        // ファイル読み込みを実行
        reader.readAsText(fileData);
    });
    
    //CSVファイル出力
    $(".csv-decode").on("click", function(){
        csv_decode();
        set_notice("Info","CSVファイルを出力しました");
    });

});