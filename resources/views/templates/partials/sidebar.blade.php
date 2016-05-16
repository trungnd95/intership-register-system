<div  class="col-md-2 side-bar" style=" padding-left:10px;padding-top: 10px">
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="sidebar-nav">
			<!-- Bootstrap Based Menu -->
			<div class="navbar" role="navigation">
				<div class="navbar-collapse collapse">
					<div class="menu-main-menu-container">
						<ul id="menu-main-menu" class="nav navbar-nav">
							{{-- <li  style="width: 150px" class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('student.seeProfile',[Auth::user()->id])}}">Profile</a></li> --}}
							{{-- <li class="clearfix"></li> --}}
							<?php 
							$cv = App\Cv::where('user_id','=',Auth::user()->id)->get();
							if(count($cv) > 0)
							{
								$href =  route('student.cv.view',Auth::user()->id);
								$target = '_blank';
							}else {
								$href= route('student.cv.init',Auth::user()->id);
								$target = "_self";
							}

							?>
							<li  class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item"><a href="{{$href}}" target="{{$target}}">Sơ yếu lí lịch</a></li>
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('student.news.index')}}">Tin tuyển dụng</a></li>
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('student.regis.index',[Auth::user()->id])}}">Đăng kí thực tập</a></li>
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('student.report.index',[Auth::user()->id])}}">Báo cáo</a></li>
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('student.status.indentify',[Auth::user()->id])}}">Tình trạng đăng kí</a></li>
							{{-- <li><a href="{{route('student.changePassword.getView',Auth::user()->id)}}">Đổi mật khẩu</a></li>
							<li style="width: 150px"><hr/></li> --}}
						</ul>
						
					</div>									
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</nav>

</div>
