@extends('layouts.common')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">Ds.Creator</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Ds.Creator</li>
  </ol>
</div><!-- /.col -->

@endsection

@section('content')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="config">
          <div class="btn csv-encode">CSV読み込み</div>
        </div>

        <div id="dscreator" class="jura">

          <div class="js-tab">
            <div class="ts" data-event="ts">TS</div>
            <div class="fx active" data-event="fx">FX</div>
            <div class="ph" data-event="ph">PH</div>
            <div class="sr" data-event="sr">SR</div>
            <div class="vt" data-event="vt">VT</div>
            <div class="pb" data-event="pb">PB</div>
            <div class="hb" data-event="hb">HB</div>
          </div>

          <div class="tab-content ts" data-role="page" id="page1"></div>
          <div class="tab-content fx" data-role="page" id="page2">
              <div class="elements-wrap"><!-- JS --></div>
          </div>

          <div class="modals-wrap">
            <div class="modal group-modal">
              <div class="groups">
                <div class="level level-group" data-group="1">Ⅰ</div>
                <div class="level level-group" data-group="2">Ⅱ</div>
                <div class="level level-group" data-group="3">Ⅲ</div>
                <div class="level level-group" data-group="4">Ⅳ</div>
                <div class="level level-group" data-group="5">Ⅴ</div>
              </div>
              <div class="values" style="display: none">
                <div class="level level-value" data-value="1">A</div>
                <div class="level level-value" data-value="2">B</div>
                <div class="level level-value" data-value="3">C</div>
                <div class="level level-value" data-value="4">D</div>
                <div class="level level-value" data-value="5">E</div>
                <div class="level level-value" data-value="6">F</div>
                <div class="level level-value" data-value="7">G</div>
                <div class="level level-value" data-value="8">H</div>
                <div class="level level-value" data-value="9">I</div>
                <div class="level level-value" data-value="10">J</div>
              </div>
              <div class="elements" style="display: none">
                <div class="level level-event" data-event="fx"></div>
                <div class="level level-event" data-event="ph"></div>
                <div class="level level-event" data-event="sr"></div>
                <div class="level level-event" data-event="vt"></div>
                <div class="level level-event" data-event="pb"></div>
                <div class="level level-event" data-event="hb"></div>
              </div>
            </div> 
          </div>
          
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('pagehead')
<link href="https://fonts.googleapis.com/css?family=Jura:400,700|Noto+Sans+SC" rel="stylesheet">
<link rel="stylesheet" href="/css/ds.css?<?=date('dHis')?>">
<style>

</style>
@endsection

@section('script')
<script src="/js/ds.js?<?=date('dHis')?>"></script>
<script>	
$(function(){	
    
  /*-----------------------------
    タブ切り替え
  -------------------------------*/
  
  window.scrollTo(0,1);
      
  //$('#page2,#page3,#page4,#page5,#page6,#page7').hide();
  
  $('.js-tab > div').click(function(){
    $('.js-tab > div,.js-tab_content').removeClass('active');
    var tabClass = $(this).attr('class');
    $(this).addClass('active');
    $('.js-tab_content').each(function(){
      if($(this).attr('class').indexOf(tabClass) != -1){
        $(this).addClass('active').fadeIn();
      }else{
        $(this).hide();
      }
    });
  });


});
</script>
@endsection
