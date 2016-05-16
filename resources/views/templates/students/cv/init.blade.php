@extends('templates.layouts.master')
@section('head.title','Tạo Cv')
@section('breadcrumbs',Breadcrumbs::render('create-cv'))
@section('templates.body.content')
	<div class="box">
		<div class="box-header">
			<h2 class="title-header">Tạo hồ sơ xin thực tập</h2><br/><hr/>
		</div>
		<div class="box-body">
			<p>Bạn chưa tạo CV.Click nút bên dưới để tạo CV</p>
			<a href="{{route('student.cv.create',[Auth::user()->id])}}" class="btn btn-primary">Tạo CV</a>
		</div>
	</div>
@endsection 