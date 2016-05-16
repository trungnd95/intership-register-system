$(document).ready(function(){

	function Count_Down()
	{
		this.day =  parseInt($('#time_downcount').attr('day'));
		this.hour =  parseInt($('#time_downcount').attr('hour'));
		this.minute = parseInt($('#time_downcount').attr('minute'));
		this.second  = parseInt($('#time_downcount').attr('second'));
	}
	Count_Down.prototype.count = function ()
	{
		if(this.second <= 0 && this.minute > 0)
		{
			this.minute = this.minute - 1;
			this.second =  59;
		}

		if(this.second <= 0 && this.minute <= 0 && this.hour > 0)
		{
			this.hour = this.hour - 1;
			this.minute = 59;
			this.second = 59
		}

		if(this.second <= 0 && this.minute <= 0 && this.hour <= 0 && this.day > 0)
		{
			this.day = this.day - 1;
			this.hour = 23;
			this.minute = 59; 
			this.second =  59;
		}

		this.second = this.second - 1;
		$('.day_downcount').html(this.day);
		$('.hour_downcount').html(this.hour);
		$('.minute_downcount').html(this.minute);
		$('.second_downcount').html(this.second);
		if(this.second <= 0 && this.minute <= 0 && this.hour <= 0 && this.day <= 0)
		{
			$('.show_count_time').remove();
			$('.show_register').removeClass('hidden');
			$('.show_register').find('table').css('width','100%');
		}
	}

	var timer = new Count_Down();
	setInterval(function(){ timer.count() },1000);
})