<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MANAGEMENT</li>
      {{-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li> --}}
      <li class="treeview">
        <a href="{{route('admin.news.index')}}">
          <i class="fa fa-newspaper-o"></i><span>Tin tuyển dụng</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.news.index') }} "><i class="fa fa-list"></i>Danh sách tin</a></li>
          <li><a href="{{route('admin.news.add')}}"><i class="fa fa-plus-circle"></i>Thêm tin</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="{{route('admin.companies.index')}}">
          <i class="fa fa-building"></i><span>Doanh nghiệp tuyển dụng</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.companies.index')}}"><i class="fa fa-list"></i>Danh sách doanh nghiệp</a></li>
          {{-- <li><a href="#"><i class="fa fa-plus-circle"></i>Thêm tin</a></li>
          <li><a href="#"><i class="fa fa-pencil"></i>Sửa tin</a></li> --}}
        </ul>
      </li>
      <li><a href="{{route('admin.configuration.index')}}"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Cấu hình</span></a></li>

      <li><a href="{{route('admin.feedback.index')}}"><i class="fa fa-comment"></i><span>Feedback</span></a></li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-info"></i><span>Thông tin về nhà phát triển</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-list"></i>About&Contact</a></li>
        </ul>
      </li>

      {{-- <li class="treeview">
        <a href="{{route('admin.slides.index')}}">
          <i class="fa fa-sliders"></i><span>Slide</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('admin.slides.index')}}"><i class="fa fa-list"></i>Danh sách slide</a></li>
            <li><a href="{{route('admin.slides.add')}}"><i class="fa fa-plus-circle"></i>Thêm slide mới</a></li>
        </ul>
      </li> --}}
      {{-- <li class="treeview">
        <a href="{{route('admin.partner.index')}}">
          <i class="fa fa-sliders"></i><span>Đối tác</span>
        </a>
      </li> --}}
      <li ><a href="{{route('admin.students.manageStudents')}}"><i class="fa fa-users"></i><span>Danh sách sinh viên</span></a></li>
      
      <li ><a href="{{ route('admin.schoolyears.index')}}"><i class="fa fa-graduation-cap"></i><span>Khóa học</span></a></li>
      
      <li ><a href="{{route('admin.status.index')}}"><i class="fa fa-bell"></i><span>Tình trạng đăng kí của sinh viên</span></a></li>

    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>