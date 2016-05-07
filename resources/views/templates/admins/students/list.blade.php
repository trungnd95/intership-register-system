@extends('templates.admins.layouts.master')
@section('head.title','Quản lí sinh viên')

@section('body.headTitle')
	Danh sách sinh viên
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-new">
					{!! csrf_field() !!}
					<table class="table table-hover text-center" id="dataTable">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên</th>
								<th>Lớp khóa học</th>
								<th>MSV</th>
								<th>CV</th>
								<th>Các công ty đăng kí</th>
								<th>Các công ty được chấp nhận</th>
								<th>Công ty chọn đi thực tập</th>
								<th>Giảng viên hướng dẫn</th>
							</tr>	
						</thead>
						<tbody>
							<?php $stt = 1;?>
							@foreach($students as $student)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td>{!! $student->full_name !!}</td>
								<td>{!! $student->class_name !!}</td>
								<td>{{$student->student_code}}</td>
								<td><a href="{{ route('student.cv.view',[$student->id]) }}" target="_blank">Xem CV</a></td>
								<td>
									@if(count($student->statuses) > 0) 
										@foreach($student->statuses as $item)
											{{$item->company->name}} ,  
										@endforeach
									@else 
										{{ 0 }}
									@endif
								</td>
								<td>
									@foreach($student->statuses as $item)
										@if($item->acceptance == 'success')
											{{ $item->company->name }} ,
										@endif
									@endforeach
								</td>
								<td>
									@foreach($student->statuses as $item)
										@if($item->acceptance == 'success' && $item->choosen == 1)
											{{ $item->company->name }} 
										@endif
									@endforeach
								</td>
								<td>
									@if($student->teacher_acceptance == 'accepted')
										{{ $student->teacher->full_name }}
									@endif 
								</td>
							</tr>
							<?php $stt ++ ;?>
							@endforeach	
						</tbody>
						
					</table>
					<!-- Modal popup to confirm delete cat -->
						<div class="modal fade" id="delete-new">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Xóa bài viết</h4>
									</div>
									<div class="modal-body">
										<p class="text-center">Chắc chắn chứ ??? </p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
										<button type="button" class="btn btn-primary confirm_del">Xác nhận</button>
									</div>
								</div>
							</div>
						</div><!-- End model-->
					
				</form>
				
			</div><!-- /.box-body -->
		</div><!-- /.box -->

	</div>
</div>
@endsection 