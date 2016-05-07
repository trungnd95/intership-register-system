@extends('templates.admins.layouts.master')
@section('head.title','Quản lí slide')

@section('body.headTitle')
    Thêm 1 logo đối tác
@endsection 

@section('admin.body.content')
<div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        @include('partials.errors')
        <!-- form start -->
        <form role="form" action="{{route('admin.partner.store')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="description">Link</label>
              <input type="text" class="form-control" name="description" id="description" value="{{old('description',isset($admin) ? $admin->description : null)}}" placeholder="Nhập link mô tả" />
            </div>
            
            <div class="form-group{{ $errors->has('wrong_sound') ? 'has-error' : ''}}">
            {{-- <span class="btn btn-success"> --}}
              <label>Logo</label><br/>
              {{-- <input type="file" id="wrong_sound" name="wrong_sound" class="form-control " value="{{ old('wrong_sound') }}"> --}}
              <!-- <script type="text/javascript">ckeditor('wrong_sound')</script> -->
              <input id="logo" name="logo" type="text" size="60" />
              <input type="button" value="Upload" onclick="BrowseServer( 'Images:/', 'logo' );" />
            {{-- </span> --}}
            @if($errors->has('logo'))
              <span class="help-block">
                <strong>{{ $errors->first('logo')}}</strong> 
              </span>
            @endif
          </div>
            {{-- <div class="form-group"> --}}
              {{-- <label for="avatar">Slide</label> --}}
              
              {{-- <div class="form-group" id="display-img" style="margin-top: 10px;"> </div>
              <div >
                <span class="btn btn-success fileinput-button">
                  <i class="glyphicon glyphicon-plus"></i>
                  <span>Add image...</span>
                  <input type="file" id="image" name="slide" class="form-control ">
                </span>
              </div> --}}
            {{-- </div> --}}
         </div><!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </form>
    </div><!-- /.box -->
  
  </div>
</div>
@endsection