@extends('templates.layouts.master')
@section('head.title','Chi tiết công ty')
@section('breadcrumbs',Breadcrumbs::render('company-detail',$company))
@section('templates.body.content')
	<div class="company_detail">
		<div class="box">
			<div class="box-header">
				<h2 class="text-center title-header"><strong>{{ $company->name}}</strong></h2>
			</div>
			{{-- <br/><hr/> --}}
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Tên công ty</th>
						<td>{{ $company->name}}</td>
					</tr>
					<tr>
						<th>Địa chỉ</th>
						<td>{!! $company->address !!}</td>
					</tr>
					<tr>
						<th>Liên hệ</th>
						<td>{!! $company->contact !!}</td>
					</tr>
					<tr>
						<th>Các dịch vụ và thế mạnh của công ty</th>
						<td>{!! $company->services !!}</td>
					</tr>
					<tr>
						<th>Mô tả công ty và thông tin tuyển dụng</th>
						<td>{!! $company->description !!}</td>
					</tr>
					<tr>
						<th>Số lượng tuyển</th>
						<td>{!! $company->recruitment_amount !!}</td>
					</tr>
					<tr>
						<th>Số lượng sinh viên đã đăng kí</th>
						<td>{!! count($company->statuses) !!}</td>
					</tr>
					<tr>
						<th>Số lượng sinh viên được chấp nhận</th>
						<td>
							<?php $count = 0;?>
							@foreach($company->statuses as $item)
								@if($item->acceptance == 'success')
									<?php $count ++ ;?>
								@endif
							@endforeach
							{{ $count }}
						</td>
					</tr>
					<tr>
						<th>Số lượng sinh viên chắc chắn sẽ thực tập tại cty</th>
						<td>
							<?php $count1 = 0;?>
							@foreach($company->statuses as $item)
								@if($item->acceptance == 'success' && $item->choosen == 1)
									<?php $count1 ++ ;?>
								@endif
							@endforeach
							{{ $count1 }}
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endsection 