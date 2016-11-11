@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs_teacher',Breadcrumbs::render('company_detail_teacher',$company))
@section ('templates.body.content')
	@include('templates.news.detail')
@endsection