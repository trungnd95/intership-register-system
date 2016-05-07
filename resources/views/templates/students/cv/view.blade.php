<!DOCTYPE html>
<html>
@include('partials.head')
<body id="top">
@if(count($cv->cv) > 0)
<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot" class="quickFade">
			<img src="{{asset('/public/upload/images/students/'.$cv->cv->image)}}" alt="Ảnh đại diện" />
		</div>
		
		<div id="name">
			<h1 class="quickFade delayTwo">{{ $cv->cv->name }}</h1>
		</div>
		
		<div id="contactDetails" class="quickFade delayFour">
			<ul>
				<li><a title="print cv" alt="print cv" onclick="window.print()" target="_blank" style="cursor:pointer;margin-left: 80%"><i class="fa fa-print fa-2x"></i>
				</a></li>
				<li>e: <a href="mailto:{{$cv->cv->email}}" target="_blank">{{$cv->cv->email}}</a></li>
				@if($cv->cv->personal_website != null)
				<li>w: <a href="{{$cv->cv->personal_website}}">{{$cv->cv->personal_website}}</a></li>
				@endif
				<li>m: {{ $cv->phone_number}}</li>
				<li>Ad: {{$cv->cv->address}}</li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Giới thiệu ngắn</h1>
				</div>
				
				<div class="sectionContent">
					<p>{!! $cv->cv->short_selfintro !!}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Quá trình học tập</h1>
			</div>
			
			<div class="sectionContent">
				{!! $cv->cv->education !!}
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Kĩ năng</h1>
			</div>
			
			<div class="sectionContent">
				{!!  $cv->cv->skills !!}
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Công nghệ đã dùng</h1>
			</div>
			
			<div class="sectionContent">
				{!! $cv->cv->technical !!}
			</div>
			<div class="clear"></div>
		</section>
		@if($cv->cv->experiences != null)
			<section>
				<div class="sectionTitle">
					<h1>Kinh nghiệm làm việc</h1>
				</div>
				
				<div class="sectionContent">
					{!! $cv->cv->experiences !!}
				</div>
				<div class="clear"></div>
			</section>
		@endif

		<section>
			<div class="sectionTitle">
				<h1>Sở thích</h1>
			</div>
			
			<div class="sectionContent">
				{!! $cv->cv->hobbies !!}
			</div>
			<div class="clear"></div>
		</section>

		@if($cv->cv->others != null)
			<section>
				<div class="sectionTitle">
					<h1>Khác</h1>
				</div>
				
				<div class="sectionContent">
					{!! $cv->cv->others !!}
				</div>
				<div class="clear"></div>
			</section>
		@endif
	</div>
</div>
@else
	<script>
             alert('Chưa tạo CV');
	</script>
@endif
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3753241-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
@include('partials.script')
</body>
</html>