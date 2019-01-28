// Portfolio Gallery Slider
jQuery(window).load(function() {	
	'use strict';
	jQuery('.portfolio-slider[id^="owl-slider-"]').each( function() { 	

		var $div = jQuery(this);
		var token = $div.data('token');
		var bool = true;
		var rtlbool = true;
		var centerbool = true;
		var autowidthbool = true;

		var settingObj = window['dt_slider_' + token];	
		if(settingObj.slider_speed == 'false') {
			bool = false;
		}		
		if(settingObj.dt_rtl != 'true') {
			rtlbool = false;
		}		

		if(settingObj.center != 'true') {
			centerbool = false;
		}		
		if(settingObj.autowidth != 'true') {
			autowidthbool = false;
		}
		if(settingObj.autowidth == 'true') {				
			jQuery("#owl-slider-"+settingObj.id+"").find('img').css({'height': settingObj.imageheight, 'width': 'auto'});
		}

		var mg = settingObj.dt_margin;

		jQuery("#owl-slider-"+settingObj.id+"").owlCarousel({
			autoHeight : true,
		    responsiveClass:true,
		    responsive:{
		        0:{
		            items:settingObj.mobile_slides,
		            nav:true
		        },
		        640:{
		            items:settingObj.tablet_slides,
		            nav:true
		        },
		        1024:{
		            items:settingObj.desktop_slides,
		            nav:true
		        }
		    },			
			navText: [
				  "<i class='fa fa-angle-left'></i>",
				  "<i class='fa fa-angle-right'></i>"
				  ],				
			rewind: true,
			autoplay: bool,
			rtl: rtlbool,
			autoplayTimeout: settingObj.slider_speed,	
			lazyLoad: settingObj.lazyload,		
			center: centerbool,
			loop: centerbool,
			autoplayHoverPause: true,
			autoWidth: autowidthbool,
			margin: parseInt(settingObj.margin),
			dots: true,
			smartSpeed: 800,
			// onInitialized: dt_get_info,
			// onChanged: dt_get_info
		});	

    function dt_get_info() {
        var activeImg = jQuery('.owl-carousel').find('.active').find('img');
        var comment = activeImg.attr('alt');
        if(comment) jQuery(".image-caption").html('<p>'+comment+'</p>');
    }		

	});
});