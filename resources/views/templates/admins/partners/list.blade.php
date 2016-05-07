@extends('templates.admins.layouts.master')
@section('head.title','Quản lí slide')

@section('body.headTitle')
	Danh sách các logo đối tác
	<a href="{{route('admin.partner.add')}}" class="btn btn-primary">Thêm logo mới </a>
@endsection 

@section('admin.body.content')
<div class="row row_slide">
	<form action="" method="POST" id="form-index-logo">
		{{csrf_field()}}
		@foreach($logos as $item)
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail">
				<img src="{{$item->image}}" alt="..." style="height: 147px;width: 240px;">
				<div class="caption">
					<p>{{$item->link}}</p>
					<p  style="text-align: center;">
						<a href="#modalLogoPartner" class="btn btn-danger btn_delete_logo_{{$item->id}}" data-toggle="modal" data-target="#modalLogoPartner" data-id="{{$item->id}}">
							Xóa
						</a>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</form> 
</div>

<!-- Modal -->
<div class="modal fade" id="modalLogoPartner">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Xóa Logo</h4>
			</div>
			<div class="modal-body">
				Bạn có chắc chắn muốn xóa logo này!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button class="btn btn-danger confirm_del_logo">Xác nhận</button>
			</div>
		</div>
	</div>
</div>
@endsection 