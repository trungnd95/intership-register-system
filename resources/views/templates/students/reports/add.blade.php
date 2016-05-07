@extends('templates.layouts.master')
@section('head.title','Báo cáo hàng tuần')
@section('breadcrumbs',Breadcrumbs::render('report'))
@section('templates.body.content')
	<div class="report">
		<div class="report-header">
			<h4>Báo cáo thực tập hàng tuần</h4>
			<hr/>
		</div>
		<div class="report-body">
			<form class="form-horizontal" action="{{route('student.report.store',[Auth::user()->id])}}" method="POST">
				{{csrf_field()}}
				<!-- Text input-->
				<div class="form-group{{ $errors->has('title_report') ? ' has-error' : '' }}">
					<label for="title_report">Tiêu đề báo cáo</label>  
					<input id="title_report" name="title_report" type="text" placeholder="Nhập tên tiêu đề báo cáo" class="form-control input-md" required>
					@if ($errors->has('title_report'))
					<span class="help-block">
						<strong>{{ $errors->first('title_report') }}</strong>
					</span>
					@endif  
				</div>

				<!-- Textarea -->
				<div class="form-group{{ $errors->has('content_report') ? ' has-error' : '' }}">
					<label for="content_report">Nội dung</label>
					<textarea class="form-control" id="content_report" name="content_report" placeholder="Nội dung của báo cáo" required></textarea>
					<script type="text/javascript">ckeditor('content_report')</script>
					@if ($errors->has('content_report'))
					<span class="help-block">
						<strong>{{ $errors->first('content_report') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit">Xong</button>
				</div>
			</form>

		</div>
	</div>
@endsection