@extends('templates.layouts.master')
@section('head.title', 'Ý kiến phản hồi')
@if(Auth::guard('teachers')->getUser() == null)
@section('breadcrumbs',Breadcrumbs::render('feedback'))
@else
@section('breadcrumbs_teacher',Breadcrumbs::render('feedback_teacher'))
@endif
@section('templates.body.content')
<div class="box">
	<div class="box-header">
		<h2 class="text-center title-header">Ý kiến phản hồi</h2>
		<br/><hr/>
	</div>
	<div class="box-body">
		<form action="{{(Auth::guard('teachers')->getUser() == null) ? route('student.feedback.saveForm') : route('teacher.feedback.saveForm')}}" method="POST" class="form-horizontal" role="form">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-2 control-label">Email của bạn</label>
				<div class="col-md-10">
					<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($user) ? $user->email : null)}}" required >
	
				</div>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">            
				<label class="col-md-2 control-label">
					@if(Auth::guard('teachers')->getUser() == null)
					Ý kiến của bạn 
					@else 
					Ý kiến của thầy/cô
					@endif
				</label>
				<div class="col-md-10">
					<textarea  id="content" name="content" class="form-control" value="" cols= "100" rows="10" placeholder="Ý kiến đóng góp..." required></textarea> 	
				</div>
				@if ($errors->has('content'))
				<span class="help-block">
					<strong>{{ $errors->first('content') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					
					<button type="reset" class="btn btn-warning" style="width:49%">Reset</button>
					<button type="submit" class="btn btn-primary" style="width:49%">Gửi</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
@endsection 

