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

        <div id="dscreator">
          <div class="tab-content ts" data-role="page" id="page1"></div>
          <div class="tab-content fx" data-role="page" id="page2">

            <div class="modal elements-modal"></div>

          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('style')
<link rel="stylesheet" href="/css/ds.css?<?=date('dHis')?>">
<style>

</style>
@endsection

@section('script')
<script src="/js/ds.js?<?=date('dHis')?>"></script>
<script>
$(function(){

});
</script>
@endsection
