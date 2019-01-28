<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Mora Theme
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area percent-sidebar">
		<?php	
		$mora_sidebars = get_post_meta($post->ID, 'mora_all_sidebars', true);
		if(!empty($mora_sidebars)) { 
				dynamic_sidebar( $mora_sidebars );
		}

		else {
			if ( is_active_sidebar( 'sidebar' ) ) { 
				dynamic_sidebar( 'sidebar' ); 
				}		
			}
		?>
</div><!-- #secondary -->
