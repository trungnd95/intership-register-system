$(document).ready(function(){
	//Add language
	$('.btn-add-schoolyear').on('click',function(){
		var stt =  $('#schoolyear-body-table').find('tr:last-child').find('td:first-child').html();
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
		html += '<td contenteditable="true" class="add-schoolyear-row"></td>';
		html += '<td></td>';
		html += '<td></td>';
		html += '</tr>';
		$('#schoolyear-body-table').append(html);
		$('.add-schoolyear-row').focus();

		$('.add-schoolyear-row').on('blur',function(){
			var row_add =  $('#schoolyear-body-table').find('tr:last-child').hide();
			var full_name = $(this).html();
			var short_name = $(this).next().html();
			var _token = $('#form-index-schoolyear').find("input[name='_token']").val();
			var url = baseURL + "/admin/khoa-hoc/them";
			$.ajax({
				url: url,
				dataType:'JSON',
				type: 'POST',
				data: {'_token':_token,'full_name':full_name,'short_name': short_name, 'stt':stt},
				cache:false,
				success:function(result){
					$('#schoolyear-body-table').append(result);
				}
			});
		});
		return false;
	});

	//Delete schoolyear
	//Delete language
	$('#delete-schoolyear').on('show.bs.modal',function(e){
	 	var schoolyear_id = $(e.relatedTarget).data('id');
	 	$(this).find('.confirm_del_schoolyear').data('schoolyear_id',schoolyear_id);
	 });

	 $('.confirm_del_schoolyear').on('click',function(){
	 	$("#delete-schoolyear").modal('hide').delay('500');
	 	var schoolyear_id = $(this).data('schoolyear_id');
	 	var url = baseURL + "/admin/khoa-hoc/" + schoolyear_id + "/delete";
	 	var _token = $('#form-index-schoolyear').find("input[name='_token']").val();
	 	$.ajax({
	 		url:url,
	 		type:"GET",
	 		dataType: 'JSON',
	 		cache:false,
	 		data: {'schoolyear_id':schoolyear_id,'_token':_token},
	 		success: function(result){
	 			$('.btn-delete-schoolyear-' + result).parent().parent().hide();
	 			swal('Xóa thành công','','success');
	 		}
	 	});
	 });
});