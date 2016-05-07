@extends('templates.layouts.master')
@section('head.title', 'Cập nhật thông tin cá nhân')
@section('breadcrumbs_teacher',Breadcrumbs::render('profile_teacher_update'))
@section('templates.body.content')
<form role="form" method="POST" action ="{{route('teacher.profile.update',[$teacher->id])}}" enctype="multipart/form-data" class="form-inline col-md-10 go-right" id="form-update" style="color: Green;background-color:#FAFAFF;border-radius:0px 22px 22px 22px;">
	<h2>Thông tin cá nhân</h2>
	<p>Thầy/cô hãy cập nhật hồ sơ của mình để phục vụ cho việc quản lí</p>
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">            
		<input id="username" name="username" type="text" class="form-control" value="{{old('username',isset($teacher) ? $teacher->username : null)}}" required>
		<label for="username">Tên đăng nhập</label>
		@if ($errors->has('username'))
		<span class="help-block">
			<strong>{{ $errors->first('username') }}</strong>
		</span>
		@endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">            
		<input id="full_name" name="full_name" type="text" class="form-control" required value="{{old('full_name',isset($teacher) ? $teacher->full_name : null)}}">
		<label for="full_name">Họ tên<span class="glyphicon glyphicon-teacher"> </span></label>
		@if ($errors->has('full_name'))
            <span class="help-block">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<input id="email" name="email" type="text" class="form-control" value="{{old('email',isset($teacher) ? $teacher->email : null)}}" required>
		<label for="email">Email<i class="fa fa-envelope-o"></i></label>
		@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
		<input id="phone_number" name="phone_number" type="tel" class="form-control"  value="{{old('phone_number',isset($teacher) ? $teacher->phone_number : null)}}" required>
		<label for="phone_number">Số điện thoại<span class="glyphicon glyphicon-phone"></span></label>
		@if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('degree') ? ' has-error' : '' }}">            
		<input id="degree" name="degree" type="text" class="form-control" value="{{ old('degree',isset($teacher) ? $teacher->degree : null ) }}" required>
		<label for="degree">Học hàm, học vị</label>
		@if ($errors->has('degree'))
            <span class="help-block">
                <strong>{{ $errors->first('degree') }}</strong>
            </span>
            @endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('strong_point') ? ' has-error' : '' }}">
		<textarea id="strong_point" name="strong_point"  class="form-control" placeholder="Điểm mạnh và hướng nghiên cứu" rows='5' cols = "63"
		required>{{old('strong_point',isset($teacher) ? $teacher->strong_point : null)}}</textarea>
		@if ($errors->has('strong_point'))
            <span class="help-block">
                <strong>{{ $errors->first('strong_point') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	
	<p1>Avatar</p1>
	<br/>
	<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
		@if(Auth::guard('teachers')->user()->avatar == null )
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> </div>
		@else 
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> 
				<img class="thumbnail" width="150px" height="150px" src="{{asset('/public/upload/images/teachers/'.Auth::guard('teachers')->user()->avatar)}}" />
			</div>
		@endif
		<div>
			<span class="btn btn-success fileinput-button">
				<i class="glyphicon glyphicon-plus"></i>
				<span>Add image...</span>
				<input type="file" id="image" name="avatar" class="form-control ">
			</span>
		</div>
	</div>
	<br/><br/>
	<div class="form-group">
		<button class="btn btn-primary" type="submit" id="submit">
			Lưu
		</button>
	</div>
	<br/><br/>
</form>
		
@endsection 

