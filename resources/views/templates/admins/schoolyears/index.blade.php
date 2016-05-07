@extends('templates.admins.layouts.master')
@section('head.title','Quản lí khóa học')

@section('body.headTitle')
	Danh sách thông tin các khóa học
	<a href="#" class="btn btn-primary btn-add-schoolyear">Thêm khóa học mới</a>
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-schoolyear">
					{!! csrf_field() !!}
					<table class="table table-hover text-center" id="dataTable">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên đầy đủ </th>
								<th>Tên rút gọn</th>
								<th>Tùy chọn</th>
							</tr>	
						</thead>
						<tbody id="schoolyear-body-table">
							<?php $stt = 1;?>
							@foreach($schoolyears as $schoolyear)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'full_name',{!! $schoolyear->id!!},&quot;{{route('admin.shoolyears.edit',[$schoolyear->id])}} &quot;,'schoolyear')">{!! $schoolyear->full_name !!}</td>
								<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'short_name',{!! $schoolyear->id!!},&quot;{{route('admin.shoolyears.edit',[$schoolyear->id])}} &quot;,'schoolyear')">{!! $schoolyear->short_name!!}</td>
								<td style="width: 20%">
									<a href="#delete-schoolyear" data-toggle="modal" data-target="#delete-schoolyear" class="btn btn-danger btn-delete-schoolyear-{{$schoolyear->id}}" data-id="{{$schoolyear->id}}">Xóa</a>
								</td>
							</tr>
							<?php $stt ++ ;?>
							@endforeach	
						</tbody>
						
					</table>
					<!-- Modal popup to confirm delete cat -->
						<div class="modal fade" id="delete-schoolyear">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Xóa khóa học!</h4>
									</div>
									<div class="modal-body">
										<p class="text-center">Chắc chắn chứ ??? </p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
										<button type="button" class="btn btn-primary confirm_del_schoolyear">Xác nhận</button>
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