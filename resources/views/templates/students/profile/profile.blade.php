@extends('templates.layouts.master')
@section('head.title', 'Cập nhật thông tin cá nhân')
@section('breadcrumbs',Breadcrumbs::render('profile'))
@section('templates.body.content')
<div class="profile-info">
	<div class="row">
		<div class="col-md-4">
			@if($user->avatar != '')
				<img src="{{asset('/upload/images/students/'.$user->avatar)}}" alt="" class="thumbnail" width="150px" height="150px" style="margin-left: 30px">
			@else 
				<img src="{{asset('/images/default-user.png')}}" alt="" class="thumbnail" width="150px" height="150px" >
			@endif
		</div>
		<div class="col-md-8 ">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Tên đăng nhập: </th>
						<td>{{$user->user_name}}</td>
					</tr>
					<tr>
						<th>Họ tên: </th>
						<td>{{$user->full_name}}</td>
					</tr>
					<tr>
						<th>Email: </th>
						<td>{{$user->email}}</td>
					</tr>
					<tr>
						<th>Mã sinh viên:  </th>
						<td>{{$user->student_code}}</td>
					</tr>
					<tr>
						<th>Lớp khóa học: </th>
						<td>{{$user->class_name}}</td>
					</tr>
					<tr>
						<th>Giảng viên hướng dẫn :  </th>
						<?php $teacher =  App\Teacher::select('*')->where('id','=',$user->teacher_id)->first()?>
						<td>
							{{(count($teacher) > 0) ? $teacher->full_name : 'Chưa được phân công'}}
							
						</td>
					</tr>	
					<tr>
						<th></th>
						<td><a href="{{route('student.update',[$user->id])}}" class="btn btn-warning">Sửa</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection 

