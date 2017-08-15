  /* 

    Tabs 

    - jQuery plug-in / dependency
    - Opens and closes tab items through classes
    - Created: March 2015

  */

  if (window.jQuery) { 
    
    (function($) {
    
      "use strict";
    
      function tabswitch() {

        //Set var for holder
        var $tabcollection = $(this).closest(".tabs-panel");

        // Set var for all tabs in holder
        var $alltabs = ($tabcollection).children(".individual-tab");

        // Set var for clicked
        var $tabclicked = $(this).parent();

        //Action on clicked
        ($tabclicked).addClass( "tab-on" );

        //Action on non clicked
        ($alltabs).not($tabclicked).removeClass( "tab-on" );

        // Set var for tab-content height
        var $selectedheight = $(this).next(".tab-content");

        var $bottom = ($selectedheight).outerHeight(true);

        $(this).closest(".tabs-panel").css('height',$bottom + 32 +"px");


        return false;
      }


      function getsetheight() {
   
        $('.tabs-panel').each(function(){
        
          var selectedheight = $(this).find(".tab-on .tab-content");
   
          var bottom = (selectedheight).outerHeight(true);
   
          $(this).css('height',bottom + 32 +"px");
   
        });
   
      }


      function tabsPanelDisp() {
        if($('.tabs-panel').length) {

      //    var tabspanel = $('.tabs-panel');   commented out as jshint was blubbing

          tabspanel.each(function(tabspanel) {
                
            var tabspanel = $(this);
            var tabs = tabspanel.find('.tab');

            var totalTabWidth = 0;
            
            $(tabs).each(function(index) {
              totalTabWidth += parseInt($(this).outerWidth(true), 10);
            });

            var columnWidth = $(this).width();
            var doubleColumnWidth = columnWidth * 2;
            var trippleColumnWidth = columnWidth * 2.67;

            if ( totalTabWidth >= trippleColumnWidth ) {
                $(this).removeClass('tabs-multi-2-lines');
                $(this).removeClass('tabs-multi-3-lines');
                $(this).addClass('tabs-multi-4-lines');
              }
            else if ( totalTabWidth + 60 >= doubleColumnWidth ) {
                $(this).removeClass('tabs-multi-2-lines');
                $(this).removeClass('tabs-multi-4-lines');
                $(this).addClass('tabs-multi-3-lines');
              }
            else if ( totalTabWidth >= columnWidth ) {
                $(this).removeClass('tabs-multi-3-lines');
                $(this).removeClass('tabs-multi-4-lines');
                $(this).addClass('tabs-multi-2-lines');
              } 
            else if ( totalTabWidth <= columnWidth ) {
                $(this).removeClass('tabs-multi-4-lines');
                $(this).removeClass('tabs-multi-3-lines');
                $(this).removeClass('tabs-multi-2-lines');
              }
          });
        }
      }


      var windowWidth = $(window).width();
        /* Fn below replaces initial on.("resize") fn, which was getting triggerd on scroll on iOS */
        $(window).resize(function(){           
          // Check window width has actually changed and it's not just iOS triggering a resize event on scroll
          if ($(window).width() !== windowWidth) {
              // Update the window width for next time
              windowWidth = $(window).width(); 
              tabsPanelDisp();
              getsetheight();
          }
          // Otherwise do nothing
      });


//      function selectTab () {
//        var hash = window.location.hash,
//            el;

//        if (hash) el = $('.' + hash.substr(1));
        // default behavior if there is no necessary element
//        if (!el || !el.length) return $('.js-tab-current-titles').addClass( "tab-on" );
//        el.addClass( "tab-on" );
//      }

      $(".tab").click(tabswitch);
      $('body').addClass('js-on');

      $(document).ready(tabsPanelDisp);
      $(document).ready(selectTab); // IN THAT ORDER!
      $(document).ready(getsetheight);
      
    })(jQuery);
  }