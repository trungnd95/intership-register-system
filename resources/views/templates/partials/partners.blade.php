<div class="second-right">
	<h3>Đối tác</h3>
	<div id="slide-rightbar">	
		<ul class="fit-patners">
			<?php $partners = App\Partner::all();?>
			@foreach($partners as $item)
			<li class="patner">
				<a href="{{$item->link}}">
					<img src="{{asset('..'.$item->image)}}" alt="" width="200px" height="300px">
				</a>
			</li>
			@endforeach
		</ul>	  
	</div>
</div>
