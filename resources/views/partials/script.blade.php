<!-- Jquery-->
<script src="{{asset('/public/lib/jquery/jquery.min.js')}}"></script>
<!-- Boostrap Js-->
<script src="{{asset('/public/lib/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Icheck-->
<script src="{{ url('public/lib/admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Validate form-->
<script src="{{ url('public/lib/validate/jquery.validate.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ url('public/lib/sweetalert/sweetalert-master/dist/sweetalert.min.js') }}"></script>

<script src="{{asset('public/lib/admin/dist/js/app.min.js')}}" type="text/javascript" charset="utf-8" async defer></script>
<!-- Pusher-->
<script src="{{asset('public/lib/pusher/dist/pusher.min.js')}}"></script>
<script src="{{asset('public/lib/pusher/dist/sockjs.min.js')}}"></script>
<!-- Data Table--> 
<script src="{{asset('public/lib/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/lib/dataTable/dataTables.bootstrap.min.js')}}"></script>
{{-- Moment --}}
<script src="{{asset('public/lib/bower_components/moment/moment.js')}}"></script>
<!-- 
	==== Custom js ==
-->
<!-- Validate form register for students -->
<script src="{{ url('public/js/student-auth.js') }}"></script>
<script src="{{ url('public/js/teacher-auth.js') }}"></script>
<script src="{{ url('public/js/common.js') }}"></script>
<script src="{{ url('public/js/register.js') }}"></script>
<script src="{{ url('public/js/status.js') }}"></script>
<script src="{{ url('public/js/comment.js') }}"></script>
<script src="{{ url('public/js/new.js') }}"></script>
<script src="{{ url('public/js/company.js') }}"></script>
<script src="{{ url('public/js/slide.js') }}"></script>
<script src="{{ url('public/js/admin.js') }}"></script>
<script src="{{ url('public/js/teacher-notify.js') }}"></script>
<script src="{{ url('public/js/student-notify.js') }}"></script>
<script src="{{ url('public/js/schoolyear.js') }}"></script>
<script src="{{ url('public/js/feedback.js') }}"></script>
 <!-- JQuery UI Script -->
 <script src="{{ url('public/lib/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Vtiker -->
 <script src="{{ url('public/lib/vtiker/vtiker.min.js') }}"></script>
<script>
	$(function() {
  		$('#slide-rightbar').vTicker();
	});	
</script>
 
<!-- YUI lib-->

 <!-- Include this after the sweet alert js file -->
 @include('sweet::alert')