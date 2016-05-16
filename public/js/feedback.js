$(document).ready(function(){
	$('#admin-feedback').unbind().on('change','input:radio',function(){

		var id  = $(this).data('id');
		var value = $(this).val();
		var _token =  $('#admin-feedback').find("input[name='_token']").val();
		
		$.ajax({
			url : baseURL + '/admin/feed-back/' + id + '/edit',
			dataType:'JSON',
			type: 'POST',
			cache: false ,
			data: {'_token': _token , 'id': id ,'value':value},
			success : function(result){

			}
		});
	});

	$('.delete-feedback').on('click',function(){
		var _token =  $('#admin-feedback').find("input[name='_token']").val();
		var id = $(this).data('id');
		$.ajax({
			url : baseURL + '/admin/feed-back/' + id +'/delete',
			dataType:'JSON',
			method: 'POST',
			cache:false,
			data: {'_token':_token, 'id': id},
			success: function(result){

			} 
		});
	});
});