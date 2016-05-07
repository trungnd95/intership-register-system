@extends('templates.admins.layouts.master')
@section('head.title','Tạo công ty mới')

@section('body.headTitle')
	Tạo công ty mới
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-lg-12">
		<form action="{{route('admin.companies.store')}}" method="POST" >
			{!! csrf_field() !!}
			<div class="box box-success">
				<div class="box-body">
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Tên công ty <span>*</span></label>
						<input class="form-control" type="text" placeholder="Nhập tên công ty" name="name" id="name" value="{{ old('name') }}" required />
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
						<label for="address">Địa chỉ</label>
						<textarea name="address" placeholder="Nhập nội dung ..."  class="form-control " >{{ old('address') }}</textarea>
						<script type="text/javascript">ckeditor('address')</script>
						@if($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('content')}}</strong>	
							</span>
						@endif
					</div>  
					
					<div class="form-group{{ $errors->has('contact') ? 'has-error' : ''}}">
						<label for="contact">Liên lạc</label>
						<textarea name="contact" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('contact') }}</textarea>
						<script type="text/javascript">ckeditor('contact')</script>
						@if($errors->has('contact'))
							<span class="help-block">
								<strong>{{ $errors->first('contact')}}</strong>	
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
						<label for="description">Mô tả công ty và thông tin tuyển dụng</label>
						<textarea name="description" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('description') }}</textarea>
						<script type="text/javascript">ckeditor('description'></script>
						@if($errors->has('description'))
							<span class="help-block">
								<strong>{{ $errors->first('description')}}</strong>	
							</span>
						@endif
					</div>
					
					<div class="form-group{{ $errors->has('services') ? 'has-error' : ''}}">
						<label for="services">Các dịch vụ và công nghệ</label>
						<textarea name="services" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('services') }}</textarea>
						<script type="text/javascript">ckeditor('services')</script>
						@if($errors->has('services'))
							<span class="help-block">
								<strong>{{ $errors->first('services')}}</strong>	
							</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('recruitment_amount') ? ' has-error' : '' }}">
						<label for="recruitment_amount">Số lượng tuyển<span>*</span></label>
						<input class="form-control" type="text" placeholder="Nhập số lượng" name="recruitment_amount" id="recruitment_amount" value="{{ old('recruitment_amount') }}" required />
						@if ($errors->has('recruitment_amount'))
						<span class="help-block">
							<strong>{{ $errors->first('recruitment_amount') }}</strong>
						</span>
						@endif
					</div>		          		 												
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
				<!-- /.box-body -->
			</div> 
		</form> 
	</div>
</div>
@endsection