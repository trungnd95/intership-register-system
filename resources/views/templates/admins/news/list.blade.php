@extends('templates.admins.layouts.master')
@section('head.title','Quản lí tin tức')

@section('body.headTitle')
	Danh sách tin tức 
	<a href="{{route('admin.news.add')}}" class="btn btn-primary">Tạo bài viết mới</a>
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
								<th>Tiêu đề</th>
								<th>Mô tả ngắn</th>
								<th>Khóa</th>
								<th>Tùy chọn</th>
							</tr>	
						</thead>
						<tbody>
							<?php $stt = 1;?>
							@foreach($news as $new)
							<tr class="text-center row-content">
								<td>{{ $stt }}</td>
								<td>{!! $new->title !!}</td>
								<td>{!! $new->short_des !!}</td>
								<td>{{$new->schoolyear->full_name}}</td>
								<td>
									<a href="{{route('admin.news.edit',[$new->id])}}" class="btn btn-warning">Sửa</a>
									<a href="#delete-new" data-toggle="modal" data-target="#delete-new" class="btn btn-danger btn-delete-new-{{$new->id}}" data-id="{{$new->id}}">Xóa</a>
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

<div class="row">
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
</div>
@endsection 