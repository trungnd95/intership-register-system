@extends('templates.layouts.master')
@section('head.title','Danh sách giảng viên')
@section('breadcrumbs',Breadcrumbs::render('teacher_list'))
@section('templates.body.content')
<section class="teacher-list">
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
			@elseif (Session::has('success'))
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<ul>
					<li> {!! Session::get('success') !!} </li>
				</ul>
			</div>	
			@endif
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">
				Danh sách các giảng viên <br/> 
			</h3>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="" id="form_list_teachers">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
				<div class="row">
					<div class="col-lg-12" id="search_display">
						<table id="dataTable" class="table table-bordered table-striped">
							<thead>
								<tr class="text-center">
									<th class="text-center">STT</th>
									<th class="text-center">Tên</th>
									<th class="text-center">Học hàm,học vị</th>
									<th class="text-center hidden">Điểm mạnh</th>
									
								</tr>
							</thead>
							<tbody>
								<?php $stt = 1; ?>
								@foreach($teachers as  $teacher)
									<tr class="text-center">
										<td class="text-center"> {{ $stt }}</td>
										<td><a href="#modal-view-teacher" data-toggle="modal" data-target="#modal-view-teacher" name="{{$teacher->full_name}}" email="{{$teacher->email}}" phone="{{$teacher->phone_number}}" strong="{{$teacher->strong_point}}" avatar="{{$teacher->avatar}}" degree="{{$teacher->degree}}">{{ $teacher->full_name}} </a></td>
										<td class="text-center">{!! $teacher->degree !!}</td>
										<td class="hidden">{!! $teacher->strong_point !!}</td>
									</tr>
									<?php $stt ++; ?>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<!-- Main content -->	
		</form>
	</div>

	<!-- Modal popup to view teacher detail-->
	<div class="modal fade" id="modal-view-teacher" style="border-radius: 10px">
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 10px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center">Thông tin giảng viên</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-2">
							<img class="thumbnail" width="130px" height="130px" src="" id="teacher_avatar" />
						</div>
						<div class="table-responsive col-md-9 col-md-offset-1">
							<table class="table table-hover table-bordered">
								<tr>
									<th>Tên</th>
									<td class="teacher_name"></td>
								</tr>
								<tr>
									<th>Email</th>
									<td class="teacher_email"></td>
								</tr>
								<tr>
									<th>Số điện thoại</th>
									<td class="teacher_phone"></td>
								</tr>
								<tr>
									<th>Học hàm, học vị</th>
									<td class="teacher_degree"></td>
								</tr>
								<tr>
									<th>Điểm mạnh và hướng nghiên cứu</th>
									<td class="teacher_strong"></td>
								</tr>
							</table>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div><!-- End model-->
</section>
@endsection 