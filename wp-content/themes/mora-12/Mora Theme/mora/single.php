<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

			<?php if(isset($mora_data['mora_social_box'])) { if($mora_data['mora_social_box'] =='1') { ?>						
				<div class="share-options align-center">
					<h6><?php esc_html_e("Share this Article", "mora"); ?></h6>
					<a href="" class="twitter-sharer" onClick="twitterSharer()"><i class="fa fa-twitter"></i></a>
					<a href="" class="facebook-sharer" onClick="facebookSharer()"><i class="fa fa-facebook"></i></a>
					<a href="" class="pinterest-sharer" onClick="pinterestSharer()"><i class="fa fa-pinterest"></i></a>
					<a href="" class="google-sharer" onClick="googleSharer()"><i class="fa fa-google-plus"></i></a>
					<a href="" class="linkedin-sharer" onClick="linkedinSharer()"><i class="fa fa-linkedin"></i></a>
				</div>
				
			<?php  } } ?>		


			<?php if(isset($mora_data['mora_prev_next_posts'])) { if($mora_data['mora_prev_next_posts'] =='1') { 
			 	the_post_navigation(
				array(
					'prev_text' => '<span>'. esc_html__('Previous Article', 'mora').'</span>%title',
					'next_text' => '<span>'. esc_html__('Next Article', 'mora').'</span>%title'
				));

			 } }
			 else {
			 	the_post_navigation(
				array(
					'prev_text' => '<span>'. esc_html__('Previous Article', 'mora').'</span>%title',
					'next_text' => '<span>'. esc_html__('Next Article', 'mora').'</span>%title'
				));			 	
			 } ?>
			
			<?php if(isset($mora_data['mora_author_box'])) { if($mora_data['mora_author_box'] =='1') { 
				mora_author(); 
			} }
			else {
				mora_author(); 
			} ?>	

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
		echo '<div id="secondary" class="widget-area percent-sidebar '.esc_attr($mora_ns).'"">';
			if(isset($mora_data['mora_blog_sidebar'])) {
				if($mora_data['mora_blog_sidebar'] !='') { 
					$mora_sideb = $mora_data['mora_blog_sidebar']; 
					dynamic_sidebar($mora_sideb); 
				}
			}
			else dynamic_sidebar('sidebar');
		echo '</div>';
	?>


</div>
<div class="space"></div>
<?php get_footer(); ?>
