@extends ('auth.layouts.app')
@section('head.title','Quên mật khẩu')
@section ('auth.body.title','Quên mật khẩu')

@section('auth.body.content')
<div class="login-box-body">
    <p class="login-box-msg">Điền email để lấy mật khẩu mới</p>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form method="post" action="{{ url('/password/email') }}">
      {!! csrf_field() !!}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Gửi link lấy mật khẩu</button>
        </div>    
      </div>
    </form>

  </div>
@endsection 