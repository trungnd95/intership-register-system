@extends('templates.layouts.master')
@section('head.title','Danh sách sinh viên hướng dẫn')
@section('breadcrumbs_teacher',Breadcrumbs::render('list_student'))
@section ('templates.body.content')
	<div class="list-students">
		<h2 class="title-header">Danh sách sinh viên hướng dẫn</h2>
		<hr/>
		@if(count($allStudents) > 0)
		<?php $stt = 1;?>
		@foreach($allStudents as $student)
		<article class="student">
			<table class="table table-hover">
				<tr class="text-center">
					<td width="10%">{{ $stt }}</td>
					<td width="60%"><a href="{{route('teacher.student.report',[$student->id])}}">{{$student->cv->name}}</a></td>
					<td width="30%"><a target="_blank" href="{{route('teacher.student.cvView',[$student->id])}}" >Xem CV</a></td>
				</tr>
			</table>
		</article>
		<?php $stt ++; ?>
		@endforeach
		@else
			<p>Không có sinh viên nào!!!</p>
		@endif
	</div>
@endsection