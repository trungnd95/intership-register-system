@extends('templates.layouts.master')
@section('head.title','Cập nhật Cv')
@section('breadcrumbs',Breadcrumbs::render('update-cv'))
@section('templates.body.content')
<div class="box">
	<div class="box-header" style="color:#008000" >
		<h2>Hồ sơ xin thực tập</h2>
		<p>Bạn hãy cập nhật CV của mình</p>
		<a href="{{route('student.cv.view',[$id])}}" class="btn btn-success pull-right view-cv">Xem Cv</a>
		<br/><hr/>
	</div>
	<div class="box-body">
		<form action="{{route('student.cv.update',[$id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">            
				<label for="name" class="col-md-2 control-label">Tên</label>
				<div class="col-md-10">
					<input id="name" name="name" type="text" class="form-control" value="{{old('name',isset($cv) ? $cv->name : null)}}" required>	
				</div>
				@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				<label class="col-md-2 control-label" style="margin-top: 30px">Ảnh đại diện</label>
				<div class="col-md-10">
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}" id="display-img" style="margin-top: 10px;margin-left:10px"> 
						@if(isset($cv))
							@if($cv->image != null)
								<img class="thumbnail" src="{{asset('/upload/images/students/'.$cv->image)}}" width="150px" height="150px" style="margin-left:2%" />
							@endif
						@endif
					</div>
					<div>
						<span class="btn btn-success fileinput-button">
							<i class="glyphicon glyphicon-plus"></i>
							<span>Upload ..</span>
							<input type="file" id="image" name="image" class="form-control ">
						</span>
					</div>	
				</div>
				
			</div>	
			
			<div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">            
				<label for="student_code" class="col-md-2 control-label">Mã sinh viên</label>
				<div class="col-md-10">
					<input id="student_code" name="student_code" type="text" class="form-control" value="{{old('student_code',isset($cv) ? $cv->student_code : null)}}" required>	
				</div>
				@if ($errors->has('student_code'))
				<span class="help-block">
					<strong>{{ $errors->first('student_code') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">            
				<label for="class" class="col-md-2 control-label">Lớp khóa học</label>
				<div class="col-md-10">
					<input id="class" name="class" type="text" class="form-control" value="{{old('class',isset($cv) ? $cv->class : null)}}" required>	
				</div>
				@if ($errors->has('class'))
				<span class="help-block">
					<strong>{{ $errors->first('class') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">            
				<label for="phone_number" class="col-md-2 control-label">Số điện thoại</label>
				<div class="col-md-10">
					<input id="phone_number" name="phone_number" type="text" class="form-control" value="{{old('phone_number',isset($cv) ? $cv->phone_number : null)}}" required>	
				</div>
				@if ($errors->has('phone_number'))
				<span class="help-block">
					<strong>{{ $errors->first('phone_number') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-2 control-label">Email 1</label>
				<div class="col-md-10">
					<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($cv) ? $cv->email : null)}}" required>	
				</div>
				
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('email1') ? ' has-error' : '' }}">
				<label for="email1" class="col-md-2 control-label">Email 2 (nếu có)</label>
				<div class="col-md-10">
					<input id="email1" name="email1" type="email" class="form-control" value="{{old('email1',isset($cv) ? $cv->email1 : null)}}" >	
				</div>
				
				@if ($errors->has('email1'))
				<span class="help-block">
					<strong>{{ $errors->first('email1') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<label for="address" class="col-md-2 control-label">Địa chỉ</label>
				<div class="col-md-10">
					<input id="address" name="address" type="text" class="form-control" value="{{old('address',isset($cv) ? $cv->address : null)}}" required>	
				</div>
				@if ($errors->has('address'))
				<span class="help-block">
					<strong>{{ $errors->first('address') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('personal_website') ? ' has-error' : '' }}">    
				<label for="personal_website" class="col-md-2 control-label">Website cá nhân (Nếu có)</label>   
				<div class="col-md-10">
					<input id="personal_website" name="personal_website" type="text" class="form-control"  value="{{old('personal_website',isset($cv) ? $cv->personal_website : null)}}">	
				</div>
				@if ($errors->has('personal_website'))
				<span class="help-block">
					<strong>{{ $errors->first('personal_website') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('short_selfintro') ? ' has-error' : '' }}">            
				<label class="col-md-2 control-label">Giới thiệu ngắn về bản thân</label>
				<div class="col-md-10">
					<textarea  id="short_selfintro" name="short_selfintro" class="form-control" value="" cols= "100" rows="10" placeholder="Giới thiệu ngắn về bản thân" required>{!! old('short_selfintro',isset($cv) ? $cv->short_selfintro : null) !!}</textarea> 	
				</div>
				
				<!-- <script type="text/javascript">ckeditor('short_selfintro')</script> -->
				@if ($errors->has('short_selfintro'))
				<span class="help-block">
					<strong>{{ $errors->first('short_selfintro') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">   
				<label class="col-md-2 control-label">Quá trình học tập (Học vấn) </label>
				<div class="col-md-10">
					<textarea  id="education" name="education" class="form-control" value="" cols= "100" rows="10" Placeholder="Quá trình học tập (Học vấn)" required>{{old('education',isset($cv) ? $cv->education : null)}}</textarea> 	
					<div class="hidden">
						<!-- <script type="text/javascript">ckeditor('education')</script>-->
					</div>
				</div>
				
				@if ($errors->has('education'))
				<span class="help-block">
					<strong>{{ $errors->first('education') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">    
				<label class="col-md-2 control-label">Kĩ năng</label>
				<div class="col-md-10">
					<textarea  id="skills" name="skills" class="form-control" value="" cols= "100" rows="10" Placeholder="Kĩ năng ( Điểm mạnh )" >{!! old('skills',isset($cv) ? $cv->skills : null) !!}</textarea> 	
				</div>
				<!-- <script type="text/javascript">ckeditor('skills')</script> -->
				@if ($errors->has('skills'))
				<span class="help-block">
					<strong>{{ $errors->first('skills') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('technical') ? ' has-error' : '' }}">            
				<label class="col-md-2 control-label">Công nghệ sử dụng</label>
				<div class="col-md-10">
					<textarea  id="technical" name="technical" class="form-control" value="" cols= "100" rows="10" Placeholder="Các công nghệ sử dụng" >{!! old('technical',isset($cv) ? $cv->technical : null) !!}</textarea> 
				<!-- <script type="text/javascript">ckeditor('technical')</script> -->	
				</div>
				@if ($errors->has('technical'))
		            <span class="help-block">
		                <strong>{{ $errors->first('technical') }}</strong>
		            </span>
		            @endif
			</div>
			<div class="form-group{{ $errors->has('experiences') ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Kinh nghiệm làm việc (nếu có)</label>      
				<div class="col-md-10">
					<textarea  id="experiences" name="experiences" class="form-control" value="" cols= "100" rows="10" Placeholder="Kinh nghiệm làm việc nếu có" >{!! old('experiences',isset($cv) ? $cv->experiences : null) !!}</textarea> 	
				</div>
				<!-- <script type="text/javascript">ckeditor('experiences')</script> -->
				@if ($errors->has('experiences'))
				<span class="help-block">
					<strong>{{ $errors->first('experiences') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('hobbies') ? ' has-error' : '' }}">    
				<label class="col-md-2 control-label">Sở thích</label>      
				<div class="col-md-10">
					<textarea  id="hobbies" name="hobbies" class="form-control" value="" cols= "100" rows="10" Placeholder="Sở thích" required>{{old('hobbies',isset($cv) ? $cv->hobbies : null)}}</textarea> 	
				</div>
				<!-- <script type="text/javascript">ckeditor('hobbies')</script> -->
				@if ($errors->has('hobbies'))
				<span class="help-block">
					<strong>{{ $errors->first('hobbies') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('others') ? ' has-error' : '' }}">    
				<label class="col-md-2 control-label">Thêm</label> 
				<div class="col-md-10">
					<textarea  id="others" name="others" class="form-control" value="" cols= "100" rows="10" Placeholder="Miêu tả khác" >{{old('others',isset($cv) ? $cv->others : null)}}</textarea> 	
				</div>
				
				<!-- <script type="text/javascript">ckeditor('others')</script> -->
				@if ($errors->has('others'))
				<span class="help-block">
					<strong>{{ $errors->first('others') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" style="width:49%">Cập nhật</button>
					<button type="reset" class="btn btn-danger" style="width:49%">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection