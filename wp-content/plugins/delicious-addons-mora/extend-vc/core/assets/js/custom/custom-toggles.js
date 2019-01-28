// Testimonials Slider
jQuery(document).ready(function() {	
	'use strict';
	jQuery('.toggle-view[id^="toggle-view"]').each( function() { 	

		var $div = jQuery(this);
		var token = $div.data('token');

		var settingObj = window['dt_toggle_' + token];	



	});

		var togglediv = jQuery(".toggle-view .toggle-content");

		togglediv.children('.trigger').on('click', function () {
	        var text = togglediv.children('.toggle-panel');
	        if (text.is(':hidden')) {
	            text.slideDown('300');
	            jQuery(this).addClass('activated');     
	        } else {
	            text.slideUp('300');
				jQuery(this).removeClass('activated'); 			
	        }
	         
	    });		
});