@extends('templates.layouts.master')
@section('head.title','Tạo Cv')
@section('breadcrumbs',Breadcrumbs::render('create-cv'))
@section('templates.body.content')
<form role="form" method="POST" action ="{{route('student.cv.store',[$id])}}" enctype="multipart/form-data" class="form-inline col-md-10 go-right" id="form-update" style="color: Green;background-color:#FAFAFF;border-radius:0px 22px 22px 22px;">
	<h2>Hồ sơ xin thực tập</h2>
	<p>Bạn hãy tạo CV của mình</p>
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">            
		<input id="name" name="name" type="text" class="form-control" value="{{old('name',isset($cv) ? $cv->name : null)}}" required>
		<label for="name">Tên</label>
		@if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>
	<br/>
	<br/>
	<br><br>
	<p1>Avatar</p1>
	<br/>
	<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
		<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;"> 
			@if(isset($cv))
				@if($cv->avatar != null)
					<img class="thumbnail" src="{{asset('/public/upload/images/students/'.$cv->image)}}" />
				@endif
			@endif
		</div>
		<div>
			<span class="btn btn-success fileinput-button">
				<i class="glyphicon glyphicon-plus"></i>
				<span>Add image...</span>
				<input type="file" id="image" name="image" class="form-control ">
			</span>
		</div>
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($cv) ? $cv->email : null)}}" required>
		<label for="email">Email<i class="fa fa-envelope-o"></i></label>
		@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
		<input id="address" name="address" type="text" class="form-control" value="{{old('address',isset($cv) ? $cv->address : null)}}" required>
		<label for="address">Địa chỉ<i class="fa fa-home"></i></label>
		@if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('personal_website') ? ' has-error' : '' }}">            
		<input id="personal_website" name="personal_website" type="text" class="form-control"  value="{{old('personal_website',isset($cv) ? $cv->personal_website : null)}}">
		<label for="personal_website">Website cá nhân (Nếu có)<span class="glyphicon glyphicon-user"> </span></label>
		@if ($errors->has('personal_website'))
            <span class="help-block">
                <strong>{{ $errors->first('personal_website') }}</strong>
            </span>
            @endif
	</div>
	
	<br><br>
	<div class="form-group{{ $errors->has('short_selfintro') ? ' has-error' : '' }}">            
		<p>Giới thiệu ngắn về bản thân</p>
		<textarea  id="short_selfintro" name="short_selfintro" class="form-control" value="" cols= "100" rows="10" placeholder="Giới thiệu ngắn về bản thân" required>{{old('short_selfintro',isset($cv) ? $cv->short_selfintro : null)}}</textarea> 
		<script type="text/javascript">ckeditor('short_selfintro')</script>
		@if ($errors->has('short_selfintro'))
            <span class="help-block">
                <strong>{{ $errors->first('short_selfintro') }}</strong>
            </span>
            @endif
	</div>
	<br/>
	<br/>
	<div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">   
		<p>Quá trình học tập (Học vấn) </p>
		<textarea  id="education" name="education" class="form-control" value="" cols= "100" rows="10" Placeholder="Quá trình học tập (Học vấn)" required>{{old('education',isset($cv) ? $cv->education : null)}}</textarea> 
		<script type="text/javascript">ckeditor('education')</script>
		@if ($errors->has('education'))
            <span class="help-block">
                <strong>{{ $errors->first('education') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">    
		<p>Kĩ năng</p>
		<textarea  id="skills" name="skills" class="form-control" value="" cols= "100" rows="10" Placeholder="Kĩ năng ( Điểm mạnh )" >{{old('skills',isset($cv) ? $cv->skills : null)}}</textarea> 
		<script type="text/javascript">ckeditor('skills')</script>
		@if ($errors->has('skills'))
            <span class="help-block">
                <strong>{{ $errors->first('skills') }}</strong>
            </span>
            @endif
	</div>
	<br><br>
	<div class="form-group{{ $errors->has('technical') ? ' has-error' : '' }}">            
		<p>Công nghệ sử dụng</p>
		<textarea  id="technical" name="technical" class="form-control" value="" cols= "100" rows="10" Placeholder="Các công nghệ sử dụng" >{{old('technical',isset($cv) ? $cv->technical : null)}}</textarea> 
		<script type="text/javascript">ckeditor('technical')</script>
		@if ($errors->has('technical'))
            <span class="help-block">
                <strong>{{ $errors->first('technical') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('experiences') ? ' has-error' : '' }}">
		<p>Kinh nghiệm làm việc nếu có</p>            
		<textarea  id="experiences" name="experiences" class="form-control" value="" cols= "100" rows="10" Placeholder="Kinh nghiệm làm việc nếu có" >{{old('experiences',isset($cv) ? $cv->experiences : null)}}</textarea> \
		<script type="text/javascript">ckeditor('experiences')</script>
		@if ($errors->has('experiences'))
            <span class="help-block">
                <strong>{{ $errors->first('experiences') }}</strong>
            </span>
            @endif
	</div>
	
	<br/><br/>
	<div class="form-group{{ $errors->has('hobbies') ? ' has-error' : '' }}">    <p>Sở thích</p>
		<textarea  id="hobbies" name="hobbies" class="form-control" value="" cols= "100" rows="10" Placeholder="Sở thích" required>{{old('hobbies',isset($cv) ? $cv->hobbies : null)}}</textarea> 
		<script type="text/javascript">ckeditor('hobbies')</script>
		@if ($errors->has('hobbies'))
            <span class="help-block">
                <strong>{{ $errors->first('hobbies') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group{{ $errors->has('others') ? ' has-error' : '' }}">    <p>Tự bạch</p>        
		<textarea  id="others" name="others" class="form-control" value="" cols= "100" rows="10" Placeholder="Miêu tả khác" >{{old('others',isset($cv) ? $cv->others : null)}}</textarea> 
		<script type="text/javascript">ckeditor('others')</script>
		@if ($errors->has('others'))
            <span class="help-block">
                <strong>{{ $errors->first('others') }}</strong>
            </span>
            @endif
	</div>
	<br/><br/>
	<div class="form-group pull">
		<button class="btn btn-primary" type="submit">Hoàn tất</button>
	</div>
	<br/> <br/>
</form>
@endsection