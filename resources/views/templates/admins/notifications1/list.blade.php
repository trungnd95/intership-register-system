@extends('templates.admins.layouts.master')
@section('head.title','Thông báo ')

@section('body.headTitle')
	Danh sách các thông báo đến sinh viên
	<a href="#" class="btn btn-primary btn-add-notification">Tạo thông báo mới</a>
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-notification">
					{!! csrf_field() !!}
					<table class="table table-hover text-center" id="dataTableNotification">
						<thead>
							<tr>
								<th>STT</th>
								<th>Nội dung</th>
								<th>Tùy chọn</th>
							</tr>	
						</thead>
						<tbody id="notification-body-table">
							<?php $stt = 1;?>
							@foreach($notifications as $notify)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'content',{!! $notify->id!!},&quot;{{route('admin.notification.edit',[$notify->id])}} &quot;,'notification')">{!! $notify->content !!}</td>
								<td style="width: 20%">
									<a href="#delete-notification" data-toggle="modal" data-target="#delete-notification" class="btn btn-danger btn-delete-notification-{{$notify->id}}" data-id="{{$notify->id}}">Xóa</a>
								</td>
							</tr>
							
							<?php $stt ++ ;?>
							@endforeach	
						</tbody>
						
					</table>
					<!-- Modal popup to confirm delete cat -->
						<div class="modal fade" id="delete-notification">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Xóa thông báo!</h4>
									</div>
									<div class="modal-body">
										<p class="text-center">Chắc chắn chứ ??? </p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
										<button type="button" class="btn btn-primary confirm_del_notification">Xác nhận</button>
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