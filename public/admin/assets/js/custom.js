$(document).ready(function(){
	$("#country").on('change', function(){
		var country_id = $("#country option:selected").val();
		$.ajax({
			url: get_state,
			method: 'POST',
			cache: false,
			data: {country_id:country_id},
			success: function(data) {
				$('#state option').remove();
				$('select[name="state"]').append('<option value="" >Choose State</option>');
				$.each(data, function(key, value) {
					$('select[name="state"]').append('<option value="'+ key +'" >'+ value +'</option>');
				});
			},
			error: function(error) {

			}
		});
	});
	// Method for fetch cities on state changed
	$("#state").change(function(){
		var state_id = $("#state option:selected").val();
		$.ajax({
			url: get_city,
			method: 'POST',
			cache: false,
			data: {state_id:state_id},
			success: function(data) {
				$('#city option').remove();
				$('select[name="city"]').append('<option value="" >Choose City</option>');
				$.each(data, function(key, value) {
					$('select[name="city"]').append('<option value="'+ key +'" >'+ value +'</option>');
				});
			},
			error: function(error) {

			}
		});
	});

	var selected_country_id = $("#country").attr("data-country_id");
	var selected_state_id = $("#state").attr("data-state_id");
	
	if(selected_country_id != '' && selected_country_id != undefined) {
		$.ajax({
			url: get_state,
			method: 'POST',
			cache: false,
			data: {country_id:selected_country_id},
			success: function(data) {
				$('#state option').remove();
				$('select[name="state"]').append('<option value="" >Choose State</option>');
				$.each(data, function(key, value) {
					$('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
				});
				$('#state option[value="'+selected_state_id+'"]').attr("selected", "selected");
			},
			error: function(error) {

			}
		});
	}
	var selected_city_id = $("#city").attr("data-city_id");
	if(selected_state_id != '' && selected_state_id != undefined) {
		$.ajax({
			url: get_city,
			method: 'POST',
			cache: false,
			data: {state_id:selected_state_id},
			success: function(data) {
				$('#city option').remove();
				$('select[name="city"]').append('<option value="" >Choose City</option>');
				$.each(data, function(key, value) {
					$('select[name="city"]').append('<option value="'+ key +'" >'+ value +'</option>');
				});
				$('#city option[value="'+selected_city_id+'"]').attr("selected", "selected");
			},
			error: function(error) {

			}
		});
	}

	$( "#doctor-form" ).validate({
		rules: {
			name: {
				required: true,
				minlength: 3,
				maxlength: 50
			},
			email: {
				required: true,
				email: true
			},
			speciality : {
				required: true
			},
			mobile : {
				required: true,
				minlength: 10,
				maxlength: 10
			},
			// phone : {
			// 	phoneUS: true
			// },
			alt_moblie : {
				minlength: 10,
				maxlength: 10
			},
			gender : {
				required: true
			},
			pic : {
				extension: "jpg, jpeg, png",
			},
			country : {
				required: true
			},
			state : {
				required: true
			},
			city : {
				required: true
			},
			address : {
				required: true,
				minlength:5,
				maxlength:200
			},
			zip : {
				required: true,
				minlength: 5,
				maxlength:6,
				digits: true
			},
			website : {
				url: true
			},
			iso_alpha_2: {
				required: true,
				minlength: 2,
				maxlength:2
			},
			iso_alpha_3: {
				required: true,
				minlength: 3,
				maxlength:3
			},
			currency_code: {
				required: true,
				minlength: 2
			},
			currency_code: {
				required: true,
				digits: true
			},
			slot_time: {
				required: true, 
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
			form.submit();
		}
	});
	

	//Password Update form validation
	$( "#password-update-form" ).validate({
		rules: {
			old_password: {
				required: true,
			},
			password: {
				required: true,
				minlength: 6
			},
			password_confirmation: {
				required: true,
				minlength: 6,
				equalTo : "#password"
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
			form.submit();
		}
	});

	//Password Update form validation
	$( "#speciality-form" ).validate({
		rules: {
			spec_name: {
				required: true,
				minlength: 3,
				maxlength:15
			},
			pic: {
				required: true
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
			form.submit();
		}
	});

	//Password Update form validation
	$( "#premium_charges" ).validate({
		rules: {
			amount: {
				required: true,
				digits: true
			},
			no_of_patient: {
				required: true,
				digits: true
			},
			premium_patient: {
				required: true,
				digits: true
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
			form.submit();
		}
	});

	$('#confirm').on('show.bs.modal', function(e) {
		var url = $(e.relatedTarget).data('href');
		if(url.includes('reject')) {
			$(".header-text").text('Confirm Reject?');
			$(".body-text").text('Are you sure! You want to Reject?');
			$(".btn-ok").text('Reject');
		} else {
			$(".header-text").text('Confirm Approve?');
			$(".body-text").text('Are you sure! You want to Approve?');
			$(".btn-ok").text('Approve');
		}
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});