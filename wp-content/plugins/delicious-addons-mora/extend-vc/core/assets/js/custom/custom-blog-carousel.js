// Blog Carousel
jQuery(window).load(function() {	
	'use strict';
	jQuery('.dt-blog-carousel[id^="owl-blog-carousel-"]').each( function() { 	

		var $div = jQuery(this);
		var token = $div.data('token');
		var rtlbool = true;
		var bool = true;

		var settingObj = window['dt_bc_' + token];	
		if(settingObj.dt_rtl != 'true') {
			rtlbool = false;
		}	
		if((settingObj.blogc_speed == '') || (settingObj.blogc_speed == 'false')) {
			bool = false;
		}		
		jQuery("#owl-blog-carousel-"+settingObj.id+"").owlCarousel({
			autoHeight : true,				
			rewind: true,
			nav: true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		    responsive:{
		        0:{
		            items:1,
		        },
		        640:{
		            items:2,
		        },
		        1024:{
		            items:settingObj.columns,
		        }
		    },				
			margin: 30,
			autoplay: bool,
			autoplayTimeout: settingObj.blogc_speed,			
			autoplayHoverPause: true,
			rtl: rtlbool,
			dots: true,
			smartSpeed: 800
		});		

	});
});
