@extends('templates.layouts.master')
@section('head.title','Thông tin cá  nhân')
@section('templates.body.sidebar')
	@include('templates.partials.sidebar_teacher')
@endsection

@section ('templates.body.content')
<div class="profile-info">
	<div class="row">
		<div class="col-md-4">
			@if($teacher->avatar != '')
				<img src="{{asset('/public/upload/images/teachers/'.$teacher->avatar)}}" alt="" class="thumbnail" width="150px" height="150px" style="margin-left: 30px">
			@else 
				<img src="{{asset('/public/images/default-user.png')}}" alt="" class="thumbnail" width="150px" height="150px" >
			@endif
		</div>
		<div class="col-md-8 ">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Tên đăng nhập: </th>
						<td>{{$teacher->username}}</td>
					</tr>
					<tr>
						<th>Họ tên: </th>
						<td>{{$teacher->full_name}}</td>
					</tr>
					<tr>
						<th>Email: </th>
						<td>{{$teacher->email}}</td>
					</tr>
					<tr>
						<th>Số diện thoại: </th>
						<td>{{$teacher->phone_number}}</td>
					</tr>
					<tr>
						<th>Học hàm, học vị </th>
						<td>{{ $teacher->degree}}</td>
					</tr>
					<tr>
						<th>Thế mạnh và hướng nghiên cứu</th>
						<td>{{ $teacher->strong_point}}</td>
					</tr>	
					<tr>
						<th></th>
						<td><a href="{{route('teacher.profile.edit',[Auth::guard('teachers')->user()->id])}}" class="btn btn-warning">Sửa</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection 