$(document).ready(function(){
	Pusher.log = function(message) {
		if (window.console && window.console.log) window.console.log(message);
	};
	var pusher = new Pusher('b0df93d2cca8a83a9f48',{
    	pong_timeout: 6000, //default = 30000
    	unavailable_timeout: 2000 //default = 10000
	});
	var channel = pusher.subscribe('comments');
	channel.bind('comment',function(data){
		// console.log(data.comment);
		var data = data.comment;
		var html = '<div class="comment">';
		html += '<div class="user">';
		html += '<img src="'+ data.avatar_src +'" alt="" width="50px" height="50px" />';
		html += '<p class="user-name"><strong>'+ data.username + '</strong> đã bình luận vào lúc <span>'+ data.created_at +'</span> </p>';
		html += '</div>';

		html += '<p class="content-comment">'+ data.comment +'</p>';

		html += '</div>';
		var total_comment = $('.comment-report-' + data.report_id).find('.total_comment').html();
		var total_comment =  parseInt(total_comment) + 1;
		$('.comment-report-' + data.report_id).find('.total_comment').html(total_comment);
		var display = $('.display-comment-' + data.report_id);
		display.append(html);

	});

	$('.comment-report').on('submit',function(e){
		e.preventDefault();
		// $("textarea[name='comment-content']").text('');
		var comment = $(this).find('.comment-field').val();
		$(this).find('.comment-field').val('');
		var _token = $(this).find("input[name='_token']").val();
		var guard = $(this).find('.guard').attr('guard');
		var guard_id = $(this).find('.guard_id').attr('guard-id');
		var comment_id =  $(this).find('.report_id').data('id');
		var url = baseURL + '/bao-cao/'+ comment_id +'/binh-luan';
		$.ajax({
			url: url,
			type:'POST',
			dataType : 'JSON',
			data : {'guard':guard,'guard_id':guard_id,'comment':comment,'_token':_token},
			success : function(result)
			{
				if(result = 'ok')
				{
					return true;
				}
			}
		})
		return false;
	});
})