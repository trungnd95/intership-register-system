<!DOCTYPE html>
<html lang="en">
	<head>

		{{-- <meta charset="UTF-8"> --}}
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CV export</title>
		<style type="text/css">
			*{ font-family: DejaVu Sans, font-size: 12px;}
			.wrapper {
				padding: 100px;
				border: 1px solid #333;
			}
			.avatar-export {
				margin-left: 50px;
			}

			.avatar-export img {
				width: 120px;
				height: 120px;
				border-radius: 50%;
				float: left ;
			}
			.avatar-export h2 {
				display: inline-block;
				margin: 35px;
			}
			.personal_information ul li {
				list-style: none;
			}
			.header-export {
				padding-bottom: 50px;
				border-bottom: 5px solid #333;
				width: 100%;
			}
			.body-export {
				margin-top: 50px;
			}
			.body-export table tr {
				/*margin:20px;*/
				height: 50px;
			}
			.body-export table tr th {
				width: 20%;
				margin-right: 0px;
			}
			.body-export table tr td {
				width: 80%;
				padding-left: 20px;
			}
			.clearfix {
				clear: both;
			}
		</style>
	</head>
	<body>
	<div class="wrapper">
		<table class="header-export">
				<tr>
					<td>
						<div class="avatar-export">
							<img src="{!! asset('/upload/images/students/'.$cv->image) !!}" alt="" />
							<div class="name-export">
								<h2>{!! $cv->name !!}</h2>
							</div>
						</div>
						<div class="clearfix"></div>
					</td>
					<td>
						<div class="personal_information">
							<ul>
								<li>Email : {!! $cv->email !!}</li>
								@if($cv->email2 != '')
								<li>Email : {!! $cv->email2 !!}</li>
								@endif
								<li>Số điện thoại: {{$cv->phone_number}}</li>
								<li>Địa chỉ: {!! $cv->address !!}</li>
							</ul>
						</div>

					</td>
				</tr>
			
		</table>
		<div class="body-export">
			<table>
				<tr>
					<th> Ngày sinh</th>
					<?php $date=date_create($cv->date_of_birth);?>
					<td>{!! date_format($date,"d/m/Y")!!}</td>
				</tr>
				<tr>
					<th>Mã sinh viên: </th>
					<td>{!! $cv->student_code !!}</td>
				</tr>
				<tr>
					<th>Lớp khóa học</th>
					<td>{!! $cv->class !!}</td>
				</tr>
				<tr>
					<th>Điểm trung bình tích lũy</th>
					<td>{!! $cv->mark_average !!}</td>
				</tr>
				@if($cv->education != '')
				<tr>
					<th>Thành tích trong quá trình học tập</th>
					<td>{!! nl2br($cv->education) !!}</td>
				</tr>
				@endif
				<tr>
					<th>Kĩ năng</th>
					<td>{!! nl2br($cv->skills ) !!}</td>
				</tr>
				@if($cv->experiences != '')
					<tr>
						<th>Kinh nghiệm làm việc</th>
						<td>{!! nl2br($cv->experiences) !!}</td>
					</tr>
				@endif

				<tr>
					<th>Sở thích</th>
					<td>{!! nl2br($cv->hobbies) !!}</td>
				</tr>
				@if($cv->others != '')
				<tr>
					<th>Thêm  </th>
					<td>{!! nl2br($cv->others) !!}</td>
				</tr>
				@endif
				<tr>
						
				</tr>
			</table>		
		</div>
	</div>
		
	</body>
</html>