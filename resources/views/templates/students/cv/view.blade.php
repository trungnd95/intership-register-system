<!DOCTYPE html>
<html>
@include('partials.head')
<page>
<body id="top">
@if(count($cv->cv) > 0)
<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot" class="quickFade">
			<img src="{{asset('/upload/images/students/'.$cv->cv->image)}}" alt="Ảnh đại diện" />
		</div>
		
		<div id="name">
			<h1 class="quickFade delayTwo">{!! $cv->cv->name !!}</h1>
		</div>
		
		<div id="contactDetails" class="quickFade delayFour">
			<ul>
				<li class="pull-right" style="margin-left: 10px"><a href="{{route('export.pdf',[$cv->id])}}" class="btn btn-default " target="_blank">Export PDF</a></li>
				@if($cv->id ==  Auth::user()->id)
					<li class="pull-right"><a class="btn btn-warning" href="{{route('student.cv.edit',$cv->id)}}">Sửa</a></li>
					{{-- <li class="clearfix"></li> --}}
				@endif
				
				<li class="clearfix"></li>
				{{-- <li><a title="print cv" alt="print cv" onclick="window.print()" target="_blank" style="cursor:pointer;margin-left: 80%"><i class="fa fa-print fa-2x"></i>
				</a></li> --}}
				<li>Email: <a href="mailto:{{$cv->cv->email}}" target="_blank">{!! $cv->cv->email !!}</a></li>
				@if($cv->cv->email1 != null)
					<li>Email2: <a href="mailto:{{$cv->cv->email1}}" target="_blank">{!! $cv->cv->email1 !!}</a></li>
				@endif
				@if($cv->cv->personal_website != null)
				<li>Website: <a href="{{$cv->cv->personal_website}}">{!! $cv->cv->personal_website !!}</a></li>
				@endif
				<li>Mobile: {!! $cv->cv->phone_number !!}</li>
				<li>Địa chỉ: {!! $cv->cv->address !!}</li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Ngày sinh </h1>
				</div>
				
				<div class="sectionContent">
					<?php $date=date_create($cv->cv->date_of_birth);?>
					<p>{!!
						
						date_format($date,"d/m/Y");
						!!}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Mã sinh viên</h1>
				</div>
				
				<div class="sectionContent">
					<p>{!! nl2br($cv->cv->student_code) !!}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Lớp khóa học</h1>
				</div>
				
				<div class="sectionContent">
					<p>{!! nl2br($cv->cv->class) !!}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Điểm trung bình tích lũy</h1>
				</div>
				
				<div class="sectionContent">
					<p>{!! nl2br($cv->cv->mark_average) !!}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		@if($cv->cv->education)
		<section>
			<div class="sectionTitle">
				<h1>Thành tích trong quá trình học tập</h1>
			</div>
			
			<div class="sectionContent">
				{!! nl2br($cv->cv->education) !!}
			</div>
			<div class="clear"></div>
		</section>
		@endif
		
		<section>
			<div class="sectionTitle">
				<h1>Kĩ năng</h1>
			</div>
			
			<div class="sectionContent">
				{!!  nl2br($cv->cv->skills) !!}
			</div>
			<div class="clear"></div>
		</section>
		@if($cv->cv->experiences != null)
			<section>
				<div class="sectionTitle">
					<h1>Kinh nghiệm làm việc</h1>
				</div>
				
				<div class="sectionContent">
					{!! nl2br($cv->cv->experiences) !!}
				</div>
				<div class="clear"></div>
			</section>
		@endif

		<section>
			<div class="sectionTitle">
				<h1>Sở thích</h1>
			</div>
			
			<div class="sectionContent">
				{!! nl2br($cv->cv->hobbies) !!}
			</div>
			<div class="clear"></div>
		</section>

		@if($cv->cv->others != null)
			<section>
				<div class="sectionTitle">
					<h1>Khác</h1>
				</div>
				
				<div class="sectionContent">
					{!! nl2br($cv->cv->others) !!}
				</div>
				<div class="clear"></div>
			</section>
		@endif
		@if(Auth::guard('teachers')->getUser() == null && Auth::guard('admins')->getUser() == null)
			<section class="sectionContent">
				{{-- <div class="sectionTitle"> --}}
					<a href="{{route('student.index')}}" class="btn btn-primary"><i class="fa fa-2x fa-arrow-left" aria-hidden="true" style="margin-right:10px"></i>Trang chủ</a>	
				{{-- </div> --}}
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
</page>
</html>