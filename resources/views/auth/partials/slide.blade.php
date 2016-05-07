<div style="">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			@for($i= 1; $i < count(App\Slide::all()) ; $i ++)
				<li data-target="#carousel-example-generic" data-slide-to="{{$i}}" ></li>
			@endfor
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php $slides =  App\Slide::all() ?>
			<div class="item active">
				<img src="{{ asset($slides[0]->image)}}" alt="" style="width:700px;height:350px;overflow: hidden">
				<div class="carousel-caption">
					<a href="{{$slides[0]->link}}">{{$slides[0]->description}}</a>
				</div>
			</div>
			<?php unset($slides[0]);?>
			@foreach($slides as $slide)
				<div class="item ">
					<img src="{{ asset($slide->image)}}" alt="" style="width:700px;height:350px; overflow: hidden" >
					<div class="carousel-caption">
						<a href="{{$slide->link}}">{{$slide->description}}</a>
					</div>
				</div>
			@endforeach
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>