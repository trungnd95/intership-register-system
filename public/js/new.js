$(document).ready(function(){
	$('#delete-new').on('show.bs.modal',function(e){
		var new_id = $(e.relatedTarget).data('id');
		$(this).find('.confirm_del').data('new_id',new_id);
	});

	$('.confirm_del').on('click',function(){
		$("#delete-new").modal('hide').delay('500');
		var new_id = $(this).data('new_id');
		var url = baseURL + "/admin/tin-tuc/" + new_id + "/delete";
		var _token = $('#form-index-new').find("input[name='_token']").val();
		$.ajax({
			url:url,
			type:"GET",
			dataType: 'JSON',
			cache:false,
			data: {'new_id':new_id,'_token':_token},
			success: function(result){
					$('.btn-delete-new-' + result).parent().parent().hide();
					swal('Xóa thành công','','success');
			}
		});
	});
});		