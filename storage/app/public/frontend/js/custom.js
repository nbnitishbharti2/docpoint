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
       // data=JSON.parse(data) 
        console.log(data);
          $("#sloat-p"+id).html(data); 
        }
    }); 
}


function more_desktop_date(type) {
    console.log('fun');
    if(new_date>=min_date){
    $.ajax({
      url: date_slot_url,
      type: 'POST', 
      data: {"type": type,"ids": doctorlistid,"date": new_date,"date_list_start": date_list_start,"date_list_end": date_list_end,"min_date":min_date}, 
      success: function(data){ 
        data=JSON.parse(data)
        new_date=data.date; 
        if(type==1){
            date_list_end=data.date_list_end;
            // $(".owl-stage").append(data.date_append);
            //end 
        }else{
            if(min_date<date_list_start){
                 date_list_start=data.date_list_start;
                 // $(".owl-stage").prepend(data.date_append);
            }
            //start
        }
        for(i=0; i<doctorlistid.length; i++){
            j=doctorlistid[i];
            $("#sloat-p"+j).html(data.sloat[j]);  
        } 
        }
    });
}
}
