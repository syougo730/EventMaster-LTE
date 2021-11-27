@extends('layouts.common') 
@section('header')
  <div class="col-sm-6">
    {{-- ここは大会名を入れる --}}
    
    <h1 class="m-0">大会情報入力</h1>
  </div>
  <!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">試合一覧</li>
    </ol>
  </div>
  <!-- /.col -->
@endsection 

@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>選手No</th>
                <th>選手名</th>
                <th>学年</th>
                <th>団体名</th>
                <th>総合順位</th>
                <th>総合点</th>
                <th>床</th>
                <th>鞍馬</th>
                <th>吊り輪</th>
                <th>跳馬</th>
                <th>平行棒</th>
                <th>鉄棒</th>
              </tr>
            </thead>
            <tbody> 
              {{-- ここに全件の試合データを表示させるよ IDを取得して次のページ(試合データ表示まで) --}}
              {{-- ここからforeachでまわそう --}} 
              @foreach($athletes as $athlete) 
                @php $data = $athlete->event_data(); @endphp
                <tr>
                  <td>{{ $athlete->athlete_number }}</td>
                  {{-- <td><a href="event/{{$event_id}}/{{$athlete_id}}">本間翔吾</a></td> --}}
                  <td><a href="/event/{{ $event_id }}/{{ $athlete->id }}">{{ $athlete->athlete_name }}</a></td>
                  <td>0</td>
                  <td>{{ $athlete->team_name() }}</td>
                  <td>1</td>
                  <td>{{ $data['ts'] }}</td>
                  <td>{{ $data['fx']['ts'] }}</td>
                  <td>{{ $data['ph']['ts'] }}</td>
                  <td>{{ $data['sr']['ts'] }}</td>
                  <td>{{ $data['vt']['ts'] }}</td>
                  <td>{{ $data['pb']['ts'] }}</td>
                  <td>{{ $data['hb']['ts'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
  </section>
@endsection 

@section('script')
  <!-- DataTables  & Plugins -->
  <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/admin/plugins/jszip/jszip.min.js"></script>
  <script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, 
        "lengthChange": false, 
        "autoWidth": false, 
        "bFilter": false,
        "buttons": ["csv"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
<style>
  body{
    overflow: hidden;
  }
  .content-wrapper {
      padding-bottom: 100px;
      overflow: auto;
  }
  .card-body{
    overflow: auto;
  }
</style>