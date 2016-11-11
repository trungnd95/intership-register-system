$(document).ready(function(){
	$('.status_confirm input[type=checkbox]').change(function() {
	if (this.checked) {
	    $('.status_confirm input[type=checkbox]').not(
	                        $(this)).prop('checked', false);
	    }
	});

	/**
	 * Check number of check input type checkbox
	 */
	$('.confirm_button').on('click',function(e){
		e.preventDefault();
		var numberChoose = $('input.company_confirm:checked').length;
		console.log(numberChoose);
		if(numberChoose == 0)
		{
			$('#modalError').modal('show');
		}
		else {
			$('#myConfirmRegister').modal('show');
		}


	});


});
