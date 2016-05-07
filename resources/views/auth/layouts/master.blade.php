<!DOCTYPE html>
<html>
@include('partials.head')
<body class="contrast-green login">
	<div class="wrapper">
		@include('partials.header')
		<div class="content" style="margin-top:20px;">
			<div class="container">
				@include('partials.flash-message')
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-8">
						@include('auth.partials.slide')
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4" style="">
						@yield('body.content')
					</div>
				</div>
			</div>
			@include('partials.load-ajax')
		</div>	
	</div>
	@include('partials.footer')
	@include('partials.script')
</body>
</html>