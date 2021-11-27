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
                      <th>FX</th>
                      <td>{{ $data['fx']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>PH</th>
                      <td>{{ $data['ph']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>SR</th>
                      <td>{{ $data['sr']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>VT</th>
                      <td>{{ $data['vt']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>PB</th>
                      <td>{{ $data['pb']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>HB</th>
                      <td>{{ $data['hb']['ts'] }}</td>
                    </tr>
                    <tr>
                      <th>TOTAL SCORE</th>
                      <td>{{ $data['ts'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div><!-- /.row -->




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

</style>
@endsection
@section('script')
<script>
var ctx = document.getElementById('mychart-radar');
var myChart = new Chart(ctx, {
  type: 'radar',
  data: {
    labels: ['FX', 'PH', 'SR', 'VT', 'PB', 'HB'],
    datasets: [{
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
    }],
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