<?php
/**
 * Template part for displaying posts.
 *
 * @package Mora Theme
 */

?>

<?php

	$mora_thumb_id = get_post_thumbnail_id($post->ID);
	$mora_alt = get_post_meta($mora_thumb_id, '_wp_attachment_image_alt', true);

?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class('grid-item')); ?>>


	<?php
	if(has_post_format('quote', $post->ID)) {

		$mora_quote_post_text = get_post_meta($post->ID, 'mora_quote_text', true);
		$mora_quote_post_author = get_post_meta($post->ID, 'mora_quote_author', true);
		?>
		<div class="quote-box">
			<p><?php echo esc_html($mora_quote_post_text);?></p>
			<span><?php echo esc_html($mora_quote_post_author);?></span>
		</div>		
	<?php } else { 

	if ( 'post' === get_post_type() ) :
		if ( has_post_thumbnail() ) { ?>
				<div class="post-thumbnail">
					<a href="<?php esc_url(the_permalink()); ?>">
						<div class="blog-grid-hover">
							<span class="read-me-more"><?php echo esc_html('Read More', 'mora'); ?></span>
						</div>						
						<?php 
						the_post_thumbnail('mora-blog-carousel-thumbnail', array('alt'   => $mora_alt)); 
						?>										
					</a>
				</div><!--end post-thumbnail-->		
			<?php } ?>

		<section class="blog-carousel-content-bg">
		
			<header class="entry-header">
				<div class="entry-meta">
					<?php
						$mora_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
							$mora_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
						}

						$mora_time_string = sprintf( $mora_time_string,
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_attr( get_the_modified_date( 'c' ) ),
							esc_html( get_the_modified_date() )
						);

						echo '<span class="posted-on">' . $mora_time_string . '</span>';

					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
						
				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark"><span>', esc_url( get_permalink() ) ), '</span></a></h3>' ); ?>

				<?php the_excerpt(); ?>

			</header><!-- .entry-header -->

			<?php
				$mora_categories_list = get_the_category_list( esc_html__( ' ', 'mora' ) );
				if ( $mora_categories_list && mora_categorized_blog() ) {
					printf( '<span class="cat-links">' . esc_html__( '%1$s', 'mora' ) . '</span>', $mora_categories_list );
				}
			?>	

			<footer class="entry-footer">
				<?php mora_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</section>
	<?php } ?>
</article>