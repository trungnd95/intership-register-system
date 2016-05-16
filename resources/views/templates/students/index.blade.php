@extends('templates.layouts.master')
@section('head.title','Trang chủ sinh viên')
@section('breadcrumbs')
	{!!  Breadcrumbs::render('home') !!}
@endsection 
@section('templates.body.content')
	<?php 
	$time = App\AdminConfiguration::select('time_start','time_end')->first();

	?>
	<div class="box">
		<div class="box-header">
			<h2 class="title-header">Thông báo</h2>
		</div>
		<div class="box-body">
			Hệ thống bắt đầu đăng kí từ <h4 class="inline"><strong>{{ $time->time_start }}</strong></h4>

			và kết thúc lúc <h4  class="inline"><strong>{{ $time->time_end}}</strong></h4>
		</div>
	</div>
@endsection