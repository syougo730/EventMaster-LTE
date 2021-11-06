/** *****************************************
 *
 * @file Ds.Creator
 * 
 * 本プログラムはFIG、日本体操協会の制定する体操競技のルールを元に作成されていますが、日本体操協会の許可を得て作成している訳ではありません。
 * 日本体操協会の許可なく営利目的での体操競技に関わるものの活動は認められていません。
 * 本プログラムは体操競技関係者が体操競技の発展を願って作成してます。
 * 本プログラムの無断利用はお控えして頂きますようお願い申し上げます。
 * 
 * **************************************** */

/** データリセット
 * 全ては無に帰す
 * 
 * @param {*} data 
 * @param {*} event 
 */
function data_resets(){

}

/**
    データ反映
*/ 
function data_set(data,event){

}

/** 
 *   TOTAL SCORE 計算
 */
 function dscore_calc(event){



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
function group_calc(groups){

    const MAX = 5; //グループ上限
    const GROUP_SCORE = [
        {group:'Ⅰ' , val:0.5},
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

    //test
    groups = ['Ⅰ','Ⅱ','Ⅰ','Ⅰ','Ⅰ','Ⅰ','Ⅰ','Ⅰ','Ⅰ','Ⅳc',];

    $.each(groups, function(idx,val){
        switch (val) {
            case 'Ⅰ':
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
        
            default:
                break;
        }
    });

    if(group1_cnt > MAX) set_notice('danger','グループⅠが上限数を超えています');
    if(group2_cnt > MAX) set_notice('danger','グループⅡが上限数を超えています');
    if(group3_cnt > MAX) set_notice('danger','グループⅢが上限数を超えています');
    if(group4_cnt > 1) set_notice('danger','終末技が複数セットされています');

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
function def_to_val(def){

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


/* 
    CSV読み込み、反映
*/
function csv_encode(data,event){

    let csv = [];

    data_set(csv,event);
}

/**
 * 
 * 以前保存したローカルストレージから技構成データを読み込む
 * 
 */ 
 function get_storage(event){

    let setName = event+'_storage';
    let data = localStorage.getItem(setName);
    let setJson = JSON.parse(data);

    console.log(setJson);

    //data_set();

}

/**
 * 
 * 種目のデータをJSON形式で保存する
 * 
 */ 
 function set_storage(json,event){

    // json = [
    //     { element:'aaa',def:'A',group:'Ⅰ' },
    //     { element:'bbb',def:'B',group:'Ⅱ' },
    //     { element:'ccc',def:'C',group:'Ⅲ' },
    // ];

    let setName = event+'_storage';
    let setJson = JSON.stringify(json);
    
    localStorage.setItem(setName,setJson);

}

/**
 * 
 * 通知欄の表示処理
 * 
 */
function set_notice(type='info',text,event=active_event()){

    if(type == 'allclear'){
        console.log("NOTICE : ALL CLEAR");
        $(".tab-content."+event+" .notice-box .notices").text("");
        exit;
    }
    let color = '';
    if(type == "danger") color = 'style="color:red;"';

    let h = '<p '+color+'>'+type+"："+text+'</p>';
    $(".tab-content."+event+" .notice-box .notices").append(h);
    
}

/**
 * 
 * 技情報の取得
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
    
    $(".level-event[data-event='"+event+"'] .element").hide();
    $(".level-event[data-event='"+event+"'] .element[data-group='"+active_group+"'][data-val='"+active_value+"']").show();

}


/** アクティブな情報を拾ってモーダルにセットする
 * 
 * @param {*} this $(".elm")
 */
function modal_init(that){

    let event = active_event();
    let elm_id = that.attr("data-key");

    console.log(event+" , "+elm_id);

}


/**
 * HTMLセッティング
 */
function set_html(){
    
    const MAX_ELEMENTS = 10;//最大技数数
    //const EVENTS = ['fx','ph','sr','vt','pb','hb'];
    const EVENTS = ['fx'];

    $.each(EVENTS,function(idx,event){

        let cnt = event !== 'vt' ? MAX_ELEMENTS+1 : 1; //跳馬だけ1技
        let cv = event !== 'fx' ? 'CV' : 'GroupⅣ / CV'; //床だけgroupⅣ
        let h = '';

        for (let i = 1; i < cnt; i++) {
            h += '<div class="elm" data-key="'+i+'">';
            h += '<div class="num">'+i+'</div>';
            h += '<div class="content">';
            h +=   '<span class="ja">"TOUCH"to SELECT ELEMENTS</span>';
            h +=   '<span class="en"></span>';
            h += '</div>';
            h += '<div class="scores">';
            h +=   '<div class="group-score"></div>';
            h +=   '<div class="def-score"></div>';
            h += '</div>';
            h += '<div class="cv">'+cv+'</div>';
            h += '</div>';
        }

        $(".tab-content."+event+" .elements-wrap").append(h);

    });

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
function modal_toggle(set=""){
    if($(".darklayer").hasClass("active") || set == 'remove'){
        $(".darklayer").removeClass("active");
        $(".modal").removeClass("active");
    }else{
        $(".darklayer").addClass("active");
        $(".modal").addClass("active");
    }
}

/**
 * 選択した値を当て込む
 * @param {array} data [Group,value,id,name,name_en]
 */
function active_set_data(dom,data){
    
    let active_group = dom[0];
    let active_value = dom[1];
    let active_content = dom[2];

    let group = data[0];
    let value = data[1];
    let content_ja = data[2];
    let content_en = data[3];
    
    active_group.text(group);
    active_value.text(value);
    active_content.html('<span class="ja">'+content_ja+'</span><span class="en">'+content_en+'</span>');

}

$(function(){

    //動的に生成した要素はDOMが操作できないので操作すべき要素を記憶しておく
    var active_elm;
    var active_group;
    var active_value;
    var active_content;

    //関数テスト-----------------

    console.log(def_to_val('C'));
    get_storage('fx');
    console.log(group_calc('test'));
    set_notice("info","通知テスト");
    set_notice("danger","通知テスト");

    //---------------------------

    let unsets = ['ph','sr','vt','pb','hb',];
    set_elements(unsets);

    set_html();
    
    //モーダルの暗幕クリック処理
    $(".darklayer").on("click",function(){
        modal_toggle("remove");
    });

    //欄選択時
    $(".elm .content").on("click",function(){
        let event = active_event();
        select_group(event);

        //動的に生成した要素はDOMが操作できないので操作すべき要素をしまっておく
        let elm = $(this).parents(".elm");
        active_elm = elm;
        active_group = elm.find(".group-score");
        active_value = elm.find(".def-score");
        active_content = elm.find(".content");
        
        if($(".elm").hasClass("set")){
            //モーダルの初期設定
            modal_init($(this).parents(".elm"));
        }

        $(".score-body").slideUp();//スコア一覧を閉じる
        modal_toggle();
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

        let dom = [active_group,active_value,active_content];
        let event = active_event();

        let data = [];//[group,value,ja,en]
        data[0] = $(".level-group.active").attr("data-group");
        data[1] = $(".level-value.active").attr("data-value");
        data[2] = $(this).find(".ja").text();
        data[3] = $(this).find(".en").text();

        active_set_data(dom,data);
        dscore_calc(event);

        modal_toggle();
    });


});