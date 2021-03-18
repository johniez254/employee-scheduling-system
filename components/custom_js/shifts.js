$(document).ready(function(){
	$("#addShiftForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {
					$("#addShiftMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
				} // /success
			}); // /ajax

		return false;
	});
});// JavaScript Document


//update shifts
$(document).ready(function(){
	$("#updateShiftForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {
					$("#shiftUpdateMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						clearForm();
						reLoad()
				}
				else {
					
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
				} // /success
			}); // /ajax

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


//Time Picker Initialization and Custom Functions
$(document).ready(function() {
    $('#from').timepicker();

    setTimeout(function() {
        $('#from').text($('#from').val());
    }, 100);

    $('#from').on('changeTime.timepicker', function(e) {
        $('#from').text(e.time.value);
    });
});

//Time Picker Initialization and Custom Functions
$(document).ready(function() {
    $('#to').timepicker();

    setTimeout(function() {
        $('#to').text($('#to').val());
    }, 100);

    $('#to').on('changeTime.timepicker', function(e) {
        $('#to').text(e.time.value);
    });
});