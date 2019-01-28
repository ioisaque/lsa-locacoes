<?php

// Extending WooCommerce

if(class_exists('WooCommerce')) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	add_filter( 'woocommerce_breadcrumb_defaults', 'mora_woocommerce_breadcrumbs' );
	function mora_woocommerce_breadcrumbs() {
	    return array(
	            'delimiter'   => ' <i class="fa fa-angle-right"></i> ',
	            'wrap_before' => '<nav class="dt-breadcrumbs" itemprop="breadcrumb">',
	            'wrap_after'  => '</nav>',
	            'before'      => '',
	            'after'       => '',
	            'home'        => _x( 'Home', 'breadcrumb', 'mora' ),
	        );
	}

	function mora_products_per_page($cols) {
		global $mora_redux_data;
		$mora_pperpage = 9;
		if(isset($mora_redux_data['mora_woo_products_per_page'])) {
			$mora_pperpage = $mora_redux_data['mora_woo_products_per_page'];
		}
		return $mora_pperpage;
	}

		add_filter( 'loop_shop_per_page', 'mora_products_per_page', 20 );


	add_filter( 'woocommerce_product_description_heading', 'mora_remove_product_description_heading' );
	function mora_remove_product_description_heading() {
	return '';
	}		

}



?>