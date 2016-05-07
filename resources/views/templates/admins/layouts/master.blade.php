<!DOCTYPE html>
<html>
  @include('partials.head')
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Main Header -->
      @include('templates.admins.partials.header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('templates.admins.partials.sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="col-lg-12">
          @if(Session::has('flash_message'))
          <div class="alert alert-{{Session::get('flash_level')}}">
            {{Session::get('flash_message')}}
          </div>
          @endif
        </div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('body.headTitle')
          </h1>
        </section>
        <div class="data-content">
          @yield('admin.body.content')
        </div>
        <div class="notify_admin">
            @include('partials.notify')  
        </div>
      </div><!-- /.content-wrapper -->
      <!-- Main Footer -->
      @include('templates.admins.partials.footer')
    </div><!-- ./wrapper -->
  <!-- REQUIRED JS SCRIPTS -->
   @include('partials.script')
  </body>
</html>
