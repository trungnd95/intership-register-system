<header class="main-header admin-header">
  <!-- Logo -->
  <a href="fit.uet.vnu.edu.vn" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">FIT</span>
    <!-- logo for regular state and mobile devices -->
    <img src="{{asset('/images/fit.png')}}" class="thumbnail circle"  alt="Logo Fit" />
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar">
        <h3 class="title text-center">Quản trị hệ thống đăng kí thực tập</h3>
        {{-- <p style="color:#fff;display:inline;margin-right: 20px" class="pull-right">
        <a id="notification_li" href="#" style="color:#fff;margin-right:10px"><i class="fa fa-globe" aria-hidden="true"></i>
        <sup id="numberOfNotifyAdmin">{{App\NotificationAdmin::where('seen','=',0)->count()}}</sup> Thông báo
        <div id="notificationContainer" style="display: none">
          <div id="notificationTitle">Notifications</div>
          <div id="notificationsBody" class="notifications"></div>
          <div id="notificationFooter"><a href="#">See All</a></div>
        </div>
        </a>
        <a href="{{route('admin.getLogout')}}" style="color:#fff"><i class="fa fa-sign-out"></i> Logout</a>
        </p> --}}
        <ul id="nav">
          <li id="notification_li" style="margin-left: 110px">
            <a id="notificationLink" href="#" style="color:#fff;margin-right:10px"><i class="fa fa-globe" aria-hidden="true"></i>
              <sup id="numberOfNotifyAdmin">{{(App\NotificationAdmin::where('seen','=',0)->count() == 0) ? '' : App\NotificationAdmin::where('seen','=',0)->count()}}</sup> Thông báo mới</a>
              <div id="notificationContainer" style="display: none">
                <div id="notificationTitle">Thông báo </div>
                <div id="notificationsBody" class="notifications">
                  
                    <form action="" method="POST" id="form-edit-noti-status">
                        {{csrf_field()}}
                      <ul class="list-notify">
                        <?php $stt = 0;?>
                        @foreach(App\NotificationAdmin::where('seen','=',0)->get() as $item)
                          <li class="notify-item">
                            <input type="hidden" name="stt" value="{{$stt}}">
                            <input type="hidden" class="notify-{{$stt}}" value="{{$item->id}}">
                            <a href="{{route('admin.notify.notifyDetail',[$item->id])}}">{{$item->message}}</a><br/>
                            <span class="time">{{$item->created_at->diffForHumans()}}</span>
                          </li>
                          <?php $stt++; ?>
                        @endforeach
                      </ul>
                  </form>
                </div>
                <div id="notificationFooter">
                  <a href="{{route('admin.notify.listNotify')}}">Tất cả</a>
                </div>
              </div>
          </li>
          <li>
            <a href="{{route('admin.getLogout')}}" style="color:#fff"><i class="fa fa-sign-out"></i> Logout</a>
          </li>
        </ul>
    </div>
  </nav>
</header>