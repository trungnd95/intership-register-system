@extends('templates.layouts.master')
@section('head.title', 'Thay đổi mật khẩu')
@section('breadcrumbs',Breadcrumbs::render('change-password'))
@section('templates.body.content')
<div class="box">
	<div class="box-header">
		<h2 class="text-center title-header">Thay đổi mật khẩu</h2>
	</div>
	<div class="box-body" style="padding: 25px">
		<form action="{{route('teacher.changePassword.postData',Auth::guard('teachers')->user()->id)}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" role="form" id="form-change-password-teacher">
			{{csrf_field()}}
			<div class="form-group{{ $errors->has('old_password_teacher') ? ' has-error' : '' }}">  
				<label for="old_password_teacher" class="col-sm-2 control-label">Mật khẩu cũ</label>         	
				<div class="col-md-10">
					<input id="old_password_teacher" name="old_password_teacher" type="password" class="form-control" required placeholder="Mật khẩu cũ" data-id="{{Auth::guard('teachers')->user()->id}}">
					<span class="text-danger error_old_password hidden" style="color:red" >Mật khẩu cũ không đúng</span>
				</div>
				@if ($errors->has('old_password_teacher'))
				<span class="help-block">
					<strong>{{ $errors->first('old_password_teacher') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
				<label for="new_password" class="col-sm-2 control-label">Mật khẩu mới</label>
				<div class="col-md-10">
					<input id="new_password" name="new_password" type="password" class="form-control" required placeholder="Mật khẩu mới" >
				</div>            
				@if ($errors->has('new_password'))
				<span class="help-block">
					<strong>{{ $errors->first('new_password') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('re_new_password') ? ' has-error' : '' }}">
				<label for="re_new_password" class="col-sm-2 control-label">Nhập lại mật khẩu mới</label>
				<div class="col-md-10">
					<input id="re_new_password" name="re_new_password" type="password" class="form-control"  required placeholder="Nhập lại mật khẩu mới">	
				</div>
				@if ($errors->has('re-new-password'))
				<span class="help-block">
					<strong>{{ $errors->first('re-new-password') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group" style="margin-top: 50px">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" style="width: 49%">Thay đổi</button>
					<button type="reset" class="btn btn-danger" style="width: 50%">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
@endsection 

