$(document).ready(function(){

    // time and date pickers

                $(".timepicker").timepicker({ 'timeFormat': 'H:i' });

                $( ".datepicker" ).datepicker({
                dateFormat: 'yy/mm/dd',
                changeMonth: true,
                changeYear: true,
	            monthNames: [ "1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月" ],
	            monthNamesShort: [ "1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月" ],
	            dayNames: [ "日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日" ],
	            dayNamesMin: [ "日","月","火","水","木","金","土" ],
	            weekHeader: "週",
	            isRTL: false,
	            showMonthAfterYear: true,
	            yearSuffix: "年"
                });



  // navigation toggles
  $(".menu").on("click", function(event){
    event.preventDefault();
    if($(this).parent().hasClass("open") != true){
        $(this).parent().addClass("open");
    } else if ($(this).parent().hasClass("open") == true){
       $(this).parent().removeClass("open");
    }
  });

  $(".toggle").on("click", function(event){
    event.preventDefault();
    if($(".submenu").hasClass("open") != true){
        $(".submenu").addClass("open");
    } else if ($(".submenu").hasClass("open") == true){
        $(".submenu").removeClass("open");
    }
  });

  // chat
  $("#toggle-chat").on("click", function(event){
      event.preventDefault();
      $(".chat-open").fadeIn("fast");
  });

  $(".contact-list a").on("click", function(event){
      event.preventDefault();
      $(".contact-list").animate({marginLeft: "-240px"});
      $(".contact-message .scroll").animate({scrollTop: $('.contact-message .scroll').get(0).scrollHeight}, 2000);
  })

  $("a.back").on("click", function(event){
      event.preventDefault();
      $(".contact-list").animate({marginLeft: "0"});
  })

  $("a.close").on("click", function(event){
      event.preventDefault();
      $(".chat-open").fadeOut("fast");
  })
});
