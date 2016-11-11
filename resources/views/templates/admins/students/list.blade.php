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
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-student-list">
					{!! csrf_field() !!}
					<table class="table table-hover text-center" id="dataTableStudent">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên</th>
								<th>Username</th>
								<th>Lớp khóa học</th>
								<th>MSV</th>
								{{-- <th>CV</th> --}}
								<th>Các công ty đăng kí</th>
								<th>Các công ty được chấp nhận</th>
								<th>Công ty chọn đi thực tập</th>
								<th>Phân công giảng viên</th>
							</tr>	
						</thead>
						<tbody>
							<?php $stt = 1;?>
							@foreach($students as $student)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td>
									@if(count($student->cv) > 0)
										{{ $student->cv->name}}
									
									
									@endif
								</td>
								<td>{{ $student->user_name }}</td>
								<td>
									@if(count($student->cv) > 0 )
										{{ $student->cv->class }}
									@endif
								</td>
								<td>
									@if(count($student->cv) > 0)
										{{ $student->cv->student_code}}
									@endif
								</td>
								{{-- <td><a href="{{ route('student.cv.view',[$student->id]) }}" target="_blank">Xem CV</a></td> --}}
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
								<td class="teacher_instruction_{{$student->id}}">
									<?php $teachers =  App\Teacher::where('confirmed','=',1)->get();?>
										<div class="teacher_name_{{$student->id}}">
											<span>
											@if($student->teacher != null)
													{!! $student->teacher->full_name !!}
											@else
													Chưa phân công
											@endif
											</span>
											<i class="fa fa-pencil teacher_instruction_edit" aria-hidden="true" style="margin-left: 10px; cursor: pointer"></i>
										</div>
										<div class="form-edit-teacher-instruction-{{$student->id}} hidden">
											<select name="allocate_teacher_instruction" class="form-control" data-user_id = {{ $student->id }}>
												<option value="">Chọn giảng viên</option>

												@foreach($teachers as $teacher)
													<option value="{{ $teacher->id }}"
															@if($student->teacher != null)
																@if($teacher->id == $student->teacher->id)
																	selected
																@endif
															@endif
															>{!! $teacher->full_name !!}</option>
												@endforeach
											</select>
										</div>
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