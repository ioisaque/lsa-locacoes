// Blog Carousel
jQuery(document).ready(function() {	
	'use strict';
	jQuery('.dt-blog-shortcode[id^="dt-blog-grid-"]').each( function() { 	

		var $div = jQuery(this);
		var token = $div.data('token');

		var settingObj = window['dt_bg_' + token];	

		var $blog_grid_container = jQuery("#dt-blog-grid-"+settingObj.id+" .blog-grid-content");

		var $blog_grid = $blog_grid_container.imagesLoaded().done( function() {
		$blog_grid.isotope({
			masonry: {
			  columnWidth: '.grid-item',
			  gutter: '.gutter-sizer'
			},
			itemSelector: '.grid-item',
			percentPosition: true
		});	

		jQuery(window).resize(function() {
			$blog_grid.isotope('layout');
			$blog_grid.isotope({
			masonry: {
			  columnWidth: '.grid-item',
			  gutter: '.gutter-sizer'
			},
			itemSelector: '.grid-item',
			percentPosition: true
			});	
		});			

	});

	});
});