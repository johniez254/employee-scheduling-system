//update timeoff
$(document).ready(function(){
	$("#addSwapForm").unbind('submit').bind('submit', function() {
		
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
					$("#addSwapMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#addSwapMessage").html('');	

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

						$("#addSwapMessage").html('<div class="alert alert-danger">'+
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

//update timeoff
$(document).ready(function(){
	$("#updateSwapForm").unbind('submit').bind('submit', function() {
		
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
					$("#updateSwapMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#updateSwapMessage").html('');	

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

						$("#updateSwapMessage").html('<div class="alert alert-danger">'+
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


//datepicker
$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
});

function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	$(".fileinput-remove-button").click();	
}

function reLoad(){
			window.location.reload(500);
}