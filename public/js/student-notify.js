$(document).ready(function(){
	Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };
    var pusher = new Pusher('b0df93d2cca8a83a9f48',{
      pong_timeout: 6000, //default = 30000
      unavailable_timeout: 2000 //default = 10000
    });
    var channel = pusher.subscribe('status-change');
    channel.bind("App\\Events\\NotifyStudent",function(data){
    	// console.log(data);
    	// if(d){
	    	var current_user_id = $('.profile').find('.current_user_id').attr('data-id');
	    	 if(data.notifyStudent.user_id == current_user_id)
	    	{
	    		var number;
	    		if(isNaN(parseInt($('.numbersNotifyStudents').html())))
	    		{
	    			number = 1;
	    		}
	    		else {
	    			number = parseInt($('.numbersNotifyStudents').html()) + 1 ;
	    		} 	
		    	$('.numbersNotifyStudents').html(number);
		    	var message =  data.notifyStudent.message;
		    	$('.notify_student').find('.notify').find('.message').html(message);
		    	$('.notify_student').find('.notify').addClass('notify_active');
			   	setTimeout(function () {      
		         	$('.notify_student').find(".notify").removeClass("notify_active");         
		      	}, 5000);
			   	var html = '<div class="alert alert-dismissable">';
	            html += '<button type="button" class="close delete-notify-teacher" data-dismiss="alert" aria-hidden="true">×</button>';
	            html += '<input type="hidden" name="" value="'+data.notifyStudent.id+'">';
	            html += '<input type="hidden" name="" value="'+data.notifyStudent.user_id+'">';
	            html +=  '<li class="notify-item">';
			   	html += '<p>'+message+'</p>';
			   	html += '<span>Vào lúc '+ data.notifyStudent.created_at +'</span>';
			   	html += '</li>';
			   	html += '</div>';
			   	$('.notification_student_' + current_user_id).prepend(html);
			   	if($('.no-notify').is(':visible'))
			   	{
			   		$('.no-notify').hide();	
			   	}
		    }
    	// }
    	
    });
	
	// var other_channel = pusher.subscribe('teacher-acceptance');
	// other_channel.bind("App\\Events\\NotifyStudent",function(data){
	// 	var current_user_id = $('.profile').find('.current_user_id').attr('data-id');
 //    	 if(data.notifyStudent.user_id == current_user_id)
 //    	{
 //    		var number;
 //    		if(isNaN(parseInt($('.numbersNotifyStudents').html())))
 //    		{
 //    			number = 1;
 //    		}
 //    		else {
 //    			number = parseInt($('.numbersNotifyStudents').html()) + 1 ;
 //    		} 	
	//     	$('.numbersNotifyStudents').html(number);
	//     	var message =  data.notifyStudent.message;
	//     	$('.notify_student').find('.notify').find('.message').html(message);
	//     	$('.notify_student').find('.notify').addClass('notify_active');
	// 	   	setTimeout(function () {      
	//          	$('.notify_student').find(".notify").removeClass("notify_active");         
	//       	}, 5000);
	// 	   	var html = '<div class="alert alert-dismissable">';
 //            html += '<button type="button" class="close delete-notify-teacher" data-dismiss="alert" aria-hidden="true">×</button>';
 //            html += '<input type="hidden" name="" value="'+data.notifyStudent.id+'">';
 //            html += '<input type="hidden" name="" value="'+data.notifyStudent.user_id+'">';
 //            html +=  '<li class="notify-item">';
	// 	   	html += '<p>'+message+'</p>';
	// 	   	html += '<span>Vào lúc '+ data.notifyStudent.created_at +'</span>';
	// 	   	html += '</li>';
	// 	   	html += '</div>';
	// 	   	$('.notification_student_' + current_user_id).prepend(html);
	// 	   	if($('.no-notify').is(':visible'))
	// 	   	{
	// 	   		$('.no-notify').hide();	
	// 	   	}
	//     }

	// });
	 //Delete notification
    $('.delete-notify-student').on('click',function(){
        var noti_id = $(this).next().val();
        var student_id = $(this).next().next().val();
        var _token =  $('#delete-noti-student').find("input[name='_token']").val();
        $.ajax({
            url: baseURL + '/sinh-vien/' + student_id + '/thong-bao/delete',
            dataType:'JSON',
            cache:false,
            type:'GET',
            data:{'_token':_token , 'noti_id' : noti_id},
            success:function(result)
            {

            }
        });
    });

    /**
     * View list teacher
     */
    
    $("#modal-view-teacher").on('show.bs.modal',function(e){
    	var avatar =  $(e.relatedTarget).attr('avatar');
    	avatar = '/public/upload/images/teachers/' + avatar;
    	$(this).find('.modal-body').find('#teacher_avatar').attr('src',avatar);
		var name = $(e.relatedTarget).attr('name');
		$(this).find('.modal-body').find('.teacher_name').text(name);
		var email = $(e.relatedTarget).attr('email');
		$(this).find('.modal-body').find('.teacher_email').text(email);
		var phone = $(e.relatedTarget).attr('phone');
		$(this).find('.modal-body').find('.teacher_phone').text(phone);
    	var degree = $(e.relatedTarget).attr('degree');
    	$(this).find('.modal-body').find('.teacher_degree').text(degree);
		var strong_point = $(e.relatedTarget).attr('strong');
		$(this).find('.modal-body').find('.teacher_strong').text(strong_point);
	});
})