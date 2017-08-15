if (window.jQuery) { 
    (function($) {
    	"use strict";

    	function openWindow(make) {
	        make.preventDefault();
      		var popUpUrl = $(this).attr('href');
	        window.open(popUpUrl, 'Ujima Radio - listen live', 'height=190, width=380, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');
        }

    $(".pop-up-link").click(openWindow);

  })(jQuery);
}