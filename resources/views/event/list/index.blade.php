@extends('layouts.common') 
@section('header')
  <div class="col-sm-6">
    {{-- ここは大会名を入れる --}}
    
    <h1 class="m-0">{{ $event->event_name }}</h1>
  </div>
  <!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item active"><a href="/event/">試合一覧</a></li>
      <li class="breadcrumb-item active">{{ $event->event_name }}</li>
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
                <th>No</th>
                <th>選手名</th>
                <th>学年</th>
                <th>団体名</th>
                <th>総合点</th>
                <th>FX</th>
                <th>PH</th>
                <th>SR</th>
                <th>VT</th>
                <th>PB</th>
                <th>HB</th>
              </tr>
            </thead>
            <tbody> 
              @foreach($athletes as $athlete) 
                @php $data = $athlete->event_data(); @endphp
                <tr>
                  <td>{{ $athlete->athlete_number }}</td>
                  <td><a href="/event/{{ $event_id }}/{{ $athlete->id }}">{{ $athlete->athlete_name }}</a></td>
                  <td>0</td>
                  <td>{{ $athlete->team_name() }}</td>
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
        "info":false,
        "paging": false,
        "responsive": false, 
        "lengthChange": false, 
        "autoWidth": false, 
        "bFilter": false,
        "buttons": ["csv"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

@section('pagehead')
<!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>

  .card-body{
    overflow: auto;
  }
</style>
@endsection