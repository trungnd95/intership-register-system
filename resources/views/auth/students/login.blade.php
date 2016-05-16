@extends('auth.layouts.master')
@section('head.title','Sinh Viên Đăng nhập')
@section('body.content')
<div class="box box-auth">
    <div class="box-header">
        <h3>Sinh Viên</h3>
        <hr/>
    </div>
    <div class="box-body">
    <div class="login-box-body" style="border:1px solid #c5c5c5;margin-top:-10px">
            <h4 class="login-box-msg"> Đăng Nhập</h4>
            @if(session('information_err'))
            <div class="alert alert-danger">

                <ul>
                    <li>{{ session('information_err') }}</li>
                    <li>{{ session('verify') }}</li>
                </ul>
            </div>
            @endif
            <form method="post" method="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input type="text" class="form-control" placeholder="Tên Email" name="email" value="{{ old('email') }}" >
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-1">
                      <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" value="1"> <span class="remember">Nhớ</span>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4 button_submit">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
              </div>
              <!-- /.col -->
          </div>
      </form>
      <hr/>
      <a href="{{ url('/password/reset') }}">Quên mật khẩu</a><br/>
      <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-register">Đăng kí</a><br/>
  </div>        
    </div>
</div>

<!-- Modal to add administrator -->
<div class="modal fade" id="modal-register">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">Đăng Kí Thành Viên</h4>
        </div>
        <form action="" method="POST" class="form-horizontal" role="form" name="student-register" id="student-register">
            <div class="modal-body">
                
                  {{ csrf_field() }}
                  <!-- User name -->
                    {{-- <div class="form-group">
                        <label class="col-md-2 control-label" for="username"> Tên đăng nhập </label>  
                        <div class="col-md-6">
                            <input id="username" name="username" type="text" placeholder="Nhập tên đăng nhập" class="form-control input-md">
                            <div class="err-username hidden" ><span style="color:red"></span></div>
                        </div>
                    </div> --}}
                    <div class="clearfix"></div>
                    <!-- Email -->
                    <div class="form-group">
                        <label class="col-md-2 control-label text-center" for="email"> Email</label>  
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <input id="email" name="email" type="text" placeholder="Nhập tên email" class="form-control input-md" style="width: 100%;display: inline-block">         
                                </div>
                                <div class="col-md-4">
                                    <span class="text-primary email-standard" > @vnu.edu.vn</span>        
                                </div>
                            </div>
                            <div class="err-email hidden" ><span style="color:red">Email không đúng định dạng</span> </div>
                        </div>
                        <div class="col-md-4">
                            <p class="text-danger text-inline">
                                <span>(Sử dụng email vnu của bạn. <br/> VD: Email : abcd@vnu.edu.vn => Nhập : abcd)</span>
                            </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Password -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password">Mật khẩu</label>  
                        <div class="col-md-6">
                            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control input-md">
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="repassword">Xác nhận mật khẩu</label>  
                        <div class="col-md-6">
                            <input id="repassword" name="repassword" type="password" equalTo="#password" placeholder="Xác nhận mật khẩu" class="form-control input-md">
                        </div>
                    </div>
            </div>
            <div class="modal-footer" style="margin-right: 30px">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-right: 10px">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" id="registerd"  value="Đăng kí" />
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
