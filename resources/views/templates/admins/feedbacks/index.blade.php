@extends('templates.admins.layouts.master')
@section('head.title','Quản lí tin tức')
@section('admin.body.content')
	<section class="notificationsTeacher">
	<div class="row">
		<div class="box">
		<div class="box-header">
			<h4 class="">
				Tất cả ý kiến đóng góp 
			</h4>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="" id="admin-feedback">
			{{ csrf_field()}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
					<div class="row">
						<div class="col-lg-12" id="feedbacks">
							<ul >
								@if(count($feedbacks) > 0)
									
									@foreach($feedbacks as $feedback )
										<div class="alert alert-dismissable">
											<button type="button" class="close delete-feedback" data-dismiss="alert" aria-hidden="true" data-id="{{$feedback->id}}">×</button>
											<li class="notify-item">
												<h4>{!! $feedback->email !!}</h4>
												<p>{!! $feedback->content !!}</p>
												<span>Vào lúc {!! $feedback->created_at !!}</span><br/><br/>
												<div class="form-group">
													<label class="col-md-4 control-label" >Trạng thái</label>
													<div class="col-md-4 "> 
														<label class="radio-inline " >
															<input type="radio" name="reply_status_{{$feedback->id}}" 
															data-id="{{$feedback->id}}" value="1"
															@if($feedback->reply_status	 ==  1)
																checked 
															@endif
															>
															Đã trả lời
														</label> 
														<label class="radio-inline" >
															<input type="radio" name="reply_status_{{$feedback->id}}" data-id="{{$feedback->id}}" value="0"
															@if($feedback->reply_status	 ==  0)
																checked 
															@endif
															>
															Chưa trả lời
														</label> 
													</div>
												</div>
											</li>	
										</div>
									@endforeach
								@else 
									<p class="no-notify">Không có đóng góp nào</p>
								@endif
							</ul>
						</div>
					</div>
				</div>
				<!-- Main content -->	
			</form>
		</div>
	</div>
	<div class="row">
	  <div class="col-lg-12">
	    @if ($feedbacks->lastPage() > 1)
	    <ul class="pagination" style="float:right; margin-top: -5px;">
	      @if ($feedbacks->currentPage() != 1)
	      <li class="paginate_button previous">
	        <a href="{{ str_replace('/?', '?', $feedbacks->url($feedbacks->currentPage() - 1)) }}">Previous</a>
	      </li>
	      @endif
	      @for ($i = 1;  $i <= $feedbacks->lastPage(); $i++)
	      <li class="paginate_button {{ ($feedbacks->currentPage() == $i) ? 'active' : '' }}">
	        <a href="{{ str_replace('/?', '?', $feedbacks->url($i)) }}">{{ $i }}</a>
	      </li>
	      @endfor
	      @if ($feedbacks->currentPage() != $feedbacks->lastPage() &&  $feedbacks->lastPage() > 1)
	      <li class="paginate_button next"><a href="{{ str_replace('/?', '?', $feedbacks->url($feedbacks->currentPage() + 1)) }}">Next</a></li>
	      @endif
	    </ul>
	    @endif
	  </div>
	</div>
</section>
@endsection