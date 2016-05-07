@extends ('auth.layouts.app')
@section('head.title','Đăng nhập')
@section ('auth.body.title','Quản trị viên')

@section('auth.body.content')
<div class="login-box-body">
    <p class="login-box-msg">Đăng nhập để vào panel quản lí</p>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form method="post" method="{{ url('/admin/login') }}">
        {!! csrf_field() !!}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username" value="{{ old('username') }}" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        {{-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1"> Remember Me
            </label>
          </div>
        </div> --}}
        <!-- /.col -->
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
@endsection 