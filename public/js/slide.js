$(document).ready(function(){
	$('#modalSlideDelete').on('show.bs.modal',function(e){
		var slide_id = $(e.relatedTarget).data('id');
		$(this).find('.confirm_del_slide').data('slide_id',slide_id);
	});

	$('.confirm_del_slide').on('click',function(){
		$("#modalSlideDelete").modal('hide').delay('500');
		var slide_id = $(this).data('slide_id');
		var url = "/admin/slide/" + slide_id + "/xoa";
		var _token = $('#form-index-slide').find("input[name='_token']").val();
		$.ajax({
			url:url,
			type:"GET",
			dataType: 'JSON',
			cache:false,
			data: {'slide_id':slide_id,'_token':_token},
			success: function(result){
					$('.btn_delete_slide_' + result).parent().parent().parent().parent().hide();
					swal('Xóa thành công','','success');
			}
		});
	});

	$('#modalLogoPartner').on('show.bs.modal',function(e){
		var logo_id = $(e.relatedTarget).data('id');
		$(this).find('.confirm_del_logo').data('logo_id',logo_id);
	});

	$('.confirm_del_logo').on('click',function(){
		$("#modalLogoPartner").modal('hide').delay('500');
		var logo_id = $(this).data('logo_id');
		var url = "/admin/partner/" + logo_id + "/delete";
		var _token = $('#form-index-logo').find("input[name='_token']").val();
		$.ajax({
			url:url,
			type:"GET",
			dataType: 'JSON',
			cache:false,
			data: {'logo_id':logo_id,'_token':_token},
			success: function(result){
					$('.btn_delete_logo_' + result).parent().parent().parent().parent().hide();
					swal('Xóa thành công','','success');
			}
		});
	});
});		