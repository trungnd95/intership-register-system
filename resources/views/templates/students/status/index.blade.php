@extends('templates.layouts.master')
@section('head.title','Tình trạng đăng kí')
@section('breadcrumbs',Breadcrumbs::render('status'))
@section('templates.body.content')
<div class="status">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">
				Tình trạng đăng kí của bạn<br/>
				<small>(Bạn hãy chọn chỉ 1 công ty muốn thực tập trong các công ty được chấp nhận)</small>
			</h3>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="{{route('student.status.confirm_choosen_company',[Auth::user()->id])}}" id="form_choosen">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
				<div class="row">
					<div class="col-lg-12" id="search_display">
						<table id="dataTable" class="table table-bordered table-striped">
							<thead>
								<tr class="text-center">
									<th width="60px" class="text-center">Chọn</th>
									<th class="text-center">Tên công ty</th>
									<th class="text-center hidden">Dịch vụ và công nghệ sử dụng</th>
									<th class="text-center hidden">Mô tả công ty và thông tin tuyển</th>
									<th class="text-center">Tình trạng</th>
								</tr>
							</thead>
							<tbody>
								@foreach($status as  $item)
								<tr class="status_confirm text-center">
									<td>
										<label>
										@if($item->acceptance == "success")
											<input type="checkbox" class="company_confirm" value="{{$item->company->id}}" name="company_confirm" 
											@if($item->choosen == 1)
												checked
											@endif
											>
										</label>
										@endif
									</td>
									<td><a class="company_info" href="#modal-view-company" data-toggle="modal" data-target="#modal-view-company" name="{{$item->company->name}}" address="{{$item->company->address}}" contact="{{$item->company->contact}}" services="{!! $item->company->services !!}" description="{{$item->company->description}}">{{ $item->company->name}} </a></td>
									<td class="hidden">{!! $item->company->services !!}</td>
									<td class="hidden">{!! $item->company->description !!}</td>
									<td> 
										@if($item->acceptance == 'success')
											Được chấp nhận
										@elseif($item->acceptance == 'pending')
											Đang chờ
										@else 
											Không được chấp nhận
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				{{-- <div class="row">
					<div class="col-lg-12">
						@if ($status->lastPage() > 1)
						<ul class="pagination" style="float:right; margin-top: -5px;">
							@if ($status->currentPage() != 1)
							<li class="paginate_button previous">
								<a href="{{ str_replace('/?', '?', $status->url($status->currentPage() - 1)) }}">Previous</a>
							</li>
							@endif
							@for ($i = 1;  $i <= $status->lastPage(); $i++)
							<li class="paginate_button {{ ($status->currentPage() == $i) ? 'active' : '' }}">
								<a href="{{ str_replace('/?', '?', $status->url($i)) }}">{{ $i }}</a>
							</li>
							@endfor
							@if ($status->currentPage() != $status->lastPage() &&  $status->lastPage() > 1)
							<li class="paginate_button next"><a href="{{ str_replace('/?', '?', $status->url($status->currentPage() + 1)) }}">Next</a></li>
							@endif
						</ul>
						@endif
					</div>
				</div> --}}
			</div>
			<div class="box-footer">
				<div class="registered">
					<button class="btn btn-primary confirm_button" >Xác nhận</button>
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
							<p> Bạn có chắc chắn đăng kí công ty vừa chọn !</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ</button>
							<button type="submit" class="btn btn-primary" name="apply" value="apply" >Đăng kí</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<!-- Modal confirm registerd -->
			<div class="modal fade" id="myConfirmRegister">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Xác nhận</h4>
						</div>
						<div class="modal-body">
							<p class="number_company_register"></p>
							<p> Bạn có chắc chắn đăng kí công ty vừa chọn !</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ</button>
							<button type="submit" class="btn btn-primary" name="apply" value="apply" >Đăng kí</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->	
		</form>
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
									<th>Các dịch vụ và thế mạnh</th>
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

		<div class="modal fade" id="modalError">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Thông báo</h4>
					</div>
					<div class="modal-body">
						<p>
							Bạn chưa chọn 1 công ty thực sự muốn thực tập trong danh sách 
							các công ty đã chấp nhận bạn !
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
</div>
@endsection