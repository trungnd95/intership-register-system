@extends('templates.layouts.master')
@section('head.title', 'Cập nhật thông tin cá nhân')
@section('templates.body.content')
<form role="form" method="POST" action ="{{route('student.store',[$user->id])}}" enctype="multipart/form-data" class="form-inline col-md-10 go-right" id="form-update" style="color: Green;background-color:#FAFAFF;border-radius:0px 22px 22px 22px;">
	<h2>Thông tin cá nhân</h2>
	<p>Bạn hãy cập nhật hồ sơ của mình để phục vụ cho việc quản lí</p>
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">            
		<input id="username" name="username" type="text" class="form-control" value="{{old('username',isset($user) ? $user->user_name : null)}}" required>
		<label for="username">Username</label>
		@if ($errors->has('username'))
		<span class="help-block">
			<strong>{{ $errors->first('username') }}</strong>
		</span>
		@endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">            
		<input id="full_name" name="full_name" type="text" class="form-control" required value="{{old('full_name',isset($user) ? $user->full_name : null)}}">
		<label for="full_name">Họ tên<span class="glyphicon glyphicon-user"> </span></label>
		@if ($errors->has('full_name'))
            <span class="help-block">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($user) ? $user->email : null)}}" required>
		<label for="email">Email<i class="fa fa-envelope-o"></i></label>
		@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">            
		<input id="student_code" name="student_code" type="text" class="form-control"  required>
		<label for="student_code">Mã sinh viên</label>
		@if ($errors->has('student_code'))
            <span class="help-block">
                <strong>{{ $errors->first('student_code') }}</strong>
            </span>
            @endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('class_name') ? ' has-error' : '' }}">
		<input id="class_name" name="class_name" type="tel" class="form-control" 
		value="{{old('class_name',isset($user) ? $user->class_name : null)}}" required>
		<label for="class_name">Tên lớp</label>
		@if ($errors->has('class_name'))
            <span class="help-block">
                <strong>{{ $errors->first('class_name') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
		<input id="phone_number" name="phone_number" type="tel" class="form-control"  value="{{old('phone_number',isset($user) ? $user->phone_number : null)}}" required>
		<label for="phone_number">Số điện thoại<span class="glyphicon glyphicon-phone"></span></label>
		@if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('teacher_id') ? ' has-error' : '' }}">        
		<select class="form-control" name="teacher_id">
			<option value="">Chọn giảng viên hướng dẫn</option>
			@foreach(App\Teacher::select('*')->get() as $teacher)
				<option id="" value="{{$teacher->id}}" style="color:red"
				@if($teacher->id == Auth::user()->teacher_id)
					selected
				@endif
				>
					Thầy/Cô :  {{$teacher->full_name}}
				</option>
			@endforeach
		</select>
		@if ($errors->has('teacher_id'))
            <span class="help-block">
                <strong>{{ $errors->first('teacher_id') }}</strong>
            </span>
        @endif
       	<a href="{{route('student.teacherList')}}" target="_blank" style="margin-left: 20px;display:inline-block">Xem danh sách các thầy cô</a>
	</div>
	<br/><br/>
	<p1>Ngày sinh</p1>
	<br/>
	<div class="form-group{{ $errors->has('birth_day') ? ' has-error' : '' }}">
		<input id="birth_day" name="birth_day" type='date' class="form-control" value = {{ old('birth_day',isset($user) ? $user->birth_day : null )}} />
		@if ($errors->has('birth_day'))
            <span class="help-block">
                <strong>{{ $errors->first('birth_day') }}</strong>
            </span>
            @endif
		{{-- <label for="birth_day">Ngày sinh<span class="glyphicon glyphicon-calendar"></span></label> --}}
	</div>
	{{-- <input type="date" name="" id="" /> --}}
	<br><br>
	<p1>Avatar</p1>
	<br/>
	<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
		@if(Auth::user()->avatar == null )
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> </div>
		@else 
			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> 
				<img class="thumbnail" width="150px" height="150px" src="{{asset('/public/upload/images/students/'.Auth::user()->avatar)}}" />
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
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<button class="btn btn-primary" type="submit" id="submit">
			Lưu
		</button>
	</div>
	<br/><br/>
</form>
		
@endsection 

