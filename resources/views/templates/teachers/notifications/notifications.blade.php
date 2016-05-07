@extends('templates.layouts.master')
@section('head.title','Thông báo')

@section('templates.body.content')
<section class="notificationsTeacher">
	<div class="row">
		<div class="box">
		<div class="box-header">
			<h4 class="">
				Tất cả thông báo của giảng viên <a href="#">{{Auth::guard('teachers')->user()->username}}</a><hr/> 
			</h4>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="" id="delete-noti-teacher">
			{{ csrf_field()}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
					<div class="row">
						<div class="col-lg-12" id="search_display">
							<ul class="notification_teacher_{{Auth::guard('teachers')->user()->id}} notifications-teacher notifications_list">
								@if(count($notifyTeacher) > 0)
									
									@for($i = 0 ; $i < $count ; $i++)
										<div class="alert alert-dismissable">
											<button type="button" class="close delete-notify-teacher" data-dismiss="alert" aria-hidden="true">×</button>
											<input type="hidden" name="" value="{{ $notifyTeacher[$i]->id }}">
											<input type="hidden" name="" value="{{ Auth::user()->id }}">
											<li class="notify-item">
												<p>{!! $notifyTeacher[$i]->message !!}</p>
												<span>Vào lúc {!! $notifyTeacher[$i]->created_at !!}</span><br/><br/>
												<div class="form-group teacher_acceptance">
													<label class="col-md-4 control-label" >Tùy chọn</label>

													<div class="col-md-4 "> 
														<?php $teacher_acceptance = \App\User::where('id','=',$notifyTeacher[$i]->user_id)->where('teacher_id','=',$notifyTeacher[$i]->teacher_id)->first();

														?>
														<label class="radio-inline " >
															<input type="radio" name="teacher_choosen_{{$notifyTeacher[$i]->id}}"  value="accepted"  class="accepted" data-id="{{$notifyTeacher[$i]->id}}" user-id="{{$notifyTeacher[$i]->user_id}}" 
															@if($teacher_acceptance->teacher_acceptance == 'accepted')
															checked
															@endif
															>
															Chấp nhận
														</label> 
														<label class="radio-inline" >
															<input type="radio" name="teacher_choosen_{{$notifyTeacher[$i]->id}}"  value="ignore" class="ignore"  data-id="{{$notifyTeacher[$i]->id}}" user-id="{{$notifyTeacher[$i]->user_id}}" 
															@if($teacher_acceptance->teacher_acceptance == 'ignore')
															checked
															@endif
															>
															Từ chối
														</label> 
													</div>
												</div>
											</li>	
										</div>
									@endfor
									@for($j = $count; $j < count($notifyTeacher) ; $j ++)
										<div class="alert alert-dismissable">
											<button type="button" class="close delete-notify-student" data-dismiss="alert" aria-hidden="true">×</button>
											<input type="hidden" name="" value="{{ $notifyTeacher[$j]->id }}">
											<input type="hidden" name="" value="{{ Auth::user()->id }}">
											<li class="notify-item seen">
												<p>{!! $notifyTeacher[$j]->message !!}</p>
												<span>Vào lúc {!! $notifyTeacher[$j]->created_at !!}</span><br/><br/>
												<div class="form-group teacher_acceptance">
													<label class="col-md-4 control-label" >Tùy chọn</label>

													<div class="col-md-4 "> 
														<?php $teacher_acceptance = \App\User::where('id','=',$notifyTeacher[$j]->user_id)->where('teacher_id','=',$notifyTeacher[$j]->teacher_id)->first();

														?>
														<label class="radio-inline " >
															<input type="radio" name="teacher_choosen_{{$notifyTeacher[$j]->id}}"  value="accepted"  class="accepted" data-id="{{$notifyTeacher[$j]->id}}" user-id="{{$notifyTeacher[$j]->user_id}}" 
															@if($teacher_acceptance->teacher_acceptance == 'accepted')
															checked
															@endif
															>
															Chấp nhận
														</label> 
														<label class="radio-inline" >
															<input type="radio" name="teacher_choosen_{{$notifyTeacher[$j]->id}}"  value="ignore" class="ignore"  data-id="{{$notifyTeacher[$j]->id}}" user-id="{{$notifyTeacher[$j]->user_id}}" 
															@if($teacher_acceptance->teacher_acceptance == 'ignore')
															checked
															@endif
															>
															Từ chối
														</label> 
													</div>
												</div>
											</li>	
										</div>
									@endfor
								@else 
									<p class="no-notify">Không có thông báo nào</p>
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
	    @if ($notifyTeacher->lastPage() > 1)
	    <ul class="pagination" style="float:right; margin-top: -5px;">
	      @if ($notifyTeacher->currentPage() != 1)
	      <li class="paginate_button previous">
	        <a href="{{ str_replace('/?', '?', $notifyTeacher->url($notifyTeacher->currentPage() - 1)) }}">Previous</a>
	      </li>
	      @endif
	      @for ($i = 1;  $i <= $notifyTeacher->lastPage(); $i++)
	      <li class="paginate_button {{ ($notifyTeacher->currentPage() == $i) ? 'active' : '' }}">
	        <a href="{{ str_replace('/?', '?', $notifyTeacher->url($i)) }}">{{ $i }}</a>
	      </li>
	      @endfor
	      @if ($notifyTeacher->currentPage() != $notifyTeacher->lastPage() &&  $notifyTeacher->lastPage() > 1)
	      <li class="paginate_button next"><a href="{{ str_replace('/?', '?', $notifyTeacher->url($notifyTeacher->currentPage() + 1)) }}">Next</a></li>
	      @endif
	    </ul>
	    @endif
	  </div>
	</div>
</section>
@endsection