<?php
/*

Template Name: Blog Template

 */

$mora_blog_layout = get_post_meta($post->ID, 'mora_blog_layout', true);

$mora_layout_class = '';
$mora_sidebar_class = '';
$mora_column_class = '';

$mora_sidebar = array('regular-right', 'regular-left', 'masonry-2-cols-sr', 'masonry-2-cols-sl');

switch($mora_blog_layout) {
	case 'regular-right':
		$mora_sidebar_class = 'sidebar-right percent-blog';
	break;

	case 'regular-left':
		$mora_sidebar_class = 'sidebar-left percent-blog';
	break;

	case 'regular':
		$mora_sidebar_class = 'no-sidebar';
	break;

	case 'masonry-3-cols':
		$mora_layout_class = 'blog-masonry';
		$mora_sidebar_class = 'no-sidebar';
		$mora_column_class = 'on-three-columns';
	break;

	case 'masonry-2-cols':
		$mora_layout_class = 'blog-masonry';
		$mora_sidebar_class = 'no-sidebar';
		$mora_column_class = 'on-two-columns';
	break;

	case 'masonry-2-cols-sr':
		$mora_layout_class = 'blog-masonry';
		$mora_sidebar_class = 'sidebar-right percent-blog';
		$mora_column_class = 'on-two-columns';
	break;

	case 'masonry-2-cols-sl':
		$mora_layout_class = 'blog-masonry';
		$mora_sidebar_class = 'sidebar-left percent-blog';
		$mora_column_class = 'on-two-columns';
	break;

		
}

?>

<?php get_header(); ?>

<?php get_template_part( 'inc/page-title' ); ?>

	<?php
		if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php the_content(); ?>		

	<?php endwhile; ?>

	<?php endif;
	 ?>		
	
	<div class="container">

	<?php

		$mora_args = array(
			'post_type'=> 'post',
			'paged'=>$paged
		);	

		$mora_blog_query = new WP_Query($mora_args);
	?>

	<div id="primary" class="content-area <?php echo esc_attr($mora_sidebar_class); ?>">
		<main id="main" class="site-main <?php echo esc_attr($mora_layout_class).' '.esc_attr($mora_column_class); ?>">
			<?php if ($mora_layout_class == 'blog-masonry') { ?>
				<div class="grid-content">
					<div class="gutter-sizer"></div>
			<?php } ?>
				
			<?php 
			if ($mora_blog_query->have_posts()) :  while ($mora_blog_query->have_posts()) : $mora_blog_query->the_post(); 

				if ($mora_layout_class != 'blog-masonry') {
					get_template_part( 'template-parts/content', get_post_format() );
				} else {
					get_template_part( 'template-parts/content', 'blog-grid-shortcode' );
				}	
				endwhile;
			endif;  
			?>	
				<div class="clear"></div>
			<?php if ($mora_layout_class == 'blog-masonry') { ?>	
				</div><!-- .grid-content -->
			<?php } ?> 

			<?php mora_navigation(); ?>
			
			<?php wp_reset_postdata(); ?>

		</main><!-- #main -->
		
	</div><!-- #primary -->

	<?php if (in_array($mora_blog_layout, $mora_sidebar)) { 
		get_sidebar(); 
	} ?>

	<div class="space"></div>
</div><!--end container-->

<?php get_footer();
