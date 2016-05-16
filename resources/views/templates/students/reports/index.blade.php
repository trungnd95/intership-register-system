@extends('templates.layouts.master')
@section('head.title','Báo cáo hàng tuần')
@if(Auth::guard('teachers')->getUser() == null)
	@section('breadcrumbs',Breadcrumbs::render('report'))
@else 
	@section('breadcrumbs_teacher',Breadcrumbs::render('student_report',$student))
@endif
@section('templates.body.content')
	<div class="report box">
		<div class="report-header">
			<h2>Báo cáo thực tập hàng tuần</h2>
			<hr/>
		</div>
		<div class="report-body">
			{{-- <div id="accordion"> --}}
			@if(count($reports) > 0)
			<div class="new-report">
				@if(Auth::guard('teachers')->getuser() == null )
					<a href="{{route('student.report.add',[Auth::user()->id])}}" class="btn btn-primary" id="new_ifExist">Tạo báo cáo mới</a>
				@endif

			</div>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				@foreach($reports as $report)
				<div class="panel panel-default">
				 <div class="panel-heading" role="tab" >
				 	<h4 class="panel-title">
				 		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$report->id}}" aria-expanded="true" aria-controls="collapseOne">
				 			{{ $report->title}}<span style="margin-left: 10px"> ( {{$report->created_at->format('d/m/Y')}})</span>
				 		</a>
				 	</h4>
				 </div>
				 <div  id="collapse-{{$report->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				 	<div class="panel-body">
				 		<div class="content-report">
				 			<p>{!! $report->content !!}</p>	
				 			<hr/>
				 		</div>
				 		<div class="comment-report-{{$report->id}}">
				 			<?php  
				 			$total_comment =  DB::table('comments')->select(DB::raw('count(*) as total'))->where('report_id','=',$report->id)->first();
				 			?>
				 			<p><a href="#"><strong><span class="total_comment">{{$total_comment->total}}</span>  Bình luận </strong></a></p>
				 			<div class="row">
				 				<div class="col-md-2">
				 					<?php 
				 						if(Auth::guard('teachers')->getUser() == null)
				 						{
				 							$id = Auth::user()->id;
				 							$cv =  App\Cv::where('user_id','=',$id)->first();
				 						}
				 					?>
				 					<img src="{{ (Auth::guard('teachers')->getUser() != null) ? asset('/images/tutor_login_icon.png') : (count($cv) > 0 && $cv->image != '') ? asset('/upload/images/students/'.$cv->image) : asset('/images/Student-icon.png')  }}" alt="" class="thumnail current_user" width="50px" height="50px">
				 				</div>
				 				<form  method="POST" action="#" class="form-horizontal comment-report" role="form" >
				 					{{csrf_field()}}
				 					<div class="hidden report_id" data-id="{{$report->id}}"></div>
				 					@if(Auth::guard('teachers')->getUser() != null)
				 					<div class="hidden guard" guard="teachers"></div>
				 					<div class="hidden guard_id" guard-id = "{{ Auth::guard('teachers')->user()->id}}"></div>
				 					@else 
				 					<div class="hidden guard" guard="students"></div>
				 					<div class="hidden guard_id" guard-id = "{{ Auth::user()->id}}"></div>
				 					@endif
				 					<div class="form-group col-md-9">
				 						<textarea name="comment-content" class="form-control comment-field" placeholder="Tạo bình luận ... " rows="1"></textarea>
				 					</div>
				 					<div class="form-group col-md-1">
				 						<button class="btn btn-primary btn-comment" type="submit">Đăng</button>
				 					</div>
				 				</form>	
				 			</div>
				 			<hr/>
				 			<div class="display-comment-{{$report->id}}">

				 				@foreach($report->comments as $comment)
				 				<div class="comment">
				 					<div class="user">
				 						<img src="{{ $comment->avatar_src }}" alt="" width="50px" height="50px" />
				 						<p class="user-name"><strong>{{ $comment->username }}</strong> đã bình luận vào lúc <span>{{ $comment->created_at }}</span> </p>
				 					</div>

				 					<p class="content-comment">{{ $comment->comment }}</p>

				 				</div>
				 				@endforeach
				 			</div>

				 		</div>
				 	</div>
				 </div>
				</div>
				@endforeach
			</div>
			
			@else 
				@if(Auth::guard('teachers')->getUser() == null)
					<a href="{{route('student.report.add',[Auth::user()->id])}}" class="btn btn-primary" >Tạo báo cáo mới</a>
				@else 
					<p>Chưa có báo cáo nào</p>
				@endif
			@endif
		</div>
		{{-- </div> --}}
	</div>
@endsection