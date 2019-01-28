<?php 
$mora_data = mora_dt_data();

if((!is_404()) || (!is_search() ) ) { 
	$mora_position = get_post_meta($post->ID, 'mora_page_title_position', true);
}

if (is_singular('portfolio')) {
	if(($mora_data['mora_breadcrumbs_enabled'] == 1) && ($mora_data['mora_breadcrumbs_for']['projects'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($mora_position); ?>">
			<div class="dt-breadcrumbs">
				<?php mora_breadcrumbs(); ?>
			</div>
		</div>
	<?php } 
} else if (is_singular() || is_page_template('template-blog.php')) {
	if(($mora_data['mora_breadcrumbs_enabled'] == 1) && ($mora_data['mora_breadcrumbs_for']['posts'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($mora_position); ?>">
			<div class="dt-breadcrumbs">
				<?php mora_breadcrumbs(); ?>
			</div>
		</div>
	<?php } } else if (is_page()) {
	if(($mora_data['mora_breadcrumbs_enabled'] == 1) && ($mora_data['mora_breadcrumbs_for']['pages'] == 1)) { ?>
		<div class="container for-breadcrumbs <?php echo esc_attr($mora_position); ?>">
			<div class="dt-breadcrumbs">
				<?php mora_breadcrumbs(); ?>
			</div>
		</div>
	<?php } }