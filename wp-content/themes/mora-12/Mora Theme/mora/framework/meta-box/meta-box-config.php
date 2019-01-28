<?php

add_filter( 'rwmb_meta_boxes', 'mora_register_meta_boxes' );

function mora_register_meta_boxes( $mora_meta_boxes )
{

	$mora_prefix = 'mora_';

	$mora_img_dir_path = get_template_directory_uri(). '/framework/meta-box/meta-box-extensions/images/';

	$mora_class_var = new mora_Delicious;
	$mora_all_sidebars = $mora_class_var->mora_my_sidebars();


	$mora_menus = wp_get_nav_menus();
	
	global $mora_menu_array;
	$mora_menu_array = array('' => '-');
	foreach ($mora_menus as $mora_menu) {
		$mora_option = $mora_menu->name;
		$mora_menu_array[$mora_menu->name] = $mora_option;
	}	

	$mora_meta_boxes[] = array(
		'id'         => 'mora_page_layout_metaboxes',
		'title'      => esc_html__( 'Page Layout', 'mora' ),
		'post_types' => array( 'page' ),
		'context'    => 'side',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'default', 'template-blog.php'),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Sidebar Position', 'mora' ),
				'id'      => "{$mora_prefix}sidebar_position",
				'type'    => 'image_select',
				'options' => array(
					'no-sidebar' => $mora_img_dir_path.'no-blog-sidebar.png',
					'sidebar-right' => $mora_img_dir_path.'sidebar-right.png',
					'sidebar-left' => $mora_img_dir_path.'sidebar-left.png',
				),
				'std'	=> 'no-sidebar',		
	            'multiple' => false,				
			),
			array(
				'name'        => esc_html__( 'Pick a Sidebar', 'mora' ),
				'id'          => "{$mora_prefix}all_sidebars",
				'type'        => 'select_advanced',
				'options'     => $mora_all_sidebars,
				'multiple'    => false,
				'std'		  => 'sidebar'
			),				
		),
	);			

	$mora_meta_boxes[] = array(
		'id'         => 'mora_blog_metaboxes',
		'title'      => esc_html__( 'Blog Layout Options', 'mora' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'template-blog.php' ),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Blog Layout', 'mora' ),
				'id'      => "{$mora_prefix}blog_layout",
				'type'    => 'image_select',
				'options' => array(
					'masonry-3-cols' => $mora_img_dir_path.'masonry-3-cols.png',
					'masonry-2-cols-sr' => $mora_img_dir_path.'masonry-2-cols-sidebar-right.png',
					'masonry-2-cols-sl' => $mora_img_dir_path.'masonry-2-cols-sidebar-left.png',
					'masonry-2-cols' => $mora_img_dir_path.'masonry-2-cols.png',
					'regular-right' => $mora_img_dir_path.'sidebar-right.png',
					'regular-left' => $mora_img_dir_path.'sidebar-left.png',
					'regular' => $mora_img_dir_path.'no-blog-sidebar.png',
				),
				'std'	=> 'masonry-3-cols',			
			),		
		),
	);		


	$mora_meta_boxes[] = array(
		'id'         => 'mora_blog_video_metaboxes',
		'title'      => esc_html__( 'Video Post Format Options', 'mora' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'video' ),		
		'fields'     => array(
			array(
				'name'  => esc_html__( 'External URL(embed YouTube or Vimeo videos )', 'mora' ),
				'id'    => "{$mora_prefix}external_video_block",
				'desc'  => esc_html__( 'Use an YouTube or Vimeo page URL(ex: http://www.youtube.com/watch?v=x6qe_kVaBpg). The embed code will be automatically created.', 'mora' ),
				'type'  => 'text',
				'size'	=> 50,
			),	
		),
	);	

	$mora_meta_boxes[] = array(
		'id'         => 'mora_quote_post_metaboxes',
		'title'      => esc_html__( 'Quote Post Format Options', 'mora' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'quote' ),		
		'fields'     => array(
			array(
				'name'  => esc_html__( 'Quote Text', 'mora' ),
				'id'    => "{$mora_prefix}quote_text",
				'type'  => 'textarea',
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'Quote Author', 'mora' ),
				'id'    => "{$mora_prefix}quote_author",
				'type'  => 'text',
				'size'	=> 50,
			),				
		),
	);		

	$mora_meta_boxes[] = array(
		'id'         => 'mora_link_post_metaboxes',
		'title'      => esc_html__( 'Link Post Format Options', 'mora' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'link' ),		
		'fields'     => array(
			array(
				'name'  => esc_html__( 'Link URL', 'mora' ),
				'id'    => "{$mora_prefix}link_url",
				'type'  => 'text',
				'size'	=> 50,
			),				
		),
	);			

	$mora_meta_boxes[] = array(
		'id'         => 'mora_blog_gallery_metaboxes',
		'title'      => esc_html__( 'Gallery Post Format Options', 'mora' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'visible'   => array( 'post_format', 'gallery' ),		
		'fields'     => array(
			array(
				'name'             => esc_html__( 'Post Slider Images', 'mora' ),
				'id'               => "{$mora_prefix}blog_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 30,
				'desc'			   => esc_html__( 'Upload new images or select them from the media library. (Ctrl/CMD + Click for selecting multiple items at once)', 'mora' )
			),	
		),
	);				

if ( post_type_exists( 'portfolio' ) ) {
	$mora_meta_boxes[] = array(
		'id'         => 'mora_portfolio_metaboxes',
		'title'      => esc_html__( 'Portfolio Options', 'mora' ),
		'post_types' => array( 'page' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'show'   => array(
			'relation'    => 'OR',
			'template'    => array( 'template-portfolio.php' ),
		),			
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Layout', 'mora' ),
				'id'      => "{$mora_prefix}portfolio_columns",
				'type'    => 'image_select',
				'options' => array(
					'grid' => $mora_img_dir_path.'masonry-3-cols.png'
				),
				'std'	=> 'grid',			
			),		
			array(
				'name'        => esc_html__( 'Grid Columns', 'mora' ),
				'id'          => "{$mora_prefix}masonry_grid_columns",
				'type'        => 'select_advanced',
				'options'     => array(
						'two-cols' => esc_html__( '2', 'mora' ),
						'three-cols' => esc_html__( '3', 'mora' ),
						'four-cols' => esc_html__( '4', 'mora' ),
						'five-cols' => esc_html__( '5', 'mora' ),
					),
				'std' 		  => 'three-cols',
				'multiple'    => false,
			),				
			array(
				'name' => esc_html__( 'With Filter', 'mora' ),
				'id'   => "{$mora_prefix}portfolio_navigation",
				'desc'  => esc_html__( 'Check the box to enable filters above the portfolio grid.', 'mora' ),
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name'    => esc_html__( 'Categories/Filters', 'mora' ),
				'id'      => "{$mora_prefix}cats_field",
				'type'    => 'taxonomy',
				'desc'	  => esc_html__('Select from which categories to display projects in the grid.', 'mora'),
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'portfolio_cats',
					'type'     => 'checkbox_tree',
					'args'     => array()
				),
			),						
		),
	);	
}


	$mora_meta_boxes[] = array(
		'id'         => 'mora_standard',
		'title'      => esc_html__( 'Page Options (optional)', 'mora' ),
		'post_types' => array( 'page', 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'        => esc_html__( 'Title Position', 'mora' ),
				'id'          => "{$mora_prefix}page_title_position",
				'type'        => 'select_advanced',
				'options'     => array(
					'left-title'	=> esc_html__( 'Left', 'mora' ),
					'center-title'	=> esc_html__( 'Center', 'mora' ),					
					),
				'multiple'    => false,
			),				
			array(
				'name'  => esc_html__( 'Title Tagline', 'mora' ),
				'id'    => "{$mora_prefix}page_tagline",
				'desc'  => esc_html__( 'You can set a tagline for the title.', 'mora' ),
				'type'  => 'text',
				'size'	=> 50,
			),
			array(
				'id'               => "{$mora_prefix}page_title_bg",
				'name'             => esc_html__( 'Title Background Image', 'mora' ),
				'type'             => 'image_advanced',
				'force_delete'     => false,
				// Maximum image uploads
				'max_file_uploads' => 1,
			),			
			array(
				'name' => esc_html__( 'Disable Title Section', 'mora' ),
				'id'   => "{$mora_prefix}page_title",
				'desc'  => esc_html__( 'Disable the entire page title section and use Visual Composer to build your page on a blank canvas.', 'mora' ),
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'name' => esc_html__( 'Disable Solid Header', 'mora' ),
				'id'   => "{$mora_prefix}solid_header_switch",
				'desc'  => esc_html__( 'Disable the solid header and set it as an overlay for the content. This is known as a fixed header or absolute positioned header.', 'mora' ),
				'type' => 'checkbox',
				'std'  => 0,
			),	
			array(
				'name' => esc_html__( 'Push Header at Top', 'mora' ),
				'id'   => "{$mora_prefix}push_header_top",
				'desc'  => esc_html__( 'Disabling the solid header will position it over the title. Push the header back to top by selecting the checkbox. Best to use when setting a background image for the page title. ', 'mora' ),
				'hidden' 	  => array('mora_solid_header_switch', '!=', '1'),
				'type' => 'checkbox',
				'std'  => 0,
			),				

			array(
				'type' => 'divider',
				'id'   => 'page_divider', // Not used, but needed
			),

			array(
				'name' => esc_html__( 'Customize the Header Behavior', 'mora' ),
				'id'   => "{$mora_prefix}pagenav_behavior_switch",
				'desc'  => esc_html__( 'Set a new behavior for the header, like setting new background colors for it or other logo.', 'mora' ),
				'type' => 'checkbox',
				'std'  => 0,
			),			

			array(
				'name'        => esc_html__( 'Menu Style', 'mora' ),
				'id'          => "{$mora_prefix}page_menu_style",
				'type'        => 'select_advanced',
				'hidden' 	  => array('mora_pagenav_behavior_switch', '!=', '1'),
				'desc'		  => esc_html__('Overwrite the global menu style, set in Appearance->Delicious Options->Header.','mora'),
				'options'     => array(
					'classic-menu' => esc_html__('Classic', 'mora'),  
					'minimal-menu' => esc_html__('Minimal', 'mora'), 
					'fullscreen-menu' => esc_html__('Fullscreen', 'mora')
					),
				'std' 		  => 'classic-menu',
				'multiple'    => false,
			),	

			array(
				'name'        => esc_html__( 'Pick a new menu?', 'mora' ),
				'id'          => "{$mora_prefix}page_new_menu",
				'type'        => 'select_advanced',
				'hidden' 	  => array('mora_pagenav_behavior_switch', '!=', '1'),
				'desc'		  => esc_html__('Select a new menu for the header.','mora'),
				'options' => $mora_menu_array,
				'multiple'    => false,
			),		

			array(
				'name'        => esc_html__( 'Initial Navigation Style', 'mora' ),
				'id'          => "{$mora_prefix}initial_navigation_style",
				'type'        => 'select_advanced',
				'columns'	  => '6',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'options'     => array(
						'light-header' => esc_html__( 'Light Background / Dark Navigation', 'mora' ),
						'dark-header' => esc_html__( 'Dark Background / Light Navigation', 'mora' ),
					),
				'std' 		  => 'light-header',
				'multiple'    => false,
			),
			
			array(
				'name'        => esc_html__( 'On Scroll Navigation Style', 'mora' ),
				'id'          => "{$mora_prefix}onscroll_navigation_style",
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'type'        => 'select_advanced',
				'columns'	  => '6',
				'options'     => array(
						'light-header' => esc_html__( 'Light Background / Dark Navigation', 'mora' ),
						'dark-header' => esc_html__( 'Dark Background / Light Navigation', 'mora' ),
					),
				'std' 		  => 'light-header',
				'multiple'    => false,
			),	

			array(
				'name' => esc_html__( 'Initial Header Background Color', 'mora' ),
				'id'   => "{$mora_prefix}initial_header_color",
				'type' => 'color',
				'columns'	  => '6',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'std'  => '#ffffff'
			),	

			array(
				'name' => esc_html__( 'On Scroll Header Background Color', 'mora' ),
				'id'   => "{$mora_prefix}onscroll_header_color",
				'type' => 'color',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',
				'std'  => '#ffffff'
			),			

			array(
				'name'       => esc_html__( 'Initial Header Background Color Opacity', 'mora' ),
				'id'         => "{$mora_prefix}initial_header_color_opacity",
				'type'       => 'slider',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',				
				'suffix'     => esc_html__( '%', 'mora' ),
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
					'value' => 100
				),
			),		
			array(
				'name'       => esc_html__( 'On Scroll Header Background Color Opacity', 'mora' ),
				'id'         => "{$mora_prefix}onscroll_header_color_opacity",
				'type'       => 'slider',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',				
				'suffix'     => esc_html__( '%', 'mora' ),
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
					'value'=> 100
				),
			),		

			array(
				'name' => esc_html__( 'Initial Logo Image(Optional)', 'mora' ),
				'id'   => "{$mora_prefix}initial_logo_image",
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',						
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),		
			array(
				'name' => esc_html__( 'On Scroll Logo Image(Optional)', 'mora' ),
				'id'   => "{$mora_prefix}onscroll_logo_image",
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'columns'	  => '6',						
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name' => esc_html__( 'SVG or Retina Ready?', 'mora' ),
				'id'   => "{$mora_prefix}initial_logo_svg_retina",
				'desc'  => esc_html__( 'If your logo is an .svg file or retina-ready .png file, set a width and height for it.', 'mora' ),
				'columns'	  => '6',	
				'type' => 'checkbox',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'std'  => 0,
			),
			array(
				'name' => esc_html__( 'SVG or Retina Ready?', 'mora' ),
				'id'   => "{$mora_prefix}onscroll_logo_svg_retina",
				'desc'  => esc_html__( 'If your logo is an .svg file or retina-ready .png file, set a width and height for it.', 'mora' ),
				'columns'	  => '6',	
				'type' => 'checkbox',
				'hidden' => array('mora_pagenav_behavior_switch', '!=', '1'),
				'std'  => 0,
			),			
			array(
				'name'  => esc_html__( 'Initial Logo Width(px)', 'mora' ),
				'id'    => "{$mora_prefix}initial_svg_retina_logo_width",
				'type'  => 'number',
				'columns'	  => '6',	
				'hidden' => array('mora_initial_logo_svg_retina', '!=', '1'),
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'OnScroll Logo Width(px)', 'mora' ),
				'id'    => "{$mora_prefix}onscroll_svg_retina_logo_width",
				'hidden' => array('mora_onscroll_logo_svg_retina', '!=', '1'),
				'type'  => 'number',
				'columns'	  => '6',	
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'Initial Logo Height(px)', 'mora' ),
				'id'    => "{$mora_prefix}initial_svg_retina_logo_height",
				'type'  => 'number',
				'columns'	  => '6',	
				'hidden' => array('mora_initial_logo_svg_retina', '!=', '1'),
				'size'	=> 50,
			),	
			array(
				'name'  => esc_html__( 'OnScroll Logo Height(px)', 'mora' ),
				'id'    => "{$mora_prefix}onscroll_svg_retina_logo_height",
				'hidden' => array('mora_onscroll_logo_svg_retina', '!=', '1'),
				'type'  => 'number',
				'columns'	  => '6',	
				'size'	=> 50,
			),																										
		),
	);	

	$mora_meta_boxes[] = array(
		'id'         => 'mora_blog_post_tagline_metaboxes',
		'title'      => esc_html__( 'Blog Post Options', 'mora' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'  => esc_html__( 'Blog Post Title Tagline', 'mora' ),
				'id'    => "{$mora_prefix}blog_post_tagline",
				'desc'  => esc_html__( 'You can set a tagline for the blog post title(optional). It will appear on single blog post pages.', 'mora' ),
				'type'  => 'text',
				'size'	=> 50,
			),	
		),
	);


	$mora_meta_boxes[] = array(
		'id'         => 'mora_portfolio_thumbnail_metaboxes',
		'title'      => esc_html__( 'Featured Image / Thumbnail Options', 'mora' ),
		'post_types' => array( 'portfolio' ),
		'context'    => 'side',
		'priority'   => 'low',
		'autosave'   => true,
		'fields'     => array(
			array(
				'name'        => esc_html__( 'Thumbnail Behavior', 'mora' ),
				'id'          => "{$mora_prefix}portf_icon",
				'type'        => 'select_advanced',
				'options'     => array(
					'link_to_page'	=> esc_html__( 'Opens the Project Page', 'mora' ),
					'lightbox_to_image'	=> esc_html__( 'Is Opening in a Lightbox', 'mora' ),
					'link_to_link'	=> esc_html__( 'Opens a Custom URL', 'mora' ),
					'lightbox_to_video'	=> esc_html__( 'Opens a Video in a Lightbox', 'mora' ),
					'lightbox_to_gallery'	=> esc_html__( 'Opens an Image Gallery in a Lightbox', 'mora' ),
					),
				'multiple'    => false,
			),		

			array(
				'name'  => esc_html__( 'Custom URL: ', 'mora' ),
				'id'    => "{$mora_prefix}portf_link",
				'desc'  => esc_html__( 'You can set the thumbnail to open a custom URL.', 'mora' ),
				'type'  => 'text',
				'hidden' => array( 'mora_portf_icon', '!=', 'link_to_link' ),
			),

			array(
				'name'  => esc_html__( 'Video URL: ', 'mora' ),
				'id'    => "{$mora_prefix}portf_video",
				'desc'  => esc_html__( 'You can set the thumbnail to open a video from third-party websites(Vimeo, YouTube) in an URL. Ex: http://www.youtube.com/watch?v=y6Sxv-sUYtM', 'mora' ),
				'type'  => 'text',
				'hidden' => array( 'mora_portf_icon', '!=', 'lightbox_to_video' ),
			),

			array(
				'name'             => esc_html__( 'Gallery Images', 'mora' ),
				'id'               => "{$mora_prefix}portf_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 30,
				'desc'			   => esc_html__( 'Upload new images or select them from the media library. (Ctrl/CMD + Click for selecting multiple items at once)', 'mora' ),
				'hidden' => array( 'mora_portf_icon', '!=', 'lightbox_to_gallery' ),
			),			

			array(
				'name'    => esc_html__( 'Thumbnail Size', 'mora' ),
				'id'      => "{$mora_prefix}portf_thumbnail",
				'type'    => 'image_select',
				'options' => array(
					'small' => $mora_img_dir_path.'portfolio-small.png',
					'wide' => $mora_img_dir_path.'portfolio-big.png',
					'horizontal' => $mora_img_dir_path.'half-horizontal.png',
					'vertical' => $mora_img_dir_path.'half-vertical.png',
				),
				'std'	=> 'small',					
			),
			array(
				'name' => esc_html__( 'Set a .GIF file as thumbnail', 'mora' ),
				'id'   => "{$mora_prefix}set_project_thumbnail_gif",
				'desc'  => esc_html__( 'Display a .gif file instead of the current thumbnail/featured image.', 'mora' ),
				'type' => 'checkbox',
				'std'  => 0,
			),	
			array(
				'name'        => esc_html__( '.GIF URL', 'mora' ),
				'id'          => "{$mora_prefix}gif_url",
				'type'        => 'file_advanced',
				'hidden' => array('mora_set_project_thumbnail_gif', '!=', '1'),
			),				
		),
	);		


	$mora_meta_boxes[] = array(
		'id'         => 'mora_project_description_metabox',
		'title'      => esc_html__( 'Project Options', 'mora' ),
		'post_types' => array( 'portfolio' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(

			array(
				'name'  => esc_html__( 'Small Project Description', 'mora' ),
				'id'    => "{$mora_prefix}small_pr_description",
				'desc'  => esc_html__( 'Add a small description for the project. It will be applied to certain portfolio styles.(HTML tags allowed)', 'mora' ),
				'type'  => 'textarea',
			),	
		),
	);		
	
	return $mora_meta_boxes;

}
?>