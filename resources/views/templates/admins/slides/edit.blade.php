@extends('templates.admins.layouts.master')
@section('head.title','Quản lí slide')

@section('body.headTitle')
    Thêm 1 slide
@endsection 

@section('admin.body.content')
<div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" action="{{route('admin.slides.update',[$slide->id])}}" method="post" enctype="multipart/form-data">
          {{ csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="description">Link</label>
              <input type="text" class="form-control" name="description" id="description" value="{{old('description',isset($slide) ? $slide->description : null)}}" placeholder="Nhập link mô tả" />
            </div>
          
            <div class="form-group{{ $errors->has('wrong_sound') ? 'has-error' : ''}}">
            {{-- <span class="btn btn-success"> --}}
              <label>Slide</label><br/>
              {{-- <input type="file" id="wrong_sound" name="wrong_sound" class="form-control " value="{{ old('wrong_sound') }}"> --}}
              <!-- <script type="text/javascript">ckeditor('wrong_sound')</script> -->
              <input id="slide" name="slide" type="text" size="60" value="{{$slide->image}}" />
              <input type="button" value="Upload" onclick="BrowseServer( 'Images:/', 'slide' );" />
            {{-- </span> --}}
            @if($errors->has('slide'))
              <span class="help-block">
                <strong>{{ $errors->first('slide')}}</strong> 
              </span>
            @endif
          </div>
         </div><!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" class="btn btn-primary" style="width: 200px">Sửa</button>
        </div>
      </form>
    </div><!-- /.box -->
  
  </div>
</div>
@endsection