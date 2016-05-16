@extends('templates.layouts.master')
@section('head.title','Danh sách sinh viên hướng dẫn')
@section('breadcrumbs_teacher',Breadcrumbs::render('list_student'))
@section ('templates.body.content')
	<div class="list-students">
		<h2 class="title-header">Danh sách sinh viên hướng dẫn</h2>
		<hr/>
		<?php $stt = 1;?>
		@foreach($allStudents as $student)
		<article class="student">
			<table class="table table-hover">
				<tr class="text-center">
					<td>{{ $stt }}</td>
					<td><a href="{{route('teacher.student.report',[$student->id])}}">{{$student->full_name}}</a></td>
					<td><a target="_blank" href="{{route('teacher.student.cvView',[$student->id])}}" >Xem CV</a></td>
				</tr>
			</table>
		</article>
		<?php $stt ++; ?>
		@endforeach
	</div>
@endsection