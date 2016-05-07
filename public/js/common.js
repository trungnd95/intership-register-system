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
})
