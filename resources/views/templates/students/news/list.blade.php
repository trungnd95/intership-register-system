@extends('templates.layouts.master')
@section('head.title','Thông tin doanh nghiệp')
@section('breadcrumbs',Breadcrumbs::render('new'))
@section('templates.body.content')
	@include('templates.news.list')
@endsection 