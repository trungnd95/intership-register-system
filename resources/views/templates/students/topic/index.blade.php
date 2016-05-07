@extends('templates.layouts.master')
@section('head.title','Đăng kí đề tài')

@section('templates.body.content')
	<div class="topic">
		<div class="topic-header">
			<h4>
				Đề tài thực tập
				@if(count($topic) > 0)
					<br/><small>(Bạn hãy click vào tên đề tài để báo cáo hàng tuần cho thầy/cô hướng dẫn)</small>
				@endif
			</h4>
		</div>
		<div class="clearfix"></div>
		<hr />
		<div class="topic-body">
			@if(count($topic) > 0)
				<h5><a href="{{route('student.report.index',[$topic->id])}}">{{ $topic->title }}</a></h5>
				<article>
					<p class="short-des" style="margin-left: 20px"><small>{{ $topic->short_des }} </small></p>
				</article>
				<a class="pull-right" href="{{route('student.topic.edit',[Auth::user()->id,$topic->id])}}" style="margin:0px 70px 20px ;">Sửa</a>
				<div class="clearfix"></div>
			@else
				<a href="{{route('student.topic.add',[Auth::user()->id])}}" class="btn btn-primary">Tạo đề tài</a>
			@endif
		</div>
	</div>
@endsection