window.LoL = {};

LoL.initMaterialPlugins = function() {
  // init selects
  if(typeof $.fn.material_select !== 'undefined') {
    $('select:not(.select2, .disabled)').material_select();
  }
  
  // init datepicker
  if(typeof $.fn.pickadate !== 'undefined') {
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: true, // Creates a dropdown of 15 years to control year
	format: 'yyyy-mm-dd'
  });
  }
  
  
  if(typeof $.fn.pikaday !== 'undefined') {
    $('.pikaday').pikaday();
  }
  

}

jQuery(function() {
  // variables
  var $ = jQuery;

  // init all if not Angular version
  if(typeof conAngular === 'undefined') {

    LoL.initMaterialPlugins();
  }


});

$(document).ready(function(){
    $('[data-toggle="popover"]').popover({animation: true, delay: {show: 100, hide: 100}}); 
});


$(window).bind("load", function() { 
       
       var footerHeight = 0,
           footerTop = 0,
           $footer = $("#footer");
           
       positionFooter();
       
       function positionFooter() {
       
                footerHeight = $footer.height();
                footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
       
               if ( ($(document.body).height()+footerHeight) < $(window).height()) {
                   $footer.css({
                        position: "absolute"
                   }).animate({
                        top: footerTop
                   })
               } else {
                   $footer.css({
                        position: "static"
                   })
               }
               
       }

       $(window)
               .scroll(positionFooter)
               .resize(positionFooter)
               
});

new WOW().init();

