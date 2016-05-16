<head>
	<title>@yield('head.title')</title>
	<meta charset="UTF-8" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta content="text/html;charset=utf-8" http-equiv="content-type">
	<meta content="FitUET - Khoa Công Nghệ Thông Tin - Hệ Thống Đăng Ký Thực Tập" name="description">
	<link rel="shortcut icon" href="{{asset('/images/fit.png')}}" type="image/x-icon" />
	<!-- Bootstrap-->
	<link href="{{asset('/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('/lib/bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet"/>
	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="{{ url('/lib/admin/dist/css/AdminLTE.min.css') }}">
  	<!-- iCheck -->
  	<link rel="stylesheet" href="{{ url('/lib/admin/plugins/iCheck/square/blue.css') }}">
  	<!-- Font Awesome-->
	<link href="{{asset('/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"/>
	<!-- Sweet Alert Css-->
	<link href="{{asset('/lib/sweetalert/sweetalert-master/dist/sweetalert.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" href="{{asset('/lib/admin/dist/css/skins/skin-blue.min.css')}}">
	<!-- Data Table --> 
	<link rel="stylesheet" type="text/css" href="{{asset('/lib/dataTable/jquery.dataTables.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/lib/dataTable/dataTables.bootstrap.min.css')}}">
	<!-- Custom CSS-->
	<link href="{{asset('/css/auth.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/load-ajax.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/custom.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/common.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/admin.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/cv.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/news.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/register.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/notification.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/rightbar.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/breadcrumbs.css')}}" rel="stylesheet"/>
	<link href="{{asset('/css/leftsidebar.css')}}" rel="stylesheet"/>
	<!--Datetime picker -->
	<link href="{{asset('/lib/datetimepicker/bootstrap-datetimepicker.min.css')}}" rel="stylesheet"/>
	<!--JQuery UI -->
	<link href="{{asset('/lib/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>
	
	<!-- CKeditor , Ckfinder-->
	<script src="{{asset('/lib/editor/ckeditor/ckeditor.js')}}" type="text/javascript" charset="utf-8" ></script>
	<script src="{{asset('/lib/editor/ckfinder/ckfinder.js')}}" type="text/javascript" charset="utf-8" ></script>
	
	<script >
			var baseURL = "{!! url('/')!!}";
			
	</script>
	<script src="{{asset('/lib/editor/func_ckfinder.js')}}" type="text/javascript" charset="utf-8" ></script>

	<script language="javascript">
         function BrowseServer( startupPath, functionData )
		{
		// You can use the "CKFinder" class to render CKFinder in a page:
		var finder = new CKFinder();

		// The path for the installation of CKFinder (default = "/ckfinder/").
		finder.basePath = '../';

		//Startup path in a form: "Type:/path/to/directory/"
		finder.startupPath = startupPath;

		// Name of a function which is called when a file is selected in CKFinder.
		finder.selectActionFunction = SetFileField;

		// Additional data to be passed to the selectActionFunction in a second argument.
		// We'll use this feature to pass the Id of a field that will be updated.
		finder.selectActionData = functionData;

		// Name of a function which is called when a thumbnail is selected in CKFinder.
		finder.selectThumbnailActionFunction = ShowThumbnails;

		// Launch CKFinder
		finder.popup();
	}

		// This is a sample function which is called when a file is selected in CKFinder.
		function SetFileField( fileUrl, data )
		{
			document.getElementById( data["selectActionData"] ).value = fileUrl;
		}

		// This is a sample function which is called when a thumbnail is selected in CKFinder.
		function ShowThumbnails( fileUrl, data )
		{
			// this = CKFinderAPI
			var sFileName = this.getSelectedFile().name;
			document.getElementById( 'thumbnails' ).innerHTML +=
			'<div class="thumb">' +
			'<img src="' + fileUrl + '" />' +
			'<div class="caption">' +
			'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
			'</div>' +
			'</div>';

			document.getElementById( 'preview' ).style.display = "";
			// It is not required to return any value.
			// When false is returned, CKFinder will not close automatically.
			return false;
		}

		// function showEdit(editableObj) {
		// 	$(editableObj).css("background","#fff");
		// } 

		function showFormEdit(editableObj) {
			var inner = $(editableObj).html();
			console.log(inner);
			var html = '<select name="contact_status" class="form-control">';
			if($.trim(inner) == 'Chưa liên hệ với công ty')
			{
				html += '<option value="0" selected >Chưa liên hệ với công ty</option>';
				html += '<option value="1"  >Đã liên hệ với công ty</option>';
			}
			else {
				html += '<option value="0"  >Chưa liên hệ với công ty</option>';
				html += '<option value="1" selected >Đã liên hệ với công ty</option>';
			}

			html += '</select>';
			$(editableObj).html(html);
			// $(editableObj).prop('onclick',null).off('click');
			$(editableObj).removeAttr('onclick');
		} 

		function getToken()
		{
			return $('#form-list-notification-admin').find("input[name='_token']").val();
		}
		function saveToDatabase(editableObj,column,user_id,company_id) {
			var _token =  getToken();
			$(editableObj).css("background","#FFF url('/public/images/loaderIcon.gif') no-repeat right");
			var editval = editableObj.innerHTML;
			if($(editableObj).children().is('select'))
			{
				editval = $(editableObj).children().val();
				
			}

			$.ajax({
				url: '/admin/thong-bao/lien-he/cap-nhat',
				type: "POST",
				dataType: 'JSON',
				data:{'column': column,'editval': editval,'user_id':user_id ,'company_id':company_id,'_token':_token},
				success: function(result){
					console.log(result);
					if(result == 'error')
					{
						swal('Lỗi','Kiểu này đã được chọn','error');
						return false;
					}
					$(editableObj).css("background","#fff");
					if(result == 1)
					{
						$(editableObj).html('Đã liên hệ với công ty');
					}
					else {
						$(editableObj).html('Chưa liên hệ với công ty');	
					}
					
					$(editableObj).attr('onclick','showFormEdit(this)');
				}        
			});
		}
		
		function showEdit(editableObj) {
			$(editableObj).css("background","#fff");
		} 

	 	function getToken1(name)
		{
			return $('#form-index-' + name).find("input[name='_token']").val();
		}

	 	function saveDataToDatabase(editableObj,column,id,url,name) {
			var _token =  getToken1(name);

			$(editableObj).css("background","#FFF url('/images/loaderIcon.gif') no-repeat right");
			var editval = editableObj.innerHTML;
			if($(editableObj).children().is('select'))
			{
				editval = $(editableObj).children().val();
				
			}

			$.ajax({
				url: url,
				type: "POST",
				dataType: 'JSON',
				data:{'column': column,'editval': editval,'id':id ,'_token':_token},
				success: function(result){
					$(editableObj).css("background","#fff");
					$(editableObj).html(result);
				}        
			});
		}
	</script>
	<script src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>
	
</head>