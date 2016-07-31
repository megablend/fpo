
$(function() {

  /** User Settings Dropdown **/
  $("#dropdown").on("click", function(e){
    // e.preventDefault();
    
    if($(this).hasClass("open")) {
      $(this).removeClass("open");
      $(this).children("ul").slideUp("fast");
    } else {
      $(this).addClass("open");
      $(this).children("ul").slideDown("fast");
    }
  });


  //filter table for the search result
  $('.star').on('click', function () {
      $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });
    
  
  /** Date Picker **/
  $("#input-dob").datepicker({
      format: "yyyy-mm-dd"
  });

  /** Date Picker **/
  $("#input-expiration-date").datepicker({
      format: "yyyy-mm-dd"
  });

  /** Date Picker **/
  $("#input-issue-date").datepicker({
      format: "yyyy-mm-dd"
  });

  $(".fit").imgLiquid({
    fill:true,
    horizontalAlign:"top"
  });
  $(".nav-anchor a").click(function() {  //use a class, since your ID gets mangled
    $('.explore-form, .header-menu').toggleClass("mobile");      //add the class to the clicked element
    $(this).toggleClass("clicked"); 
  });

  


 $(".games").typed({
    strings: ["amazing", "low cost", "good", "standard"],
    typeSpeed: 170,
    backDelay: 600,
    loop: true,
    // defaults to false for infinite loop
    loopCount: false
  });

 $(".ad .le-city").typed({
    strings: ["Lagos", "Port Harcourt", "Ibadan", "Enugu", "Abeokuta", "Ile-Ife", "Abuja"],
    typeSpeed: 170,
    backDelay: 600,
    loop: true,
    // defaults to false for infinite loop
    loopCount: false
  });

 $('.tip').darkTooltip({
    animation:'fadeIn',
    gravity:'west',
    theme:'light',
    size:'medium'
  });
});