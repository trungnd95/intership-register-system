
$(document).ready(function(){
	$('#delete-company').on('show.bs.modal',function(e){
		var company_id = $(e.relatedTarget).data('id');
		$(this).find('.confirm_del').data('company_id',company_id);
	});

	$('.confirm_del').on('click',function(){
		$("#delete-company").modal('hide').delay('500');
		var company_id = $(this).data('company_id');
		var url = baseURL + "/admin/cong-ty/" + company_id + "/delete";
		var _token = $('#form-index-company').find("input[name='_token']").val();
		$.ajax({
			url:url,
			type:"GET",
			dataType: 'JSON',
			cache:false,
			data: {'company_id':company_id,'_token':_token},
			success: function(result){
					$('.btn-delete-company-' + result).parent().parent().hide();
					swal('Xóa thành công','','success');
			}
		});
	});
});		