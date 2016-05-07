@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')

@section('templates.body.content')
<section class="content-register">
	<div class="row">
		<div class="col-lg-12">
			@if (count($errors) > 0)
			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<ul>
					@foreach ($errors->all() as $error)
					<li> {!! $error !!} </li>
					@endforeach
				</ul>
			</div>	
			@elseif (Session::has('success'))
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<ul>
					<li> {!! Session::get('success') !!} </li>
				</ul>
			</div>	
			@endif
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">
				Đăng kí các công ty thực tập<br/> 
				<small>(Để đăng kí 	 ty bạn muốn thực tập. Tích vào ô chọn)</small>
			</h3>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="{{route('student.regis.store',[Auth::user()->id])}}" id="form_list_company">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
				{{-- <div class="row" style="margin-bottom: 5px;">
					<div class="col-lg-2">
					</div>
					<div class="col-lg-offset-6 col-lg-3">
						<div class="input-group search-regis">
							<input type="text" name="txtSeach" class="form-control" placeholder="Tìm kiếm công ty" value="" id="search_company"> 
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat" value="seach">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</div>
				</div> --}}
				<div class="row">
					<div class="col-lg-12" id="search_display">
						<table id="dataTable" class="table table-bordered table-striped">
							<thead>
								<tr class="text-center">
									<th width="60px" class="text-center">Chọn</th>
									<th class="text-center">Danh sách công ty</th>
									<th class="text-center hidden">Dịch vụ và công nghệ sử dụng</th>
									<th class="text-center hidden">Mô tả công ty và thông tin tuyển</th>
									<th class="text-center">Số lượng tuyển</th>
									<th class="text-center">Vị trí còn</th>
								</tr>
							</thead>
							<tbody>
								@foreach($companies as  $company)
									<tr class="text-center">
										<td><input type="checkbox" class="company_registered" value="{{ $company->id}}" name="items[]" 
										@if(count($company->statuses) > 0)
											disabled
										@endif
										/></td>
										<td><a href="#modal-view-company" data-toggle="modal" data-target="#modal-view-company" name="{{$company->name}}" address="{{$company->address}}" contact="{{$company->contact}}" services="{!! $company->services !!}" description="{!! $company->description !!}">{{ $company->name}} </a></td>
										<td class="hidden">{!! $company->services !!}</td>
										<td class="hidden">{!! $company->description !!}</td>
										<td> {{ $company->recruitment_amount}}</td>
										<td>
											<?php  $count = 0; ?>
											@foreach($company->statuses as $status)
												@if($status->acceptance == "success" && $status->choosen == 1)
													<?php $count ++ ;?>
												@endif
											@endforeach
											{{ $company->recruitment_amount - $count}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<div class="registered">
					<button class="btn btn-primary registered_button" >Đăng kí</button>
				</div>
			</div>
			<div class="modal fade" id="myConfirmRegister">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Xác nhận</h4>
						</div>
						<div class="modal-body">
							<p class="number_company_register"></p>
							<p> Bạn có chắc chắn đăng kí những công ty vừa chọn !</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ</button>
							<button type="submit" class="btn btn-primary" name="apply" value="apply" >Đăng kí</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- Main content -->	
		</form>
	</div>
	
	<div class="modal fade" id="modalError">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Thông báo</h4>
				</div>
				<div class="modal-body">
					<p>Bạn chưa chọn công ty nào muốn thực tập!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Modal popup to view conmpany detail-->
	<div class="modal fade" id="modal-view-company">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-center"></h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<tr>
								<th>Địa chỉ</th>
								<td class="company_address"></td>
							</tr>
							<tr>
								<th>Liên hệ</th>
								<td class="company_contact"></td>
							</tr>
							<tr>
								<th>Thế mạnh và các dịch vụ</th>
								<td class="company_services"></td>
							</tr>
							<tr>
								<th>Mô tả ngắn</th>
								<td class="company_shortdescription"></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div><!-- End model-->
</section>
@endsection 