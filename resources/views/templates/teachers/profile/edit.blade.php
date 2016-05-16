@extends('templates.layouts.master')
@section('head.title', 'Cập nhật thông tin cá nhân')
@section('breadcrumbs_teacher',Breadcrumbs::render('profile_teacher_update'))
@section('templates.body.content')
<div class="box">
	<div class="box-header" class="text-center">
		<h3>Thông tin cá nhân</h3>
		<p>Thầy/cô hãy cập nhật hồ sơ của mình để phục vụ cho việc quản lí</p>
		<br/><hr/>
	</div>
	<div class="box-body">
		<form action="{{route('teacher.profile.update',[$teacher->id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
		{{ csrf_field() }}
			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"> 
				<label for="username" class="col-md-2 control-label">Tên đăng nhập</label>        
				<div class="col-md-10">
					<input id="username" name="username" type="text" class="form-control" value="{{old('username',isset($teacher) ? $teacher->username : null)}}" required>	
				</div>
				@if ($errors->has('username'))
				<span class="help-block">
					<strong>{{ $errors->first('username') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">  
				<label for="full_name" class="col-md-2 control-label">Họ tên</label>          
				<div class="col-md-10">
					<input id="full_name" name="full_name" type="text" class="form-control" required value="{{old('full_name',isset($teacher) ? $teacher->full_name : null)}}">	
				</div>
				@if ($errors->has('full_name'))
				<span class="help-block">
					<strong>{{ $errors->first('full_name') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-2 control-label">Email</label>
				<div class="col-md-10">
					<input id="email" name="email" type="text" class="form-control" value="{{old('email',isset($teacher) ? $teacher->email : null)}}" required>	
				</div>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
				<label for="phone_number" class="col-md-2 control-label">Số điện thoại</label>
				<div class="col-md-10">
					<input id="phone_number" name="phone_number" type="tel" class="form-control"  value="{{old('phone_number',isset($teacher) ? $teacher->phone_number : null)}}" required>	
				</div>
				@if ($errors->has('phone_number'))
				<span class="help-block">
					<strong>{{ $errors->first('phone_number') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('degree') ? ' has-error' : '' }}">  
				<label for="degree" class="col-md-2 control-label">Học hàm, học vị</label>        
				<div class="col-md-10">
					<input id="degree" name="degree" type="text" class="form-control" value="{{ old('degree',isset($teacher) ? $teacher->degree : null ) }}" required>	
				</div>
				@if ($errors->has('degree'))
				<span class="help-block">
					<strong>{{ $errors->first('degree') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('strong_point') ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Điểm mạnh và hướng nghiên cứu</label>
				<div class="col-md-10">
					<textarea id="strong_point" name="strong_point"  class="form-control" placeholder="Điểm mạnh và hướng nghiên cứu" rows='5' cols = "63"
					required>{{old('strong_point',isset($teacher) ? $teacher->strong_point : null)}}</textarea>	
				</div>
				@if ($errors->has('strong_point'))
				<span class="help-block">
					<strong>{{ $errors->first('strong_point') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Ảnh đại diện</label>
				<div class="col-md-10">
					@if(Auth::guard('teachers')->user()->avatar == null )
					<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> </div>
					@else 
					<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> 
						<img class="thumbnail" width="150px" height="150px" src="{{asset('/upload/images/teachers/'.Auth::guard('teachers')->user()->avatar)}}" style="margin-left: 0%" />
					</div>
					@endif
					<div>
						<span class="btn btn-success fileinput-button">
							<i class="glyphicon glyphicon-plus"></i>
							<span>Upload</span>
							<input type="file" id="image" name="avatar" class="form-control ">
						</span>
					</div>	
				</div>
				
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" style="width: 49%">Cập nhật</button>
					<button type="reset" class="btn btn-danger" style="width: 49%">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
@endsection 

