
//add shcedule
$(document).ready(function(){
	$("#addTimeOffForm").unbind('submit').bind('submit', function() {
		
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
					$("#addTimeOffMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#addTimeOffMessage").html('');	

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

						$("#addTimeOffMessage").html('<div class="alert alert-danger">'+
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



//add shcedule
$(document).ready(function(){
	$("#addOptionForm").unbind('submit').bind('submit', function() {
		
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
					$("#addOptionMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#addOptionMessage").html('');	

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

						$("#addOptionMessage").html('<div class="alert alert-danger">'+
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


//update Option
$(document).ready(function(){
	$("#updateOptionForm").unbind('submit').bind('submit', function() {
		
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
					$("#updateOptionMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#updateOptionMessage").html('');	

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

						$("#updateOptionMessage").html('<div class="alert alert-danger">'+
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
	$("#updateTimeOffForm").unbind('submit').bind('submit', function() {
		
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
					$("#updateTimeOffMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
						$("#updateTimeOffMessage").html('');	

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

						$("#updateTimeOffMessage").html('<div class="alert alert-danger">'+
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