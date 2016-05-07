@extends('templates.admins.layouts.master')
@section('head.title','Quản lí đăng kí')

@section('body.headTitle')
	Danh sách tình trạng đăng kí sinh viên
	<br/>
	{{-- <small>Dành cho những sv đang chờ sự chấp nhận của công ty</small> --}}
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-status">
					{!! csrf_field() !!}
					<table class="table table-hover text-center table-status" id="dataTable">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên</th>
								<th>Lớp khóa học</th>
								<th>MSV</th>
								<th>CV</th>
								<th>Công ty đăng kí</th>
								<th>Tình trạng</th>
								<th>Giảng viên hướng dẫn</th>
								<th>Tình trạng</th>
								<th>Tình trạng liên hệ vs cty</th>
							</tr>	
						</thead>
						<tbody>
							<?php $stt = 1;?>
							@foreach($students as $student)
								@foreach($student->statuses as $item)
								<tr class="text-center row-content">
									<td>{{ $stt }}</td>
									<td>{!! $student->full_name !!}</td>
									<td>{!! $student->class_name !!}</td>
									<td>{{$student->student_code}}</td>
									<td><a href="{{ route('admin.notify.cvView',[$student->id]) }}" target="_blank">Xem CV</a></td>
									<td>
										{{$item->company->name}}
									</td>
									<td class="row-{{$item->id}}">
										<div class="result-{{$item->id}}">
											@if($item->acceptance == 'success')
												<span>Đã chấp nhận</span>
											@elseif ($item->acceptance == 'pending')
												<span>Đang chờ</span>
											@else ($item->acceptance == 'failure')
												<span>Không được chấp nhận</span>
											@endif	
											<br/><a href="#" data-id="{{$item->id}}" class="btn btn-warning btn-edit-company-status">Sửa</a>
										</div>
										
										<div class="div_edit_company_status_{{$item->id}} hidden">
											<select name="company_status edit-company-status"class="form-control" required="required">
												<option value="success">Đã chấp nhận</option
												>
												<option value="failure">Không được chấp nhận</option
												>
											</select>
											<a href="#" class="btn btn-success save-edit-company-status-{{$item->id}}">Lưu</a>
											<input type="hidden" name="" value="{{$item->id}}" class="status_id">
										</div>

									</td>
									<td>
										{{$student->teacher->full_name}}
									</td>
									<td>
										@if($student->teacher_acceptance == 'accepted')
											Đã chấp nhận
										@elseif ($student->teacher_acceptance == 'pending')
											Đang chờ
										@else ($student->teacher_acceptance == 'ignore')
											Không được chấp nhận
										@endif
									</td>
									<td>
										<div class="contact-{{$item->id}}">
											@if($item->contacted == 1)
												Đã liên hệ
											@else 	
												Chưa liên hệ
											@endif	
											<br/><a href="#" data-id="{{$item->id}}" class="btn btn-warning btn-edit-contact-status">Sửa</a>
										</div>
										<div class="div_edit_contact_status_{{$item->id}} hidden">
											<select name="company_status edit-contact-status"class="form-control" required="required">
												<option value="1">Đã liên hệ</option
												>
												<option value="0">Chưa liên hệ</option
												>
											</select>
											<a href="#" class="btn btn-success save-edit-contact-status-{{$item->id}}">Lưu</a>
											<input type="hidden" name="" value="{{$item->id}}" class="status_id">
										</div>
										
									</td>
								</tr>
								<?php $stt ++ ;?>
								@endforeach
							@endforeach	
							<input class="hidden stt" value="{{$stt}}" />
						</tbody>
						
					</table>
					
				</form>
				
			</div><!-- /.box-body -->
		</div><!-- /.box -->

	</div>
</div>
@endsection 