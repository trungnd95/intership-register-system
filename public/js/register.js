/**=================================
 * ==== Handle js in register page==
 * =================================
 */
$(document).ready(function(){
	$('.registered_button').on('click',function(e){
		e.preventDefault();
		var numberChoose = $('input.company_registered:checked').length;
		// console.log(numberChoose);
		if(numberChoose == 0)
		{
			$('#modalError').modal('show');
		}else {
			$('#myConfirmRegister').modal('show');
			$('#myConfirmRegister').find('.modal-body').find('.number_company_register').text("Bạn đã lựa chọn " + numberChoose + " công ty");
		}
    return false;
	});
	$("#modal-view-company").on('show.bs.modal',function(e){

		var name = $(e.relatedTarget).attr('name');
		$(this).find('.modal-header').find('.modal-title').text(name);
		var address = $(e.relatedTarget).attr('address');
		$(this).find('.modal-body').find('.company_address').text(address);
		var contact = $(e.relatedTarget).attr('contact');
		$(this).find('.modal-body').find('.company_contact').text(contact);
    var services = $(e.relatedTarget).attr('services');
    $(this).find('.modal-body').find('.company_services').text(services);
		var description = $(e.relatedTarget).attr('description');
		$(this).find('.modal-body').find('.company_shortdescription').text(description);
	});

	/**
	 * Ajax search company
	 */
	/**
     * Ajax search employee
     */
     var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
    $("#search_company").keyup(function(event) {
        delay(function(){
            var _token = $("#form_list_company").find("input[name='_token']").val();
            var key_search  = $("#search_company").val();
            var url =  "/sinh-vien/dang-ki-thuc-tap/search-result"  ;
            $.ajax({
                url : url,
                type: "GET",
                dataType: "JSON",
                cache:false,
                data: {'key_search': key_search},
                success: function(data){  
                    $('#search_display').html(data);
                },
                error: function(){

                }
            });
        }, 100 );
    });

    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };
    var pusher = new Pusher('b0df93d2cca8a83a9f48',{
      pong_timeout: 6000, //default = 30000
      unavailable_timeout: 2000 //default = 10000
    });
    var channel = pusher.subscribe('notify-admin');
    channel.bind("App\\Events\\NotifyAdmin",function(data){
      var number;
      if(isNaN(parseInt($('#numberOfNotifyAdmin').html())))
      {
        number = 1;
 
      }
      else {
        number = parseInt($('#numberOfNotifyAdmin').html()) +1 ;
      }
      $('#numberOfNotifyAdmin').html(number);
      $('.notify_admin').find('.notify').find('.message').html(data.notifyAdmin.message);
      $('.notify_admin').find('.notify').addClass('notify_active');
      setTimeout(function () {      
         $('.notify_admin').find(".notify").removeClass("notify_active");         
      }, 5000);
      
      var stt;
      if($('ul.list-notify').find('li').length === 0)
      {
          stt = 0;
      }
      else {
        stt = $('ul.list-notify').find('li').find("input[name='stt']").val() + 1;            
      }

      html = '<li class="notify-item">';
      html += '<input type="hidden" name="stt" value="'+ stt +'" />';
      html += '<input type="hidden" class="notify-'+ stt + '" value="'+ data.notifyAdmin.id +'">';
      html += '<a href="/admin/thong-bao/'+ data.notifyAdmin.id+'">'+ data.notifyAdmin.message+'</a><br/>';
      html += '<span class="time">'+moment(data.notifyAdmin.created_at).fromNow();  +'</span>';
      html += '</li>';
      $('ul.list-notify').append(html);

      var html_inList = '<tr class="text-center row-content">';
      html_inList += '<td style="width: 2%"></td>';
      html_inList += '<td><a href="/admin/thong-bao/'+data.notifyAdmin.id+'">'+data.notifyAdmin.message+'</a></td>';
      html_inList +=  '<td contenteditable="true" onclick="showFormEdit(this)" onChange="saveToDatabase(this,\'contacted\','+data.notifyAdmin.user_id+','+data.notifyAdmin.company_id+')">';
      html_inList +=  'Chưa liên hệ với công ty</td>';
      html_inList += '</tr>';
      $('#list-notifications-admin').prepend(html_inList);
      $('.dataTables_empty').hide();
    });



});