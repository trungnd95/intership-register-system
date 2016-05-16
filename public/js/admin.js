$(document).ready(function(){
	$('.btn-edit-company-status').unbind().on('click',function(){
		// e.preventDefault();
		// e.preventDefault();
    	// e.stopPropagation();
		var id = $(this).attr('data-id');
		$(this).parent().addClass('hidden');
		$(this).parent().next().removeClass('hidden');
		$('.save-edit-company-status-'+id).unbind().on('click',function(){
			// e.preventDefault();
			// e.stopPropagation();
			var result =  $(this).prev().val();	
			var _token = $('#form-index-status').find("input[name='_token']").val();
			var status_id = $(this).next().val();
			var url  = baseURL + '/admin/tinh-trang-dang-ki/'+status_id +'/cap-nhat';
			$.ajax({
				url: url,
				dataType:'JSON',
				cache: false,
				type:'POST',
				data:{'status_id':status_id,'value':result,'_token':_token},
				success:function(result){
					var html = '';
					if(result[1] == 'success')
					{
						html = '<span>Đã chấp nhận</span>';
					}
					else {
						html = '<span>Không được chấp nhận</span>';
					}
					// html += '<br/><a href="#" data-id="'+result[0]+'" class="btn btn-warning btn-edit-company-status">Sửa</a>';
					$('.div_edit_company_status_' + result[0]).addClass('hidden');
					// $('.btn-edit-company-status').removeClass('hidden');
					$('.result-' + result[0]).removeClass('hidden');
					$('.result-' + result[0]).find('span').html(html);
				}	
			});
			return false;
		});
		

		return false;
	});
	
	//Change contact status
	$('body').unbind().on('click','.btn-edit-contact-status',function(){
		var id = $(this).attr('data-id');
		$(this).parent().addClass('hidden');
		$(this).parent().next().removeClass('hidden');
		$('.save-edit-contact-status-'+id).unbind().on('click',function(e){
			e.preventDefault();
			var result =  $(this).prev().val();	
			var _token = $('#form-index-status').find("input[name='_token']").val();
			var status_id = $(this).next().val();
			var url  = baseURL + '/admin/tinh-trang-dang-ki/'+status_id +'/cap-nhat';
			$.ajax({
				url: url,
				dataType:'JSON',
				cache: false,
				type:'POST',
				data:{'status_id':status_id,'contact':result,'_token':_token},
				success:function(result){
					var html = '';
					if(result[1] == '1')
					{
						html = '<span>Đã liên hệ</span>';
					}
					else {
						html = '<span>Chưa liên hệ</span>';
					}
					html += '<br/><a href="#" data-id="'+result[0]+'" class="btn btn-warning btn-edit-contact-status">Sửa</a>';
					$('.div_edit_contact_status_' + result[0]).addClass('hidden');
					// $('.btn-edit-company-status').removeClass('hidden');
					$('.contact-' + result[0]).removeClass('hidden');
					$('.contact-' + result[0]).html(html);
				}	
			})
			return false;
		})
		

		return false;
	});

	//Click to see notifications
	$("body").on('click','#notificationLink',function()
	{
		if($("#notificationContainer").is(':visible'))
		{
			$("#notificationContainer").delay('1000').hide();
			$('ul.list-notify').html('');
		}
		else {
			$("#notificationContainer").fadeToggle(300);
			var number = $("#numberOfNotifyAdmin").html();
			$("#numberOfNotifyAdmin").html('');
			var data = [];
			if(parseInt(number) > 0)
			{
				for(var i = 0 ; i < number ; i++)
				{
					data.push($('.notify-' + i).val());
				}
				var _token = $('#form-edit-noti-status').find("input[name='_token']").val();
				$.ajax({
					url: baseURL + '/admin/thong-bao/sua',
					type:'POST',
					dataType:'JSON',
					cache:false,
					data: {'data':data,'_token':_token},
					success:function(data)
					{

					}
				});
			}
			
			
		}
		
		return false;
	});

	// Document Click hiding the popup 
	$(document).click(function()
	{
		$("#notificationContainer").delay('1000').hide();
		$('ul.list-notify').html('');
	});

	// //Popup on click
	// $("#notificationContainer").click(function()
	// {
	// 	return false;
	// });


	/**
	 * Allocate teacher instruction to student
	 */

	$('body').on('click','.teacher_instruction_edit',function(){
		$(this).parent().addClass('hidden');
		$(this).parent().next().removeClass('hidden');

		$("select[name='allocate_teacher_instruction']").unbind().on('change',function(){
			$(this).parent().parent().css("background","#FFF url('/public/images/loaderIcon.gif') no-repeat right");
			var teacher_id = $(this).val();
			var student_id = $(this).data('user_id');
			var _token = $('#form-index-student-list').find("input[name='_token']").val();
			$.ajax({
				url : baseURL + '/admin/sinh-vien/phan-cong-giang-vien',
				dataType:'JSON',
				cache:false,
				type: 'POST',
				data: {'_token':_token, 'teacher_id':teacher_id, 'student_id':student_id},
				success:function(result)
				{
					$('.form-edit-teacher-instruction-'+result.student).addClass('hidden');
					$('.teacher_instruction_' + result.student).css('background','#fff');
					$('.teacher_name_' + result.student).removeClass('hidden');
					$('.teacher_name_' + result.student).find('span').html(result.teacher);
				}
			});
		})
	});


	// $('.datetimeRegis').on('change','input',function(){
		// var time = $(this).val();
		// alert(time);
	// });
	// console.log($('.datetimeRegis').find('input').val());
})