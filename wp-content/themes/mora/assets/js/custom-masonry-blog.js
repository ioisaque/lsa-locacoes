jQuery(document).ready(function() {
	'use strict';
	
	var $blog_masonry = jQuery('.blog-masonry .grid-content').isotope({
		masonry: {
		  columnWidth: '.grid-item',
		  gutter: '.gutter-sizer'
		},
		itemSelector: '.grid-item',
		percentPosition: true
	});		

	$blog_masonry.imagesLoaded().progress( function() {
		$blog_masonry.isotope('layout');		
	});		

	jQuery(window).resize(function() {
		$blog_masonry.isotope('layout');
	});
})
