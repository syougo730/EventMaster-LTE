@extends('layouts.common')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">{{ $athlete->athlete_name }}</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/event/">試合一覧</a></li>
    <li class="breadcrumb-item"><a href="/event/{{ $event_id }}/">試合結果</a></li>
    <li class="breadcrumb-item active">選手情報</li>
  </ol>
</div><!-- /.col -->

@endsection

@section('content')



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $event->event_name }}</h3>
            </div>
        </div>

        <!-- ATHLETE DATA -->
        <div class="row">


          <div class="col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">EVENT DATA</h3>
              </div>
              <div class="card-body">
                <canvas id="mychart-radar"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">ATHLETE DATA</h3>
              </div>
              <div class="card-body">
                <table class="prof-table">
                  <tbody>
                    <tr>
                      <th>選手番号</th>
                      <td>{{ $athlete->athlete_number }}</td>
                    </tr>
                    <tr>
                      <th>所属</th>
                      <td>{{ $athlete->team_name() }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-fx">FX</a></th>
                      <td>{{ $data['fx']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-ph">PH</a></th>
                      <td>{{ $data['ph']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-sr">SR</a></th>
                      <td>{{ $data['sr']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-vt">VT</a></th>
                      <td>{{ $data['vt']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-pb">PB</a></th>
                      <td>{{ $data['pb']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th><a href="#element-hb">HB</a></th>
                      <td>{{ $data['hb']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>TOTAL SCORE</th>
                      <td><b>{{ $data['ts'] }}</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div><!-- /.row -->

        <!-- ********************
              FX
          ********************* -->
          <div id="element-fx" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">FX</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_fx" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <div class="element-box">
                <div class="element-num">1</div>
                <div class="element-name">
                  <div class="ja">あああああああああああ</div>
                  <div class="en">aaaaaaaaaaaaa</div>
                </div>
                <div class="element-status">
                  <div class="status-group">Ⅲ</div>
                  <div class="status-difficult">B</div>
                </div>
                <div class="element-cv">0.1</div>
              </div>
            </div>
          </div>

        <!-- ********************
              PH
          ********************* -->
          <div id="element-ph" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">PH</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_ph" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <!-- JS -->
            </div>
          </div>

        <!-- ********************
              SR
          ********************* -->
          <div id="element-sr" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">SR</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_sr" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <!-- JS -->
            </div>
          </div>

        <!-- ********************
              VT
          ********************* -->
          <div id="element-vt" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">VT</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_vt" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <!-- JS -->
            </div>
          </div>

        <!-- ********************
              PB
          ********************* -->
          <div id="element-pb" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">PB</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_pb" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <!-- JS -->
            </div>
          </div>

        <!-- ********************
              HB
          ********************* -->
          <div id="element-hb" class="card elements-card">
            <div class="card-header border-0">
              <h3 class="card-title">HB</h3>
              <label class="btn import-btn">
                <input type="file" accept=".csv" name="csv_import_hb" style="display: none">
                <span>CSV読込</span>
              </label>
            </div>
            <div class="card-body">
              <!-- JS -->
            </div>
          </div>
            

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->




@endsection

@section('pagehead')
<style>
table.prof-table {
    width: 100%;
}
table.prof-table td, 
table.prof-table th {
    border: 1px solid #cbcbcb;
    padding: 5px;
}
table.prof-table td {
    text-align: right;
}

.card.elements-card .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn.import-btn {
    margin: 0;
    background-color: #007bff;
    color: #fff;
}
.elements-card .card-header::after {
    content: none;
}
.element-box {
    display: flex;
    align-items: center;
    font-size: 12px;
}
.element-box>div {
    padding: 3px 6px;
    margin: 1px;
    background: #f3f3f3;
    min-height: 40px;
    min-width: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}.element-num {
    text-align: center;
}.element-status {
    align-items: center;
}.element-name {
    width: 100%;
    white-space: nowrap;
    overflow: auto;
}

/*スクロールバー*/
.element-box ::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}
.element-box ::-webkit-scrollbar-track {
  border-radius: 10px;
  box-shadow: inset 0 0 6px rgba(0, 0, 0, .1);
}
.element-box ::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 50, .5);
  border-radius: 10px;
  box-shadow:0 0 0 1px rgba(255, 255, 255, .3);
}
</style>
@endsection
@section('script')
<script>
var ctx = document.getElementById('mychart-radar');
var myChart = new Chart(ctx, {
  type: 'radar',
  data: {
    labels: ['FX', 'PH', 'SR', 'VT', 'PB', 'HB'],
    datasets: [
      {
        label: 'E SCORE',
        data: [
          {{ $data['fx']['es'] }},
          {{ $data['ph']['es'] }},
          {{ $data['sr']['es'] }},
          {{ $data['vt']['es'] }},
          {{ $data['pb']['es'] }},
          {{ $data['hb']['es'] }}
        ],
        // データライン
        backgroundColor:'rgb(231 76 60 / 25%)',
        borderColor: '#e74c3c',
        borderWidth: 2,
        pointRadius:6,
        pointBackgroundColor:'lightRed',
      },
      {
        label: 'TOTAL SCORE',
        data: [
          {{ $data['fx']['ts'] }},
          {{ $data['ph']['ts'] }},
          {{ $data['sr']['ts'] }},
          {{ $data['vt']['ts'] }},
          {{ $data['pb']['ts'] }},
          {{ $data['hb']['ts'] }}
        ],
        // データライン
        backgroundColor:'rgb(0 123 255 / 25%)',
        borderColor: '#007bff',
        borderWidth: 2,
        pointRadius:6,
        pointBackgroundColor:'lightBlue',
      },
    ],
  },
  options: {
    scale: {
      title:{
        fontSize:20,
      },
      ticks: {
        // 目盛り
        min: 4,
        max:16,
        stepSize: 2,
        fontSize: 12,
        fontColor: "gray"
      },
      r: {
        // 最小値・最大値
        min: 5,
        max: 17,
        // 背景色
        backgroundColor: 'lightyellow',
        // グリッドライン
        grid: {
          color: 'lightseagreen',
        },
        // アングルライン
        angleLines: {
          color: 'brown',
        },
        // ポイントラベル
        pointLabels: {
          color: 'blue',
          backdropColor: '#ddf',
          backdropPadding: 5,
          padding: 20,
        },
      },
    },
  },
});

</script>
@endsection