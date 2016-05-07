@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs',Breadcrumbs::render('new'))
@section('templates.body.content')
	@include('templates.news.list')
@endsection 