<?php
/**
 * Template part for displaying posts.
 *
 * @package Mora Theme
 */

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>

	<?php 
		$mora_video_class = new mora_Delicious;
		$mora_video_class->mora_video($post->ID); 
	 ?>

	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if(!is_single()) { ?>
				<?php mora_posted_on(); ?>
			<?php } ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
				
		<?php if(!is_single()) { ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php } ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			mora_more_tag();
			the_content(esc_html__('Read More', 'mora'));
		
		?>

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
