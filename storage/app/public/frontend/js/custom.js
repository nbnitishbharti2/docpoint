$(document).ready(function(){
    // User form Validation 
	$( "#user-registration" ).validate({
		rules: {
			name: {
                required: true,
                minlength:3
            },
            email: {
                required: true,
                email:true
            },
            mobile: {
                required: true,
                minlength:10,
                maxlength:10,
                integer:true
			},
			password: {
				required: true,
				minlength: 8
			},
			password_confirmation: {
				required: true,
				minlength: 8,
				equalTo : "#password"
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
            form.submit();
            $(".register").prop("disabled", true);
		}
    });
    
    // Doctor form Validation 
	$( "#doctor-registration" ).validate({
		rules: {
			name: {
                required: true,
                minlength:3
            },
            email: {
                required: true,
                email:true
            },
            mobile: {
                required: true,
                minlength:10,
                maxlength:10,
                integer:true
			},
			password: {
				required: true,
				minlength: 8
			},
			password_confirmation: {
				required: true,
				minlength: 8,
				equalTo : "#password"
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
            form.submit();
            $(".register").prop("disabled", true);
		}
    });
    
    // Login form Validation 
	$( "#login" ).validate({
		rules: {
			email: {
                required: true,
            },
            password: {
				required: true
			},
		}, 
		submitHandler: function(form) {
			// do other things for a valid form
            form.submit();
            $(".login-btn").prop("disabled", true);
		}
	});
});

function onlyNumberKey(evt) { 
    // Only ASCII charactar in that range allowed 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
        return false; 
    return true; 
}

function more_desktop(id, date) {
    $.ajax({
      url: slot_url,
      type: 'POST', 
      data: {"id": id,"date": date}, 
      success: function(data){ 
        data=JSON.parse(data) 
        console.log(data);
          $("#sloat-p"+id).html(""); 
        }
    }); 
}