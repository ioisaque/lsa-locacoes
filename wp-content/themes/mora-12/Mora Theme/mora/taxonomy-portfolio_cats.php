<?php
	get_header(); 

$mora_data = mora_dt_data();	
?>

	<div class="page-title-wrapper">
		<div class="container">
			<h2 class="section-title"><?php _e('Category: ', 'mora'); ?><strong><?php single_cat_title(); ?></strong></h2>
			<?php
				$categ_desc = category_description( get_the_category( $id ) ); 

				if($categ_desc != '') { 
				?>
					<h4 class="section-tagline"><?php echo esc_html($categ_desc) ?> </h4>
				<?php } ?>			
		</div>
	</div>
	<div class="space"></div>

	<div class="container">
	<section class="delicious-grid" id="gridwrapper_portfolio">		

		<section id="portfolio-wrapper">		
			<ul class="portfolio grid three-cols dt-gap-15 isotope dt-gallery grid_portfolio">
			
				<?php

				// Begin The Loop
				if (have_posts()) : while (have_posts()) : the_post(); 	

				// Get The Taxonomy 'Filter' Categories
				$mora_terms = get_the_terms( get_the_ID(), 'portfolio_cats' ); 

				$mora_portf_icon = get_post_meta($post->ID,'mora_portf_icon',true);						
				$mora_portf_link = get_post_meta($post->ID,'mora_portf_link',true);						
				$portf_video = get_post_meta($post->ID,'mora_portf_video',true);						
				$mora_portf_thumbnail = get_post_meta($post->ID,'mora_portf_thumbnail',true);	
				
				$mora_lgal = rwmb_meta( 'mora_portf_gallery', 'type=image_advanced&size=full', $post->ID );

				$mora_gal_output = '';
				if(!empty($mora_lgal)) { 
					$mora_gal_output .= '<div class="dt-single-gallery">';
					
					foreach($mora_lgal as $mora_gal_item) {
						$mora_gal_output .= '<a href="'.esc_url($mora_gal_item['url']).'" title="'.esc_attr($mora_gal_item['title']).'"></a>';
					}
					$mora_gal_output .= '</div>';
				}

				$mora_thumb_id = get_post_thumbnail_id($post->ID);
				$mora_image_url = wp_get_attachment_url($mora_thumb_id);
				
				$mora_grid_thumbnail = $mora_image_url;
				$mora_item_class = 'item-small';
				
				switch ($mora_portf_thumbnail) {
					case 'landscape':
						$mora_grid_thumbnail = aq_resize($mora_image_url, 640, 480, true);
						$mora_item_class = 'item-wide';
						break;
					case 'portrait':
						$mora_grid_thumbnail = aq_resize($mora_image_url, 640, 853, true);
						$mora_item_class = 'item-small';
						break;								
				}				
					
				
				?>
				<li class="grid-item">
					<?php	
						if ($mora_portf_icon == 'lightbox_to_image') { ?>
							<a href="<?php echo esc_url(wp_get_attachment_url($mora_thumb_id));?>" class="img-anchor dt-lightbox-gallery" title="<?php esc_attr(the_title()); ?>">
								<div class="project-hover">
									<i class="fa fa-search"></i>
								</div>
								<img src="<?php echo esc_url($mora_grid_thumbnail); ?>" alt="" />
							</a>
						<?php } 
						else if ($mora_portf_icon == 'link_to_page') {  ?>
							<a class="img-anchor" href="<?php esc_url(the_permalink()); ?>">
								<div class="project-hover">
									<i class="fa fa-external-link"></i>
								</div>								
								<img src="<?php echo esc_url($mora_grid_thumbnail); ?>" alt="" />
							</a>
						<?php } 
						else if ($mora_portf_icon == 'link_to_link') {  ?>
							<a class="img-anchor" href='<?php echo esc_url($mora_portf_link); ?>'>
								<div class="project-hover">
									<i class="fa fa-external-link"></i>
								</div>								
								<img src="<?php echo esc_url($mora_grid_thumbnail); ?>" alt="" />
							</a>
						<?php }	
						else if ($mora_portf_icon == 'lightbox_to_video') {  ?>
							<a class="img-anchor dt-lightbox-gallery mfp-iframe" href="<?php echo esc_url($portf_video); ?>" title="<?php esc_attr(the_title()); ?>">
								<div class="project-hover">
									<i class="fa fa-play-circle"></i>
								</div>								
								<img src="<?php echo esc_url($mora_grid_thumbnail); ?>" alt="" />
							</a>
						<?php }	
						if ($mora_portf_icon == 'lightbox_to_gallery') {  ?> 
							<a class="dt-gallery-trigger img-anchor" title="<?php esc_attr(the_title()); ?>" >
								<div class="project-hover">
									<i class="fa fa-picture-o"></i>
								</div>								
								<img src="<?php echo esc_url($mora_grid_thumbnail); ?>" alt="" />
							</a>
						<?php echo '' . $mora_gal_output; } ?>

						<div class="grid-item-on-hover">
							<div class="grid-text">
								<h3><a href="<?php esc_url(the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
								<div class="grid-item-cat">
								<?php
								$mora_copy = $mora_terms;
								if(isset($mora_data['mora_taxonomy_links']) && ($mora_data['mora_taxonomy_links'] =='1')) {
									foreach ( $mora_terms as $mora_term ) {
										$mora_term_link = get_term_link($mora_term->slug, 'portfolio_cats');
										if (function_exists('icl_t')) { 
										   echo '<a href="'.esc_url($mora_term_link).'">'.icl_t('Portfolio Category', 'Term '.delicious_get_taxonomy_cat_ID( $mora_term->name ).'', $mora_term->name).'</a>'; 
										}
										else 
											echo '<a href="'.esc_url($mora_term_link).'">'.esc_html($mora_term->name).'</a>';
											if (next($mora_copy )) {
												echo esc_html__(', ', 'mora');
											}
										}	
								}
								else {
									foreach ( $mora_terms as $mora_term ) {
									if (function_exists('icl_t')) { 
									   echo icl_t('Portfolio Category', 'Term '.delicious_get_taxonomy_cat_ID( $mora_term->name ).'', $mora_term->name);
									}
									else 
										echo esc_html($mora_term->name);
										if (next($mora_copy )) {
											echo esc_html__(', ', 'mora');
										}
									}										
								}

								?>
								</div>									
							</div>

						</div>							
						

				</li>

	
				<?php endwhile; endif; // END the WordPress Loop ?>
			</ul>
			<?php mora_navigation(); ?>
			<?php wp_reset_postdata(); // Reset the Query Loop ?>			
					
		</section>
	</section>
	</div><!--end centered-wrapper-->
	<div class="space"></div>

<?php get_footer(); ?>