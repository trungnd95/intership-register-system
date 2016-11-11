@extends('templates.layouts.master')
@section('head.title','Tình trạng đăng kí')
@section('breadcrumbs',Breadcrumbs::render('status'))
@section('templates.body.content')
	<div class="verify">
		<div class="box">
			<div class="box-header">
				<h2 class="title-header">Thông báo</h2><hr/>		
			</div>
			<div class="box-body">
				<p>
				Bạn đã đăng kí công ty	<strong style="font-size: 18px"> {{ $company->name }} </strong>để thực tập.<br/>
					Nếu bạn muốn thay đổi công ty. <a href="{{ route('student.status.indentify',[Auth::user()->id]) }}" > <i class="fa fa-step-backward" aria-hidden="true" style="margin-right: 5px"></i> Trở về </a><br/>
					Một lần nữa xin chúc mừng bạn. Mong bạn hãy cố gắng hết sức!!!
					<br/> 
				</p>		
			</div>
			<div class="box-footer">
				{{-- <hr/> --}}
				<a href="fit.uet.vnu.edu.vn" >Fit - UET</a>
			</div>
		</div>
		
		
	</div>
@endsection