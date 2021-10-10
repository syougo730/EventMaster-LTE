@extends('layouts.common')

@section('header')

<div class="col-sm-6">
  <h1 class="m-0">大会情報入力</h1>
</div><!-- /.col -->
<div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">大会情報入力</li>
  </ol>
</div><!-- /.col -->

@endsection

@section('content')



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        

    <div class="description">
      <p>GoogleDriveで作成した「event_config」スプレッドシートのURLを入力してください。<br>
          (URL例：https://docs.google.com/spreadsheets/d/xxxxxxxxxxxxxxxxxxxxxxxx/edit#gid=0)</p>
      <p>※男子版のみ対応</p>
  </div>

  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Quick Example</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="post" action="./set">
        <div class="card-body">

          <div class="form-group">
            <label for="config">Config</label>
            <input type="text" class="form-control @error('config') is-invalid @enderror" id="config" name="config" placeholder="Config" required>
          </div>

          @error('config')
            <p style="color: red">入力が正しくありません。</p>
          @enderror

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
        
      </form>
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