function dt_item_on_hover() {
	// Portfolio Grid In and Out Effect //
	var portfoliohover = jQuery('.grid-item a');
	portfoliohover.on({
	    mouseenter: function() {
	       jQuery(this).find('.grid-item-on-hover').animate({ opacity: 1 }, 350);
	    },
	    mouseleave: function() {
	       jQuery(this).find('.grid-item-on-hover').animate({ opacity: 0 }, 350);
	    }
	})	
}

function dt_portfolio_grid_lightboxes() {
	var mfpgallery = jQuery('.mfp-gallery');
	mfpgallery.each(function() {
	    jQuery(this).find('.dt-lightbox-gallery').magnificPopup({
	    	type: 'image',
	        gallery: {
	          enabled:true,
	          preload: [0,1]
	        }
	    });
	});				

	var dtgallery = jQuery('.dt-gallery-trigger');
	jQuery('.dt-gallery-trigger').on('click', function () {
	    jQuery(this).next().magnificPopup('open');
	});

	jQuery('.dt-single-gallery').each(function () {
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

}

jQuery(document).ready(function() {
	'use strict';
	dt_item_on_hover();
	// Isotope for Portfolio

jQuery('.delicious-grid[id^="gridwrapper_"]').each( function() { 

	var $div = jQuery(this);
	var token = $div.data('token');
	var settingObj = window['dt_grid_' + token];	
	
	var $container = '';
	var $optionSets = '';

	var $initial_filter = '';

	if (typeof settingObj === 'undefined') {
		$container = jQuery(" .grid_portfolio");
		$optionSets = jQuery('#gridwrapper_portfolio #filter_options .option-set');
	}
	else {
		if(settingObj.initial_word != '') {
			$initial_filter = '.'+settingObj.initial_word+'';
		}			
		$container = jQuery(".grid_"+settingObj.id+"");
		$optionSets = jQuery('#gridwrapper_'+settingObj.id+'  #filter_options .option-set');
	}



	var colWidth = function () {
		var w = $container.width(), 
			columnNum = 1,
			columnWidth = 0;

		// apply default settings
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


		columnWidth = Math.floor(w/columnNum);

		$container.find('.grid-item').each(function() {
			var $item = jQuery(this);

			var gwidth = 0;

			$item.css({'margin': gwidth/2});
			$item.css({'width': columnWidth});

			if(settingObj.dt_portf_style != 'masonry') { 

				if ($item.hasClass('item-hd')) {
					jQuery('.item-hd').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						// 'height' : Math.round(((columnWidth)-gwidth) * 0.5625) + 'px'
					});
					jQuery('.item-hd img').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : 'auto'
					});	
				}	

				if ($item.hasClass('item-regular')) {
					jQuery('.item-regular').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						// 'height' : Math.round(((columnWidth)-gwidth) * 0.75) + 'px'
					});
					jQuery('.item-regular img').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : 'auto'
					});						
				}	

				if ($item.hasClass('item-portrait')) {
					jQuery('.item-portrait').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						// 'height' : Math.round(((columnWidth)-gwidth) * 1.30) + 'px'
					});
					jQuery('.item-portrait img').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : 'auto'
					});						
				}												

				if ($item.hasClass('item-wide')) {
					if (w < 480) {
						jQuery('.item-wide').css({
							'width'		 : ((columnWidth)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
						});
						jQuery('.item-wide img').css({
							'width'		 : ((columnWidth)-gwidth) + 'px',
							'height' : 'auto'
						});	
					}
					else {
						jQuery('.item-wide').css({
							'width'		 : ((columnWidth*2)-gwidth) + 'px',
							'height' : Math.round((2*(((columnWidth)-gwidth) * 0.7777777))+gwidth) + 'px'
						});
						jQuery('.item-wide img').css({
							'width'		 : ((columnWidth*2)-gwidth) + 'px',
							'height' : 'auto'
						});				
					}
				}	
				
				if ($item.hasClass('item-small')) {
					jQuery('.item-small').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
					});
					jQuery('.item-small img').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : 'auto'
					});						
				}			
					
				if ($item.hasClass('item-long')) {
					if (w < 480) {
						jQuery('.item-long').css({
							'width'		 : ((columnWidth)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777/2) + 'px'
						});
						jQuery('.item-long img').css({
							'width'		 : ((columnWidth)-gwidth) + 'px',
							'height' : 'auto'
						});		
					}
					else {
						jQuery('.item-long').css({
							'width'		 : ((columnWidth*2)-gwidth) + 'px',
							'height' : Math.round(((columnWidth)-gwidth) * 0.7777777) + 'px'
						});
						jQuery('.item-long img').css({
							'width'		 : ((columnWidth*2)-gwidth) + 'px',
							'height' : 'auto'
						});					
					}
				}
				
				if ($item.hasClass('item-high')) {
					jQuery('.item-high').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : Math.round((2*(((columnWidth)-gwidth) * 0.7777777))+gwidth) + 'px'
					});
					jQuery('.item-high img').css({
						'width'		 : ((columnWidth)-gwidth) + 'px',
						'height' : 'auto'
					});				
				}
			}				

		});
		return columnWidth;
	}

	var $del_grid = $container.isotope({
		layoutMode: 'packery',
		masonry: { columnWidth: colWidth(), gutterWidth: 0 },
		itemSelector: '.grid-item',
		filter: $initial_filter,
		percentPosition: true
	});	

	$del_grid.imagesLoaded().progress( function() {
		$del_grid.isotope('layout');
	});


	jQuery(window).on("resize", function(){
		$del_grid.isotope('layout');
		$del_grid.isotope({masonry: { columnWidth: colWidth(), gutterWidth: 0 }});
	});

	var $optionLinks = $optionSets.find('a');
	
	if($initial_filter != '') {
		$optionLinks.each(function(){
			var $this = jQuery(this);
			if ( $this.hasClass('selected') ) {
				$this.removeClass('selected');
			}
			if($this.attr('data-filter') == $initial_filter) {
				$this.addClass('selected');
			}
		});
	}	

	// bind filter button click
	$optionSets.on( 'click', 'li a', function() {
		var filterValue = jQuery( this ).attr('data-filter');
		// use filterFn if matches value
		$del_grid.isotope({ filter: filterValue });
	});
	// change selected class on buttons
	$optionSets.each( function( i, buttonGroup ) {
		var $buttonGroup = jQuery( buttonGroup );
		$buttonGroup.on( 'click', 'li a', function() {
		  $buttonGroup.find('.selected').removeClass('selected');
		  jQuery( this ).addClass('selected');
		});
	});	

	if(settingObj.cat_trigger != "") {
		var open = false;
		var trigger = jQuery('.cat-trigger');
		if(trigger.hasClass('active')) {
			open = true;
		}
	    trigger.on('click', function() {
	        if (open == false) {
	            jQuery('#filter_options').slideDown(400);
	            jQuery(this).removeClass("idle").addClass('active');
	            open = true;
	        } else {
	            jQuery('#filter_options').slideUp(400);
	            jQuery(this).removeClass('active').addClass('idle');
	            open = false;
	        }   
	    });
	}

	if(settingObj.distyle != 'all') {
		// load more btn
	    var ias = jQuery.ias({
	      container: ".portfolio",
	      item: ".grid-item",
	      pagination: ".dt_pagination",
	      next: ".next",
	      delay: 1200
	    });

	    ias.on('render', function(items) {
	      jQuery(items).css({ opacity: 0 });
	      jQuery(items).removeClass('wow');
	    });    


	    ias.on('rendered', function(items) {
			$del_grid.imagesLoaded().done(function() {
				$del_grid.append( items ).isotope( 'appended', items );
				$del_grid.isotope('layout');
				$del_grid.isotope({masonry: { columnWidth: colWidth(), gutterWidth: 0 }});
			});
	   	 	jQuery('.to-hide').remove(); 	
			dt_item_on_hover();	    
			dt_portfolio_grid_lightboxes();
	    });

	    ias.on('loaded', function(data, items) {
	    	$del_grid.isotope();
	    	jQuery(items).css({ opacity: 1 });
	     	jQuery(items).addClass('wow');
	    });

		ias.on('noneLeft', function() {	
		    $del_grid.isotope();
		});	    		

		// load more btn
		if(settingObj.distyle == 'load-more-btn') { 
		    ias.extension(new IASTriggerExtension({
			    text: settingObj.dt_load_more,
			    html: '<div class="ias-wrapper"><div class="ias-trigger ias-trigger-next"><a class="to-trigger">{text}</a></div></div>'
			}));
		}

		// load more infinite
		if(settingObj.distyle == 'load-more-infinite') { 
			ias.extension(new IASSpinnerExtension({
				html: '<div class="ias-wrapper"><div class="ias-infinite-loader">'+settingObj.dt_infinite_loader+'</div></div>'
			}));
		}
	    ias.extension(new IASNoneLeftExtension({html: '<div class="ias-noneleft" style="text-align:center"><p>'+settingObj.dt_no_projects_left+'</p></div>'}));	


	}
	});
});