@extends('templates.admins.layouts.master')
@section('head.title','Quản lí thông báo')

@section('body.headTitle')
	Chi tiết thông báo
@endsection 

@section('admin.body.content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<p>{{$notificationAdmin->message}}</p>
				<span>Vào lúc {{$notificationAdmin->created_at}}</span>	
				<?php $user = App\User::findOrFail($notificationAdmin->user_id)?><br/><hr/>
				<p ><a href="{{route('admin.notify.cvView',[$user->id])}}" target="_blank">Xem CV của {{($user->full_name != '') ? $user->full_name : $user->user_name }}</a></p>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		
	</div>
</div>
@endsection 