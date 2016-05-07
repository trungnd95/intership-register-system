
$(document).ready(function(){

	/*=======================
	  ====Validate register==
	  =======================*/
	  
	  $('#student-register').validate({
	  		rules:{
	  			username:{
	  				required:true,
	  				minlength:4,
	  				maxlength:32
	  			},
	  			email:"required",
	  			password:{
	  				required:true,
	  				minlength:6
	  			},
	  			repassword:{
	  				required:true,
	  				equalTo: "#password"
	  			}
	  		},
	  		messages: {
	  			username:{
	  				required: "Bạn chưa nhập tên đăng nhập",
	  				minlength: "Tên đăng nhập tối thiểu là 4 kí tự",
	  				maxlength: "Tên đăng nhập quá dài, tối đa là 32 kí tự"
	  			},
	  			email:"Bạn chưa nhập tên email",
	  			password:{
	  				required: "Bạn chưa nhập mật khẩu",
	  				minlength: "Mật khẩu quá ngắn, tối thiểu 6 kí tự"
	  			},
	  			repassword:{
	  				required: "Bạn cần xác nhận lại mật khẩu",
	  				equalTo : "Mật khẩu không giống với mật khẩu bên trên"
	  			}
	  		},
	  		submitHandler:function(submit){
	  			$('#modal-register').modal('hide').delay('500');
	  			$('.loading').removeClass('hidden');
	  			var url 		= "http://internship.dev/register";
	  			var _token 		= $(submit).parent().parent().find("input[name='_token']").val();
	  			var username 	= $(submit).parent().parent().find("input[name='username']").val();
	  			var email 		= $(submit).parent().parent().find("input[name='email']").val();
	  			var password 	= $(submit).parent().parent().find("input[name='password']").val();

	  			$.ajax({
	  				url: url,
	  				type:"POST",
	  				dataType:"JSON",
	  				cache:false,
	  				data: {'_token':_token,'username':username,'email':email,'password':password},
	  				success:function(result){
	  						$('.loading').addClass('hidden');
	  						if(result == 'registered')
	  						{
	  							swal("Đăng kí thành công", "Bạn vui lòng kiểm tra email để xác nhận", "success");
	  							// alert('ok');
	  						}else {
	  							sweetAlert("Xảy ra lỗi khi đăng kí", result,'error');
	  						}
	  				},
	  				error: function(err){
	  						$('.loading').addClass('hidden');
	  						swal("Lỗi","Kiểm tra lại kết nối của bạn","error");
	  						// if( err.status === 401 ) //redirect if not authenticated user.
	  						// 	$( location ).prop( 'pathname', 'auth/login' );
	  						// if( err.status === 422 ) {
					    //     //process validation errors here.
					    //     $errors = err.responseJSON; //this will get the errors response data.
					    //     //show them somewhere in the markup
					    //     //e.g
					    //     errorsHtml = '<div class="alert alert-danger"><ul>';

					    //     $.each( data, function( key, value ) {
					    //         errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
					    //     });
					    //     errorsHtml += '</ul></di>';
					    //     swal({
					    //     	title: "Xảy ra lỗi khi đăng kí",
					    //     	text  : errorsHtml,
					    //     	html: true
					    //     });					    }
	  				}
	  			});
	  		}
	  		
	  });
});