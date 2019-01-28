function mora_onepage_nav() {
	'use strict';

	jQuery(".dt-homepage-menu-container ul li, .menu-mora-menu-container ul li").css({ "overflow":"visible"});

	jQuery('.page-template-template-homepage .dt-homepage-menu-container ul li.external, .page-template-template-homepage .menu-mora-menu-container ul li.external').each(function() {
		jQuery(this).children('a').addClass('external');
		jQuery(this).removeClass('external');
	});


	var navn = jQuery(".page-template-template-homepage #site-navigation");
	jQuery(navn).find('a').on('click', function () {
		if (navn.is(":visible") && navn.hasClass("is-nav-mobile")) {
			jQuery('#burger-menu').trigger('click');
		}
	});		


	jQuery('.page-template-template-homepage .dt-homepage-menu-container ul li.initial, .page-template-template-homepage .menu-mora-menu-container ul li.initial').addClass('current');

	var bool = false;
	if(mora_onepage.mora_hashtags == 1) {
		bool = true;
	}

	var moraoffset = parseInt(mora_onepage.mora_offset);

	//Scroll Nav
	jQuery('.page-template-template-homepage .dt-homepage-menu-container ul, .page-template-template-homepage .menu-mora-menu-container ul').onePageNav({
		currentClass: 'current',
		filter: ':not(.external)',
		changeHash: bool,
		scrollOffset: moraoffset
	});		    		
}

jQuery(document).ready(function() {
	mora_onepage_nav();	

});