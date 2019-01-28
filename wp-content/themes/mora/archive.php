<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mora Theme
 */

get_header(); ?>

<?php $mora_data = mora_dt_data(); ?>

<?php get_template_part( 'inc/page-title' ); ?>

<?php 
	$mora_ns = '';
	$mora_sidebar_pos = 'sidebar-right';
	if(isset($mora_data['mora_blog_sidebar_pos'])) {
		if($mora_data['mora_blog_sidebar_pos'] == 'no-blog-sidebar') {
			$mora_ns = 'nu-sidebar'; 
		}
		if($mora_data['mora_blog_sidebar_pos'] !='') {
			$mora_sidebar_pos = $mora_data['mora_blog_sidebar_pos'];
		}

	} 
?>

<div class="container">

	<div id="primary" class="content-area percent-blog <?php echo esc_attr($mora_sidebar_pos); ?>">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
		echo '<div id="secondary" class="widget-area percent-sidebar '.esc_attr($mora_ns).'"">';
			if(isset($mora_data['mora_blog_sidebar'])) {
				if($mora_data['mora_blog_sidebar'] !='') { 
					$mora_blog_sidebar_pos = $mora_data['mora_blog_sidebar']; 
					dynamic_sidebar($mora_blog_sidebar_pos); 
				}
			}
			else dynamic_sidebar('sidebar');
		echo '</div>';
	?>

</div>
<?php get_footer(); ?>
