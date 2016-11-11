<div class="news">
	<div class="box">
		{{-- <div class="box-header">
			<h2 class="title-header">Tin tức</h2><hr/>
		</div> --}}
	
		<div class="box-body">
			<div class="row">
				<div class="list-news">
					@foreach($companies as $company)
					<ariticle class="new">
						<header id="header-new">
							<div class="title-new">
								<h3 class="title">{{ $company->name }}</h3>	
							</div>
							{{-- <div class="date-post">
								<p style="opacity: .9">{{ $new->created_at->format('d/m/Y') }} </p>
							</div> --}}
						</header><!-- /header -->
						<div class="short-content">
							<p>{!!  nl2br(substr($company->description,0,100)) !!}</p>
						</div>
						<footer>
							<p><a href="{{(Auth::guard('teachers')->getUser() == null ) ? route('student.company.detail',$company->id) : route('teacher.company.detail',$company->id) }}">Chi tiết</a></p>
							<div class="share">
								<ul class="pull-right list">	
									<li><strong>Share</strong></li>
									<li><a href="{{ \Share::load((Auth::guard('teachers')->getUser() != null) ? '#' : route('student.company.detail',$company->id), $company->name)->facebook()}}" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="{{ \Share::load((Auth::guard('teachers')->getUser() != null) ? '#' : route('student.company.detail',$company->id), $company->name)->facebook()}}" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="{{ \Share::load((Auth::guard('teachers')->getUser() != null) ? '#' : route('student.company.detail',$company->id), $company->name)->facebook()}}" ><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
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
					@if ($companies->lastPage() > 1)
					<ul class="pagination" style="float:right; margin-top: -5px;">
						@if ($companies->currentPage() != 1)
						<li class="paginate_button previous">
							<a href="{{ str_replace('/?', '?', $companies->url($companies->currentPage() - 1)) }}">Previous</a>
						</li>
						@endif
						@for ($i = 1;  $i <= $companies->lastPage(); $i++)
						<li class="paginate_button {{ ($companies->currentPage() == $i) ? 'active' : '' }}">
							<a href="{{ str_replace('/?', '?', $companies->url($i)) }}">{{ $i }}</a>
						</li>
						@endfor
						@if ($companies->currentPage() != $companies->lastPage() &&  $companies->lastPage() > 1)
						<li class="paginate_button next"><a href="{{ str_replace('/?', '?', $companies->url($companies->currentPage() + 1)) }}">Next</a></li>
						@endif
					</ul>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>