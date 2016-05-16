<div class="news">
	<div class="box">
		{{-- <div class="box-header">
			<h2 class="title-header">Tin tức</h2><hr/>
		</div> --}}
	
		<div class="box-body">
			<div class="row">
				<div class="list-news">
					@foreach($news as $new)
					<ariticle class="new">
						<header id="header-new">
							<div class="title-new">
								<h3 class="title">{{ $new->title }}</h3>	
							</div>
							<div class="date-post">
								<p style="opacity: .9">{{ $new->created_at->format('d/m/Y') }} </p>
							</div>
						</header><!-- /header -->
						<div class="short-content">
							<p>{!!  nl2br($new->short_des) !!}</p>
						</div>
						<footer>
							<p><a href="{{ (Auth::guard('teachers')->getUser() != null) ? route('teacher.news.detail',[$new->slug]) : route('student.news.detail',[$new->slug]) }}">Chi tiết</a></p>
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
					<hr />
					@endforeach
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					@if ($news->lastPage() > 1)
					<ul class="pagination" style="float:right; margin-top: -5px;">
						@if ($news->currentPage() != 1)
						<li class="paginate_button previous">
							<a href="{{ str_replace('/?', '?', $news->url($news->currentPage() - 1)) }}">Previous</a>
						</li>
						@endif
						@for ($i = 1;  $i <= $news->lastPage(); $i++)
						<li class="paginate_button {{ ($news->currentPage() == $i) ? 'active' : '' }}">
							<a href="{{ str_replace('/?', '?', $news->url($i)) }}">{{ $i }}</a>
						</li>
						@endfor
						@if ($news->currentPage() != $news->lastPage() &&  $news->lastPage() > 1)
						<li class="paginate_button next"><a href="{{ str_replace('/?', '?', $news->url($news->currentPage() + 1)) }}">Next</a></li>
						@endif
					</ul>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>