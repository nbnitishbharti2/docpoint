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

function more_desktop(id, date, slottype) {
	var active=$("#sloat-doctor-details").val();
    $.ajax({
      url: slot_url,
      type: 'POST', 
      data: {"id": id,"date": date,"page_type":page_type,"active":active,'sloattype':slottype}, 
      success: function(data){  
          $("#sloat-p"+id).html(data); 
        }
    }); 
}
function setsloat2(id) { 
	var old_val=$("#sloat-doctor-details").val();
	 $("#sloat-doctor-details").val(id); 
	 $("#li_"+id).addClass("active");
	 $("#li_"+old_val).removeClass("active");
}

function more_desktop_date(type) {
	var active=$("#sloat-doctor-details").val();
	
    if(new_date>=min_date || type==1){
		$.ajax({
			url: date_slot_url,
			type: 'POST', 
			data: {"type": type,"ids": doctorlistid,"date": new_date,"date_list_start": date_list_start,"date_list_end": date_list_end,"min_date":min_date,"page_type":page_type,"active":active,'sloattype':appoinment_type}, 
			success: function(data){ 
				data=JSON.parse(data)
				new_date=data.date_list_start;
				console.log(type);
				console.log(min_date);
				console.log(new_date);
				console.log(data.date_list_start);
				if(type==1) {
					date_list_end=data.date_list_end;
					date_list_start=data.date_list_start;
					//$(".owl-stage").append(data.date_append);
					$(".owl-stage").html(data.date_append);
					$('.owl-prev').prop("disabled", false);
					$(".owl-prev").removeClass('disabled');
				} else {
					if(min_date<data.date_list_start){
						date_list_start=data.date_list_start;
						$(".owl-stage").html(data.date_append);
						$('.owl-prev').prop("disabled", false);
					   $(".owl-prev").removeClass('disabled');
					//	$(".owl-stage").prepend(data.date_append);
					}else{
						if(min_date>=new_date){
							$(".owl-prev").addClass('disabled');
							$(".owl-prev").attr( 'disabled', 'disabled' );
						}
						$(".owl-stage").html(data.date_append);
						//document.getElementsByClassName("owl-prev").disabled = true;
					}
				}
				
				for(i=0; i<doctorlistid.length; i++){
					j=doctorlistid[i];
					$("#sloat-p"+j).html(data.sloat[j]);  
				} 
			}
		});
	}
	$(".owl-next").removeClass('disabled');
}


function more_desktop_change_type(type) {
	var active=$("#sloat-doctor-details").val();
	appoinment_type=type 
	if(type=='Physical'){
		$("#inperson").prop("checked", true);
	}else{
		$("#videovisit").prop("checked", true);
	}
    if(new_date>=min_date || type==1){
		$.ajax({
			url: change_type_slot_url,
			type: 'POST', 
			data: {"type": type,"ids": doctorlistid,"date": new_date,"date_list_start": date_list_start,"date_list_end": date_list_end,"min_date":min_date,"page_type":page_type,"active":active,'sloattype':appoinment_type}, 
			success: function(data){ 
				data=JSON.parse(data);
				for(i=0; i<doctorlistid.length; i++){
					j=doctorlistid[i];
					$("#sloat-p"+j).html(data.sloat[j]);  
				} 
			}
		});
	}
	$(".owl-next").removeClass('disabled');
}

$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
		console.log(content.length);
        if(content.length > 100) {
			if(content.length > showChar) {
 
				var c = content.substr(0, showChar);
				var h = content.substr(showChar, content.length - showChar);
	 
				var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
	 
				$(this).html(html);
			}
		}
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
  });