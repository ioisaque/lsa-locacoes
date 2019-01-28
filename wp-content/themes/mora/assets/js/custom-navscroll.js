jQuery(document).ready(function() {
	'use strict';
	// Header Effect on Scroll

	var def_color = mora_styles.mora_default_color;	
	var header_logo = jQuery(".logo img");

	if(mora_styles.mora_pagenav_behavior_switch != 1) { 
		jQuery(".header-regular #header").css({'background': mora_styles.mora_header_bg});
	}
	else { 
		jQuery('.header-regular #site-navigation, .header-regular .bm, #headersocial').removeClass(mora_styles.mora_scheme).addClass(mora_styles.mora_initial_navigation_style);
		jQuery(".header-regular #header").css({"background": "rgba("+mora_styles.mora_initial_header_color+","+(mora_styles.mora_initial_header_color_opacity / 100)+")"});
		if(typeof(mora_styles.mora_initial_logo_image_url) != "undefined" && mora_styles.mora_initial_logo_image_url != '') { 
			header_logo.attr("src",""+mora_styles.mora_initial_logo_image_url+"");		

			if(typeof(mora_styles.mora_initial_logo_svg_retina) != "undefined" && mora_styles.mora_initial_logo_svg_retina != '') { 
				header_logo.attr("width",""+mora_styles.mora_initial_svg_retina_logo_width+"").attr("height",""+mora_styles.mora_initial_svg_retina_logo_height+"").css({"height": ""+mora_styles.mora_initial_svg_retina_logo_height+"px", "width": ""+mora_styles.mora_initial_svg_retina_logo_width+"px"});
			}
		}
	}

	if(mora_styles.mora_scrolling_effect != 0) {
		jQuery(window).scroll( function() {
			var value = jQuery(this).scrollTop();
			if ( value > 150 )	{

					jQuery(".header-regular #header").removeClass("initial-state").addClass("scrolled-header").css({"padding-top": mora_styles.mora_scroll_pt+"px", "padding-bottom": mora_styles.mora_scroll_pb+"px"});
					jQuery(".no-rgba .scrolled-header").css({"background": def_color});
					jQuery(".header-regular .logo img").css({"height": ""+mora_styles.mora_logo_onscroll_height+"px", "width": "auto"});
					if(mora_styles.mora_alternativelogo == 1) {
						if(mora_styles.mora_alternative_svg_logo_enabled == 0) {
							jQuery("#header.scrolled-header .logo img").attr("src",""+mora_styles.mora_alternativelogosrc+"");
						}
						else if(mora_styles.mora_alternative_svg_logo_enabled == 1) {
							jQuery("#header.scrolled-header .logo img").attr("src",""+mora_styles.mora_alternative_svg_logo_src+"").attr("width",""+mora_styles.mora_alternative_svg_logo_width+"").attr("height",""+mora_styles.mora_alternative_svg_logo_height+"").css({"height": ""+mora_styles.mora_alternative_svg_logo_height+"px", "width": ""+mora_styles.mora_alternative_svg_logo_width+"px"});
						}
						
					}

				if(mora_styles.mora_pagenav_behavior_switch != 1) { 
					jQuery(".header-regular .scrolled-header").css({"background": mora_styles.mora_header_scroll_bg});
					jQuery(".header-regular .scrolled-header .main-navigation ul ul").css({'background': mora_styles.mora_header_scroll_bg});
					if(mora_styles.mora_scheme != mora_styles.mora_scheme_on_scroll) {
						jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(mora_styles.mora_scheme).addClass(mora_styles.mora_scheme_on_scroll);
					}						
				}				

				else {
					// custom page background color
					jQuery(".header-regular .scrolled-header").css({"background": "rgba("+mora_styles.mora_onscroll_header_color+","+(mora_styles.mora_onscroll_header_color_opacity / 100)+")"});

					// custom page menu style
					jQuery('.header-regular #site-navigation, .bm, .header-regular  #headersocial, .searchform-wrapper').removeClass(mora_styles.mora_scheme).removeClass(mora_styles.mora_initial_navigation_style).addClass(mora_styles.mora_onscroll_navigation_style);

					// custom logo
					if(typeof(mora_styles.mora_onscroll_logo_image_url) != "undefined" && mora_styles.mora_onscroll_logo_image_url !== '') { 					
						header_logo.attr("src",""+mora_styles.mora_onscroll_logo_image_url+"").attr("height", ""+mora_styles.mora_logo_onscroll_height+"").css({"height": ""+mora_styles.mora_logo_onscroll_height+"px", "width": "auto"});

						if(typeof(mora_styles.mora_onscroll_logo_svg_retina) != "undefined" && mora_styles.mora_onscroll_logo_svg_retina !== '') { 
							header_logo.attr("width",""+mora_styles.mora_onscroll_svg_retina_logo_width+"").attr("height",""+mora_styles.mora_onscroll_svg_retina_logo_height+"").css({"height": ""+mora_styles.mora_onscroll_svg_retina_logo_height+"px", "width": ""+mora_styles.mora_onscroll_svg_retina_logo_width+"px"});
						}

					}
				}
			}
			else {
				jQuery(".header-regular #header").removeClass("scrolled-header").addClass("initial-state");
				jQuery(".header-regular #header").css({"padding-top": mora_styles.mora_init_pt+"px", "padding-bottom": mora_styles.mora_init_pb+"px"});
				jQuery(".logo img").css({"width": mora_styles.mora_logo_width, "height": mora_styles.mora_logo_height});

				if((mora_styles.mora_alternativelogo == 1) && (mora_styles.mora_logo_svg_enabled == 1)) {
					header_logo.attr("src",""+mora_styles.mora_logo_svg_url+"");
				}							
				else if((mora_styles.mora_alternativelogo == 1) && (mora_styles.mora_logo_svg_enabled == 0)) {
					header_logo.removeAttr("src").attr("src",""+mora_styles.mora_mainlogosrc+"");
				}

				if(mora_styles.mora_pagenav_behavior_switch != 1) { 
					jQuery(".header-regular .initial-state").css({'background': mora_styles.mora_header_bg});	
					if(mora_styles.mora_scheme != mora_styles.mora_scheme_on_scroll) {
						jQuery('#site-navigation, .bm').removeClass(mora_styles.mora_scheme_on_scroll).addClass(mora_styles.mora_scheme);
					}	
					jQuery(".initial-state .main-navigation ul ul").css({'background': mora_styles.mora_header_bg});
					if(mora_styles.mora_scheme != mora_styles.mora_scheme_on_scroll) {
						jQuery('#site-navigation, .bm, #headersocial, .searchform-wrapper').removeClass(mora_styles.mora_scheme_on_scroll).addClass(mora_styles.mora_scheme); 
					}	
				}		
				else {
					// custom page background color
					jQuery(".header-regular .initial-state").css({"background": "rgba("+mora_styles.mora_initial_header_color+","+(mora_styles.mora_initial_header_color_opacity / 100)+")"});


					// custom page menu style
					jQuery('.header-regular #site-navigation, .header-regular  .bm, #headersocial, .header-regular  .searchform-wrapper').removeClass(mora_styles.mora_scheme_on_scroll).removeClass(mora_styles.mora_onscroll_navigation_style).addClass(mora_styles.mora_initial_navigation_style);

					// custom logo
					if(typeof(mora_styles.mora_initial_logo_image_url) != "undefined" && mora_styles.mora_initial_logo_image_url !== '') { 					
						header_logo.removeAttr("src").attr("src",""+mora_styles.mora_initial_logo_image_url+"").attr("height",""+mora_styles.mora_initial_logo_image_height+"").css({"height": ""+mora_styles.mora_initial_logo_image_height+"px", "width": ""+mora_styles.mora_initial_logo_image_width+"px"});;

						if(typeof(mora_styles.mora_initial_logo_svg_retina) != "undefined" && mora_styles.mora_initial_logo_svg_retina !== '') { 
							header_logo.attr("width",""+mora_styles.mora_initial_svg_retina_logo_width+"").attr("height",""+mora_styles.mora_initial_svg_retina_logo_height+"").css({"height": ""+mora_styles.mora_initial_svg_retina_logo_height+"px", "width": ""+mora_styles.mora_initial_svg_retina_logo_width+"px"});
						} else { 
							header_logo.css({"width": mora_styles.mora_initial_logo_image_width, "height": mora_styles.mora_initial_logo_image_height});
						}						
								
					}
				}				
			}
		});	
	}
});


jQuery(window).load(function() {
	'use strict';
	
	var headernavheight = jQuery('.header-regular .site-header .container').height();
	var socialaheight = jQuery('.header-regular #headersocial li a').height();
	jQuery('.header-regular .logo-container').css({'height': headernavheight});	 
	jQuery('.header-regular #headersocial').css({'height': headernavheight});	 
	jQuery('.header-regular #headersocial li').css({'margin-top': (headernavheight - socialaheight)/2 });		
	jQuery('.header-regular .header-nav').css({'min-height': headernavheight});		
})