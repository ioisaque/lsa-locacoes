function gallery_item_on_hover() {
	// Portfolio Grid In and Out Effect //
	var galleryhover = jQuery('.delicious-gallery-item a');
	galleryhover.on({
	    mouseenter: function() {
	       jQuery(this).find('.delicious-gallery-on-hover').animate({ opacity: 1 }, 350);
	    },
	    mouseleave: function() {
	       jQuery(this).find('.delicious-gallery-on-hover').animate({ opacity: 0 }, 350);
	    }
	})	
}

jQuery.extend(jQuery.lazyLoadXT, {
  selector: '.go-lazy',
  edgeY:  100,
  srcAttr: 'data-src'
});
jQuery.lazyLoadXT.updateEvent += ' layoutComplete';

jQuery(document).ready(function() {	
	'use strict';

	gallery_item_on_hover();


	jQuery('.delicious-gallery-wrapper[id^="dt-gallery-"]').each( function() { 	

		var $div = jQuery(this);
		var token = $div.data('token');

		var settingObj = window['dt_gl_' + token];	

		var $container = jQuery('#dt-gallery-'+settingObj.id+' .delicious-gallery');

		var $optionSets = '';
		if(settingObj.gallery_type == 'g-with-filters') {
			$optionSets = jQuery('#dt-gallery-'+settingObj.id+'  #gallery_filter_options .gallery-option-set');	
		}
		

	$container.each(function() {
		jQuery(this).find('.no-lazy').addClass('wow fadeInUp');
	})

	var colWidth = function () {
		var w = $container.width(), 
			columnNum = 1,
			colw = 0;
			if (w > 1800) {
				columnNum  = settingObj.dt_columns_big_pc;
			} else if (w > 1440) {
				columnNum  = settingObj.dt_columns_pc;
			} else if (w > 1279) {
				columnNum  = settingObj.dt_columns_laptop;
			} else if (w > 1023) {
				columnNum  = settingObj.dt_columns_small_laptop;
			} else if (w > 767) {
				columnNum  = settingObj.dt_columns_tablet;
			} else if (w > 479) {
				columnNum  = settingObj.dt_columns_mobile;
			}	


		colw = Math.floor(w/columnNum);	

		$container.find('.delicious-gallery-item').each(function() {
			var $item = jQuery(this);

			$item.css({'width': colw});
			if(settingObj.grid_type != 'is-masonry') { 
				jQuery($item).css({
					'width'		 : (colw) + 'px',
					'height' : 2 * Math.floor(((colw) * 0.7763157894736842)/2) + 'px'
				});
				jQuery($item).find('img').css({
					'width'		 : ((colw)) + 'px',
					'height' : 'auto'
				});	

				if ($item.hasClass('twobytwo')) {
					jQuery('.twobytwo').css({
						'width'		 : (colw * 2) + 'px',
						'height' : 4 * Math.floor(((colw) * 0.7763157894736842)/2) + 'px'
					});
					jQuery('.twobytwo img').css({
						'width'		 : ((colw * 2)) + 'px',
						'height' : 'auto'
					});	
				}	

				if ($item.hasClass('twobyone')) {
					jQuery('.twobyone').css({
						'width'		 : (colw * 2) + 'px',
						'height' : 2* Math.floor(((colw) * 0.7763157894736842)/2) + 'px'
					});
					jQuery('.twobyone img').css({
						'width'		 : ((colw * 2)) + 'px',
						'height' : 'auto'
					});	
				}				

				if ($item.hasClass('onebytwo')) {
					jQuery('.onebytwo').css({
						'width'			: colw,
						'height' : 4 * Math.floor((( colw ) * 0.7763157894736842)/2) + 'px'
					});
					jQuery('.onebytwo img').css({
						'width'			: colw,
						'height'		 : 'auto'
					});	
				}	
			}						

		});		

		return colw;
	}		

		var $gal_grid = $container.isotope({
			layoutMode: 'packery',
			packery: {
			  	columnWidth: colWidth(),				
			},
			itemSelector: '.delicious-gallery-item',
			percentPosition: true,			
		});	

		if(settingObj.gallery_type == 'g-with-filters') {
			//filters
			var $optionLinks = $optionSets.find('a');
			// bind filter button click
			$optionSets.on( 'click', 'li a', function() {
				var filterValue = jQuery( this ).attr('data-filter');
				// use filterFn if matches value
				$gal_grid.isotope({ filter: filterValue });
			});
			// change selected class on buttons
			$optionSets.each( function( i, buttonGroup ) {
				var $buttonGroup = jQuery( buttonGroup );
				$buttonGroup.on( 'click', 'li a', function() {
				  $buttonGroup.find('.selected').removeClass('selected');
				  jQuery( this ).addClass('selected');
				});
			});		
		}			

		jQuery.lazyLoadXT.onload = function() {
			var $el = jQuery(this); 
		    $el
		        .removeClass('lazy-hidden')
		        .addClass('animated fadeInUp'); 
			$gal_grid.isotope('layout');			             
		};  

	    $gal_grid.isotope('on', 'layoutComplete', function() {
	        jQuery(window).trigger('layoutComplete');
	    });			

		jQuery(window).resize(function() {
			$gal_grid.isotope('layout');
			$gal_grid.isotope({
				layoutMode: 'packery',
			packery: {
			  	columnWidth: colWidth(),				
			},
			itemSelector: '.delicious-gallery-item',
			percentPosition: true,	
			});	
		});		
});
		
});