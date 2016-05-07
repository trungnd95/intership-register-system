@extends('templates.layouts.master')
@section('head.title','Thông báo')
@section('breadcrumbs',Breadcrumbs::render('notification'))
@section('templates.body.content')
<section class="notificationsStudent">
	<div class="row">
		<div class="box">
		<div class="box-header">
			<h4 class="">
				Tất cả thông báo của <a href="#">{{Auth::user()->user_name}}</a><hr/> 
			</h4>
		</div>
		<!-- /.box-header -->
		<form method="POST" action="" id="delete-noti-student">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="box-body">
					<div class="row">
						<div class="col-lg-12" id="search_display">
							<ul class="notification_student_{{Auth::user()->id}} notifications-student notifications_list">
								@if(count($notificationsStudent) > 0)
									@for($i = 0 ; $i < $count ; $i++)
										<div class="alert alert-dismissable">
											<button type="button" class="close delete-notify-student" data-dismiss="alert" aria-hidden="true">×</button>
											<input type="hidden" name="" value="{{ $notificationsStudent[$i]->id }}">
											<input type="hidden" name="" value="{{ Auth::user()->id }}">
											<li class="notify-item">
												<p>{!! $notificationsStudent[$i]->message !!}</p>
												<span>Vào lúc {!! $notificationsStudent[$i]->created_at !!}</span>
											</li>	
										</div>
									@endfor
									@for($j = $count; $j < count($notificationsStudent) ; $j ++)
										<div class="alert alert-dismissable">
											<button type="button" class="close delete-notify-student" data-dismiss="alert" aria-hidden="true">×</button>
											<input type="hidden" name="" value="{{ $notificationsStudent[$j]->id }}">
											<input type="hidden" name="" value="{{ Auth::user()->id }}">
											<li class="notify-item seen">
												<p>{!! $notificationsStudent[$j]->message !!}</p>
												<span>Vào lúc {!! $notificationsStudent[$j]->created_at !!}</span>
											</li>	
										</div>
									@endfor
								@else 
									<p class="no-notify">Không có thông báo nào</p>
								@endif
							</ul>
						</div>
					</div>
				</div>
				<!-- Main content -->	
			</form>
		</div>
	</div>
	<div class="row">
	  <div class="col-lg-12">
	    @if ($notificationsStudent->lastPage() > 1)
	    <ul class="pagination" style="float:right; margin-top: -5px;">
	      @if ($notificationsStudent->currentPage() != 1)
	      <li class="paginate_button previous">
	        <a href="{{ str_replace('/?', '?', $notificationsStudent->url($notificationsStudent->currentPage() - 1)) }}">Previous</a>
	      </li>
	      @endif
	      @for ($i = 1;  $i <= $notificationsStudent->lastPage(); $i++)
	      <li class="paginate_button {{ ($notificationsStudent->currentPage() == $i) ? 'active' : '' }}">
	        <a href="{{ str_replace('/?', '?', $notificationsStudent->url($i)) }}">{{ $i }}</a>
	      </li>
	      @endfor
	      @if ($notificationsStudent->currentPage() != $notificationsStudent->lastPage() &&  $notificationsStudent->lastPage() > 1)
	      <li class="paginate_button next"><a href="{{ str_replace('/?', '?', $notificationsStudent->url($notificationsStudent->currentPage() + 1)) }}">Next</a></li>
	      @endif
	    </ul>
	    @endif
	  </div>
	</div>
</section>
@endsection