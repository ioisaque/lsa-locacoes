jQuery(document).ready(function() {	
	// Responsive Navigation 
	'use strict';
	var mora_nava = jQuery(".nav-btn"),
		mora_navb = jQuery("#site-navigation"),
		mora_wind = jQuery(window).width(),	
		mora_winh;
		
		if(mora_wind < 1024) {
			 mora_winh = jQuery(window).height()
		}
		else {
			mora_winh = jQuery(window).outerHeight() -jQuery('#header').outerHeight()
		}

	// Add classes		
    jQuery(window).resize(function () {
		var mora_nava = jQuery(".nav-btn"),
			mora_navb = jQuery("#site-navigation"),
			mora_wind = jQuery(window).width(),
			mora_winh;

		if(mora_wind < 1024) {
			 mora_winh = jQuery(window).height()
		}
		else {
			mora_winh = jQuery(window).outerHeight() -jQuery('#header').outerHeight()
		}
		
		if (mora_wind > 1023) {
			mora_navb.addClass("is-nav-desktop");
			mora_navb.removeClass("is-nav-mobile")
		}
		if (mora_wind < 1024) {
			mora_navb.addClass("is-nav-mobile");
			mora_navb.removeClass("is-nav-desktop")
		}

		// Nav CSS adjustment for mobile
		if (mora_wind < 1024) {
		jQuery('#site-navigation.is-nav-mobile').css({'max-height': mora_winh-200, 'overflow-y': 'scroll', 'overflow-x': 'hidden'});
		}
		if (mora_wind > 1023) {
			jQuery('#site-navigation.is-nav-desktop').css({'overflow': 'visible'});
		}		

    });
			
		if (mora_wind > 1023) {
			mora_navb.addClass("is-nav-desktop");
			mora_navb.removeClass("is-nav-mobile")
		}
		if (mora_wind < 1024) {
			mora_navb.addClass("is-nav-mobile");
			mora_navb.removeClass("is-nav-desktop");
		}	
		// Nav CSS adjustment for is-nav-mobile
		if (mora_wind < 1024) {
		jQuery('#site-navigation.is-nav-mobile').css({'max-height': mora_winh-200, 'overflow-y': 'scroll', 'overflow-x': 'hidden'});
		}
		if (mora_wind > 1023) {
			jQuery('#site-navigation.is-nav-desktop').css({'overflow': 'visible'});
		}				

});