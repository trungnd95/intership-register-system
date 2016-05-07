@extends('templates.layouts.master')
@section('head.title', 'Đăng kí đề tài')
@section('templates.body.content')

<form role="form" method="POST" action ="{{route('student.topic.update',[Auth::user()->id,$topic->id])}}"class="form-inline col-md-10 go-right" id="form-update" style="color: Green;background-color:#FAFAFF;border-radius:0px 22px 22px 22px;">
	<h2>Đăng kí đề tài</h2>
	<p>Bạn hãy đăng kí 1 đề tài về vấn đề bạn thích trong thời gian thực tập</p>
	{{ csrf_field() }}
	<hr />
	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">            
		<input id="title" name="title" type="text" class="form-control" value="{{old('title',isset($topic)? $topic->title : null )}}" required>
		<label for="title">Tên đề tài</label>
		@if ($errors->has('title'))
		<span class="help-block">
			<strong>{{ $errors->first('title') }}</strong>
		</span>
		@endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('short_des') ? ' has-error' : '' }}">     
		<p>Miêu tả ngắn về đề tài</p>
		<textarea id="short_des" name="short_des" type="text" class="form-control" cols= "64" rows="10" placeholder="Miêu tả ngắn về đề tài" required>{{old('short_des',isset($topic) ? $topic->short_des : null)}}</textarea>
		@if ($errors->has('short_des'))
		<span class="help-block">
			<strong>{{ $errors->first('short_des') }}</strong>
		</span>
		@endif
	</div>
	<br/>
	<br/>
	<div class="form-group">
		<button class="btn btn-primary" class="button-dang-ki" type="submit">Thay đổi</button>
	</div>
	<br/><br/>
</form>

@endsection