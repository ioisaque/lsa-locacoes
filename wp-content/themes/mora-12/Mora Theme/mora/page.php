<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mora Theme
 */

$mora_tagline = get_post_meta($post->ID, 'mora_page_tagline', true);
$mora_title = get_post_meta($post->ID, 'mora_page_title', true);

get_header(); ?>
	
<?php get_template_part( 'inc/page-title' ); ?>

<div class="container">	

	<div id="primary" class="content-area percent-page <?php echo esc_attr($mora_delicious::mora_sidebar_position($post->ID)) ?>">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>



				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>


		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
		$mora_sid_pos = get_post_meta($post->ID, 'mora_sidebar_position', true);
		if($mora_sid_pos == '') {
			$mora_sid_pos = 'sidebar-right';
		}
		if(($mora_sid_pos === 'sidebar-right') || ($mora_sid_pos === 'sidebar-left')) 
			get_sidebar(); 
	?>
</div>
<?php get_footer(); ?>
