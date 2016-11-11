@extends('templates.admins.layouts.master')
@section('head.title','Sửa thông tin công ty')

@section('body.headTitle')
	Sửa thông tin công ty
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-lg-12">
		<form action="{{route('admin.companies.update',[$company->id])}}" method="POST" >
			@include('partials.errors')
			{!! csrf_field() !!}
			<div class="box box-success">
				<div class="box-body">
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Tên công ty <span>*</span></label>
						<input class="form-control" type="text" placeholder="Nhập tên công ty" name="name" id="name" value="{{ old('name',isset($company)? $company->name : null) }}" required />
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
						<label for="address">Địa chỉ</label>
						<textarea name="address" placeholder="Nhập nội dung ..."  class="form-control " >{{ old('address',isset($company) ? $company->address: null) }}</textarea>
						<script type="text/javascript">ckeditor('address')</script>
						@if($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('content')}}</strong>	
							</span>
						@endif
					</div>  
					
					<div class="form-group{{ $errors->has('contact') ? 'has-error' : ''}}">
						<label for="contact">Liên lạc</label>
						<textarea name="contact" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('contact',isset($company)  ? $company->contact : null ) }}</textarea>
						<script type="text/javascript">ckeditor('contact')</script>
						@if($errors->has('contact'))
							<span class="help-block">
								<strong>{{ $errors->first('contact')}}</strong>	
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('short_description') ? 'has-error' : ''}}">
						<label for="short_description">Mô tả công ty và thông tin tuyển dụng</label>
						<textarea name="short_description" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('short_description',isset($company) ? $company->description : null) }}</textarea>
						<script type="text/javascript">ckeditor('short_description')</script>
						@if($errors->has('short_description'))
							<span class="help-block">
								<strong>{{ $errors->first('short_description')}}</strong>	
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('services') ? 'has-error' : ''}}">
						<label for="services">Các dịch vụ và công nghệ</label>
						<textarea name="services" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('services',isset($company) ? $company->services : null) }}</textarea>
						<script type="text/javascript">ckeditor('services')</script>
						@if($errors->has('services'))
							<span class="help-block">
								<strong>{{ $errors->first('services')}}</strong>	
							</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('recruitment_amount') ? ' has-error' : '' }}">
						<label for="recruitment_amount">Số lượng tuyển<span>*</span></label>
						<input class="form-control" type="text" placeholder="Nhập số lượng" name="recruitment_amount" id="recruitment_amount" value="{{ old('recruitment_amount',isset($company) ? $company->recruitment_amount : null) }}" required />
						@if ($errors->has('recruitment_amount'))
						<span class="help-block">
							<strong>{{ $errors->first('recruitment_amount') }}</strong>
						</span>
						@endif
					</div>		          		 												
				</div>
				<div class="box-footer">
					
					<button type="reset" class="btn btn-danger">Reset</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
				<!-- /.box-body -->
			</div> 
		</form> 
	</div>
</div>
@endsection