@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs',Breadcrumbs::render('new_detail',$new))
@section('templates.body.content')
	@include('templates.news.detail')
@endsection 