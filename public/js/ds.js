/** *****************************************
 *
 * @file Ds.Creator
 * 
 * **************************************** */

/* 
    CSV読み込み、反映
*/
function csv_encode(data,event){

    let csv = [];

    data_set(csv,event);
}

/**
    データ反映
*/ 
function data_set(data,event){

}

/*
    TOTAL SCORE 計算
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

    if(group1_cnt > MAX) set_notice('グループⅠが上限数を超えています','danger');
    if(group2_cnt > MAX) set_notice('グループⅡが上限数を超えています','danger');
    if(group3_cnt > MAX) set_notice('グループⅢが上限数を超えています','danger');
    if(group4_cnt > 1) set_notice('終末技が複数セットされています','danger');

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


/**
 * 
 * 以前保存したストレージから技構成データを読み込む
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
function set_notice(text,type='info'){

    console.log( type + '：' + text );

}

/**
 * 
 * 技情報の取得
 * 
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
                
                let h = '<div class="element" data-group="'+val['group']+'" data-val="'+val['vv']+'">'+'<span class="ja">'+val['name']+'</span>'+'<span class="en">'+val['name_en']+'</span>'+'</div>';
                $(".elements-modal").append(h);
                val_count[val['vv']]++;
                group_count[val['group']]++;

            });

            $.each(val_count,function(idx,val){
                if(!val){
                    $("."+event+" .value").attr('data-val',val).hide();
                }
            });
            $.each(group_count,function(idx,val){
                if(!val){
                    $("."+event+" .group").hide();
                }                
            });

        },function(e){
            alert('error');
            console.log(e);
        });

    });


}




$(function(){

    console.log(def_to_val('C'));
 
    get_storage('fx');

    console.log(group_calc('test'));

    var unsets = ['ph','sr','vt','pb','hb',];
    set_elements(unsets);

});