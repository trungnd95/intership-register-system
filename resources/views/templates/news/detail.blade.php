<div class="news">
	<div class="detail-new">
		<ariticle class="new">
			<header id="header-new">
				<div class="title-new">
					<h3 class="title">{{ $new->title }}</h3>	
				</div>
				<div class="date-post">
					<p style="opacity: .9">{{ $new->created_at->format('d/m/Y') }} </p>
				</div>
			</header><!-- /header -->
			<div class="content-new">
				<p>{!! nl2br($new->content) !!}</p>
			</div>
			<footer>
				<div class="share">
					<ul class="pull-right list">	
						<li><strong>Share</strong></li>
						<li><a href="{{ \Share::load((Auth::guard('teachers')->getUser() != null) ? route('teacher.news.detail',[$new->slug]) : route('student.news.detail',[$new->slug]), $new->title)->facebook()}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="{{ \Share::load((Auth::guard('teachers')->getUser() != null) ? route('teacher.news.detail',[$new->slug]) : route('student.news.detail',[$new->slug]), $new->title)->twitter()}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="{{ \Share::load(route('student.news.detail',[$new->slug]), $new->title)->gplus()}}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</footer>
		</ariticle>
	</div>
	
	<div class="clearfix"></div>
	<div class="related-news" >
		<hr/>
		<h4 style="opacity:.7">Tin tức liên quan</h4>
		<ul class="list-related">
			@foreach($relateds as $related)
			<li><a href="{{ (Auth::guard('teachers')->getUser() != null) ? route('teacher.news.detail',[$related->slug]) : route('student.news.detail',[$related->slug]) }}"> {{ $related->title }} </a> (<span style="opacity:.7 ; color: #88a4bd"> {{ $related->created_at->format('d/m/Y')}}</span>) </li>	
			@endforeach
		</ul>
	</div>
</div>