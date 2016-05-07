<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>@yield('auth.body.title')</b></a>
  </div>
  <div class="row">
            <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li> {!! $error !!} </li>
                        @endforeach
                    </ul>
                </div>          
            @elseif ($errors->any())
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>                        
                        <li> {{$errors->first()}} </li>
                    </ul>
                </div>
            @endif  
            </div>
    </div>
  <!-- /.login-logo -->
  @yield('auth.body.content');
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>