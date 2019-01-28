<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mora Theme
 */


if ( ! function_exists( 'mora_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mora_posted_on() {
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

	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$mora_categories_list = get_the_category_list( esc_html__( ', ', 'mora' ) );
		if ( $mora_categories_list && mora_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'mora' ) . '</span>', $mora_categories_list ); // WPCS: XSS OK.
		}
	}	


	if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'mora' ), esc_html__( '1 Comment', 'mora' ), esc_html__( '% Comments', 'mora' ) );
		echo '</span>';
	}	

}
endif;

if ( ! function_exists( 'mora_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mora_entry_footer() {
	$mora_data = mora_dt_data();
	if(is_single()) { 
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			if(isset($mora_data['mora_tags_list'])) { 
				if($mora_data['mora_tags_list'] =='1') {
					/* translators: used between list items, there is a space after the comma */
					$mora_tags_list = get_the_tag_list();
						if ( $mora_tags_list ) {
							printf( '<span class="tags-links">' . esc_html__( '%1$s', 'mora' ) . '</span>', $mora_tags_list ); // WPCS: XSS OK.
						}
					}
			}
			else {
				$mora_tags_list = get_the_tag_list();
				if ( $mora_tags_list ) {
					printf( '<span class="tags-links">' . esc_html__( '%1$s', 'mora' ) . '</span>', $mora_tags_list ); // WPCS: XSS OK.
				}				
			}
		}

		edit_post_link( esc_html__( 'Edit', 'mora' ), '<span class="edit-link">', '</span>' );
	}
}
endif;

if(! function_exists('mora_author')) {
	function mora_author() {
		if ( 'post' === get_post_type() ) {
			$mora_author_bio = get_the_author_meta('description');
			if($mora_author_bio != '') {
				echo '<div class="author-bio">';
					echo get_avatar( get_the_author_meta('user_email'), '70', '' );
					echo '<div class="author-description">';
						echo '<span>'.esc_html__('Author', 'mora').'</span>';
						echo '<h3>'. get_the_author_link().'</h3>';
						echo '<p>'.$mora_author_bio.'</p>';
					echo '</div>';
				echo '</div>';					
			}

		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mora_categorized_blog() {
	if ( false === ( $mora_the_cool_cats = get_transient( 'mora_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$mora_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$mora_the_cool_cats = count( $mora_the_cool_cats );

		set_transient( 'mora_categories', $mora_the_cool_cats );
	}

	if ( $mora_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mora_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mora_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mora_categorized_blog.
 */
function mora_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mora_categories' );
}
add_action( 'edit_category', 'mora_category_transient_flusher' );
add_action( 'save_post',     'mora_category_transient_flusher' );
