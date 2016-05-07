@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs_teacher',Breadcrumbs::render('new_detail_teacher',$new))
@section ('templates.body.content')
	@include('templates.news.detail')
@endsection