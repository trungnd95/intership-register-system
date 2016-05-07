@extends('templates.admins.layouts.master')
@section('head.title','Tạo bài viết mới')

@section('body.headTitle')
	Tạo bài viết mới
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-lg-12">
		<form action="{{route('admin.news.store')}}" method="POST" >
			{!! csrf_field() !!}
			<div class="box box-success">
				<div class="box-body">
					<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
						<label for="title">Tiêu đề <span>*</span></label>
						<input class="form-control" type="text" placeholder="Nhập tiêu đề" name="title" id="title" value="{{ old('title') }}" required />
						@if ($errors->has('title'))
						<span class="help-block">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
						<label for="content">Nội dung</label>
						<textarea name="content" placeholder="Nhập nội dung ..."  class="form-control " >{{ old('content') }}</textarea>
						<script type="text/javascript">ckeditor('content')</script>
						@if($errors->has('content'))
							<span class="help-block">
								<strong>{{ $errors->first('content')}}</strong>	
							</span>
						@endif
					</div>  
					
					<div class="form-group{{ $errors->has('short_des') ? 'has-error' : ''}}">
						<label for="short_des">Mô tả ngắn</label>
						<textarea name="short_des" placeholder="Mô tả ngắn ..."  class="form-control " >{{ old('short_des') }}</textarea>
						<script type="text/javascript">ckeditor('short_des')</script>
						@if($errors->has('short_des'))
							<span class="help-block">
								<strong>{{ $errors->first('short_des')}}</strong>	
							</span>
						@endif
					</div>
					<!-- Select Basic -->
					<div class="form-group{{ $errors->has('schoolyear') ? 'has-error' : ''}}">
						<label class="col-md-2 control-label" for="schoolyear">Khóa</label>
						<div class="col-md-4">
							<select id="selectbasic" name="schoolyear" class="form-control">
								<option value="">Chọn khóa học</option>}

								@foreach($schoolyears as $item)
									<option value="{!! $item->id !!}">{{$item->full_name}}</option>
								@endforeach
							</select>
							@if($errors->has('schoolyear'))
								<span class="help-block">
									<strong>{{ $errors->first('schoolyear')}}</strong>
								</span>
							@endif
						</div>
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