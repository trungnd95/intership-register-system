<div  class="col-xs-1 col-md-1 side-bar" style=" padding-left:10px">
	<br>
	<div style="text-align: left; ">
		<div class="container">
			<div class="btn-group btn-group-vertical">

				<div class="btn-group">
					<a href="{{route('student.seeProfile',[Auth::user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-user"></span>
							<p>Profile</p>
						</button>
					</a>
				</div>

				<div class="btn-group">
					<?php 
						$cv = App\CV::where('user_id','=',Auth::user()->id)->get();
						if(count($cv) > 0)
						{
							$href =  route('student.cv.view',Auth::user()->id);
							$target = '_blank';
						}else {
							$href= route('student.cv.init',Auth::user()->id);
							$target = "_self";
						}

					?>
					<a href="{{$href}}" target="{{$target}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-file"></span>
							<p>CV</p>
						</button>
					</a>
				</div>
				<div class="btn-group">
					<a href="{{route('student.news.index')}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-list"></span>
							<p>Tin <br/>tuyển dụng</p>
						</button>
					</a>
				</div>
				
				<div class="btn-group">
					<a href="{{route('student.regis.index',[Auth::user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-ok"></span>
							<p>Đăng kí TT </p>
						</button>
					</a>
				</div>

				<div class="btn-group">
					<a href="{{route('student.report.index',[Auth::user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-save-file"></span>
							<p>Báo cáo</p>
						</button>
					</a>
				</div>

				<div class="btn-group">
					<a href="{{route('student.status.indentify',[Auth::user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-bullhorn"></span>
							<p>Tình trạng</p>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>