@extends('templates.layouts.master')
@section('head.title','Tình trạng đăng kí')
@section('breadcrumbs',Breadcrumbs::render('status'))
@section('templates.body.content')
	<div class="verify">
		<h2 class="title-header">Thông báo</h2>
		<p>
			Bạn đã đăng kí công ty	<strong> {{ $company->name }} </strong>để thực tập.<br/>
			Nếu bạn muốn thay đổi công ty. <a href="{{ route('student.status.indentify',[Auth::user()->id]) }}" >Trở về </a><br/>
			Một lần nữa xin chúc mừng bạn. Mong bạn hãy cố gắng hết sức!!!
			<br/> <a href="fit.uet.vnu.edu.vn" >Fit - UET</a>
		</p>
	</div>
@endsection