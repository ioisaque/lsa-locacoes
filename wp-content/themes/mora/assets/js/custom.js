/**
 * custom.js
 */

function mora_wpml_widget_position() {
	'use strict';
    var mora_sitenavheight = jQuery('.is-nav-desktop #primary-menu').height();
    var mora_flagsheight = jQuery('.is-nav-desktop .flags_language_selector ul').outerHeight();
    var mora_search = jQuery('.is-nav-desktop .searchform-switch').outerHeight();
    jQuery("#site-navigation.is-nav-desktop .flags_language_selector").css({'margin-top': (mora_sitenavheight - mora_flagsheight) / 2 });      	
    jQuery("#site-navigation.is-nav-desktop .searchform-switch").css({'margin-top': (mora_sitenavheight - mora_search) / 2 });  
}

jQuery(document).ready( function() {
	'use strict';

    jQuery("#typed").typed({
        stringsElement: jQuery('#typed-strings'),
        cursorChar: ".",
        typeSpeed: 100,
        startDelay: 2000,
        backSpeed: 80,
        backDelay: 2000,
        loop: true,
        loopCount: 3
    });	

    jQuery("#text-typed").typed({
        stringsElement: jQuery('#text-typed-strings'),
        cursorChar: "_",
        typeSpeed: 100,
        startDelay: 2000,
        backSpeed: 80,
        backDelay: 2000,
        loop: true,
        loopCount: 3        
    });	    
	
	// Fixed Element Height
	var mora_headerheight = jQuery('#header').outerHeight();
	
	jQuery('.menu-fixer').css({'height': mora_headerheight});	

    if(typeof mora_custom !== 'undefined') {
        if(mora_custom.mora_header_top == '1') {
            var ptop = jQuery('.page-id-'+mora_custom.mora_id+' .page-title-wrapper').css("padding-top");
            jQuery('.page-id-'+mora_custom.mora_id+' .page-title-wrapper').css({"padding-top": 'calc('+ptop+' + '+mora_headerheight+'px)'});
        }
    }

    if(typeof mora_custom_2 !== 'undefined') {
        if(mora_custom_2.mora_reveal_footer == '1') {
    		jQuery('.footer-reveal').footerReveal({ shadow: false, zIndex: -101 });
        }
    }    


    var mora_hswidth = jQuery('#headersocial').width();
    jQuery('.is-header-social .main-navigation.classic-menu').css({'margin-right': mora_hswidth + 40})
    jQuery('.is-header-social .main-navigation.minimal-menu').css({'margin-right': mora_hswidth + 110})

	var mora_open = false;

	var mora_wrap_li = jQuery("ul#wrap-navigation > li");
	mora_wrap_li.each(function(i) {
		jQuery(this).addClass("animated fadeInUp").addClass("fm-item-" + (i+1));
	});

	var mora_primary_li = jQuery("ul#primary-menu > li");
	mora_primary_li.each(function(i) {
		jQuery(this).addClass("animated fadeInUp").addClass("fm-item-" + (i+1));
	});	
    jQuery('.bm').on('click', function() {
        jQuery(this).find("#burger-menu").toggleClass("active");
        jQuery(this).find(".burger-icon").toggleClass("active");
        if (mora_open == false) {
            jQuery('.nav-trigger').fadeIn(300);
            jQuery('#header').addClass('is-triggered');
            jQuery('#headersocial').addClass('is-triggered');

            mora_open = true;

            // fullscreen menu open
            jQuery('.overlay').fadeIn(200);
        } else {
            jQuery('.nav-trigger').fadeOut(300);
            jQuery('#header').removeClass('is-triggered');
            jQuery('#headersocial').removeClass('is-triggered');
            mora_open = false;

            // fullscreen menu close
            jQuery('.overlay').fadeOut(200);

        }   
        mora_wpml_widget_position();
    });

    if(jQuery("#site-navigation").hasClass('classic-menu')) {
    	mora_wpml_widget_position();
    }


	var mora_windoww = jQuery(window).width();

	if(mora_windoww < 1112) {
	    var mora_leftopen = false;
	    jQuery("#mora-left-side").addClass('is-mobile');

	    jQuery('.menu-to-trigger').on('click', function() {
	    	
	    	if (mora_leftopen == false) {
	    		jQuery('#leftside-content').fadeIn(300);
	    		mora_leftopen = true;
	    	}
	    	else {
	    		jQuery('#leftside-content').fadeOut(300);
	    		mora_leftopen = false;
	    	}
	    });
	    var mora_ismobileleftsidea = jQuery('.is-mobile #leftside-content a');
	    mora_ismobileleftsidea.on('click', function() {
	        jQuery('.is-mobile #leftside-content').fadeOut(300);
	        mora_leftopen = false;
	    });	    
	}
	else {
		jQuery("#mora-left-side").removeClass('is-mobile');
		jQuery('#leftside-content').fadeIn(300);
	}

	jQuery(window).resize(function () {
		var mora_windoww = jQuery(window).width();
		jQuery("#mora-left-side").addClass('is-mobile');

		if(mora_windoww < 1112) {
		    var mora_leftopen = false;

		    jQuery('.menu-to-trigger').on('click', function() {
		    	
		    	if (mora_leftopen == false) {
		    		jQuery('#leftside-content').fadeIn(300);
		    		mora_leftopen = true;
		    	}
		    	else {
		    		jQuery('#leftside-content').fadeOut(300);
		    		mora_leftopen = false;
		    	}
		    });
		    var mora_ismobileleftsidea = jQuery('.is-mobile #leftside-content a');
		    mora_ismobileleftsidea.on('click', function() {
		        jQuery('.is-mobile #leftside-content').fadeOut(300);
		        mora_leftopen = false;
		    });	    
		}		
		else {
			jQuery("#mora-left-side").removeClass('is-mobile');
			jQuery('#leftside-content').fadeIn(300);
		}
	});	


	jQuery('#header #site-navigation .switch-lang').tipsy({fade: true, gravity: 'n', className: 'wpml-switcher'});
	jQuery('#header .overlay .switch-lang').tipsy({fade: true, gravity: 's', className: 'wpml-switcher'});    

    var mora_wrapnava = jQuery('.wrap-nav a');
    mora_wrapnava.on('click', function() {
        jQuery('.overlay').fadeOut(400);
        jQuery('#burger-menu, .burger-icon').removeClass('active');
        mora_open = false;
    });	

    
	var fullscreenul = jQuery('.wrap li.menu-item-has-children');
	fullscreenul.on({
	    mouseenter: function() {
	        jQuery(this).children('ul').slideDown(700);
	    },
	    mouseleave: function() {
	        jQuery(this).children('ul').slideUp(700);
	    }
	})	    

	// Minimum height for content, based on viewport:
	var mora_vph = jQuery(window).height();	
	var mora_sf = jQuery('.site-footer').outerHeight();
	var mora_sh = jQuery('.site-header').outerHeight();
	jQuery(".site-content").css({"min-height": mora_vph - mora_sf - mora_sh});

	// Magnific Popup
	var mora_ightbox = jQuery(".dt-lightbox");
	mora_ightbox.magnificPopup({

	});

	var mora_withlightboxa = jQuery(".with-lightbox a")
	mora_withlightboxa.magnificPopup({
		type: 'image'
	});

	var mora_mfpgallery = jQuery('.dt-gallery');
	mora_mfpgallery.each(function() {
	    jQuery(this).find('.dt-lightbox-gallery').magnificPopup({
	    	type: 'image',
	        gallery: {
	          enabled:true,
	          preload: [0,1]
	        }
	    });
	});				

	var mora_del_gallery = jQuery('.dt-gallery-trigger');
	mora_del_gallery.on('click', function () {
	    jQuery(this).next().magnificPopup('open');
	});

	var mora_dtsinglegal = jQuery('.dt-single-gallery');
	mora_dtsinglegal.each(function () {
	    jQuery(this).magnificPopup({
	        delegate: 'a',
	        type: 'image',
	        gallery: {
	            enabled: true,
	            navigateByImgClick: true
	        },
	        fixedContentPos: false
	    });
	});			


	// smoothscroll effect for custom links
	var mora_smoothscrollbtn = jQuery('.smooth-scroll, .smooth-scroll a');
	mora_smoothscrollbtn.on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = jQuery(this.hash);
		  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
		    jQuery('html,body').animate({
		      scrollTop: target.offset().top
		    }, 900);
		    return false;
		  }
		}
	});	

	var $searchformfatimes = jQuery(".searchform-switch .fa-times-circle");
	var $searchformfasearch = jQuery(".searchform-switch .fa-search");
	var $searchform = jQuery(".searchform-wrapper .search-form");

	$searchform.addClass("display-none");

	$searchformfatimes.fadeOut();
	$searchformfasearch.on('click', function () {
		$searchformfasearch.fadeOut("slow");
		
		$searchform.fadeIn("slow", function(){
			  jQuery(this).removeClass("display-none");
		});
		$searchformfatimes.fadeIn("slow");
	});
	
	$searchformfatimes.on('click', function () {
		$searchformfatimes.fadeOut("slow");
		$searchform.fadeOut("slow", function(){
			  jQuery(this).addClass("display-none");
		});			
		$searchformfasearch.fadeIn("slow");
	});				

	// tooltips for slider hexagons
	jQuery('.dt-hexagon').tipsy({
		gravity: 's',
		fade: true,
		delayIn: 100, 
		title: 'title',
		offset: 34
	})

	// Video in Posts
	var mora_postvideo = jQuery(".post-video");
	mora_postvideo.fitVids();		

	// page title height for flexbox
	var mora_pagetitleheight = jQuery('.page-title-wrapper .container').height();
	jQuery('.page-title-wrapper .flexbase').css({'height': mora_pagetitleheight});	 


	// to top btn
	var mora_offset = 500,
	mora_backtotop = jQuery('.upbtn');

	jQuery(window).scroll(function(){
		( jQuery(this).scrollTop() > mora_offset ) ? mora_backtotop.addClass('dt-is-visible') : mora_backtotop.removeClass('dt-is-visible');
	});	
	
	mora_backtotop.on('click', function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 700);
        return false;
    });			

	var mora_related_prod = jQuery('.related.products li');
    mora_related_prod.removeClass('four three five six').addClass('three');

	//sticky support
	jQuery('.mora-is-sticky').sticky({
		topSpacing:150,
		bottomSpacing: 430
	});


});


jQuery(window).load(function(){
	'use strict';
	// rtl 
	var row_full = jQuery('body.rtl div[data-vc-full-width="true"]');
	var row_pos = row_full.css("left");
	row_full.css({"left": "auto", "right": row_pos});

});

(function($) {
  'use strict';
  
  $.fn.removeDuplicates = function() {
    var $original = $([]);
    
    this.each(function(i, el) {
      var $el = $(el),
          isDuplicate;
      
      $original.each(function(i, orig) {
        if (el.isEqualNode(orig)) {
          isDuplicate = true;
          $el.remove();
        }
      });
      
      if (!isDuplicate) {
        $original = $original.add($el);
      }
    });
    
    return $original;
  };
  
}(jQuery));

jQuery('.svg-more').removeDuplicates();