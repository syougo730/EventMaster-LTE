@extends('layouts.common')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">メインページ</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    {{-- <li class="breadcrumb-item active">nextpage-name</li> --}}
  </ol>
</div><!-- /.col -->

@endsection

@section('content')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        {{-- ページ右側　内容が入ります --}}

        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdppdAQRHlQUxS2CYIpSojEa0G8aysjmXGAZqZnt9AIYasTNQ/viewform?embedded=true" width="640" height="800" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('style')
<style>

</style>
@endsection