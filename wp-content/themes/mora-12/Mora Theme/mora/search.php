<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Mora Theme
 */

$mora_data = mora_dt_data();

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

get_header(); ?>

<div class="page-title-wrapper">
	<div class="container">
		<div class="nine columns flexbase">
			<h1><?php esc_html_e('Search Results for: ', 'mora'); ?>"<?php the_search_query(); ?>"</h1>
		</div>

		<div class="three columns flexbase">
			<?php get_search_form(); ?>
		</div>			
	</div>
</div>

<div class="space"></div>

<div class="container">

	<section id="primary" class="content-area percent-blog <?php echo esc_attr($mora_sidebar_pos); ?>">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

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
