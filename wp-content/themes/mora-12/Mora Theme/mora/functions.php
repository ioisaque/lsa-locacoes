<?php
// Mora Theme functions and definitions.
require_once ( get_template_directory() . '/framework/plugins/class-tgm-plugin-activation.php');

if ( file_exists( get_template_directory() . '/framework/admin/admin-init.php' ) ) {
    require_once( get_template_directory() . '/framework/admin/admin-init.php' );
}

require_once( get_template_directory() . '/framework/meta-box/meta-box/meta-box.php' );


// Extensions
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-conditional-logic/meta-box-conditional-logic.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-tabs/meta-box-tabs.php');
include( get_template_directory().'/framework/meta-box/meta-box-extensions/meta-box-columns/meta-box-columns.php');
include( get_template_directory() . '/framework/meta-box/meta-box-config.php' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/breadcrumbs.php';
require get_template_directory() . '/inc/navigation.php';
require get_template_directory() . '/inc/jetpack.php';

include (get_template_directory()."/inc/image-resizer.php");
include (get_template_directory()."/framework/widgets/widget-social.php");

include (get_template_directory()."/framework/extend_woocommerce.php");

require_once (get_template_directory().'/framework/plugins/envato_setup/envato_setup.php');

class Mora_Delicious {

	function __construct() {
		add_action( 'init', array($this, 'mora_wooc_init' ));
		add_action( 'after_setup_theme', array($this, 'mora_setup' ) );
		add_action( 'after_setup_theme', array($this, 'mora_content_width'), 0 );
		add_action( 'widgets_init', array($this, 'mora_widgets_init') );
		add_action( 'init', array($this, 'mora_image_sizes') );
		add_action( 'wp_enqueue_scripts', array($this, 'mora_scripts') );
		add_action( 'admin_print_footer_scripts', array($this, 'mora_add_quicktags') );	
		add_action( 'tgmpa_register',  array($this, 'mora_register_required_plugins') ); 	
		add_action( 'init', array($this, 'mora_remove_redux_notices') );	
		add_action( 'wp_enqueue_scripts', array($this, 'mora_header_custom_js') ) ;	
		add_action( 'wp_enqueue_scripts', array($this, 'mora_footer_custom_js') );			
		add_action( 'wp_print_scripts', array($this, 'mora_dequeue_script'), 100 );	
		add_action('get_header', array($this, 'mora_filter_head'));	
		add_action('admin_enqueue_scripts', array($this, 'mora_admin_style'));	
		add_action( 'wp_head', array($this, 'delicious_footer_builder_add_css') ) ;

		add_filter( 'the_content_more_link', array($this, 'mora_wrap_readmore'), 10, 1 );
		add_filter( 'excerpt_length', array($this, 'mora_custom_excerpt_length'), 999 );	
		add_filter( 'excerpt_more', array($this, 'mora_excerpt_more') );	
		add_filter( 'the_content_more_link', array($this, 'mora_remove_more_link_scroll') );	
		add_filter( 'upload_mimes', array($this, 'mora_mime_types') );	

		add_filter('mora_theme_setup_wizard_username', array($this,'mora_set_theme_setup_wizard_username'), 10);
		add_filter('mora_theme_setup_wizard_oauth_script', array($this,'mora_set_theme_setup_wizard_oauth_script'), 10);		

		add_action( 'pt-ocdi/after_import', array($this,'mora_ocdi_after_import_setup') );
		add_filter( 'pt-ocdi/import_files', array($this,'mora_ocdi_import_files') );	
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
		add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );		

		add_filter('wp_nav_menu_items',array($this, 'mora_add_more_menu_item'), 10, 2);
		


		add_filter('loop_shop_columns', array($this, 'mora_loop_columns') );

		add_filter( 'the_password_form', array($this, 'mora_password_form' ));
	}
	


	// woocommerce theme support
	public function mora_wooc_init () {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}	

	// remove admin bar bump
	public function mora_filter_head() {
	   remove_action('wp_head', '_admin_bar_bump_cb');
	} 	

	// Theme setups
	public function mora_setup() {

		load_theme_textdomain( 'mora', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'mora' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'video',
			'gallery',
			'quote',
			'link'
		) );
	}

	// Set the content width in pixels, based on the theme's design and stylesheet.
	public function mora_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'mora_content_width', 1280 );
	}

	// Register blog sidebar, footer and custom sidebar
	public function mora_widgets_init() {
		register_sidebar(array(
			'name' => esc_html__( 'Blog Sidebar', 'mora' ),
			'id' => 'sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'mora' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => esc_html__( 'Footer', 'mora' ),
			'id' => 'footer',
			'description' => esc_html__( 'Widgets in this area will be shown in the footer.', 'mora' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__( 'Page Sidebar', 'mora' ),
			'id' => 'page-sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown in the sidebar of any page.', 'mora' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => esc_html__( 'Sliding Menu Sidebar', 'mora' ),
			'id' => 'sliding-menu-sidebar',
			'description' => esc_html__( 'Widgets in this area will be shown in the sidebar of the sliding menu. You can enable it from Appearance->Delicious Options->Header: Vertical Sliding Menu.', 'mora' ),
			'before_widget' => '<aside id="%1$s" class="darker-overlay widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));		
	}


	// Set different thumbnail dimensions
	public function mora_image_sizes() {
		add_image_size( 'mora-blog-thumbnail', 1120, 9999, false ); 	// Blog thumbnails
		add_image_size( 'mora-blog-grid-thumbnail', 640, 9999, false ); // Blog thumbnails
		add_image_size( 'mora-blog-carousel-thumbnail', 640, 480, true ); // Blog thumbnails
		add_image_size( 'mora-full-size',  9999, 9999, false ); 		// Full Size
	}

	
	// Enqueue scripts and styles.

	public function mora_dequeue_script() {
	   wp_dequeue_script( 'isotope' );
	}

	function mora_admin_style() {
		wp_enqueue_style( 'mora-admin-style', get_template_directory_uri() . '/assets/css/admin.css' );	
	}

	public function mora_scripts() {
		$mora_data = mora_dt_data();
		global $post;

		$mora_postid = '';
		if( !is_404() || !is_search() ) {
			if($post != NULL) { 
		    	$mora_postid = $post->ID;
			}
		}	

		wp_enqueue_style( 'mora-style', get_stylesheet_uri() );

		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.css' );	
		wp_enqueue_style( 'et-line', get_template_directory_uri() . '/assets/fonts/et-line-font/et-line.css' );	
		wp_enqueue_style( 'simple-line-icons', get_template_directory_uri() . '/assets/fonts/simple-line-icons/simple-line-icons.css' );	
		

		// preloader
		if(isset($mora_data['mora_enable_preloader'])) {
			if($mora_data['mora_enable_preloader'] != 0) {	
				wp_enqueue_script('qloader', get_template_directory_uri() . '/assets/js/plugins/jquery.queryloader2.js', array('jquery'), '1.0', false );
				wp_enqueue_script('mora-custom-loader', get_template_directory_uri() . '/assets/js/custom-loader.js', array('jquery', 'qloader'), '1.0', false );

				$mora_preloader_logo_output = '<div id="spinner"></div>';
				if(isset($mora_data['mora_preloader_logo']['url']) && ($mora_data['mora_preloader_logo']['url'] !='')) {
					$mora_preloader_logo_output = '<div id="preloader-with-img"><div id="spinner"></div><img class="is-in-preloader" src="'.$mora_data['mora_preloader_logo']['url'].'" width="80" height= "80"/></div></div>';
				}
				wp_localize_script( 'qloader', 'mora_load', array( 'logo' => $mora_preloader_logo_output) );	

			}
		}	
		wp_enqueue_script( 'mora-plugins', get_template_directory_uri() . '/assets/js/plugins/jquery-plugins.js', array('jquery'), false, true );

		if(isset($mora_data['mora_smoothscroll_enabled']) && ($mora_data['mora_smoothscroll_enabled'] =='1')) { 
			wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/js/plugins/smoothScroll.js', array('jquery'), '1.4.0', true );		
		}
		wp_enqueue_script( 'mora-nav', get_template_directory_uri() . '/assets/js/custom-nav.js', array('jquery'), '1.0', true );		
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/plugins/jquery.isotope.js', array('jquery'), '3.0.1', true );		

		wp_enqueue_script( 'navscroll', get_template_directory_uri() . '/assets/js/custom-navscroll.js', array('jquery'), '1.0', true );	
		wp_register_script('owlcarousel', get_template_directory_uri() . '/assets/js/plugins/owlcarousel.js', array('jquery'), '2.0', true );
		wp_enqueue_script( 'mora-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true );	
		wp_enqueue_script( 'mora-custom-scripts-header', get_template_directory_uri() . '/assets/js/custom-scripts-header.js', array('jquery'), '1.0', false );	

		if(isset($mora_data['mora_header_type']) && ($mora_data['mora_header_type'] == 'header-left')) {
			wp_enqueue_script( 'mora-custom-vc', get_template_directory_uri() . '/assets/js/custom-vc.js', array('jquery'), '1.0', true );
		}

		if(isset($mora_data['mora_slide_sidebar']) && ($mora_data['mora_slide_sidebar'] == '1')) {
			wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/plugins/classie.js', '1.0', true );	
			wp_enqueue_script( 'mora-slidemenu', get_template_directory_uri() . '/assets/js/custom-slidemenu.js', array('classie'), '1.0', true );			
		}
		wp_register_script('mora-social', get_template_directory_uri() . '/assets/js/custom-social.js', array('jquery'), FALSE, true );	

		if (is_page_template('template-blog.php')) {
			wp_enqueue_script( 'mora-masonry-blog', get_template_directory_uri() . '/assets/js/custom-masonry-blog.js', array('isotope'), '1.0', true );		
		}	

		$mora_onepage_nav_offset = 0;
		$mora_onepage_nav_hashtags = false;

		if(isset($mora_data['mora_nav_hashtags'])&& ($mora_data['mora_nav_hashtags'] == 1)) {
			$mora_onepage_nav_hashtags = $mora_data['mora_nav_hashtags'];
		}		

		if(isset($mora_data['mora_scrolloffset'])&& ($mora_data['mora_scrolloffset'] != '')) {
			$mora_onepage_nav_offset = $mora_data['mora_scrolloffset'];
		}

		wp_enqueue_script('mora-onepage-custom-nav', get_template_directory_uri() . '/assets/js/custom-onepage-nav.js', array('jquery'), '1.0', true );

		wp_localize_script( 'mora-onepage-custom-nav', 'mora_onepage', array( 'mora_offset' => $mora_onepage_nav_offset, 'mora_hashtags' => $mora_onepage_nav_hashtags) );	


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if(isset($mora_data['mora_social_box'])) { 
			if($mora_data['mora_social_box'] =='1') {			
				wp_enqueue_script('mora-social');
			}
		}

			//counting footer widgets number and assigning them a width
			$mora_number = self::mora_count_sidebar_widgets( 'footer', false );
			$mora_footer_columns = '';
				if($mora_number == 2) { 
					$mora_footer_columns = '#topfooter aside { width: 48%; }'; }   	
				else if($mora_number == 3) { 
					$mora_footer_columns = '#topfooter aside { width:30.66%; }'; } 	
				
				else if ($mora_number == 4) { 
				$mora_footer_columns = '#topfooter aside { width:22%; }'; } 
				
				else if ($mora_number == 5) { 
				$mora_footer_columns = '#topfooter aside { width:16.8%; }'; } 
				else {
					$mora_footer_columns = '#topfooter aside { width:22%; }'; 
				}
				
			wp_add_inline_style( 'mora-style', $mora_footer_columns );		

			//custom css	
			$mora_custom_css = '';
			if(!empty($mora_data['mora_more_css'])) {
				$mora_custom_css .= $mora_data['mora_more_css'];
			}	
			wp_add_inline_style( 'mora-style', $mora_custom_css );	


			$mora_grayscale_css = '';
			$mora_grayscale_svg = "filter: url("."data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg'><filter id='grayscale'><feColorMatrix type='matrix' values='0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0'/></filter></svg>#grayscale".");";
			if(isset($mora_data['mora_grayscale_effect'])&& ($mora_data['mora_grayscale_effect'] == 1)) {
				$mora_grayscale_css .= '.member-wrapper .thumbnail-wrapper img, .portfolio>li a.img-anchor img, .post-thumbnail img, .client-thumbnail img {-webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: grayscale(100%); filter: gray; '.$mora_grayscale_svg.' }';			
			}		

			wp_add_inline_style( 'mora-style', $mora_grayscale_css );			


			// secondary font options
			$mora_secondary_font = 'Montserrat';
			$mora_secondary_font_output = '';

			if(isset($mora_data['mora_secondary_typo']) && $mora_data['mora_secondary_typo'] != '') {
				$mora_secondary_font = $mora_data['mora_secondary_typo']['font-family'];

				$mora_secondary_font_output = '.dt-button, button, input[type="submit"].solid, .post-read-more, input[type="reset"].solid, input[type="button"].solid, .dt-dropcap-1, .format-quote span, .dt-play-video, .skillbar-title, .counter-number, .package-price, .ias-wrapper .ias-trigger, .ias-wrapper .ias-trigger .to-trigger, .ias-noneleft p, .ias-infinite-loader, .ias-wrapper.to-hide, .timeline-wrapper .timeline-list li .timeline-item .timeline-number, span.info-title, .to-trigger, .projnav li span, .is-alt-text, .pagenav, .small-btn-link, .dt-blog-carousel .cat-links a, .testimonial-name, .testimonial-position, .counter-text, #filters a, .process-item-symbol, .read-me-more, .button-map span { font-family: '.$mora_secondary_font.', Helvetica, Arial, sans-serif;} ';
			}

			wp_add_inline_style( 'mora-style', $mora_secondary_font_output );

			// menu items style
			$mora_menu_item_style = 'strikethrough';
			$mora_menu_item_output = '';
			
			if((isset($mora_data['mora_menu_items_style'])) && ($mora_data['mora_menu_items_style'] != '')) {
				$mora_menu_item_style = $mora_data['mora_menu_items_style'];
			}

			if($mora_menu_item_style == 'underline') {
				$mora_menu_item_output = 'html .main-navigation a:before,html .main-navigation a:after,html .main-navigation .current>a:before,html .main-navigation .current>a:after{bottom:0;top:inherit;margin-right:0;margin-left:0}html .main-navigation .current>a:after{width:100%}html .main-navigation a:before{margin-left:0}html .main-navigation a:after{margin-left:0}html .main-navigation a:hover:before{width:100%;margin-left:0}html .main-navigation a:hover:after{margin-right:0;width:100%}html .main-navigation li > a{padding-bottom:3px} html .main-navigation :not(.menu-item-type-custom).current_page_item>a:after {top: auto; width: 100%; margin-left: 0}';
			} else 
			if($mora_menu_item_style == 'noline') {
				$mora_menu_item_output = '.main-navigation a:before, .main-navigation a:after { content: none !important; }';
			}

			wp_add_inline_style( 'mora-style', $mora_menu_item_output );

			// custom color scheme
			$mora_color_scheme = '#f39c12';
			$mora_output_scheme = '';
			if((isset($mora_data['mora_custom_color_scheme'])) && ($mora_data['mora_custom_color_scheme'] != '')) {
				$mora_color_scheme = $mora_data['mora_custom_color_scheme'];


				$mora_output_scheme = '.dt-button.button-primary:hover, button.button-primary:hover, input[type="submit"].button-primary:hover, input[type="reset"].button-primary:hover, input[type="button"].button-primary:hover, .dt-button.button-primary:focus, button.button-primary:focus, input[type="submit"].button-primary:focus, input[type="reset"].button-primary:focus, input[type="button"].button-primary:focus, .widget-area .tagcloud a:hover, #headersocial li a:hover, .section-intro a:hover { background-color: '.$mora_color_scheme.'; border-color:  '.$mora_color_scheme.'; }

					.main-navigation ul ul li.current-menu-item > a, .main-navigation a:hover, .main-navigation .current > a, .main-navigation .current > a:hover, .main-navigation.dark-header a:hover,.author-bio .author-description h3 a:hover, .blog-grid a.excerpt-read-more span:hover, h2.entry-title a:hover, h1.entry-title a:hover, aside[id^="woocommerce_"] li a:hover, html .woocommerce ul.products li.product a h3:hover, html .woocommerce .woocommerce-message:before, .widget-area a:hover,.main-navigation :not(.menu-item-type-custom).current_page_item > a, 

					p a, .process-item-title .pi-title, .no-fill .dt-service-icon * , .thin-fill .dt-service-icon span, .thin-fill .dt-service-icon i, .dt-services-grid .delicious-service .delicious-service-icon, .dt-blog-carousel h3.entry-title a:hover, .dt-blog-carousel a.excerpt-read-more span:hover, .dt_pagination a, .dt_pagination a:hover, .dt_pagination span.current, .portfolio.portfolio-layout-mosaic li .dt-awesome-project h3 a:hover, .portfolio.portfolio-layout-parallax li .dt-awesome-project h3 a:hover, ul.dt-tabs li:hover, ul.dt-tabs li.current span.dt-tab-count, ul.dt-tabs li.current span.dt-tab-title, .dt-service-box:hover .dt-service-box-icon span, .timeline-wrapper .timeline-list li .timeline-item:hover .timeline-number, .darker-overlay ul li a:hover, .rev_slider a, #mora-left-side .menu li a:hover, #mora-left-side .menu li.current > a, #mora-left-side #menu-mora-regular-menu .current-menu-item a, .testimonial-name, .main-navigation .current > a, .page-template-template-blog .blog-masonry .grid-content .entry-header .entry-title a:hover, .dt-blog-grid-shortcode .entry-header .entry-title a:hover, .dt-play-video a:hover, #topfooter a:hover, .portfolio.text-under-thumbnail .grid-item h3 a:hover
					 { color: '.$mora_color_scheme.'; }

					.main-navigation a:before, .main-navigation a:after, .main-navigation a:hover:before, .main-navigation .current > a:after, .main-navigation :not(.menu-item-type-custom).current_page_item > a:after, ::-webkit-scrollbar-thumb:hover,

					.work-cta:hover, .bold-fill .dt-service-icon i, .bold-fill .dt-service-icon span, .dt-blog-carousel .post-thumbnail .post-icon, .portfolio.portfolio-layout-mosaic li .dt-awesome-project h3 a:after, .portfolio.portfolio-layout-parallax li .dt-awesome-project h3 a:after, .timeline-wrapper .timeline-list li:hover:after, #mora-left-side .menu li > a:before, html .main-navigation .current_page_item:not(.menu-item-type-custom) > a:after, html .main-navigation .current_page_item:not(.menu-item-type-custom) > a:before, .skillbar-bar
					 { background: '.$mora_color_scheme.' ; }

					 html .main-navigation .current_page_item:not(.menu-item-type-custom) > a:after, html .main-navigation .current_page_item:not(.menu-item-type-custom) > a:before, .main-navigation a:hover::before, .main-navigation .current > a::after, .main-navigation a:before, .main-navigation a:after, .timeline-wrapper .timeline-list li:hover:after {
					 	background-color: '.$mora_color_scheme.' ;
					 }
					
					html #comments .bodycomment a, .blog-grid a.excerpt-read-more span:hover, html .woocommerce .woocommerce-message,  html .single-product.woocommerce #content .product .woocommerce-tabs .tabs li.active,

					.thin-fill .dt-service-icon span, .thin-fill .dt-service-icon i, .dt-blog-carousel a.excerpt-read-more span:hover, .dt_pagination a:hover, .dt_pagination span.current, .section-intro a, .pricing-column.featured-column
					   { border-color: '.$mora_color_scheme.'}
				';
			} 

			wp_add_inline_style( 'mora-style', $mora_output_scheme );	

			wp_localize_script( 'mora-custom-loader', 'mora_loader', array( 'mora_bcolor' => $mora_color_scheme) );			


			// custom background colors	
			$mora_style_css ='';

			// solid header switch
			$mora_solid_header_switch = rwmb_meta("mora_solid_header_switch");
			$mora_push_header_top = rwmb_meta("mora_push_header_top");
			if (isset($mora_solid_header_switch) && ($mora_solid_header_switch == 1)) {
				$mora_style_css .= '.menu-fixer { display: none;}';

				wp_localize_script( 'mora-custom-js', 'mora_custom', array( 'mora_id' => $mora_postid, 'mora_header_top' => $mora_push_header_top) );	
			}

			// reaveal footer switch
			$mora_reveal_footer = '';
			if(isset($mora_data['mora_footer_reveal']) && ($mora_data['mora_footer_reveal'] === '1')) { 
				$mora_reveal_footer = '1';
				wp_localize_script( 'mora-custom-js', 'mora_custom_2', array( 'mora_reveal_footer' => $mora_reveal_footer) );	
			}		


			$mora_page_title_bg = rwmb_meta("mora_page_title_bg");

			if (isset($mora_page_title_bg) && ($mora_page_title_bg != "")) {
				foreach ( $mora_page_title_bg as $image ) {		
					$mora_style_css .= 'html .page-id-'.$mora_postid.' .page-title-wrapper, html .postid-'.$mora_postid.' .page-title-wrapper { background: url('.$image['full_url'].') fixed center center; background-size: cover; -webkit-background-size: cover; }';
				}
			}


			// header background
			$mora_default_header_color = "#fff";

			if((isset($mora_data['mora_header_background'])) || ($mora_data['mora_header_background'] != '')) { 

				if($mora_data['mora_header_background']['alpha'] != '1' ) {
					$mora_default_header_color = $mora_data['mora_header_background']['rgba'];
				}
				else
				$mora_default_header_color = $mora_data['mora_header_background']['color'];
			}

			// header background on scroll
			$mora_header_color_on_scroll = "#fff";
			if(isset($mora_data['mora_header_background_on_scroll'])) {
				if(($mora_data['mora_header_background_on_scroll']['alpha'] != '1' ) && array_key_exists('rgba', $mora_data['mora_header_background_on_scroll'])) { 
					$mora_header_color_on_scroll = $mora_data['mora_header_background_on_scroll']['rgba'];
				}
				else
				$mora_header_color_on_scroll = $mora_data['mora_header_background_on_scroll']['color'];
			}
			else {
				$mora_header_color_on_scroll = "#fff";
			}

			if(!empty($mora_data['mora_body_background'])) {
				$mora_style_css .= 'html body {background: '.$mora_data['mora_body_background'].';}';
			}	
			if(!empty($mora_data['mora_wrapper_background'])) {
				$mora_style_css .= '#wrapper {background: '.$mora_data['mora_wrapper_background'].';}';
			}			
			
			// margin-top for logo
			if(!empty($mora_data['mora_margin_logo'])) {
				$mora_style_css .= '#header .logo img { margin-top: '.$mora_data['mora_margin_logo'].'px;}';
			}

			//background patterns 
			if((!empty($mora_data['mora_pattern'])) && ($mora_data['mora_pattern'] != 'bg12')) {
				$mora_style_css .= 'html body #page { background: url('.get_template_directory_uri().'/assets/images/bg/'.$mora_data['mora_pattern'].'.png) repeat scroll 0 0;}';
			}		
						
			wp_add_inline_style( 'mora-style', $mora_style_css );

			// disable floating header 
			$mora_no_float = '';
			if(isset($mora_data['mora_floating_header'])) {
				if($mora_data['mora_floating_header'] == 0) {
					$mora_no_float .= '#header { position: relative; } .menu-fixer { display: none !important }';
				}
			}

			wp_add_inline_style('mora-style', $mora_no_float);	

			$mora_logo_onscroll_height = '30';
			if(isset($mora_data['mora_onscroll_logo_height'])) {
				$mora_logo_onscroll_height = $mora_data['mora_onscroll_logo_height'];
			}
			
			$mora_mainlogo_src = '';
			$mora_logo_details = array('0', '110', '30');
			if(isset($mora_data['mora_custom_logo']['id']) && ($mora_data['mora_custom_logo']['id'] != '')) {
				$mora_logo_details = wp_get_attachment_image_src($mora_data['mora_custom_logo']['id'], 'mora-full-size');	
				$mora_mainlogo_src = $mora_data['mora_custom_logo']['url'];
			}

			$mora_alternative_logo_src = '';
			$mora_alternative_svg_logo_enabled = '0';
			$mora_alternative_svg_logo_src = '';
			$mora_alternative_svg_logo_width = '110';
			$mora_alternative_svg_logo_height = '30';

			if(isset($mora_data['mora_alternativelogo_enabled']) && ($mora_data['mora_alternativelogo_enabled'] == '1')) {
				if(isset($mora_data['mora_alternative_logo']['id']) && ($mora_data['mora_alternative_logo']['url'] != '')) {
					$mora_alternative_logo_src = $mora_data['mora_alternative_logo']['url'];	
				}		
				if(isset($mora_data['mora_alternativelogo_enabled']) && ($mora_data['mora_alternativelogo_enabled'] == '1')) {
					// $mora_alternative_svg_logo_enabled = $mora_data['mora_alternativelogo_enabled'];
					$mora_alternative_svg_logo_enabled = $mora_data['mora_alternative_svg_enabled'];
					if(isset($mora_data['mora_alternative_svg_logo']['id']) && ($mora_data['mora_alternative_svg_logo']['url'] != '')) {
					$mora_alternative_svg_logo_src = $mora_data['mora_alternative_svg_logo']['url'];	
				}	
				$mora_alternative_svg_logo_width = $mora_data['mora_alternative_svg_logo_width'];
				$mora_alternative_svg_logo_height = $mora_data['mora_alternative_svg_logo_height'];
				}

			}


			$mora_logo_width = $mora_logo_details[1];
			$mora_logo_height = $mora_logo_details[2];

			$mora_logo_svg_url = '';
			$mora_logo_svg_enabled = '0';
			$mora_svg_logo_css = '';

			if(isset($mora_data['mora_svg_enabled']) && ($mora_data['mora_svg_enabled'] == '1')) {
				$mora_logo_svg_enabled = $mora_data['mora_svg_enabled'];
				$mora_logo_svg_url = $mora_data['mora_svg_logo']['url'];
				$mora_logo_width = $mora_data['mora_svg_logo_width'];
				$mora_logo_height = $mora_data['mora_svg_logo_height'];
				$mora_svg_logo_css = '.logo img { width: '.$mora_logo_width.'px; height: '.$mora_logo_height.'px; }';
			}

			wp_add_inline_style('mora-style', $mora_svg_logo_css);				

			$mora_init_pt = 30;
			$mora_init_pb = 30;
			$mora_scroll_pt = 15;
			$mora_scroll_pb = 15;

			if(isset($mora_data['mora_initial_header_padding'])) {
				$mora_init_pt = $mora_data['mora_initial_header_padding']['padding-top'];
				$mora_init_pb = $mora_data['mora_initial_header_padding']['padding-bottom'];
			}	

			if(isset($mora_data['mora_onscroll_header_padding'])) {
				$mora_scroll_pt = $mora_data['mora_onscroll_header_padding']['padding-top'];
				$mora_scroll_pb = $mora_data['mora_onscroll_header_padding']['padding-bottom'];
			}		

			$mora_scrolling_effect = 1;	
			if(isset($mora_data['mora_scrolling_effect'])) {
				if ($mora_data['mora_scrolling_effect'] == 0) {
					$mora_scrolling_effect = 0;
				}
			}

			// theme options header scheme
			$mora_headerscheme = 'light-header';
			if(isset($mora_data['mora_header_scheme'])) { $mora_headerscheme = $mora_data['mora_header_scheme']; }	

			// theme options header scheme on scroll
			$mora_headerscheme_on_scroll = 'light-header';
			if(isset($mora_data['mora_header_scheme_on_scroll'])) { $mora_headerscheme_on_scroll = $mora_data['mora_header_scheme_on_scroll']; }	


			// page custom header options
			$mora_pagenav_behavior_switch = rwmb_meta('mora_pagenav_behavior_switch');

			// page custom navigation style
			$mora_initial_navigation_style = rwmb_meta('mora_initial_navigation_style');			
			$mora_onscroll_navigation_style = rwmb_meta('mora_onscroll_navigation_style');		

			// page custom header background color
			$mora_initial_header_color = self::mora_hex2rgb(rwmb_meta('mora_initial_header_color'));

			$mora_onscroll_header_color = self::mora_hex2rgb(rwmb_meta('mora_onscroll_header_color'));

			// page custom header background color opacity
			$mora_initial_header_color_opacity = rwmb_meta('mora_initial_header_color_opacity');
			$mora_onscroll_header_color_opacity = rwmb_meta('mora_onscroll_header_color_opacity');		

			// page custom header logo
			$mora_init_logo_img = rwmb_meta('mora_initial_logo_image', 'type=image_advanced&size=full', $mora_postid );
			$mora_onscroll_logo_img = rwmb_meta('mora_onscroll_logo_image', 'type=image_advanced&size=full', $mora_postid );


			$mora_initial_logo_image_url = '';
			$mora_initial_logo_image_width = '110';
			$mora_initial_logo_image_height = '30';

			$mora_onscroll_logo_image_url = '';
			$mora_onscroll_logo_image_width = '110';
			$mora_onscroll_logo_image_height = '30';	
					
			if( !is_404() ) {
				if( !is_search() ) {
					foreach($mora_init_logo_img as $mora_init_logo_img_fields) {
						$mora_initial_logo_image_url = $mora_init_logo_img_fields['url'];
						$mora_initial_logo_image_width = $mora_init_logo_img_fields['width'];
						$mora_initial_logo_image_height = $mora_init_logo_img_fields['height'];
					}

					foreach($mora_onscroll_logo_img as $mora_onscroll_logo_img_fields) {
						$mora_onscroll_logo_image_url = $mora_onscroll_logo_img_fields['url'];
						$mora_onscroll_logo_image_width = $mora_onscroll_logo_img_fields['width'];
						$mora_onscroll_logo_image_height = $mora_onscroll_logo_img_fields['height'];
					}
				}
			}

			// page custom header svg logo

			$mora_initial_logo_svg_retina = rwmb_meta('mora_initial_logo_svg_retina');
			$mora_onscroll_logo_svg_retina = rwmb_meta('mora_onscroll_logo_svg_retina');

			$mora_initial_svg_retina_logo_width = rwmb_meta('mora_initial_svg_retina_logo_width');
			$mora_initial_svg_retina_logo_height = rwmb_meta('mora_initial_svg_retina_logo_height');

			$mora_onscroll_svg_retina_logo_width = rwmb_meta('mora_onscroll_svg_retina_logo_width');
			$mora_onscroll_svg_retina_logo_height = rwmb_meta('mora_onscroll_svg_retina_logo_height');			

			wp_localize_script( 'navscroll', "mora_styles", 
				array( 
					'mora_logo_svg_url' => $mora_logo_svg_url,
					'mora_logo_svg_enabled' => $mora_logo_svg_enabled,
					'mora_header_bg' => $mora_default_header_color, 
					'mora_header_scroll_bg' => $mora_header_color_on_scroll, 
					'mora_default_color' => $mora_default_header_color, 
					'mora_logo_width' => $mora_logo_width, 
					'mora_logo_height' => $mora_logo_height, 
					'mora_logo_onscroll_height' => $mora_logo_onscroll_height,
					'mora_init_pt' => $mora_init_pt, 
					'mora_init_pb' => $mora_init_pb, 
					'mora_scroll_pt' => $mora_scroll_pt, 
					'mora_scroll_pb' => $mora_scroll_pb, 
					'mora_scrolling_effect' => $mora_scrolling_effect, 
					'mora_mainlogosrc' => $mora_mainlogo_src , 
					'mora_alternativelogosrc' => $mora_alternative_logo_src , 
					'mora_alternativelogo' => $mora_data['mora_alternativelogo_enabled'], 
					'mora_alternative_svg_logo_src' => $mora_alternative_svg_logo_src,
					'mora_alternative_svg_logo_width' => $mora_alternative_svg_logo_width,
					'mora_alternative_svg_logo_width' => $mora_alternative_svg_logo_width,
					'mora_alternative_svg_logo_height' => $mora_alternative_svg_logo_height,
					'mora_alternative_svg_logo_enabled' => $mora_alternative_svg_logo_enabled,
					'mora_scheme' => $mora_headerscheme, 
					'mora_scheme_on_scroll' => $mora_headerscheme_on_scroll, 

					'mora_pagenav_behavior_switch' => $mora_pagenav_behavior_switch, 
					'mora_initial_navigation_style' => $mora_initial_navigation_style, 
					'mora_onscroll_navigation_style' => $mora_onscroll_navigation_style, 
					'mora_initial_header_color' => $mora_initial_header_color, 
					'mora_onscroll_header_color' => $mora_onscroll_header_color, 
					'mora_initial_header_color_opacity' => $mora_initial_header_color_opacity, 
					'mora_onscroll_header_color_opacity' => $mora_onscroll_header_color_opacity,
					'mora_initial_logo_image_url' => $mora_initial_logo_image_url,
					'mora_initial_logo_image_width' => $mora_initial_logo_image_width,
					'mora_initial_logo_image_height' => $mora_initial_logo_image_height,
					'mora_onscroll_logo_image_url' => $mora_onscroll_logo_image_url,
					'mora_onscroll_logo_image_width' => $mora_onscroll_logo_image_width,
					'mora_onscroll_logo_image_height' => $mora_onscroll_logo_image_height,

					'mora_initial_logo_svg_retina' => $mora_initial_logo_svg_retina,
					'mora_onscroll_logo_svg_retina' => $mora_onscroll_logo_svg_retina,
					'mora_initial_svg_retina_logo_width' => $mora_initial_svg_retina_logo_width,
					'mora_initial_svg_retina_logo_height' => $mora_initial_svg_retina_logo_height,
					'mora_onscroll_svg_retina_logo_width' => $mora_onscroll_svg_retina_logo_width,
					'mora_onscroll_svg_retina_logo_height' => $mora_onscroll_svg_retina_logo_height,


					'page_id' => $mora_postid

				 ) );			
			
			$mora_init_h_padding = '';
			$mora_init_h_padding = '#header { padding-top: '.$mora_init_pt.'px; padding-bottom: '.$mora_init_pb.'px;  }';
			wp_add_inline_style( 'mora-style', $mora_init_h_padding );
				

	}


	// Read More wrapping
	public function mora_wrap_readmore($mora_more_link)
	{
		return '<div class="post-read-more">'.$mora_more_link.'</div>';
	}
	

	//set excerpt length
	public function mora_custom_excerpt_length( $length ) {
		return 18;
	}

	// customize excerpt read more
	public function mora_excerpt_more( $more ) {
		return '... <a class="excerpt-read-more" href="' . esc_url(get_permalink( get_the_ID() )) . '"><span>' . esc_html__( 'Read More', 'mora' ) . '</span></a>';
	}

	// prevent page scroll when clicking the more link
	public function mora_remove_more_link_scroll( $mora_link ) {
		$mora_link = preg_replace( '|#more-[0-9]+|', '', $mora_link );
		return $mora_link;
	}


	// header custom js
	public function mora_header_custom_js() {
		$mora_data = mora_dt_data();
		if(isset($mora_data['mora_header_custom_js']) && ($mora_data['mora_header_custom_js'] !='')) { 
			wp_add_inline_script( 'mora-custom-scripts-header', $mora_data['mora_header_custom_js'] );
		}
	}


	// footer custom js
	public function mora_footer_custom_js() {
		$mora_data = mora_dt_data();
		if(isset($mora_data['mora_footer_custom_js']) && ($mora_data['mora_footer_custom_js'] !='')) { 
			wp_add_inline_script( 'mora-custom-js', $mora_data['mora_footer_custom_js'] );
		}
	}	
	

	// allow svg files to be used with the theme
	public function mora_mime_types($mora_mimes) {
	  $mora_mimes['svg'] = 'image/svg+xml';
	  return $mora_mimes;
	}
	

	public function mora_add_quicktags() {
		if (wp_script_is('quicktags')){ 
			?>
			<script type="text/javascript">
				QTags.addButton( 'section-intro', 'mora Intro', '<p class="section-intro">', '</p>', '8', 'mora Section Intro', 201 );
			</script>
			<?php
	 	}
	}

	public function delicious_footer_builder_add_css() {
		$mora_data = mora_dt_data();	

		if(isset($mora_data['mora_custom_footer']) && ($mora_data['mora_custom_footer'] == '1')) { 
			if(isset($mora_data['mora_custom_footer_pages']) && ($mora_data['mora_custom_footer_pages'] != '')) {	
		        $id = $mora_data['mora_custom_footer_pages'];
		        if ( $id ) {
		            $shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
		            if ( ! empty( $shortcodes_custom_css ) ) {
		                echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.$id.'">' .$shortcodes_custom_css. '</style>';
		              
		            }
		        } 
			}
		}

	}		

	public function mora_add_more_menu_item ( $mora_items, $mora_args ) {

		$mora_data = mora_dt_data();

		if(isset($mora_data['mora_slide_sidebar']) && ($mora_data['mora_slide_sidebar'] === '1')) {

		    if( $mora_args->theme_location === 'primary')  {
				
		        $mora_items .=  '<li class="svg-more"><svg class="menu-button" id="open-button" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M80.6,50c0,3.8-3.1,6.9-6.9,6.9c-3.8,0-6.9-3.1-6.9-6.9c0-3.8,3.1-6.9,6.9-6.9C77.5,43.1,80.6,46.2,80.6,50z M26.3,56.9  c3.8,0,6.9-3.1,6.9-6.9c0-3.8-3.1-6.9-6.9-6.9c-3.8,0-6.9,3.1-6.9,6.9C19.4,53.8,22.5,56.9,26.3,56.9z M43.1,50  c0,3.8,3.1,6.9,6.9,6.9c3.8,0,6.9-3.1,6.9-6.9c0-3.8-3.1-6.9-6.9-6.9C46.2,43.1,43.1,46.2,43.1,50z"/></svg></li>';

			}

		}
	    return $mora_items;
	}



	public function mora_password_form() {
	    global $post;
	    $mora_label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	    $mora_output = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
	    ' . esc_html__( "This content is password protected. To view it please enter your password below:", 'mora' ) . '
	    <div class="half-space"></div><input name="post_password" id="' . esc_attr($mora_label) . '" type="password" size="20" maxlength="20" /><input type="submit" class="solid" name="Submit" value="' . esc_attr__( "Submit", 'mora' ) . '" />
	    </form>
	    ';
	    return $mora_output;
	}	


	// UTILITY FUNCTIONS

	// Hex 2 RGB values
	function mora_hex2rgb($mora_hex) {
	   $mora_hex = str_replace("#", "", $mora_hex);

	   if(strlen($mora_hex) == 3) {
	      $mora_r = hexdec(substr($mora_hex,0,1).substr($mora_hex,0,1));
	      $mora_g = hexdec(substr($mora_hex,1,1).substr($mora_hex,1,1));
	      $mora_b = hexdec(substr($mora_hex,2,1).substr($mora_hex,2,1));
	   } else {
	      $mora_r = hexdec(substr($mora_hex,0,2));
	      $mora_g = hexdec(substr($mora_hex,2,2));
	      $mora_b = hexdec(substr($mora_hex,4,2));
	   }
	   $mora_rgb = array($mora_r, $mora_g, $mora_b);
	   return implode(",", $mora_rgb); // returns the rgb values separated by commas
	}	

	// count sidebar widgets
	function mora_count_sidebar_widgets( $mora_sidebar_id, $mora_echo = true ) {
		$mora_the_sidebars = wp_get_sidebars_widgets();
		if( !isset( $mora_the_sidebars[$mora_sidebar_id] ) )
			return esc_html__( 'Invalid sidebar ID', 'mora' );
		if( $mora_echo )
			echo count( $mora_the_sidebars[$mora_sidebar_id] );
		else
			return count( $mora_the_sidebars[$mora_sidebar_id] );
	}		

	// get all sidebars in an array 
	function mora_my_sidebars() {
	    global $wp_registered_sidebars;
	    $mora_all_sidebars = array();
	    if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {
	        
	        foreach ( $wp_registered_sidebars as $mora_sidebar ) {
	            $mora_all_sidebars[ $mora_sidebar['id'] ] = $mora_sidebar['name'];
	        }
	        
	    }
	    return $mora_all_sidebars;
	}	

	//get sidebar position
	static function mora_sidebar_position($mora_postid) {
		global $mora_sidebar_pos;
		$mora_sidebar_pos = get_post_meta($mora_postid, 'mora_sidebar_position', true);
		if($mora_sidebar_pos == '') 
			$mora_sidebar_pos = 'sidebar-right';
		
		$mora_sidebar_class = '';
		
		if($mora_sidebar_pos == 'sidebar-right')
			$mora_sidebar_class = 'sidebar-right';
		else if($mora_sidebar_pos == 'sidebar-left')
			$mora_sidebar_class = 'sidebar-left';
		else if($mora_sidebar_pos == 'no-sidebar')
			$mora_sidebar_class = 'no-sidebar';
		echo esc_attr($mora_sidebar_class);	
	}


	// mora Video Function
	function mora_video($mora_postid) { 
	
		$mora_external_item = get_post_meta($mora_postid, 'mora_external_video_block', true);		
		
		if(($mora_external_item != '')) {
			if( strpos($mora_external_item, 'youtube') ) {
				preg_match(
						'/[\\?\\&]v=([^\\?\\&]+)/',
						$mora_external_item,
						$mora_matches
					);
				$mora_id = $mora_matches[1];
				 
				$mora_width = '780';
				$mora_height = '440';
				echo '<div class="post-video"><iframe class="dt-youtube" width="' .esc_attr($mora_width). '" height="'.esc_attr($mora_height).'" src="//www.youtube.com/embed/'.esc_attr($mora_id).'" frameborder="0" allowfullscreen></iframe></div>';
			}
			
			if( strpos($mora_external_item, 'vimeo') ) {
				preg_match(
						'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
						$mora_external_item,
						$mora_matches
					);
				$mora_id = $mora_matches[2];	

				$mora_width = '780';
				$mora_height = '440';		
				
				echo '<div class="post-video"><iframe src="https://player.vimeo.com/video/'.esc_attr($mora_id).'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.esc_attr($mora_width).'" height="'.esc_attr($mora_height).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';	
			}			
		}

	}	

	// mora Gallery Function
	function mora_gallery($mora_postid) {  

		$mora_token = wp_generate_password(5, false, false);
		wp_enqueue_script('owlcarousel');
	   	wp_enqueue_script('mora-custom-gallery', get_template_directory_uri() . '/assets/js/custom-gallery.js', array('jquery'), '1.0', false );	
		wp_localize_script( 'mora-custom-gallery', 'mora_gallery_' . $mora_token, array( 'mora_post_id' => $mora_postid) );
		

		$mora_gallery_images = array();
		if(class_exists('RW_Meta_Box')) {
			$mora_gallery_images = rwmb_meta( 'mora_blog_gallery', 'type=image_advanced&size=full', $mora_postid );
		}

		if(!empty($mora_gallery_images)) {	

				echo '<div class="owl-carousel gallery-slider dt-gallery" id="gs-'.esc_attr($mora_postid).'" data-token="' . $mora_token . '">';	
					
					foreach ($mora_gallery_images as $mora_gallery_item) {
						
						$mora_resizer_url = $mora_gallery_item['url'];
						$mora_resized_image = aq_resize( $mora_resizer_url, 780, 408, true );

							echo  '<div class="slider-item">';
								echo  '<a class="not-link dt-lightbox-gallery" href="'.esc_url($mora_resizer_url).'" >';
									echo  '<img src="'.esc_url($mora_resized_image).'" alt="'.esc_attr($mora_gallery_item['caption']).'" />';
								echo  '</a>';
							echo  '</div>';
					}

				echo  '</div><!--end slides-->';
		}
	}


	public function mora_loop_columns() {
		$mora_data = mora_dt_data();
		if (isset($mora_data["mora_woo_products_per_row"])) {
			return $mora_data["mora_woo_products_per_row"];
		}
		else {
			return '3';
		}
		
	}


	public function mora_register_required_plugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$mora_plugins = array(	

			array(
					'name' 	   => esc_html__('Redux Framework', 'mora'),
					'slug' 	   => 'redux-framework',
					'required' => true
			),			

			array(
					'name'                  => esc_html__('Delicious Addons - Mora Edition', 'mora'), 
					'version'				=> '1.2',
					'slug'                  => 'delicious-addons-mora', 
					'source'                => get_template_directory() . '/framework/plugins/delicious-addons-mora/delicious-addons-mora.zip', 
					'required'              => true,
				),						

			array(
					'name'                  => esc_html__('WPBakery Visual Composer', 'mora'), 
					'version'				=> '5.2.1',
					'slug'                  => 'js_composer', 
					'source'                => get_template_directory() . '/framework/plugins/visual-composer/js_composer.zip', 
					'required'              => true,
				),	

			array(
					'name'                  => esc_html__('Templatera Addon for Visual Composer', 'mora'), 
					'version'				=> '1.1.12',
					'slug'                  => 'templatera', 
					'source'                => get_template_directory() . '/framework/plugins/visual-composer/templatera.zip', 
					'required'              => false,
				),			

			array(
					'name'                  => esc_html__('Revolution Slider', 'mora'), 
					'version'				=> '5.4.5.2',
					'slug'                  => 'revslider', 
					'source'                => get_template_directory() . '/framework/plugins/revolution-slider/revslider.zip', 
					'required'              => false,
				),	

			array(
					'name'                  => esc_html__('Envato Market', 'mora'), 
					'version'				=> '1.0.0-RC2',
					'slug'                  => 'envato-market', 
					'source'                => get_template_directory() . '/framework/plugins/envato-market/envato-market.zip', 
					'required'              => false,
				),				

			array(
				'name' 		=> esc_html__('Contact Form 7', 'mora'),
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),		

			array(
				'name' 		=> esc_html__('One Click Demo Import', 'mora'),
				'slug' 		=> 'one-click-demo-import',
				'required' 	=> false,
			),										

		);

		$theme_text_domain = 'mora';

		$mora_tgmpa_config = array(
			'id'           => 'mora',                 
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'parent_slug'  => 'themes.php',            
			'capability'   => 'edit_theme_options',    
			'has_notices'  => true,                   
			'dismissable'  => true,                   
			'dismiss_msg'  => '',                      
			'is_automatic' => false,                   
			'message'      => '',                   
		);

		tgmpa( $mora_plugins, $mora_tgmpa_config );

	}


	public function mora_ocdi_import_files() {
		return array(
			array(
				'import_file_name'           => 'MORA DEMO CONTENT',
				'import_file_url'            => 'https://dev.deliciousthemes.com/mora/MORA-ALL-CONTENT.xml',
			),
		);
	}


	public function mora_ocdi_after_import_setup() {		

		register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'mora' ) );
		$menu_header = get_term_by('name', 'Mora One Page Menu', 'nav_menu');
		set_theme_mod( 'nav_menu_locations', array(
					'primary' => $menu_header->term_id) );	

		// Assign front page
		$front_page_id = get_page_by_title( 'Homepage - One Page + Image Slider' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );	

	}

    public function mora_set_theme_setup_wizard_username($username){
        return 'deliciousthemes';
    }


    public function mora_set_theme_setup_wizard_oauth_script($oauth_url){
        return 'https://deliciousthemes.com/envato/api/server-script.php';
    }

	// remove the theme options panel notices
	public function mora_remove_redux_notices() {
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	    }
	}	

} // END CLASS

$mora_delicious = new Mora_Delicious();





// Language Switcher for WPML
if (!function_exists('mora_language_selector')) {
	function mora_language_selector() {
		if (function_exists('icl_get_languages')) {
			$mora_languages = icl_get_languages();
			
			if(!empty($mora_languages)){
				echo '<div id="header_language_list"><ul>';
					foreach($mora_languages as $mora_l){
						if($mora_l['active']) { echo '<li class="active-lang switch-lang" original-title="'.esc_attr($mora_l['native_name']).'">'; }
							else { echo '<li class="switch-lang" original-title="'.esc_attr($mora_l['native_name']).'">'; }
						if(!$mora_l['active']) echo '<a href="'.esc_url($mora_l['url']).'">';
							if($mora_l['code'] != 'zh-hant') {
								if($mora_l['code'] === 'ru') {
									echo "PY";
								}
								else
							 		echo esc_html(substr($mora_l['native_name'], 0, 2)); 
								} 
							else { echo esc_html($mora_l['native_name']); }
						if(!$mora_l['active']) echo '</a>';
						echo '</li>';
					}
				echo '</ul></div>';
			}
		}
	}
}


// Sets how comments are displayed
if(!function_exists('mora_comment')) { 
	function mora_comment($mora_comment, $mora_args, $mora_depth) {
		$GLOBALS['comment'] = $mora_comment; ?>
		<li class="comment" <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<div class="commentwrap">
				<div class="avatar">
					<?php echo get_avatar($mora_comment,$size='60'); ?>
				</div><!--end avatar-->
				
				<div class="metacomment">
					<span class="comment-author-name"><?php echo get_comment_author_link() ?></span>
					<span class="comment-time"><?php echo get_comment_date(); ?></a><?php edit_comment_link(esc_html__('Edit', 'mora'),'  ','') ?></span>
				</div><!--end metacomment-->
			
				<div class="bodycomment">
					<?php if ($mora_comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.', 'mora') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div><!--end bodycomment-->

				<div class="replycomment">
					<?php comment_reply_link(array_merge( $mora_args, array('depth' => $mora_depth, 'max_depth' => $mora_args['max_depth']))) ?> 
				</div>
			</div><!--end commentwrap-->
		
	<?php }

	function mora_dt_data() {
		global $mora_redux_data;
		return $mora_redux_data;
	}

	function mora_more_tag() {
		global $more;
		if(!is_single()) { $more = 0; }
	}	

}
