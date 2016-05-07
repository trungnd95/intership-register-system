<!DOCTYPE html>
<html lang="en">
	@include('partials.head')
	<body>
		<div class="wrapper">
			@include('partials.header')
			<div class="content">
				<div class="container-fluid" >
					@include('templates.partials.under_nav')
					<div class="row">
						@if(Auth::guard('teachers')->getUser() == null)
							@include('templates.partials.sidebar')
						@else 
							@include('templates.partials.sidebar_teacher')
						@endif
						<div  class="col-xs-12 col-md-7 col-md-offset-1 content-frontend">
							@yield('templates.body.content')
						</div>
						@include ('templates.partials.rightbar')
						{{-- <div  class="col-xs-1 col-md-1" id="Customer feed"></div> --}}
					</div>
				</div>

			</div>
			@if(Auth::guard('teachers')->getUser() == null)
				<div class="notify_student">
					@include('partials.notify')
				</div>
			@else 
				<div class="notify_teacher">
					@include('partials.notify')
				</div>
			@endif		
		</div>

		@include('partials.footer')
		@include('partials.script')
		<script type="text/javascript">
			
			$(function() {
				var current = location.pathname;
				var current = baseURL + current;
				// console.log(current);
				$('.btn-group > a').each(function(){
					var $this = $(this);
			        if($this.attr('href').indexOf(current) !== -1 && $this.attr('href').length == current.length){
			        	$this.children().addClass('active');
			        }
   				})
			});
		</script>	
	</body>
</html>