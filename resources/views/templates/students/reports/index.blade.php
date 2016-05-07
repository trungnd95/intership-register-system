@extends('templates.layouts.master')
@section('head.title','Báo cáo hàng tuần')
@if(Auth::guard('teachers')->getUser() == null)
	@section('breadcrumbs',Breadcrumbs::render('report'))
@else 
	@section('breadcrumbs_teacher',Breadcrumbs::render('student_report',$student))
@endif
@section('templates.body.content')
	<div class="report">
		<div class="report-header">
			<h4>Báo cáo thực tập hàng tuần</h4>
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
			<div id="accordion">
				@foreach($reports as $report)
				<h3>{{ $report->title}}<span style="margin-left: 10px"> ( {{$report->created_at->format('d/m/Y')}})</span></h3>
				<div id="report-main">
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
								<img src="{{ (Auth::guard('teachers')->getUser() != null) ? asset('/public/upload/images/teachers/'.Auth::guard('teachers')->user()->avatar) : asset('/public/upload/images/students/'.Auth::user()->avatar) }}" alt="" class="thumnail current_user" width="50px" height="50px">
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