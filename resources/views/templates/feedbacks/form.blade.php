@extends('templates.layouts.master')
@section('head.title', 'Ý kiến phản hồi')
@if(Auth::guard('teachers')->getUser() == null)
@section('breadcrumbs',Breadcrumbs::render('feedback'))
@else
@section('breadcrumbs_teacher',Breadcrumbs::render('feedback_teacher'))
@endif
@section('templates.body.content')
<form role="form" method="POST" action ="{{(Auth::guard('teachers')->getUser() == null) ? route('student.feedback.saveForm') : route('teacher.feedback.saveForm')}}" class="form-inline col-md-10 go-right" id="form-update" style="color: Green;background-color:#FAFAFF;border-radius:0px 22px 22px 22px;">
	<h2>Ý kiến phản hồi</h2><br/><br/>
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($user) ? $user->email : null)}}" required >
		<label for="email">Email của bạn<i class="fa fa-envelope-o"></i></label>
		@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">            
		<p>
			@if(Auth::guard('teachers')->getUser() == null)
				Ý kiến của bạn 
			@else 
				Ý kiến của thầy/cô
			@endif
		</p>
		<textarea  id="content" name="content" class="form-control" value="" cols= "100" rows="10" placeholder="Ý kiến đóng góp..." required></textarea> 
		@if ($errors->has('content'))
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
            @endif
	</div>
	<br/>
	<br/>
	<div class="form-group">
		<button class="btn btn-primary" type="submit" id="submit">
			Lưu
		</button>
	</div>
	<br/><br/>
</form>
		
@endsection 

