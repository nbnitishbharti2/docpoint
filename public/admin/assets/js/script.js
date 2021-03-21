(function($) {
    "use strict";
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');
	
	// Sidebar
	
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}
	
	// Sidebar Initiate
	init();
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	// Sidebar overlay
	
	$(".sidebar-overlay").on("click", function () {
		$wrapper.removeClass('slide-nav');
		$(".sidebar-overlay").removeClass("opened");
		$('html').removeClass('menu-opened');
	});
	
	// Page Content Height
	
	if($('.page-wrapper').length > 0 ){
		var height = $(window).height();	
		$(".page-wrapper").css("min-height", height);
	}
	
	// Page Content Height Resize
	
	$(window).resize(function(){
		if($('.page-wrapper').length > 0 ){
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});
	
	// Select 2
	
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }
	
	// Datetimepicker
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa fa-angle-down",
				next: 'fa fa-angle-right',
				previous: 'fa fa-angle-left'
			}
		});
		$('.datetimepicker').on('dp.show',function() {
			$(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
		}).on('dp.hide',function() {
			$(this).closest('.temp').addClass('table-responsive').removeClass('temp')
		});
	}

	// Tooltip
	
	if($('[data-toggle="tooltip"]').length > 0 ){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
    // Datatable

   //  if ($('.datatable').length > 0) {
   //      $('.datatable').DataTable({ 
			// "bFilter": true,
			// "sort":false,
			// "filter": true, 
   //      });
   //  }
  	$.extend($.fn.dataTable.defaults, {
	  dom: 'Bfrtip',
	  buttons: [ 'pdf','csv']
	});

	$(".datatable").DataTable();
  // 	$('.datatable').DataTable();
  //   $('.datatable').DataTable( {
  //      	dom: 'Bfrtip',
	 //  	buttons: [
  //   'copy', 'excel', 'pdf'
  // ]
  //   });
 
	
	// Email Inbox

	if($('.clickable-row').length > 0 ){
		$(document).on('click', '.clickable-row', function() {
			window.location = $(this).data("href");
		});
	}

	// Check all email
	
	$(document).on('click', '#check_all', function() {
		$('.checkmail').click();
		return false;
	});
	if($('.checkmail').length > 0) {
		$('.checkmail').each(function() {
			$(this).on('click', function() {
				if($(this).closest('tr').hasClass('checked')) {
					$(this).closest('tr').removeClass('checked');
				} else {
					$(this).closest('tr').addClass('checked');
				}
			});
		});
	}
	
	// Mail important
	
	$(document).on('click', '.mail-important', function() {
		$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
	});
	
	// Summernote
	
	if($('.summernote').length > 0) {
		$('.summernote').summernote({
			height: 200,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: false                 // set focus to editable area after initializing summernote
		});
	}
	
    // Product thumb images

    if ($('.proimage-thumb li a').length > 0) {
        var full_image = $(this).attr("href");
        $(".proimage-thumb li a").click(function() {
            full_image = $(this).attr("href");
            $(".pro-image img").attr("src", full_image);
            $(".pro-image img").parent().attr("href", full_image);
            return false;
        });
    }

    // Lightgallery

    if ($('#pro_popup').length > 0) {
        $('#pro_popup').lightGallery({
            thumbnail: true,
            selector: 'a'
        });
    }
	
	// Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			allowPageScroll: false,
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height() - 60;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function() {
			var rHeight = $(window).height() - 60;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}
	
	// Small Sidebar

	$(document).on('click', '#toggle_btn', function() {
		if($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').slideDown();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').slideUp();
		}
		setTimeout(function(){ 
			mA.redraw();
			mL.redraw();
		}, 300);
		return false;
	});
	$(document).on('mouseover', function(e) {
		e.stopPropagation();
		if($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if(targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').slideDown();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').slideUp();
			}
			return false;
		}
	});
	// Change Doctor Status
	$('.doctor').on("change", function(){
		var status = '';
		var doctor_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_doctor_status,
			method: 'POST',
			cache: false,
			data: {doctor_id:doctor_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	// Change Doctor Sponsored Status
	$('.sponsored').on("change", function(){
		var sponsored = '';
		var doctor_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			sponsored = "Yes";
		} else {
			sponsored = "No";
		}
		$.ajax({
			url: change_doctor_sponsored_status,
			method: 'POST',
			cache: false,
			data: {doctor_id:doctor_id,sponsored:sponsored},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	// Change Doctor Sponsored Status
	$('.appointment').on("change", function(){
		var appoinment_status = '';
		var appointment_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			appoinment_status = "Active";
		} else {
			appoinment_status = "Rejected";
		}
		$.ajax({
			url: change_appoinment_status,
			method: 'POST',
			cache: false,
			data: {appointment_id:appointment_id,status:appoinment_status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	$('.user').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_user_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	//change country status
	$('.country').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_country_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	//change state status
	$('.state').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_state_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});


	//change city status
	$('.city').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_city_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});


	//change location status
	$('.location').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_location_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});


	//change appoinment sloat status
	$('.appointment-sloat').on("change", function(){
		var status = '';
		var user_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_appoinmrnt_slot_status,
			method: 'POST',
			cache: false,
			data: {user_id:user_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	// Chnage Speciality Status
	$('.speciality').on("change", function(){
		var status = '';
		var speciality_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "active";
		} else {
			status = "Inactive";
		}
		$.ajax({
			url: change_speciality_status,
			method: 'POST',
			cache: false,
			data: {speciality_id:speciality_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});

	// Chnage Reason Status
	$('.reason').on("change", function(){
		var status = '';
		var reason_id = $(this).attr("data-id");
		if ($(this).prop('checked')==true){ 
			status = "Active";
		} else {
			status = "New";
		}
		$.ajax({
			url: change_reason_status,
			method: 'POST',
			cache: false,
			data: {reason_id:reason_id,status:status},
			success: function(data) {
				if(data.status == true){
					$.toast({
						heading: 'Success',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'success',
						position : 'top-right',
						hideAfter : 3000,
					});
				} else {
					$.toast({
						heading: 'Error',
						text: data.msg,
						showHideTransition: 'slide',
						icon: 'error',
						position : 'top-right',
						hideAfter : 3000,
					});
				}
			},
			error: function(error) {
				$.toast({
					heading: 'Error',
					text: error,
					showHideTransition: 'slide',
					icon: 'error',
					position : 'top-right',
					hideAfter : 3000,
				});
			}
		});
	});
})(jQuery);

//Delete doctor show popup function
function confirm_doctor_delete(doctor_id) {
	var delete_url = $('#delete-doctor').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + doctor_id;
	$('#delete-doctor').attr('href', delete_url);
	$('#modal-doctor-delete').modal('show');
}

//Delete user show popup function
function confirm_user_delete(user_id) {
	var delete_url = $('#delete-user').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + user_id;
	$('#delete-user').attr('href', delete_url);
	$('#modal-user-delete').modal('show');
}

//Delete speciality show popup function
function confirm_speciality_delete(speciality_id) {
	var delete_url = $('#delete-speciality').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + speciality_id;
	$('#delete-speciality').attr('href', delete_url);
	$('#modal-speciality-delete').modal('show');
}

//Delete country show popup function
function confirm_country_delete(country_id) {
	var delete_url = $('#delete-country').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + country_id;
	$('#delete-country').attr('href', delete_url);
	$('#modal-country-delete').modal('show');
}
//Delete state show popup function
function confirm_state_delete(state_id) {
	var delete_url = $('#delete-state').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + state_id;
	$('#delete-state').attr('href', delete_url);
	$('#modal-state-delete').modal('show');
}
//Delete city show popup function
function confirm_city_delete(city_id) {
	var delete_url = $('#delete-city').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + city_id;
	$('#delete-city').attr('href', delete_url);
	$('#modal-city-delete').modal('show');
}
//Delete location show popup function
function confirm_location_delete(location_id) {
	var delete_url = $('#delete-location').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + location_id;
	$('#delete-location').attr('href', delete_url);
	$('#modal-location-delete').modal('show');
}
//Delete appoinment sloats show popup function
function confirm_appoinment_sloats_delete(location_id) {
	var delete_url = $('#delete-appointment-sloat').attr('href');
	var del_arr=delete_url.split('/');
	del_arr.pop();
	del_arr.push(location_id);
	delete_url=del_arr.toString('');
	delete_url=delete_url.replaceAll(',','/');
	//delete_url = delete_url.replace(/\d+/g, '') + location_id;
	$('#delete-appointment-sloat').attr('href', delete_url);
	$('#modal-appointment-sloat-delete').modal('show');
}



