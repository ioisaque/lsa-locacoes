<?php
/**
 * Template part for displaying posts.
 *
 * @package Mora Theme
 */

?>

<?php
	$mora_quote_post_text = get_post_meta($post->ID, 'mora_quote_text', true);
	$mora_quote_post_author = get_post_meta($post->ID, 'mora_quote_author', true);
?>

<article id="post-<?php esc_attr(the_ID()); ?>" <?php esc_attr(post_class('grid-item')); ?>>
	<div class="quote-box">
		<p><?php echo esc_html($mora_quote_post_text);?></p>
		<span><?php echo esc_html($mora_quote_post_author);?></span>
	</div>	
</article>