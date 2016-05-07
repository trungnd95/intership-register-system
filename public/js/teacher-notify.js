$(document).ready(function(){
	Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };
    var pusher = new Pusher('b0df93d2cca8a83a9f48',{
      pong_timeout: 6000, //default = 30000
      unavailable_timeout: 2000 //default = 10000
    });
    var channel = pusher.subscribe('teacher-notify');
    channel.bind("App\\Events\\NotifyTeacher",function(data){
    	var current_teacher_id = $('.profile').find('.current_teacher_id').attr('data-id');
    	 if(data.notifyTeacher.teacher_id  == current_teacher_id)
    	{
    		var number;
    		if(isNaN(parseInt($('.numbersNotifyTeachers').html())))
    		{
    			number = 1;
    		}
    		else {
    			number = parseInt($('.numbersNotifyTeachers').html()) + 1 ;
    		} 	
	    	$('.numbersNotifyTeachers').html(number);
	    	var message =  data.notifyTeacher.message;
	    	$('.notify_teacher').find('.notify').find('.message').html(message);
	    	$('.notify_teacher').find('.notify').addClass('notify_active');
		   	setTimeout(function () {      
	         	$('.notify_teacher').find(".notify").removeClass("notify_active");         
	      	}, 5000);
            var html = '<div class="alert alert-dismissable">';
            html += '<button type="button" class="close delete-notify-teacher" data-dismiss="alert" aria-hidden="true">×</button>';
            html += '<input type="hidden" name="" value="'+data.notifyTeacher.id+'">';
            html += '<input type="hidden" name="" value="'+data.notifyTeacher.teacher_id+'">';
		   	html +=  '<li class="notify-item">';
		   	html += '<p>'+message+'</p>';
		   	html += '<span>Vào lúc '+ data.notifyTeacher.created_at +'</span>';
            html += '<div class="form-group teacher_acceptance">';
            html += '<label class="col-md-4 control-label" >Tùy chọn</label>';
            html += '<div class="col-md-4 ">'; 
            html += '<label class="radio-inline " >';
            html += '<input type="radio" name="teacher_choosen_'+ data.notifyTeacher.id+'"  value="accepted"  class="accepted" data-id="'+data.notifyTeacher.id+'" user-id="'+data.notifyTeacher.user_id+'">';
            html += 'Chấp nhận</label> ';
            html += '<label class="radio-inline" >';
            html += '<input type="radio" name="teacher_choosen_'+data.notifyTeacher.id+'"  value="ignore" class="ignore"  data-id="'+data.notifyTeacher.id+'" user-id="'+data.notifyTeacher.user_id+'">';
            html += 'Từ chối</label> ';
            html += '</div></div>';
		   	html += '</li>';
            html += '</div>';
		   	$('.notification_teacher_' + current_teacher_id).prepend(html);
		   	if($('.no-notify').is(':visible'))
		   	{
		   		$('.no-notify').hide();	
		   	}
	    }
    });

    //Delete notification
    $('body').on('click','.delete-notify-teacher',function(){
        var noti_id = $(this).next().val();
        var teacher_id = $(this).next().next().val();
        var _token =  $('#delete-noti-teacher').find("input[name='_token']").val();
        $.ajax({
            url: '/giang-vien/' + teacher_id + '/thong-bao/delete',
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
     * Teacher acceptance
     */
    $('#delete-noti-teacher').on('change','input:radio',function(){
         var acceptance = $(this).val();
         var user_id =  $(this).attr('user-id');
         var noti_id =  $(this).data('id');
         var _token =  $('#delete-noti-teacher').find("input[name='_token']").val();
         var teacher_id =  $(this).parent().parent().parent().parent().prev().val();
         $.ajax({
                url: '/giang-vien/'+teacher_id+'/thong-bao/'+ noti_id + '/chap-nhan',
                dataType:'JSON',
                cache:false,
                type:'POST',
                data: {'_token':_token , 'user_id':user_id,'acceptance':acceptance,'teacher_id':teacher_id},
                success : function(result){

                }
         })

    });

   
})