<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mora Theme
 */

?>
<?php $mora_data = mora_dt_data(); ?>

	</div><!-- #content -->

	<?php  
		$mora_fclass = '';
		if(isset($mora_data['mora_footer_layout'])) {
				$mora_fclass = $mora_data['mora_footer_layout'];
		} 

		$mora_reveal_class = '';
		if(isset($mora_data['mora_footer_reveal']) && ($mora_data['mora_footer_reveal'] == '1')) { 
				$mora_reveal_class = 'footer-reveal';
		} 


 		$mora_footer_scheme = 'light-footer';
 		if(isset($mora_data['mora_footer_scheme'])) { 
 			$mora_footer_scheme = $mora_data['mora_footer_scheme']; 
 		} 

	 	 ?> 		


<?php if(isset($mora_data['mora_custom_footer']) && ($mora_data['mora_custom_footer'] == '1')) { 

	if(isset($mora_data['mora_custom_footer_pages']) && ($mora_data['mora_custom_footer_pages'] != '')) {
		echo '<div class="custom-footer '.esc_attr($mora_reveal_class).'">';
			echo '<div class="container">';
				$post_custom_css = get_post_meta( $mora_data['mora_custom_footer_pages'], '_wpb_shortcodes_custom_css', true );
				echo "<style>". $post_custom_css . "</style>";

				echo apply_filters( 'the_content', get_post_field('post_content', $mora_data['mora_custom_footer_pages']) );
			echo '</div>';
		echo '</div>';
	}
} else {
	?>	

	<footer id="colophon" class="site-footer <?php echo esc_attr($mora_footer_scheme) . ' '. esc_attr($mora_fclass) . ' ' . esc_attr($mora_reveal_class); ?>">

		
		<?php
		if ( is_active_sidebar( 'footer' ) ) : ?>	
		<div class="container">	

			<?php 
				$mora_del = new Mora_Delicious(); 
				$mora_footer_widgets = '';
				$mora_footer_widgets = $mora_del->mora_count_sidebar_widgets( 'footer', false ); 
			?>

			<div id="topfooter" class="<?php echo 'widno-'.$mora_footer_widgets; ?>">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div><!--end topfooter-->
			
		</div><!--end container-->
		<?php endif; ?>	


		<div class="container">
			<?php 
			if(isset($mora_data['mora_svg_footer_enabled']) && ($mora_data['mora_svg_footer_enabled'] == '1')) { 
					if(isset($mora_data['mora_svg_footer_logo']['url']) && ($mora_data['mora_svg_footer_logo']['url'] !='')) {
					?>
				<div class="footer-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img class="is-svg" src="<?php echo esc_url($mora_data['mora_svg_footer_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" width="<?php echo esc_attr($mora_data['mora_svg_footer_logo_width']); ?>" height="<?php echo esc_attr($mora_data['mora_svg_footer_logo_height']); ?>" /></a>
				</div>
			<?php	
			} }
			else if(isset($mora_data['mora_footer_logo']['url']) && ($mora_data['mora_footer_logo']['url'] !='')) { ?>
				<div class="footer-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr(bloginfo( 'name' )); ?>" rel="home"><img src="<?php echo esc_url($mora_data['mora_footer_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )) ?>" /></a>
				</div>
			<?php } ?>		

			<ul id="social" class="align-center">
				<?php
					$mora_social_links = array('rss','facebook','twitter','flickr','google-plus', 'dribbble' , 'linkedin', 'pinterest', 'youtube', 'github-alt', 'vimeo-square', 'instagram', 'tumblr', 'behance', 'vk', 'xing', 'soundcloud', 'codepen', 'yelp', 'slideshare', 'houzz', '500px', 'tripadvisor');
					if($mora_social_links) {
						foreach($mora_social_links as $mora_social_link) {
							if(!empty($mora_data[$mora_social_link])) { echo '<li><a href="'. esc_url($mora_data[$mora_social_link]) .'" title="'. esc_attr($mora_social_link) .'" class="'.esc_attr($mora_social_link).'"  target="_blank"><i class="fa fa-'.esc_attr($mora_social_link).'"></i></a></li>';
							}								
						}
						if(!empty($mora_data['skype'])) { echo '<li><a href="skype:'. esc_attr($mora_data['skype']) .'?call" title="'. esc_attr($mora_data['skype']) .'" class="'.esc_attr($mora_data['skype']).'"  target="_blank"><i class="fa fa-skype"></i></a></li>';
						}							
					}
				?>
			</ul>
			<div class="site-info">
				<?php $url = 'http://www.sige.pro.br/padraoWeb/divulgacao_online/'; ?>
				<?=file_get_contents($url.'rodape_light.html');?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

<?php } ?>

	<a class="upbtn" href="#">
		<svg class="arrow-top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="25 25 50 50" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M42.8,47.5c0.4,0.4,1,0.4,1.4,0l4.8-4.8v21.9c0,0.6,0.4,1,1,1s1-0.4,1-1V42.7l4.8,4.8c0.4,0.4,1,0.4,1.4,0   c0.4-0.4,0.4-1,0-1.4L50,38.9l-7.2,7.2C42.4,46.5,42.4,47.1,42.8,47.5z"/></g></svg>
	</a>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
