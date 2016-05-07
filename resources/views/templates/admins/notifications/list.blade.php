@extends('templates.admins.layouts.master')
@section('head.title','Quản lí thông báo')

@section('body.headTitle')
	Tất cả thông báo
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-list-notification-admin">
					{!! csrf_field() !!}
					{{-- @if(count($all_Notify) > 0) --}}
					<table class="table table-hover text-center" id="dataTable">
						<thead>
							<tr>
								<th>STT</th>
								<th>Nội dung</th>
								<th>Tình trạng xử lí</th>
							</tr>	
						</thead>
						<tbody id="list-notifications-admin">
							<?php $stt = 1;?>
							@foreach($all_Notify as $item)
							<tr class="text-center row-content">
								<td style="width: 2%">{{ $stt }}</td>
								<td><a href="{{route('admin.notify.notifyDetail',[$item->id])}}">{!! $item->message !!}</a></td>
								<td contenteditable="true" onclick="showFormEdit(this)" onChange="saveToDatabase(this,'contacted',{!! $item->user_id!!},{!! $item->company_id!!})">
									<?php $contacted = App\Status::select('contacted')->where('user_id','=',$item->user_id)->where('company_id','=',$item->company_id)->first();?>
									@if(count($contacted) > 0)
										@if($contacted->contacted == 1)
										Đã liên hệ với công ty
										@else 
										Chưa liên hệ với công ty
										@endif
									@endif
								</td>
							</tr>

							<?php $stt ++ ;?>
							@endforeach	
						</tbody>
						
					</table>
					{{-- @else  --}}
						{{-- <p>Không có thông báo nào</p> --}}
					{{-- @endif --}}
				</form>
				
			</div><!-- /.box-body -->
		</div><!-- /.box -->

	</div>
</div>
@endsection 