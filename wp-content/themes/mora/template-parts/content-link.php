<?php
/**
 * Template part for displaying posts.
 *
 * @package Mora Theme
 */

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class()); ?>>

<?php
	$mora_link_url = get_post_meta($post->ID, 'mora_link_url', true);
	$mora_thumb_id = get_post_thumbnail_id($post->ID);
	$mora_alt = get_post_meta($mora_thumb_id, '_wp_attachment_image_alt', true);
?>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail">
			<a target="_blank" href="<?php echo esc_url($mora_link_url) ; ?>">
				<?php the_post_thumbnail('mora-blog-thumbnail', array('alt'   => $mora_alt)); ?>
			</a>
		</div><!--end post-thumbnail-->		
	<?php } ?>

	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if(!is_single()) { ?>
				<?php mora_posted_on(); ?>
			<?php } ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
				
		<?php if(!is_single()) { ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a target="_blank" href="%s" rel="bookmark">', esc_url( $mora_link_url ) ), '</a></h2>' ); ?>
		<?php } ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			mora_more_tag();
			the_content(esc_html__('Read More', 'mora'));
		
		?>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mora_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
