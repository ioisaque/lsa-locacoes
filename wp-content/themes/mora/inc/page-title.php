<?php
/**
 * Page title section for this theme
 *
 * @package Mora Theme
 */
if((!is_404()) || (!is_search() ) ) { 
	$mora_tagline = get_post_meta($post->ID, 'mora_page_tagline', true);
	$mora_title = get_post_meta($post->ID, 'mora_page_title', true);
	$mora_position = get_post_meta($post->ID, 'mora_page_title_position', true);
	$mora_blog_post_title = get_post_meta($post->ID, 'mora_blog_post_tagline', true);
}
?>
<?php if($mora_title != '1') { ?>
	<div class="page-title-wrapper">
		<div class="container <?php echo esc_attr($mora_position); ?>">
		<?php
			if(is_home()) { ?>
				<div class="nine columns flexbase">
					<h1><?php esc_html_e("Blog", "mora"); ?></h1>
					<?php
					if(!empty($mora_tagline)) {
					 	echo '<h4>'. esc_html($mora_tagline) . '</h4>';
					} ?>
				</div>
		
				<div class="three columns flexbase">
					<?php get_search_form(); ?>
				</div>				
			<?php }
			else if (is_archive()) { 
				if (have_posts()) : 
					$mora_post = $posts[0];				
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<h4>', '</h4>' ); 
				endif; 					
			}
			else if (is_page_template('template-blog.php')) { ?>	
				<div class="nine columns flexbase">
					<?php echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
					if(!empty($mora_tagline)) {
					 	echo '<h4>'. esc_html($mora_tagline) . '</h4>';
					} ?>
				</div>
		
				<div class="three columns flexbase">
					<?php get_search_form(); ?>
				</div>
			<?php }
			else if (is_page()) {
				 echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
				if(!empty($mora_tagline)) {
				 	echo '<h4>'. esc_html($mora_tagline) . '</h4>';
				}
			} 	
			else if ('portfolio' == get_post_type()) {
				 echo '<h1>'. esc_html(get_the_title()) . '</h1>'; 
				if(!empty($mora_tagline)) {
				 	echo '<h4>'. esc_html($mora_tagline) . '</h4>';
				}				
			}					
			else if (is_single()) {
				echo '<h1>'. wp_kses_post(get_the_title()) . '</h1>'; 
				if(isset($mora_blog_post_title)) {
					if($mora_blog_post_title != '') {
						echo '<h3 class="delicious-post-title">'.wp_kses_post($mora_blog_post_title).'</h3>';
					}
				}
				echo '<header class="entry-header"><div class="entry-meta">';
				mora_posted_on();
				echo '</div></header>';
			}
			?>

		</div>
	</div>	

<?php get_template_part( 'inc/page-title-breadcrumbs' ); ?>

	<div class="space under-title"></div>

<?php } ?> 