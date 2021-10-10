@extends('layouts.common')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">大会情報入力</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">試合一覧</li>
  </ol>
</div><!-- /.col -->

@endsection

@section('content')



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>

            <div class="card-body">
                <?php echo $event->event_name ?>
                {{-- ここに内容をいれるよ --}}

                {{-- @foreach($events as $event) --}}

                    {{-- ここに全件の試合データを表示させるよ IDを取得して次のページ(試合データ表示まで) --}}


                {{-- これはテスト用　--}}
                <div>
                    {{-- <a href="/event/{{ $event->id }}">{{ $event->event_name }}</a> --}}
                </div>

                {{-- @endforeach --}}


            </div>

        </div>


      </div>
      <!-- /.container-fluid -->



    </div>
    <!-- /.content -->




@endsection

@section('style')
<style>

</style>
@endsection