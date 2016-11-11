$(document).ready(function(){
	//Add language
	$('.btn-add-notification').on('click',function(){
		var stt =  $('#notification-body-table').find('tr:last-child').find('td:first-child').html();
		if(isNaN(stt))
		{
			stt = 1;
			$('.dataTables_empty').hide();
		}
		else {
			stt =  parseInt(stt) + 1;
		}

		html = '<tr>';
		html += '<td>'+ stt + '</td>';
		html += '<td contenteditable="true" class="add-notification-row"></td>';
		html += '<td></td>';
		html += '</tr>';
		$('#notification-body-table').append(html);
		$('.add-notification-row').focus();

		$('.add-notification-row').on('blur',function(){
			var row_add =  $('#notification-body-table').find('tr:last-child').hide();
			var content = $(this).html();
			// var short_name = $(this).next().html();
			var _token = $('#form-index-notification').find("input[name='_token']").val();
			var url = baseURL + "/admin/notification/add";
			$.ajax({
				url: url,
				dataType:'JSON',
				type: 'POST',
				data: {'_token':_token,'content':content, 'stt':stt},
				cache:false,
				success:function(result){
					$('#notification-body-table').append(result);
				}
			});
		});
		return false;
	});

	//Delete schoolyear
	//Delete language
	$('#delete-notification').on('show.bs.modal',function(e){
	 	var notification_id = $(e.relatedTarget).data('id');
	 	$(this).find('.confirm_del_notification').data('notification_id',notification_id);
	 });

	 $('.confirm_del_notification').on('click',function(){
	 	$("#delete-notification").modal('hide').delay('500');
	 	var notification_id = $(this).data('notification_id');
	 	var url = baseURL + "/admin/notification/" + notification_id + "/delete";
	 	var _token = $('#form-index-notification').find("input[name='_token']").val();
	 	$.ajax({
	 		url:url,
	 		type:"POST",
	 		dataType: 'JSON',
	 		cache:false,
	 		data: {'notification_id':notification_id,'_token':_token},
	 		success: function(result){
	 			$('.btn-delete-notification-' + result).parent().parent().hide();
	 			swal('Xóa thành công','','success');
	 		}
	 	});
	 });
});