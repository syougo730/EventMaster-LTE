@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            
            <div class="sp sp-logo">
                <img src="/img/logo.png" alt="">
            </div>

            <div class="card">
                {{-- <div class="card-header">ログイン</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label">{{ __('メールアドレス') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label">{{ __('パスワード') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('記憶する') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary submit-btn">
                                    {{ __('ログイン') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れた方はこちら') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
body {
    display: flex;
    overflow: hidden;
}
#app{
    width: 50%;
    min-width: 500px;
}
.sub{
    width: 60%;
}
main {
    height: 100%;
}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
div#venta {
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.logo {
    width: 350px;
    box-shadow: 0 0 5px 5px rgb(0 0 0 / 15%);
}
.logo>img {
    width: 100%;
}
.btn-link{
    margin: auto;
}
.submit-btn {
    margin: 15px 0;
}

.sp{display: none;}
.sp-logo{
    margin: 20px 10px;   
}.sp-logo>img{
    width: 100%;
}
@media screen and (max-width:900px){
    .sp{display: block;}
    #app{
        width: 100%;
        min-width: unset;
    }
    .sub{ 
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
    }
    .offset-md-4 {
        text-align: center;
    }
    .card {
        margin: 10px;
    }
}
</style>
@endsection

@section('venta')
<div id="venta" class="">
    <div class="logo">
        <img src="/img/logo.png" alt="">
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.21/dist/vanta.net.min.js"></script>
<script>
VANTA.NET({
  el: "#venta",
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00,
  color: 0xffffff,
  size: 0.50,
  backgroundColor: 0xcbcbff
})
</script>
@endsection