<!-- Jquery-->
<script src="{{asset('/lib/jquery/jquery.min.js')}}"></script>
<!-- Boostrap Js-->
<script src="{{asset('/lib/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Icheck-->
<script src="{{ url('/lib/admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Validate form-->
<script src="{{ url('/lib/validate/jquery.validate.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ url('/lib/sweetalert/sweetalert-master/dist/sweetalert.min.js') }}"></script>

<script src="{{asset('/lib/admin/dist/js/app.min.js')}}" type="text/javascript" charset="utf-8" async defer></script>
<!-- Pusher-->
<script src="{{asset('/lib/pusher/dist/pusher.min.js')}}"></script>
<script src="{{asset('/lib/pusher/dist/sockjs.min.js')}}"></script>
<!-- Data Table--> 
<script src="{{asset('/lib/dataTable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/lib/dataTable/dataTables.bootstrap.min.js')}}"></script>
{{-- Moment --}}
<script src="{{asset('/lib/datetimepicker/moment.min.js')}}"></script>
{{-- Datetime picker --}}
<script src="{{asset('/lib/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<!-- 
	==== Custom js ==
-->
<!-- Validate form register for students -->
<script src="{{ url('/js/student-auth.js') }}"></script>
<script src="{{ url('/js/teacher-auth.js') }}"></script>
<script src="{{ url('/js/common.js') }}"></script>
<script src="{{ url('/js/register.js') }}"></script>
<script src="{{ url('/js/status.js') }}"></script>
<script src="{{ url('/js/comment.js') }}"></script>
<script src="{{ url('/js/new.js') }}"></script>
<script src="{{ url('/js/company.js') }}"></script>
<script src="{{ url('/js/slide.js') }}"></script>
<script src="{{ url('/js/admin.js') }}"></script>
<script src="{{ url('/js/teacher-notify.js') }}"></script>
<script src="{{ url('/js/student-notify.js') }}"></script>
<script src="{{ url('/js/notification.js') }}"></script>
<script src="{{ url('/js/feedback.js') }}"></script>
<script src="{{ url('/js/countdown.js') }}"></script>
 <!-- JQuery UI Script -->
 <script src="{{ url('/lib/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Vtiker -->
 <script src="{{ url('/lib/vtiker/vtiker.min.js') }}"></script>
<script>
	$(function() {
  		$('#slide-rightbar').vTicker();
	});	
</script>
 
<!-- YUI lib-->

 <!-- Include this after the sweet alert js file -->
 @include('sweet::alert')