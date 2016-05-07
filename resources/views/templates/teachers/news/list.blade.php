@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs_teacher',Breadcrumbs::render('new_teacher'))
@section ('templates.body.content')
	@include('templates.news.list')
@endsection