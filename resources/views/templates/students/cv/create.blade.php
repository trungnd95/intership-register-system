@extends('templates.layouts.master')
@section('head.title','Cập nhật Cv')
@section('breadcrumbs',Breadcrumbs::render('create-cv'))
@section('templates.body.content')
<div class="box">
	<div class="box-header" style="color:#008000" >
		<h2>Hồ sơ xin thực tập</h2>
		<p>Bạn hãy cập nhật CV của mình</p>
		<a href="{{route('student.cv.view',[$id])}}" class="btn btn-success pull-right view-cv" target="_blank">Xem Cv</a>
		<br/><hr/>
	</div>
	<div class="box-body">
		<form action="{{route('student.cv.store',[$id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" role="form">
			{{csrf_field()}}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">            
				<label for="name" class="col-md-3 control-label">Tên</label>
				<div class="col-md-9">
					<input id="name" name="name" type="text" class="form-control" value="{{old('name',isset($cv) ? $cv->name : null)}}" required>
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">            
				<label for="date_of_birth" class="col-md-3 control-label">Ngày tháng năm sinh</label>
				<div class="col-md-9">
					<input id="date_of_birth" name="date_of_birth" type="date" class="form-control" value="{{old('date_of_birth',isset($cv) ? $cv->date_of_birth : null)}}" required>
					@if ($errors->has('date_of_birth'))
					<span class="help-block">
						<strong>{{ $errors->first('date_of_birth') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
				<label class="col-md-3 control-label" style="margin-top: 30px">Ảnh đại diện</label>
				<div class="col-md-9">
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
							@if ($errors->has('image'))
							<span class="help-block">
							<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
						</span>
					</div>	
				</div>
				
			</div>	
			
			<div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">            
				<label for="student_code" class="col-md-3 control-label">Mã sinh viên</label>
				<div class="col-md-9">
					<input id="student_code" name="student_code" type="text" class="form-control" value="{{old('student_code',isset($cv) ? $cv->student_code : null)}}" required>
					@if ($errors->has('student_code'))
					<span class="help-block">
						<strong>{{ $errors->first('student_code') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			
			<div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">            
				<label for="class" class="col-md-3 control-label">Lớp khóa học</label>
				<div class="col-md-9">
					<input id="class" name="class" type="text" class="form-control" value="{{old('class',isset($cv) ? $cv->class : null)}}" required>
					@if ($errors->has('class'))
					<span class="help-block">
						<strong>{{ $errors->first('class') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">            
				<label for="phone_number" class="col-md-3 control-label">Số điện thoại</label>
				<div class="col-md-9">
					<input id="phone_number" name="phone_number" type="text" class="form-control" value="{{old('phone_number',isset($cv) ? $cv->phone_number : null)}}" required>
					@if ($errors->has('phone_number'))
					<span class="help-block">
						<strong>{{ $errors->first('phone_number') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-3 control-label">Email 1</label>
				<div class="col-md-9">
					<input id="email" name="email" type="email" class="form-control" value="{{old('email',isset($cv) ? $cv->email : null)}}" required>
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif	
				</div>
				
				
			</div>

			<div class="form-group{{ $errors->has('email1') ? ' has-error' : '' }}">
				<label for="email1" class="col-md-3 control-label">Email 2 (nếu có)</label>
				<div class="col-md-9">
					<input id="email1" name="email1" type="email" class="form-control" value="{{old('email1',isset($cv) ? $cv->email1 : null)}}" >
					@if ($errors->has('email1'))
					<span class="help-block">
						<strong>{{ $errors->first('email1') }}</strong>
					</span>
					@endif	
				</div>
				
				
			</div>

			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<label for="address" class="col-md-3 control-label">Địa chỉ hiện tại</label>
				<div class="col-md-9">
					<input id="address" name="address" type="text" class="form-control" value="{{old('address',isset($cv) ? $cv->address : null)}}" required>
					@if ($errors->has('address'))
					<span class="help-block">
						<strong>{{ $errors->first('address') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			
			<div class="form-group{{ $errors->has('personal_website') ? ' has-error' : '' }}">    
				<label for="personal_website" class="col-md-3 control-label">Website cá nhân (Nếu có)</label>   
				<div class="col-md-9">
					<input id="personal_website" name="personal_website" type="text" class="form-control"  value="{{old('personal_website',isset($cv) ? $cv->personal_website : null)}}">
					@if ($errors->has('personal_website'))
					<span class="help-block">
						<strong>{{ $errors->first('personal_website') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('mark_average') ? ' has-error' : '' }}">    
				<label for="mark_average" class="col-md-3 control-label">Điểm trung bình tích lũy tính đến thời điểm hiện tại</label>   
				<div class="col-md-9">
					<input id="mark_average" name="mark_average" type="text" class="form-control"  value="{{old('mark_average',isset($cv) ? $cv->mark_average : null)}}">
					@if ($errors->has('mark_average'))
					<span class="help-block">
						<strong>{{ $errors->first('mark_average') }}</strong>
					</span>
					@endif	
				</div>
				
			</div>
			<div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">   
				<label class="col-md-3 control-label">Thành tích trong quá trình học tập (Nếu có)</label>
				<div class="col-md-9">
					<textarea  id="education" name="education" class="form-control" value="" cols= "100" rows="10" Placeholder="Quá trình học tập (Học vấn)" >{{old('education',isset($cv) ? $cv->education : null)}}</textarea> 
					@if ($errors->has('education'))
					<span class="help-block">
						<strong>{{ $errors->first('education') }}</strong>
					</span>
					@endif	
					<div class="hidden">
						<!-- <script type="text/javascript">ckeditor('education')</script>-->
					</div>
				</div>
				
				
			</div>

			<div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">    
				<label class="col-md-3 control-label">Kĩ năng</label>
				<div class="col-md-9">
					<textarea  id="skills" name="skills" class="form-control" value="" cols= "100" rows="10" Placeholder="Kĩ năng ( Điểm mạnh )" >{!! old('skills',isset($cv) ? $cv->skills : null) !!}</textarea> 
					@if ($errors->has('skills'))
				<span class="help-block">
					<strong>{{ $errors->first('skills') }}</strong>
				</span>
				@endif	
				</div>
				<!-- <script type="text/javascript">ckeditor('skills')</script> -->
				
			</div>
			<div class="form-group{{ $errors->has('experiences') ? ' has-error' : '' }}">
				<label class="col-md-3 control-label">Kinh nghiệm làm việc (nếu có)</label>      
				<div class="col-md-9">
					<textarea  id="experiences" name="experiences" class="form-control" value="" cols= "100" rows="10" Placeholder="Kinh nghiệm làm việc nếu có" >{!! old('experiences',isset($cv) ? $cv->experiences : null) !!}</textarea>
					@if ($errors->has('experiences'))
					<span class="help-block">
						<strong>{{ $errors->first('experiences') }}</strong>
					</span>
					@endif 	
				</div>
				<!-- <script type="text/javascript">ckeditor('experiences')</script> -->
				
			</div>

			<div class="form-group{{ $errors->has('hobbies') ? ' has-error' : '' }}">    
				<label class="col-md-3 control-label">Sở thích</label>      
				<div class="col-md-9">
					<textarea  id="hobbies" name="hobbies" class="form-control" value="" cols= "100" rows="10" Placeholder="Sở thích" required>{{old('hobbies',isset($cv) ? $cv->hobbies : null)}}</textarea>
					@if ($errors->has('hobbies'))
					<span class="help-block">
						<strong>{{ $errors->first('hobbies') }}</strong>
					</span>
					@endif 	
				</div>
				<!-- <script type="text/javascript">ckeditor('hobbies')</script> -->
				
			</div>
			<div class="form-group{{ $errors->has('others') ? ' has-error' : '' }}">    
				<label class="col-md-3 control-label">Thêm</label> 
				<div class="col-md-9">
					<textarea  id="others" name="others" class="form-control" value="" cols= "100" rows="10" Placeholder="Miêu tả khác" >{{old('others',isset($cv) ? $cv->others : null)}}</textarea> 
					@if ($errors->has('others'))
					<span class="help-block">
						<strong>{{ $errors->first('others') }}</strong>
					</span>
					@endif	
				</div>
				
				<!-- <script type="text/javascript">ckeditor('others')</script> -->
				
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<a onclick="goBack()" class="btn btn-default" style="width:49%">Hủy bỏ</a>
					<button type="submit" class="btn btn-primary" style="width:49%">Cập nhật</button>
					
				</div>
			</div>
		</form>
	</div>
</div>
@endsection