@extends('templates.admins.layouts.master')
@section('head.title','Quản lí doanh nghiệp')

@section('body.headTitle')
	Danh sách thông tin các công ty
	<a href="{{route('admin.companies.add')}}" class="btn btn-primary">Thêm công ty mới</a>
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<form action="" method="POST" class="form-horizontal" role="form" id="form-index-company">
					{!! csrf_field() !!}
					<table class="table table-hover text-center" id="dataTableCompany">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên công ty</th>
								<th>Địa chỉ</th>
								<th>Dịch vụ và công nghệ sử dụng</th>
								<th>Số lượng tuyển</th>
								<th>Số vị trí còn</th>
								<th>Tùy chọn</th>
							</tr>	
						</thead>
						<tbody>
							<?php $stt = 1;?>
							@foreach($companies as $company)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td>{!! $company->name !!}</td>
								<td>{!! $company->address !!}</td>
								<td>{!! $company->services !!}</td>
								<td> {{$company->recruitment_amount}}</td>
								<td>
									{{ $company->recruitment_amount - count($company->statuses) }}
								</td>
								<td>
									<a href="{{route('admin.companies.edit',[$company->id])}}" class="btn btn-warning">Sửa</a>
									<a href="#delete-company" data-toggle="modal" data-target="#delete-company" class="btn btn-danger btn-delete-company-{{$company->id}}" data-id="{{$company->id}}">Xóa</a>
								</td>
							</tr>
							@endforeach	
						</tbody>
						
					</table>
					<!-- Modal popup to confirm delete cat -->
						<div class="modal fade" id="delete-company">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Xóa công ty</h4>
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

{{-- <div class="row">
	<div class="col-lg-12">
	@if ($news->lastPage() > 1)
		<ul class="pagination" style="float:right; margin-top: -5px;">
		@if ($news->currentPage() != 1)
			<li class="paginate_button previous">
			<a href="{{ str_replace('/?', '?', $news->url($news->currentPage() - 1)) }}">Previous</a>
			</li>
			@endif
			@for ($i = 1;  $i <= $news->lastPage(); $i++)
			<li class="paginate_button {{ ($news->currentPage() == $i) ? 'active' : '' }}">
			<a href="{{ str_replace('/?', '?', $news->url($i)) }}">{{ $i }}</a>
			</li>
			@endfor
			@if ($news->currentPage() != $news->lastPage() &&  $news->lastPage() > 1)
			<li class="paginate_button next"><a href="{{ str_replace('/?', '?', $news->url($news->currentPage() + 1)) }}">Next</a></li>
			@endif
		</ul>
		@endif
	</div>
</div> --}}
@endsection 