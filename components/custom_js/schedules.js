
//add shcedule
$(document).ready(function(){
	$("#addScheduleForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$("#scheduleAddMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						clearForm();
						$("html, body").animate({scrollTop: '0px'}, 100);
						reLoad();
				}
				else {
					if(response.messages instanceof Object) {
						$("#scheduleAddMessage").html('');	

						$.each(response.messages, function(index, value) {
							var key = $("#" + index);
								
							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.help-block').remove();

							key.after(value);

						});
						
					} 
					else {						
						$(".help-block").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');

						$("#scheduleAddMessage").html('<div class="alert alert-danger">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					} // /else
				} // /else
			} // /if
		});

		return false;
	});
});// JavaScript Document


//update shcedule
$(document).ready(function(){
	$("#updateScheduleForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$("#scheduleUpdateMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						clearForm();
						$("html, body").animate({scrollTop: '0px'}, 100);
						reLoad();
				}
				else {
					if(response.messages instanceof Object) {
						$("#scheduleUpdateMessage").html('');	

						$.each(response.messages, function(index, value) {
							var key = $("#" + index);
								
							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.help-block').remove();

							key.after(value);

						});
						
					} 
					else {						
						$(".help-block").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');

						$("#scheduleUpdateMessage").html('<div class="alert alert-danger">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					} // /else
				} // /else
			} // /if
		});

		return false;
	});
});// JavaScript Document

function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	$(".fileinput-remove-button").click();	
}

function reLoad(){
			window.location.reload(500);
}


 /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker();
	// JavaScript Document