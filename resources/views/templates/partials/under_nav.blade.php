<div class="row">
	<div class="col-md-12" style="margin-top: 20px">
		<div class="space">
			<ul class="nav nav-tabs under_nav">
				@if(Auth::guard('teachers')->getUser() == null)
					@yield('breadcrumbs')
				@else 
					@yield('breadcrumbs_teacher')
				@endif
				<div class="right-nav">
					{{-- <li class="instruct"><a href="#"><i class="fa fa-book"></i>Hướng dẫn</a></li> --}}
					<li class="feedback"><a href="{{(Auth::guard('teachers')->getUser() == null) ? route('student.feedback.getForm') : route('teacher.feedback.getForm')}}"><i class="fa fa-comment" style="margin-right: 5px"></i>Phản hồi</a></li>
					<li class="dropdown profile">
						@if(Auth::guard('teachers')->getUser() == null)
							<a class="hidden current_user_id" data-id="{{(\Auth::check()) ? \Auth::user()->id : ''}}"></a>
						@else 
							<a class="hidden current_teacher_id" data-id="{{ \Auth::guard('teachers')->user()->id }}"></a>
						@endif
						<a href="" data-toggle="dropdown" class="dropdown-toggle">
							<i class="fa fa-user" style="margin-right:5px"></i><sup class="{{ (Auth::guard('teachers')->getUser() != null) ? 'numbersNotifyTeachers' : 'numbersNotifyStudents'}}">
							@if(Auth::guard('teachers')->getUser() != null)
								
								@if(App\TeacherNotification::where('seen','=',0)->where('teacher_id','=',Auth::guard('teachers')->user()->id)->count() > 0)
										{{ App\TeacherNotification::where('seen','=',0)->where('teacher_id','=',Auth::guard('teachers')->user()->id)->count() }}
								@endif
								
							@else
								
								@if(App\StudentNotification::where('seen','=',0)->where('user_id','=',Auth::user()->id)->count() > 0)
									{{ App\StudentNotification::where('seen','=',0)->where('user_id','=',Auth::user()->id)->count() }}
								@endif
							@endif
							</sup>
							{{ (Auth::guard('teachers')->getUser() != null ) ? Auth::guard('teachers')->user()->username : Auth::user()->user_name }}
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu under_nav_all" style="background: #5a94f4">
							<li><a href="{{ (Auth::guard('teachers')->getUser() != null ) ? route ('teacher.notifications',[Auth::guard('teachers')->user()->id]) : route('student.notifications',[Auth::user()->id]) }}" id="notifications"><i class="fa fa-bell-o" style="margin-right: 5px"></i><sup class="{{ (Auth::guard('teachers')->getUser() != null) ? 'numbersNotifyTeachers' : 'numbersNotifyStudents'}}">
							@if(Auth::guard('teachers')->getUser() != null)
								{{ App\TeacherNotification::where('seen','=',0)->where('teacher_id','=',Auth::guard('teachers')->user()->id)->count()}}
							@else

								{{ App\StudentNotification::where('seen','=',0)->where('user_id','=',Auth::user()->id)->count()}}
								
							@endif
							</sup> Thông báo</a>
							<input type="hidden" name="" data-id ="{{(Auth::guard('teachers')->getUser() != null) ? Auth::guard('teachers')->user()->id : Auth::user()->id}}" guard="{{(Auth::guard('teachers')->getUser() != null) ? 'teachers' : 'students'}}">
							</li>

							<li><a href="{{ (Auth::guard('teachers')->getUser() == null) ? route('student.changePassword.getView',Auth::user()->id) : route('teacher.changePassword.getView',Auth::guard('teachers')->user()->id ) }}"><i class="fa fa-lock" aria-hidden="true" style="margin-right:5px"></i>Đổi mật khẩu</a></li>

							<li><a href="{{ (Auth::guard('teachers')->getUser() != null) ? url('/giang-vien/dang-xuat') : url('/logout') }}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
						</ul>
				
					</li>	
				</div>
				
			</ul>
		</div>
	</div>
</div>