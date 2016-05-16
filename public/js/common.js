$(document).ready(function(){
	//Upload image avatar
	File.prototype.convertToBase64 = function(callback){
		var FR= new FileReader();
		FR.onload = function(e) {
			callback(e.target.result)
		};       
		FR.readAsDataURL(this);
	}
	$("#image").on('change',function(){
		var selectedFile = this.files[0];
		selectedFile.convertToBase64(function(base64){
      // alert(base64);
      html = '<div class="row">';
      html += '<div class="col-xs-6 col-md-3">';
      html += '<a href="#" class="thumbnail" id="display-img">';
      html += '<img src="'+base64+'" class="img-avata-upload"  />';
      html += '</a>';
      html += '</div>';
      html += '</div>';
      $('#display-img').html(html);
  }); 
	});

	$('.alert-success').delay(4000).slideUp('slow');

	// Enable  Jquery ui

	$(function() {
	    $( "#accordion" ).accordion({
	      collapsible: true
	    });
	});

	//Enable data table
	$('#dataTable').DataTable();	

	//Edit datatable view
	var html = $('#dataTable_length').find('select').html();
	html = 'Hiển thị <select  name="dataTable_length" aria-controls="dataTable" class="form-control input-sm">' + html + '</select> kết quả / 1 trang';
    $('#dataTable_length').find('label').html(html);
    $('#dataTable_info').hide();
    $('.dataTables_empty').html('Không có dữ liệu');
    

    //Date time picker  
     $('#datetimepicker1').datetimepicker({
    format: 'DD/MM/YYYY HH:mm A'
}).on('dp.change',function(e){
     	var time_start = $(this).find('input').val();
     	var _token = $('#form_set_date').find("input[name='_token']").val();
     	$.ajax({
     		url: baseURL + '/admin/time/save',
     		dataType: 'JSON',
     		cache:'false',
     		type: 'POST',
     		data: {'_token': _token, 'time_start': time_start},
     		success:function(result)
     		{

     		}
     	});
     });
     $('#datetimepicker2').datetimepicker({
        format: 'DD/MM/YYYY HH:mm A'
      }).on('dp.change',function(e){
     	var time_end = $(this).find('input').val();
     	var _token = $('#form_set_date').find("input[name='_token']").val();
     	$.ajax({
     		url: '/admin/time/save',
     		dataType: 'JSON',
     		cache:'false',
     		type: 'POST',
     		data: {'_token': _token, 'time_end': time_end},
     		success:function(result)
     		{

     		}
     	});
     });

     //active menu sidebar
     var current = window.location.href;
      console.log(current);
      $('#menu-main-menu > li > a').each(function(){
            if($(this).attr('href').indexOf(current) != -1 && $(this).attr('href').length == current.length){
            $(this).addClass('active1');
             $(this).parent().addClass('active1');
            }
            // console.log($(this).attr('href').indexOf(current));
        });
})
