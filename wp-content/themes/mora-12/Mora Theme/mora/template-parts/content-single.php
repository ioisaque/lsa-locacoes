<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mora Theme
 */

?>


<?php

	$mora_thumb_id = get_post_thumbnail_id($post->ID);
	$mora_alt = get_post_meta($mora_thumb_id, '_wp_attachment_image_alt', true);

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>

	<div class="post-thumbnail">
		<?php the_post_thumbnail('mora-blog-thumbnail', array('alt'   => $mora_alt)); ?>
	</div><!--end post-thumbnail-->		

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php mora_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mora' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mora_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

