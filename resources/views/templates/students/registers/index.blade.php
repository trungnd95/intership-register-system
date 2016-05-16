@extends('templates.layouts.master')
@section('head.title','Tin tức tuyển dụng')
@section('breadcrumbs',Breadcrumbs::render('register'))
@section('templates.body.content')
<section class="content-register ">
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
	<?php 
	$count_regis = 0;
	?>
	@foreach($companies as $company)
	@if(count($company->statuses ) > 0)
	<?php $count_regis ++ ;?>
	@endif
	@endforeach
	
	<!-- Count down to time register-->
	
	<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date = new DateTime();
	// echo $date->format('d/m/y H:i A');
	$time = App\AdminConfiguration::select('time_start','time_end')->first();
	$time_start = DateTime::createFromFormat('d/m/Y H:i A', $time->time_start);
	if($date < $time_start)
	{
		$date_diff = date_diff($date, $time_start);	
		?>
		<div class="box show_count_time">
			<div class="box-header"><h2 class="title-header">Thông báo</h2><hr/></div>
			<div class="box-body">
				<input type="hidden" id="time_downcount" day="{{$date_diff->d}}" hour ="{{$date_diff->h}}" minute="{{$date_diff->i}}" second="{{$date_diff->s}}" />
				<div class="show_downcount">
					Còn <span class="day_downcount">{{ $date_diff->d }}  </span> ngày
					<span class="hour_downcount">{{$date_diff->h}} </span> giờ :
					<span class="minute_downcount">{{$date_diff->i}}</span> phút :
					<span class="second_downcount">{{$date_diff->s}}</span> giây
				</div>		
			</div>
		</div>
		<?php 
	}
	?>
	{{-- Check if registerd compnies ==  max_register ==> not allow continute register --}}
	<div class="show_register {{($date < $time_start) ? 'hidden' : ''}}">
		@if($count_regis < $max_register->max_register)
		<div class="box">
			
			<div class="box-header">
				<h2 class="title-header">
					Đăng kí các công ty thực tập<br/> 
					<small>(Để đăng kí 	 ty bạn muốn thực tập. Tích vào ô chọn)</small><br/><hr/>
				</h2>
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
					<div class="row ">
						<div class="col-lg-12" id="search_display">
							<table id="dataTable" class="table table-bordered table-striped student-register-index" >
								<thead>
									<tr class="text-center">
										<th width="60px" class="text-center">Chọn</th>
										<th class="text-center">Danh sách công ty</th>
										<th class="text-center hidden">Dịch vụ và công nghệ sử dụng</th>
										<th class="text-center hidden">Mô tả công ty và thông tin tuyển</th>
										<th class="text-center">Số lượng tuyển</th>
										<th class="text-center">Vị trí còn</th>
										<th class="text-center">Chi tiết</th>
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
											<td><a href="#modal-view-company" data-toggle="modal" data-target="#modal-view-company" name="{{$company->name}}" address="{{$company->address}}" contact="{{$company->contact}}" services="{!! $company->services !!}" >{{ $company->name}} </a></td>
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
											<td class="text-center"><a href="{{route('student.regis.companyDetail',[Auth::user()->id,$company->id])}}" target="_blank">Xem</a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="box-footer register_footer" >
					<div class="registered" >
						<button class="btn btn-primary registered_button">Đăng kí</button>
						<a class="btn btn-warning reset_register_button" >Bỏ chọn</a>
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
		@else 
		<p style="margin:50px">Bạn đã đăng kí tối đa 4 công ty. <a href="#" onclick="window.history.back();">Quay lại</a></p>
		@endif
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
							{{-- <tr>
								<th>Mô tả ngắn</th>
								<td class="company_shortdescription"></td>
							</tr> --}}
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