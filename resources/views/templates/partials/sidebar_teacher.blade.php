<div  class="col-xs-1 col-md-1 side-bar" style=" padding-left:10px">
	<br>
	<div style="text-align: left; ">
		<div class="container">
			<div class="btn-group btn-group-vertical">
				<div class="btn-group">
					<a href="{{route('teacher.pfofile.detail',[Auth::guard('teachers')->user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-user"></span>
							<p>Profile</p>
						</button>
					</a>
				</div>

				<div class="btn-group">
					<a href="{{route('teacher.news.index')}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-list"></span>
							<p>Tin <br/>tuyển dụng</p>
						</button>
					</a>
				</div>
				
				<div class="btn-group">
					<a href="{{route('teacher.students.list',[Auth::guard('teachers')->user()->id])}}">
						<button type="button" class="btn btn-nav">
							<span class="glyphicon glyphicon-ok"></span>
							<p>Danh sách <br/>sinh viên <br/>hướng dẫn </p>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>