<div class="box leftbar-auth box-auth">
	<div class="box-header">
		<h3>Thông báo</h3>
		<hr/>
	</div>
	<div class="box-body slide">
		<?php 
			$notifications = App\Notification::all();
		?>
		<ul class="list-notification">
			@foreach($notifications as $notification)
		
				<li style="list-style: circle; margin-left: 15px"><p>{{$notification->content}}</p></li>
			
			@endforeach	
		</ul>
	</div>
</div>