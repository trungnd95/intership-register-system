<div  class=" col-md-2 side-bar" style=" padding-left:10px;padding-top: 10px">
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="sidebar-nav">
			<!-- Bootstrap Based Menu -->
			<div class="navbar" role="navigation">
				<div class="navbar-collapse collapse">
					<div class="menu-main-menu-container">
						<ul id="menu-main-menu" class="nav navbar-nav">
							{{-- <li  style="width: 150px" class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('teacher.pfofile.detail',[Auth::guard('teachers')->user()->id])}}">Profile</a></li> --}}
							
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('teacher.company.list')}}">Doanh nghiệp</a></li>
							<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('teacher.students.list',[Auth::guard('teachers')->user()->id])}}">Danh sách sinh viên hướng dẫn</a></li>
							{{-- <li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="{{route('teacher.changePassword.getView',Auth::guard('teachers')->user()->id)}}">Đổi mật khẩu</a></li>
							<li style="width: 150px"><hr/></li> --}}
						</ul>
						
					</div>									
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</nav>
</div>