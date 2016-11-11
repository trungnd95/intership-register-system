@extends('templates.layouts.master')
@section('head.title','Doanh nghiệp')
@section('breadcrumbs_teacher',Breadcrumbs::render('company_teacher'))
@section ('templates.body.content')
	@include('templates.news.list')
@endsection