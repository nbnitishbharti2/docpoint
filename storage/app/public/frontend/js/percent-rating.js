
$('.star-div').each(function(){
    // working on being able to add any number of stars.
    var currentRating = 0;
    var jqueryElm = $(this);
    var starCount = 5;
    var starValue = Math.floor(100 / starCount);

    jqueryElm.click(function(e) {
      var x = e.pageX - this.offsetLeft;
      var total = (x/jqueryElm.width())*100;
      rateStyleJQ(Math.floor(total), jqueryElm);
    });

    jqueryElm.mousemove(function(e) {
      var x = e.pageX - this.offsetLeft;
      var total = (x/jqueryElm.width())*100;
      rateStyleHover(Math.floor(total), jqueryElm);
    });
    // to clear hover effect when mouse leaves div
    jqueryElm.mouseout(function() {
      $(".star").removeClass("star-hover");
      // show original rating after hover if unclicked
      rateStyleJQ(currentRating, jqueryElm);
    });

    function rateStyleJQ(num, jqueryElmX) {
      var starOvers = jqueryElmX.find(".star-over");
      starOvers.removeClass("star-visible").css("width","");
      var ratingRounded = (Math.floor(num)/starValue);
      var leftOver = (Math.floor(num) % starValue)*starCount;
      starOvers.slice(0, ratingRounded).addClass("star-visible");
      if (leftOver !== 0) {
        $(starOvers[Math.floor(ratingRounded)]).addClass('star-visible').css("width",leftOver+"%");
    }
      currentRating = num;
    }

    function rateStyleHover(num, jqueryElmX) {
      var starOvers = jqueryElmX.find(".star-over");
      starOvers.removeClass("star-hover").removeClass("star-visible").css("width","");
      var ratingRounded = (Math.floor(num)/starValue);
      var leftOver = (Math.floor(num) % starValue)*starCount;
      starOvers.slice(0, ratingRounded).addClass("star-hover");
        if (leftOver !== 0) {
        $(starOvers[Math.floor(ratingRounded)]).addClass('star-hover').css("width",leftOver+"%");
    }
    }
    
    var num_aftr_point = parseFloat($(this).attr("data-rating")).toFixed(2).split('.')[1];
    var totalRating = parseFloat($(this).attr("data-rating"));
    if(totalRating == 0 || totalRating < 0){
      $(this).children(".star-under:nth-child(1)").children(".star-over").removeClass("star-visible");
      $(this).children(".star-under:nth-child(1)").children(".star-over").css("width", "0%");
    }
    else if(totalRating<1 && totalRating>0){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(1)").children(".star-over").css("width", num_aftr_point + "%");
    }else if(totalRating<2){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").css("width", num_aftr_point + "%");
    }
    else if(totalRating<3){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(3)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(3)").children(".star-over").css("width", num_aftr_point + "%");
    }
    else if(totalRating<4){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(3)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(4)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(4)").children(".star-over").css("width", num_aftr_point + "%");
    }
    else if(totalRating<5){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(3)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(4)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(5)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(5)").children(".star-over").css("width", num_aftr_point + "%");
    }
    else if(totalRating == 5 || totalRating>5){
      $(this).children(".star-under:nth-child(1)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(2)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(3)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(4)").children(".star-over").addClass("star-visible");
      $(this).children(".star-under:nth-child(5)").children(".star-over").addClass("star-visible");
    }
    $(this).click(function(){
      var afterRating = currentRating/100*5
      var newRating =  Math.ceil(afterRating.toFixed(2))
     // alert(newRating)
     // var newRating =  Math.ceil(afterRating.toFixed(2))
      $(this).attr("data-rating", newRating); 
       var name=($(this).attr("id"))
       $("#"+name+"_count").val(newRating)
      $(this).attr("value", newRating);
      if(parseFloat($(this).attr("data-rating"))>= 4.51){
        $(this).attr("data-rating", 5);
        $(this).children(".star-under:nth-child(6)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 1){
        $(this).attr("data-rating", 1);
        $(this).children(".star-under:nth-child(1)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 2){
        $(this).attr("data-rating", 2);
        $(this).children(".star-under:nth-child(2)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 3){
        $(this).attr("data-rating", 3);
        $(this).children(".star-under:nth-child(3)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 4){
        $(this).attr("data-rating", 4);
        $(this).children(".star-under:nth-child(4)").children(".star-over").css("width", "100%");
      }
      $(this).children(".star-under:nth-child(4)").children(".star-over").css("width", "100%");
    });
    $(this).mouseout(function(){
      if(parseFloat($(this).attr("data-rating"))>= 4.51){
        $(this).children(".star-under:nth-child(6)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 1){
        $(this).attr("data-rating", 1);
        $(this).children(".star-under:nth-child(2)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 2){
        $(this).attr("data-rating", 2);
        $(this).children(".star-under:nth-child(3)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 3){
        $(this).attr("data-rating", 3);
        $(this).children(".star-under:nth-child(4)").children(".star-over").css("width", "100%");
      }
      if(parseFloat($(this).attr("data-rating"))== 4){
        $(this).attr("data-rating", 4);
        $(this).children(".star-under:nth-child(5)").children(".star-over").css("width", "100%");
      }
      
    });
  });