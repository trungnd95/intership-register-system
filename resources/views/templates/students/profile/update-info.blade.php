@extends('templates.layouts.master')
@section('head.title', 'Cập nhật thông tin cá nhân')
@section('breadcrumbs',Breadcrumbs::render('update-profile'))
@section('templates.body.content')
<div class="box">
	<div class="box-header">
		<h3>Thông tin cá nhân</h3>
		<p>Bạn hãy cập nhật hồ sơ của mình để phục vụ cho việc quản lí</p><hr/>
	</div>
	<div class="box-body" style="padding: 25px">
		<form action="{{route('student.store',[$user->id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">  
				<label for="username" class="col-sm-2 control-label">Username</label>         	
				<div class="col-md-10">
					<input id="username" name="username" type="text" class="form-control" value="{{old('username',isset($user) ? $user->user_name : null)}}" required>
				</div>
				@if ($errors->has('username'))
				<span class="help-block">
					<strong>{{ $errors->first('username') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
				<label for="full_name" class="col-sm-2 control-label">Họ tên</label>
				<div class="col-md-10">
					<input id="full_name" name="full_name" type="text" class="form-control" required value="{{old('full_name',isset($user) ? $user->full_name : null)}}">
				</div>            
				@if ($errors->has('full_name'))
				<span class="help-block">
					<strong>{{ $errors->first('full_name') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-md-10">
					<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($user) ? $user->email : null)}}" required>	
				</div>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">    	    <label for="student_code" class="col-sm-2 control-label">Mã sinh viên</label>
				<div class="col-md-10">
					<input id="student_code" name="student_code" type="text" class="form-control"  required>
				</div>
				@if ($errors->has('student_code'))
				<span class="help-block">
					<strong>{{ $errors->first('student_code') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('class_name') ? ' has-error' : '' }}">
				<label for="class_name" class="col-sm-2 control-label">Tên lớp</label>
				<div class="col-md-10">
					<input id="class_name" name="class_name" type="tel" class="form-control" 
					value="{{old('class_name',isset($user) ? $user->class_name : null)}}" required>	
				</div>
				
				@if ($errors->has('class_name'))
				<span class="help-block">
					<strong>{{ $errors->first('class_name') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
				<label for="phone_number" class="col-md-2 control-label">Số điện thoại</label>
				<div class="col-md-10">
					<input id="phone_number" name="phone_number" type="tel" class="form-control"  value="{{old('phone_number',isset($user) ? $user->phone_number : null)}}" required>	
				</div>
				
				@if ($errors->has('phone_number'))
				<span class="help-block">
					<strong>{{ $errors->first('phone_number') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('birth_day') ? ' has-error' : '' }}">
				<label for="birth_day" class="col-md-2 control-label">Ngày sinh</label>
				<div class="col-md-10">
					<input id="birth_day" name="birth_day" type='date' class="form-control" value = {{ old('birth_day',isset($user) ? $user->birth_day : null )}} />
				</div>
				@if ($errors->has('birth_day'))
				<span class="help-block">
					<strong>{{ $errors->first('birth_day') }}</strong>
				</span>
				@endif

			</div>
			
			<br/>
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
				<label class="col-md-2 control-label" for="avatar">Avatar</label>
				<div class="col-md-10">
					@if(Auth::user()->avatar == null )
					<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px; margin-left: -77%"> </div>
					@else 
					<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> 
						<img class="thumbnail" width="150px" height="150px" src="{{asset('/upload/images/students/'.Auth::user()->avatar)}}" style="margin-left: 0%" />
					</div>
					@endif
					<div>
						<span class="btn btn-success fileinput-button">
							<i class="glyphicon glyphicon-plus"></i>
							<span>Upload avatar</span>
							<input type="file" id="image" name="avatar" class="form-control ">
						</span>
					</div>
				</div>
			</div>
			<div class="form-group" style="margin-top: 50px">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" style="width: 49%">Cập nhật</button>
					<button type="reset" class="btn btn-danger" style="width: 50%">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
@endsection 

