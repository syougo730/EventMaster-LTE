@extends('layouts.open')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">Ds.Creator Ver{{ $version }}</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Ds.Creator Ver{{ $version }}</li>
  </ol>
</div><!-- /.col -->

@endsection

@section('content')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="config">
          <label class="btn csv-encode">CSV読込<input type="file" name="csv_file" accept=".csv" style="display:none;"></label>
          <div class="btn csv-decode">CSV出力</div>
          <div class="btn data-btn">DATA1</div>
          <div class="btn data-btn">DATA2</div>
          <div class="btn data-btn">DATA3</div>
          <div class="btn delete-btn">RESET</div>
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
          
          <!-- --------------------------------
                Floor Exercise
          ---------------------------------- -->
          <div class="tab-content fx" data-role="page" id="page2">
              <div class="elements-wrap">
                @for($i = 1; $i < 11; $i++)
                <div class="elm" data-key="{{ $i }}">
                  <div class="num">{{ $i }}</div>
                  <div class="content">
                    <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                    <span class="en"></span>
                  </div>
                  <div class="scores">
                    <div class="group-score"></div>
                    <div class="def-score"></div>
                  </div>
                  <div class="cv">GroupⅣ / CV</div>
                </div>
                @endfor
              </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>

          <!-- --------------------------------
                Pommel Hourse
          ---------------------------------- -->
          <div class="tab-content ph" data-role="page" id="page3">
            <div class="elements-wrap">
              @for($i = 1; $i < 11; $i++)
              <div class="elm" data-key="{{ $i }}">
                <div class="num">{{ $i }}</div>
                <div class="content">
                  <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                  <span class="en"></span>
                </div>
                <div class="scores">
                  <div class="group-score"></div>
                  <div class="def-score"></div>
                </div>
              </div>
              @endfor
            </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>
          
          <!-- --------------------------------
                Still Rings
          ---------------------------------- -->
          <div class="tab-content sr" data-role="page" id="page4">
            <div class="elements-wrap">
              @for($i = 1; $i < 11; $i++)
              <div class="elm" data-key="{{ $i }}">
                <div class="num">{{ $i }}</div>
                <div class="content">
                  <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                  <span class="en"></span>
                </div>
                <div class="scores">
                  <div class="group-score"></div>
                  <div class="def-score"></div>
                </div>
              </div>
              @endfor
            </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>

          <!-- --------------------------------
                Vault
          ---------------------------------- -->
          <div class="tab-content vt" data-role="page" id="page5">
            <div class="elements-wrap">
              @for($i = 1; $i < 2; $i++)
              <div class="elm" data-key="{{ $i }}">
                <div class="num">{{ $i }}</div>
                <div class="content">
                  <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                  <span class="en"></span>
                </div>
                <div class="scores">
                  <div class="group-score"></div>
                  <div class="def-score"></div>
                </div>
              </div>
              @endfor
            </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>

          <!-- --------------------------------
                Parallel Bars
          ---------------------------------- -->
          <div class="tab-content pb" data-role="page" id="page6">
            <div class="elements-wrap">
              @for($i = 1; $i < 11; $i++)
              <div class="elm" data-key="{{ $i }}">
                <div class="num">{{ $i }}</div>
                <div class="content">
                  <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                  <span class="en"></span>
                </div>
                <div class="scores">
                  <div class="group-score"></div>
                  <div class="def-score"></div>
                </div>
              </div>
              @endfor
            </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>
          
          <!-- --------------------------------
                Horizontal Bar
          ---------------------------------- -->
          <div class="tab-content hb" data-role="page" id="page7">
            <div class="elements-wrap">
              @for($i = 1; $i < 11; $i++)
              <div class="elm" data-key="{{ $i }}">
                <div class="num">{{ $i }}</div>
                <div class="content">
                  <span class="ja">"TOUCH"to SELECT ELEMENTS</span>
                  <span class="en"></span>
                </div>
                <div class="scores">
                  <div class="group-score"></div>
                  <div class="def-score"></div>
                </div>
                <div class="cv">CV</div>
              </div>
              @endfor
            </div>
              <div class="notice-box">
                <span class="jura">Notice</span>
                <div class="notices noto"><!-- JS --></div>
              </div>
          </div>
          
          
          <!-- --------------------------------
                SELECT ELEMENTS MODAL
          ---------------------------------- -->
          <div class="modals-wrap">
            <div class="darklayer"></div>
            <div class="modal select-modal">

              <div class="modal-area-wrap">
                <div class="groups">
                  <div class="level level-group" data-group="I">I</div>
                  <div class="level level-group" data-group="Ⅱ">Ⅱ</div>
                  <div class="level level-group" data-group="Ⅲ">Ⅲ</div>
                  <div class="level level-group" data-group="Ⅳ">Ⅳ</div>
                  <div class="level level-group" data-group="Ⅴ">Ⅴ</div>
                </div>
                <div class="btn clear-btn">クリア</div>
              </div>
              
              <div class="values" style="display: none">
                <div class="level level-value" data-value="A">A</div>
                <div class="level level-value" data-value="B">B</div>
                <div class="level level-value" data-value="C">C</div>
                <div class="level level-value" data-value="D">D</div>
                <div class="level level-value" data-value="E">E</div>
                <div class="level level-value" data-value="F">F</div>
                <div class="level level-value" data-value="G">G</div>
                <div class="level level-value" data-value="H">H</div>
                <div class="level level-value" data-value="I">I</div>
                <div class="level level-value" data-value="J">J</div>
              </div>
              <div class="elements" style="display: none">
                <div class="level-event" data-event="fx"></div>
                <div class="level-event" data-event="ph"></div>
                <div class="level-event" data-event="sr"></div>
                <div class="level-event" data-event="vt"></div>
                <div class="level-event" data-event="pb"></div>
                <div class="level-event" data-event="hb"></div>
              </div>
            </div> 

            <div class="modal cv-modal">
              
              <div class="modal-area-wrap">
                <div class="cv">
                  <div class="level level-cv" data-cv="0.1">0.1</div>
                  <div class="level level-cv" data-cv="0.2">0.2</div>
                </div>
                <div class="btn clear-btn">クリア</div>
              </div>

              <div class="groups">
                <div class="level level-group4" data-group="Ⅳa">Ⅳa</div>
                <div class="level level-group4" data-group="Ⅳb">Ⅳb</div>
                <div class="level level-group4" data-group="Ⅳc">Ⅳc</div>
                <div class="level level-group4" data-group="Ⅳ">Ⅳ</div>
              </div>


            </div>
          </div>
          

          <!-- --------------------------------
                SCORES ACCORDION
          ---------------------------------- -->
          <div class="total-scores">
            <div class="score-header">
              <span class="score-header-title">FloorExercise</span>
              <span class="score-header-content">0.0</span>
            </div>
            <div class="score-body" style="display: none">
              <div class="events">
                <!-- FX -->
                <div class="fx">
                  <p class="event-title">FloorExercise</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>
                <!-- PH -->
                <div class="ph">
                  <p class="event-title">PommelHourse</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>
                <!-- SR -->
                <div class="sr">
                  <p class="event-title">StillRings</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>
                <!-- VT -->
                <div class="vt">
                  <p class="event-title">Vault</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>
                <!-- PB -->
                <div class="pb">
                  <p class="event-title">ParallelBars</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>
                <!-- HB -->
                <div class="hb">
                  <p class="event-title">HorizontalBar</p>
                  <div class="difficult">
                    <span>難度</span>
                    <span>0.0</span>
                  </div>
                  <div class="exp">
                    <span>特別要求</span>
                    <span>0.0</span>
                  </div>
                  <div class="cv">
                    <span>CV</span>
                    <span>0.0</span>
                  </div>
                  <div class="dscore">
                    <span>Dscore</span>
                    <span>0.0</span>
                  </div>
                </div>

              </div>
              
              <div class="score-footer">
                <div class="total-difficult">
                  <span>難度</span>
                  <span>0.0</span>
                </div>
                <div class="total-exp">
                  <span>特別要求</span>
                  <span>0.0</span>
                </div>
                <div class="total-cv">
                  <span>CV</span>
                  <span>0.0</span>
                </div>
                <div class="total-score">
                  <span class="score-footer-title">TOTAL SCORE</span>
                  <span class="score-footer-content">0.0</span>
                </div>
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
      
  $('#page1,#page3,#page4,#page5,#page6,#page7').hide();

  $('.js-tab > div').click(function(){
    $('.js-tab > div,.tab-content').removeClass('active');
    var tabClass = $(this).attr('class');
    $(this).addClass('active');
    $('.tab-content').each(function(){
      if($(this).attr('class').indexOf(tabClass) != -1){
        $(this).addClass('active').fadeIn();
      }else{
        $(this).hide();
      }
    });
  });

  $(".score-header").on("click",function(){
    $(".score-body").slideToggle();
  });


});
</script>
@endsection
