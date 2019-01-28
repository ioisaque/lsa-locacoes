<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "mora_redux_data";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'mora_redux_data',
        'use_cdn' => TRUE,
        'page_slug' => 'delicious_options',
        'page_title' => esc_html__('Delicious Options', 'mora'),
        'update_notice' => FALSE,
        'dev_mode' => FALSE, //SET TO FALSE
        'display_name' => $theme->get('Name'),
        'display_version' => $theme->get('Version'),
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => esc_html__('Delicious Options', 'mora'),
        'allow_sub_menu' => TRUE,
        'customizer' => TRUE,
        'default_mark' => '*',
        'google_api_key' => 'AIzaSyBPVwg6CaFLmKlxYjQu0bJGpxDN1p04S-Q',
        'disable_tracking' => TRUE,
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'fade',
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'http://themeforest.net/user/deliciousthemes/portfolio',
        'title' => esc_html__( 'Check out our Portfolio', 'mora' ),
        'icon'  => 'el el-globe-alt'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/deliciousthemes',
        'title' => esc_html__( 'Like us on Facebook', 'mora' ),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/deliciousthemes',
        'title' => esc_html__( 'Follow us on Twitter', 'mora' ),
        'icon'  => 'el el-twitter'
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'mora' ),
        'id'         => 'general',
        'icon'  => 'el el-globe-alt',
        'fields'     => array(
                    array(
                        'id'        => 'opt-info-field',
                        'type'      => 'info',
                        'title'  => esc_html__('Welcome to Mora Options Panel.', 'mora'),
                        'desc'      => esc_html__('It is meant to make your life easier by offering you options for customizing your website (upload custom logo, choose a color scheme, set up footer social icons, etc.).', 'mora')
                    ),      
 
                    array(
                        'id'        => 'mora_main_layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Layout', 'mora'),
                        'desc'  => esc_html__('Select the main content alignment. Choose between wide and boxed layout.', 'mora'),
                        'options'   => array(
                            'wide-layout' => array('alt' => 'Wide Layout',  'img' => ReduxFramework::$_url . 'assets/img/1c.png'),
                            'boxed-layout' => array('alt' => 'Boxed Layout',  'img' => ReduxFramework::$_url . 'assets/img/3cm.png')
                        ),
                        'default'   => 'wide-layout'
                    ),    
                    array(
                        'id'        => 'mora_enable_preloader',
                        'type'      => 'switch',
                        'title'     => esc_html__('Website Preloader', 'mora'),
                        'subtitle'  => esc_html__('You can enable/disable the website`s spinning wheel preloader.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),  

                   array(
                        'id'        => 'section-preloader-start',
                        'type'      => 'section',
                        'indent'    => true, 
                        'required'  => array('mora_enable_preloader', '=', '1'),
                    ),                    
                   array(
                        'id'        => 'mora_preloader_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Preloader Logo(Optional)', 'mora'),
                        'desc'  => esc_html__('You can insert a logo in the middle of the preloader. Tip: image should be circle shaped.', 'mora')             
                    ),
                    array(
                        'id'        => 'section-preloader-end',
                        'type'      => 'section',
                        'indent'    => false,
                        'required'  => array('mora_enable_preloader', "=", 1),
                    ),                      
                    array(
                        'id'        => 'mora_grayscale_effect',
                        'type'      => 'switch',
                        'title'     => esc_html__('Grayscale(black&white) Effect', 'mora'),
                        'subtitle'  => esc_html__('You can enable/disable the website`s grayscale effect for the images.', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                                                           
                    array(
                        'id'        => 'mora_site_desc_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('WordPress Site Tagline', 'mora'),
                        'desc'  => esc_html__('Enable/Disable the WordPress site tagline near logo. You can set a tagline in Settings->General.', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),      
                    array(
                        'id'        => 'mora_smoothscroll_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Smooth Scrolling Effect', 'mora'),
                        'subtitle'  => esc_html__('Enable/Disable the Smooth Scrolling effect for the website.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),  
                    array(
                        'id'        => 'mora_breadcrumbs_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Breadcrumbs', 'mora'),
                        'subtitle'  => esc_html__('Enable/Disable breadcrumbs. Breadcrumbs are a type of navigation which appears under a page title).', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),    
                   array(
                        'id'        => 'section-breadcrumbs-start',
                        'type'      => 'section',
                        'indent'    => true, 
                        'required'  => array('mora_breadcrumbs_enabled', '=', '1'),
                    ),                    
                    array(
                        'id'       => 'mora_breadcrumbs_for',
                        'type'     => 'checkbox',
                        'title'    => esc_html__('Enable Breadcrumbs for:', 'mora'), 
                        'desc'     => esc_html__('Select on what types of pages to display breadcrumbs.', 'mora'),
                        'options'  => array(
                            'pages' => 'Pages',                            
                            'posts' => 'Posts',
                            'projects' => 'Projects'
                        ),
                        'default' => array(
                            'pages' => '1', 
                            'posts' => '0', 
                            'projects' => '0'
                        )
                    ),
                    array(
                        'id'        => 'section-breadcrumbs-end',
                        'type'      => 'section',
                        'indent'    => false,
                        'required'  => array('mora_breadcrumbs_enabled', "=", 1),
                    ),                       


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'mora' ),
        'id'         => 'logo',
        'icon'  => 'el el-picasa',
        'fields'     => array(
                   array(
                        'id'        => 'mora_custom_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Main Logo', 'mora'),
                        'desc'  => esc_html__('Upload an image that will represent your website`s logo.', 'mora'),
                        'default'   => array('url' => 'https://deliciousthemes.com/logo-mora.png')                
                    ),

                    array(
                        'id'        => 'mora_svg_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use SVG Logo', 'mora'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'mora'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'mora_section-svglogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_svg_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'mora_svg_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an SVG Logo', 'mora'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'mora'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'mora_svg_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Width', 'mora'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '110'
                    ),        

                    array(
                        'id'        => 'mora_svg_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Height', 'mora'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '30'
                    ),                                            

                    array(
                        'id'        => 'section-svglogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_svg_enabled', "=", 1),
                    ),                        

                    array(
                        'id'        => 'mora_alternativelogo_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Alternative Logo', 'mora'),
                        'desc'  => esc_html__('You can choose to display an alternative logo for the scrolling state of the header(when header is scrolled down). Make sure to have the Scrolling Effect enabled in the Theme Options->Header section.', 'mora'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'section-alternativelogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_alternativelogo_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'mora_alternative_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload Alternative Logo', 'mora'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('You can upload an alternative logo for the scrolling state of the header.', 'mora'),
                        'required'  => array('mora_alternativelogo_enabled', '=', '1'),
                        'default'   => ''                
                    ),  

                   array(
                        'id'        => 'mora_alternative_svg_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use Alternative SVG Logo', 'mora'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'mora'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'mora_section-alternative-svglogo-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_alternative_svg_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'mora_alternative_svg_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an Alternative SVG Logo', 'mora'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'mora'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'mora_alternative_svg_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Alternative SVG Logo Width', 'mora'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '110'
                    ),        

                    array(
                        'id'        => 'mora_alternative_svg_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('Alternative SVG Logo Height', 'mora'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '30'
                    ),                                            

                    array(
                        'id'        => 'section-alternative-svglogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_alternative_svg_enabled', "=", 1),
                    ),                                                                         

                    array(
                        'id'        => 'section-alternativelogo-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_alternativelogo_enabled', '=', '1'),
                    ),         

                    array(
                        'id'        => 'mora_margin_logo',
                        'type'      => 'slider',
                        'title'     => esc_html__('Margin-Top Value for Header`s Logo', 'mora'),
                        'desc'  => esc_html__('You can adjust the logo position in header by setting a top-margin to it. You can use negative values as well. For example, if you enter 10, the logo will be lowered by 10px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'default'       => 0,
                        'min'           => -100,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'text'                           
                    ),   

                    array(
                        'id'        => 'mora_onscroll_logo_height',
                        'type'      => 'slider',
                        'title'     => esc_html__('Logo Height on Scroll', 'mora'),
                        'desc'  => esc_html__('Adjust the logo height on scroll. Currently is set to 30px', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'default'       => 30,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 200,
                        'display_value' => 'text'                           
                    )                                      

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'mora' ),
        'icon'       => 'el el-icon-star-empty',
        'id'         => 'admin-header',
        ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General Settings', 'mora' ),
        'id'         => 'admin-header-general',     
        'subsection'       => true,   
        'fields'     => array(
                    array(
                        'id'        => 'mora_header_type',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Header Type', 'mora'),
                        'subtitle'  => esc_html__('Set the type of the header: regular top header or left side header.', 'mora'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'header-regular' => 'Regular Top Header', 
                            'header-left' => 'Left Side Header'
                        ), 
                        'default'   => 'header-regular'
                    ),             

                    array(
                        'id'        => 'mora_nav_hashtags',
                        'type'      => 'switch',
                        'title'     => __('Enable/Disable Hashtags in URL', 'mora'),
                        'subtitle'  => __('You can enable hashtags in the URL of your webiste when clicking on menu items to navigate on page.', 'mora'),
                        'default'   => false,
                        'on'        => 'Enabled',
                        'off'       => 'Disabled'
                    ),                        

                    array(
                        'id'        => 'mora_scrolloffset',
                        'type'      => 'text',
                        'title'     => __('Navigation ScrollOffset Value', 'mora'),
                        'subtitle'  => __('You can adjust the position at which the scrolling effect stops when a menu item is clicked. You can use it to set an offset value to the top of each section stop. For example, the 100 value will stop the navigation 100px above the section.', 'mora'),
                        'desc'      => __('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '0'
                    ),                                                                                                         
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Regular Header', 'mora' ),
        'id'         => 'admin-header-regular',
        'subsection' => 'true',
        'fields'     => array(
                    array(
                        'id'        => 'mora_menu_type',
                        'type'      => 'select',
                        'title'     => esc_html__('Menu Style', 'mora'),
                        'desc'  => esc_html__('Select the menu style of the theme.', 'mora'),
                        'options'   => array('classic-menu' => 'Classic',  'minimal-menu' => 'Minimal', 'fullscreen-menu' => 'Fullscreen'),
                        'default'   => 'classic-menu',
                    ),                    

                    array(
                        'id'        => 'mora_menu_items_style',
                        'type'      => 'select',
                        'title'     => esc_html__('Menu Items Style', 'mora'),
                        'desc'  => esc_html__('Select the menu items style for the theme.', 'mora'),
                        'options'   => array('noline' => 'No Line', 'strikethrough' => 'Strikethrough',  'underline' => 'Underline'),
                        'default'   => 'noline',
                    ),   

                    array(
                        'id'        => 'mora_header_scheme',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mood Scheme', 'mora'),
                        'desc'  => esc_html__('Select a scheme for the header. Dark or Light. This will mainly affect the navigation. Then pick a color from below.', 'mora'),
                        'options'   => array('light-header' => 'Light Background / Dark Navigation', 'dark-header' => 'Dark Background / Light Navigation'),
                        'default'   => 'light-header',
                    ),    

                    array(
                        'id'        => 'mora_header_background',
                        'type'      => 'color_rgba',
                        'compiler'  => 'true',
                        // 'output'    => array('background' => '#header'),
                        'title'     => esc_html__('Header Background Color', 'mora'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the header (default: white).', 'mora'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 1
                        ),
                    ),           

                    array(
                        'id'            => 'mora_initial_header_padding',
                        'type'          => 'spacing',
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'title'         => esc_html__('Padding-Top/Padding-Bottom values for header`s initial position', 'mora'),
                        'desc'      => esc_html__('Set new padding values for the header`s look on initial position.', 'mora'),
                        'desc'          => esc_html__('Values are defined in pixels. Default: 48 with 48', 'mora'),
                        'default'       => array(
                            'padding-top'    => '30', 
                            'padding-bottom' => '30', 
                        )
                    ), 

                   array(
                        'id'        => 'mora_floating_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sticky Header', 'mora'),
                        'desc'  => esc_html__('You can enable a floating/sticky top-bar header which will include your logo and menu. If disabled, the scrolling effect from below will be ignored.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                 

                    array(
                        'id'        => 'mora_scrolling_effect',
                        'type'      => 'switch',
                        'title'     => esc_html__('Scrolling Effect', 'mora'),
                        'desc'  => esc_html__('You can disable the scrolling effect of the header. If disabled, "Padding-Top/Padding-Bottom values for header`s on scroll position" will be ignored.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),   

                    array(
                        'id'        => 'mora_slide_sidebar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Vertical Sliding Menu', 'mora'),
                        'desc'  => esc_html__('Enable an off-canvas sliding sidebar on the website. A new menu item(...) will be added to the header.', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                       

                    array(
                        'id'            => 'mora_onscroll_header_padding',
                        'type'          => 'spacing',
                        'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                        'top'           => true,     // Disable the top
                        'right'         => false,     // Disable the right
                        'bottom'        => true,     // Disable the bottom
                        'left'          => false,     // Disable the left
                        'required'  => array('mora_scrolling_effect', '=', '1'),
                        'title'         => esc_html__('Padding-Top/Padding-Bottom values for header`s on scroll position', 'mora'),
                        'desc'      => esc_html__('Set new padding values for the header`s look on scroll position.', 'mora'),
                        'desc'          => esc_html__('Values are defined in pixels. Default: 16 with 16', 'mora'),
                        'default'       => array(
                            'padding-top'    => '15', 
                            'padding-bottom' => '15', 
                        )
                    ),   

                    array(
                        'id'        => 'mora_header_scheme_on_scroll',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Mood Scheme on Scroll', 'mora'),
                        'desc'  => esc_html__('Select a scheme for the header. Dark or Light. This will mainly affect the navigation. Then pick a color from below.', 'mora'),
                        'options'   => array('light-header' => 'Light Background / Dark Navigation', 'dark-header' => 'Dark Background / Light Navigation'),
                        'default'   => 'light-header',
                    ), 

                    array(
                        'id'        => 'mora_header_background_on_scroll',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Header Background Color on Scroll', 'mora'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the header (default: white - 90% transparent).', 'mora'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 0.9
                        ),
                    ),   


                    array(
                        'id'        => 'mora_search_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Search Widget in Header', 'mora'),
                        'desc'  => esc_html__('You can enable a search icon widget in the header.', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                        

            )
        ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Left Side Header', 'mora' ),
        'id'         => 'admin-header-leftside',
        'subsection' => 'true',
        ));    


    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'mora' ),
        'id'         => 'admin-footer',
        'icon'       => 'el el-icon-minus',
        'fields'     => array(
                    array(
                        'id'        => 'mora_copyright_textarea',
                        'type'      => 'editor',
                        'title'     => esc_html__('Footer Text', 'mora'),
                        'desc'  => esc_html__('Place here your copyright line. For ex: Copyright 2016 | My website.', 'mora'),
                        'default'   => 'COPYRIGHT &copy; MORA STUDIO. ALL RIGHTS RESERVED',
                    ),   
                    array(
                        'id'        => 'mora_footer_layout',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Footer Layout', 'mora'),
                        'subtitle'  => esc_html__('Set the look of the footer: content on right-left sides, or content centered.', 'mora'),
                        
                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'footer-sides' => 'Content on Sides', 
                            'footer-centered' => 'Content Centered'
                        ), 
                        'default'   => 'footer-centered'
                    ), 

                    array(
                        'id'        => 'mora_footer_scheme',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Mood Scheme', 'mora'),
                        'desc'  => esc_html__('Select a scheme for the footer. Dark or Light. This will mainly affect the text.', 'mora'),
                        'options'   => array('light-footer' => 'Light Background / Dark Text', 'dark-footer' => 'Dark Background / Light Text'),
                        'default'   => 'dark-footer',
                    ),                      

                    array(
                        'id'       => 'mora_footer_reveal',
                        'type'     => 'checkbox',
                        'title'    => __('Footer Reveal Effect', 'mora'), 
                        'desc'     => __('Check to enable the "reveal" effect on footer.', 'mora'),
                        'default'  => '0'
                    ),    
                      
                   array(
                        'id'        => 'mora_footer_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Footer Logo', 'mora'),
                        'desc'  => esc_html__('You can add a logo inside the footer(Optional).', 'mora'),
                        'default'   => array('url' => 'https://deliciousthemes.com/logo-mora-white.png')                
                    ),  
                   array(
                        'id'        => 'mora_svg_footer_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use SVG Logo', 'mora'),
                        'desc'  => esc_html__('You can use an .svg logo instead of a regular .png or .jpg logo.', 'mora'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  
                   array(
                        'id'        => 'mora_section-svglogo-footer-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_svg_footer_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'mora_svg_footer_logo',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Upload an SVG Logo', 'mora'),
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'  => esc_html__('Upload your SVG logo. Make sure to set the width and height in the next fields.', 'mora'),
                        'default'   => ''                
                    ),  

                    array(
                        'id'        => 'mora_svg_footer_logo_width',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Width', 'mora'),
                        'desc'  => esc_html__('If you enter 100, the logo width will be set to 100px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '110'
                    ),        

                    array(
                        'id'        => 'mora_svg_footer_logo_height',
                        'type'      => 'text',
                        'title'     => esc_html__('SVG Logo Height', 'mora'),
                        'desc'  => esc_html__('If you enter 50, the logo height will be set to 50px. ', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'validate'  => 'numeric',
                        'default'   => '30'
                    ),                                            

                    array(
                        'id'        => 'section-svglogo-footer-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_svg_footer_enabled', "=", 1),
                    ), 

                   array(
                        'id'        => 'mora_custom_footer',
                        'type'      => 'switch',
                        'title'     => esc_html__('Footer Builder', 'mora'),
                        'desc'  => esc_html__('Overwrite the above settings and build a custom footer using Visual Composer and pages.', 'mora'),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  

                   array(
                        'id'        => 'mora_section-custom-footer-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_custom_footer', '=', 1),
                    ),                                        

                    array(
                        'id'        => 'mora_custom_footer_pages',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Builder Page', 'mora'),
                        'desc'  => esc_html__('Select the page which will replace the footer.', 'mora'),
                        'data'  => 'pages',
                            'args'  => array(
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                )
                    ),                 

                    array(
                        'id'        => 'section-custom-footer-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_custom_footer', "=", 1),
                    ),                                                                   


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'mora' ),
        'icon'       => 'el el-website',
        'id'         => 'admin-blog',
        'fields'     => array(
                   array(
                        'id'        => 'mora_blog_sidebar_pos',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Sidebar Position for Blog Related Pages', 'mora'),
                        'desc'  => esc_html__('Select a sidebar position for blog related pages. It will be applied to single posts, index page, archive and search pages.', 'mora'),
                        'options'   => array(
                            'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                            'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            'no-blog-sidebar' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                        ),
                        'default'   => 'sidebar-right'
                    ),  
                    array(
                        'id'        => 'mora_blog_sidebar',
                        'type'      => 'select',
                        'title'     => esc_html__('Sidebar Name for Blog Related Pages', 'mora'),
                        'desc'  => esc_html__('Select the sidebar which will be applied to blog related pages, including single posts, index page, archive pages and search result pages.', 'mora'),
                        'data'      => 'sidebars',
                        'default' => 'sidebar',
                    ),                      

                    array(
                        'id'        => 'mora_tags_list',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Tags list on Blog Posts', 'mora'),
                        'desc'  => esc_html__('If the option is on, the tags list will be displayed at the bottom of the post.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),                                                      
                    array(
                        'id'        => 'mora_social_box',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Social Share Icons for Blog Posts Inner Pages', 'mora'),
                        'desc'  => esc_html__('If the option is on, the social icons for sharing the post will be displayed.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ), 
                    array(
                        'id'        => 'mora_author_box',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Author Box for Blog Posts Inner Pages', 'mora'),
                        'desc'  => esc_html__('If the option is on, the author box will be displayed.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),    
                    array(
                        'id'        => 'mora_prev_next_posts',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Prev/Next Posts Links for Blog Posts', 'mora'),
                        'desc'  => esc_html__('If the option is on, links for Prev/Next posts will be displayed.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),   
                    array(
                        'id'        => 'mora_breadcrumbs_blog_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the `Blog` link in breadcrumbs.', 'mora'),
                        'desc'  => esc_html__('Add an URL for the Blog link in the breadcrumbs which appear on posts.', 'mora')
                    ),  
                    array(
                        'id'        => 'mora_breadcrumbs_blog_keyword',
                        'type'      => 'text',
                        'default'   => 'The Journal',
                        'title'     => esc_html__('Breadcrumb Keyword for Blog.', 'mora'),
                        'desc'  => esc_html__('Ex: Blog or Journal.', 'mora')
                    ),                                                                        
        )
    ) ); 

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'mora' ),
        'id'         => 'admin-portfolio',
        'icon'       => 'el el-icon-briefcase',
        'fields'     => array(
                    array(
                        'id'        => 'mora_proj_nav_enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Project Navigation', 'mora'),
                        'desc'  => esc_html__('Enable/Disable the project navigation from project pages.', 'mora'),
                        'default'   => 1,
                        'on'        => 'On',
                        'off'       => 'Off',
                    ),  
                   array(
                        'id'        => 'section-projnav-start',
                        'type'      => 'section',
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_proj_nav_enabled', '=', '1'),
                    ),

                    array(
                        'id'        => 'mora_portfolio_back_link',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the portfolio `Back` button icon', 'mora'),
                        'desc'  => esc_html__('Add an URL for the portfolio Back button.', 'mora'),
                        'hint'      => array(
                            //'title'     => '',
                            'content'   => 'Default URL is set to homepage. Ex: http://website.com#work. The URL will be also used to highlight the menu item in the navigation.',
                        )                        
                    ),

                    array(
                        'id'       => 'mora_portfolio_nav_behaviour',
                        'type'     => 'radio',
                        'title'    => esc_html__('Project Navigation Behavior:', 'mora'), 
                        'desc'     => esc_html__('Select how would you like the navigation to behave: Display link to another project from the same category or not.', 'mora'),
                        'options'  => array(
                            'all-categories' => 'Projects from all categories',
                            'same-category' => 'Projects from the same category', 
                        ),
                        'default' => 'all-categories'
                    ),                    

                    array(
                        'id'        => 'section-projnav-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('mora_proj_nav_enabled', '=', '1'),
                    ),     

 
                    array(
                        'id'        => 'mora_portfolio_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio',
                        'title'     => esc_html__('Portfolio Slug URL', 'mora'),
                        'hint'  => array( 
                            'content' => esc_html__('Change the default portfolio slug URL. Currently, this is set to <strong>portfolio</strong>. Ex: http://website.com/portfolio/project-name. Changing it to <strong>works</strong>, the URLs will become http://website.com/works/project-name. Once you`ll change it, you`ll probably get 404 error pages for projects. To fix this, refresh the permalinks: go to Settings->Permalinks and click on Default. Save. Then click on your custom URL structure(Postname) and save again.', 'mora')
                            ),                 
                    ), 

                    array(
                        'id'        => 'mora_breadcrumbs_portfolio_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL for the `Portfolio` link in breadcrumbs.', 'mora'),
                        'desc'  => esc_html__('Add an URL for the portfolio link in the breadcrumbs which appear on projects.', 'mora')
                       
                    ),
                    array(
                        'id'        => 'mora_breadcrumbs_portfolio_keyword',
                        'type'      => 'text',
                        'default'   => 'Projects',
                        'title'     => esc_html__('Breadcrumb Keyword for Portfolio.', 'mora'),
                        'desc'  => esc_html__('Ex: Projects or Work.', 'mora')
                    ),                                                  
        )
    ) );     

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'mora' ),
        'id'         => 'admin-typography',
        'icon'       => 'el-icon-filter',
        'fields'     => array(
                   array(
                        'id'        => 'mora_typo_info',
                        'type'      => 'info',
                        'title'  => esc_html__('Typography Options', 'mora'),
                        'desc'      => esc_html__('The theme is using Google Fonts to render the typography style for your website. You can however, make use of default fonts.).', 'mora')
                    ),                    

                    array(
                        'id'        => 'mora_body_font_typo',
                        'type'      => 'typography',
                        'output'    => array('html body', 'input[type="text"]','input[type="email"]','input[type="number"]','input[type="tel"]','input[type="password"]','input[type="search"]','input[type="url"]', 'textarea', 'h4.section-tagline', '.page-title-wrapper h4'),
                        'title'     => esc_html__('Body Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for the body', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'all_styles'=> true,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#686868',
                            'font-size'     => '15px',
                            'font-family'   => 'Open Sans',
                            'line-height'   => '28px',
                            'font-weight'   => '300',
                        ),
                    ),

                    array(
                        'id'        => 'mora_menu_typo',
                        'type'      => 'typography',
                        'output'    => array('html .main-navigation li a', '#mora-left-side .menu li a'),
                        'title'     => esc_html__('Menu Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for the main menu.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '13px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '22px',
                            'font-weight'   => '400',
                        ),
                    ),

                    array(
                        'id'        => 'mora_submenu_typo',
                        'type'      => 'typography',
                        'output'    => array('html .main-navigation ul ul a'),
                        'title'     => esc_html__('Dropdown Menu Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for the submenu/dropdown items.', 'mora'),
                        'text-align'=> false,
                        'subsets'   => true,
                        'color' => false,
                        'default'   => array(
                            'google'      => true,
                            'font-size'     => '13px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '22px',
                            'font-weight'   => '400'
                        ),
                    ),                    

                    array(
                        'id'        => 'mora_h1_typo',
                        'type'      => 'typography',
                        'output'    => array('html h1'),
                        'title'     => esc_html__('H1 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 1.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '42px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '52px',
                            'font-weight'   => '400',
                        ),
                    ),  

                    array(
                        'id'        => 'mora_h2_typo',
                        'type'      => 'typography',
                        'output'    => array('html h2'),
                        'title'     => esc_html__('H2 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 2.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '30px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '42px',
                            'font-weight'   => '400',
                        ),
                    ),  

                    array(
                        'id'        => 'mora_h3_typo',
                        'type'      => 'typography',
                        'output'    => array('html h3'),
                        'title'     => esc_html__('H3 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 3.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '24px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '32px',
                            'font-weight'   => '400',
                        ),
                    ),  

                    array(
                        'id'        => 'mora_h4_typo',
                        'type'      => 'typography',
                        'output'    => array('html h4'),
                        'title'     => esc_html__('H4 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 4.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '18px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '28px',
                            'font-weight'   => '400',
                        ),
                    ),      

                    array(
                        'id'        => 'mora_h5_typo',
                        'type'      => 'typography',
                        'output'    => array('html h5'),
                        'title'     => esc_html__('H5 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 5.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '15px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '24px',
                            'font-weight'   => '400',
                        ),
                    ),       

                    array(
                        'id'        => 'mora_h6_typo',
                        'type'      => 'typography',
                        'output'    => array('html h6'),
                        'title'     => esc_html__('H6 Font Options', 'mora'),
                        'desc'  => esc_html__('Select font options for Heading 6.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'color'         => '#323232',
                            'font-size'     => '14px',
                            'font-family'   => 'Montserrat',
                            'line-height'   => '20px',
                            'font-weight'   => '700',
                        ),
                    ),  
                    array(
                        'id'        => 'mora_secondary_typo',
                        'type'      => 'typography',
                        'title'     => esc_html__('Secondary Font Options', 'mora'),
                        'desc'  => esc_html__('Select the secondary font options. Only some elements will be affected.', 'mora'),
                        'google'    => true,
                        'text-align'=> false,
                        'font-size'=> false,
                        'color'=> false,
                        'line-height'=> false,
                        'subsets'   => true,
                        'default'   => array(
                            'google'      => true,
                            'font-family'   => 'Montserrat',
                            'font-weight'   => '400'
                        ),
                    ),                        
                                                     
        )
    ) );    

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Styling', 'mora' ),
        'id'         => 'admin-styling',
        'icon'       => 'el-icon-brush',
        'fields'     => array(
                    array(
                        'id'        => 'mora_custom_color_scheme',
                        'type'      => 'color',
                        'title'     => esc_html__('Color Scheme', 'mora'),
                        'desc'  => esc_html__('Set the color for the scheme.', 'mora'),
                        'default'   => '#ed862a',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'mora_body_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body'),
                        'title'     => esc_html__('Body Background Color', 'mora'),
                        'desc'  => esc_html__('Leave blank or pick a color for the body. (default: #fafafa).', 'mora'),
                        'default'   => '#fafafa',
                        'transparent' => false,
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'mora_wrapper_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html body #page'),
                        'title'     => esc_html__('Content Wrapper Background Color', 'mora'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the content wrapper (default: #fff).', 'mora'),
                        'default'   => '#ffffff',
                        'transparent' => false,
                        'validate'  => 'color'
                    ),           
                    array(
                        'id'        => 'mora_footer_background',
                        'type'      => 'color',
                        'output'    => array('background-color' => 'html .site-footer'),
                        'title'     => esc_html__('Footer Background Color', 'mora'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the footer (default: #323232).', 'mora'),
                        'default'   => '#323232',
                        'transparent' => false,
                        'validate'  => 'color'
                    ),   
                    array(
                        'id'        => 'mora_selected_text_background',
                        'type'      => 'color',
                        'output'    => array('background' => '-moz::selection,::selection'),
                        'title'     => esc_html__('Selected Text Background Color', 'mora'),
                        'desc'  => esc_html__('Leave blank if you want to keep the default background color or pick a color for the selected text (default: blue, set by the browser).', 'mora'),
                        'default'   => '#323232',                      
                        'transparent' => false,
                        'validate'  => 'color'
                    ),                                                   

                    array(
                        'id'        => 'mora_pattern',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Patterns for Background', 'mora'),
                        'desc'  => esc_html__('Select a pattern and set it as background. Choose between these patterns. More to come...', 'mora'),
                        'options'   => array(
                            'bg12' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg12.png'),
                            'bg1' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg1.png'),
                            'bg2' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg2.png'),
                            'bg3' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg3.png'),
                            'bg4' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg4.png'),
                            'bg5' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg5.png'),
                            'bg6' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg6.png'),
                            'bg7' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg7.png'),
                            'bg8' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg8.png'),
                            'bg9' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg9.png'),
                            'bg10' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg10.png'),
                            'bg11' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg11.png'),
                            'bg14' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg14.png'),
                            'bg15' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg15.png'),
                            'bg16' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg16.png'),
                            'bg17' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg17.png'),
                            'bg18' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg18.png'),
                            'bg19' => array('alt' => '',  'img' => get_template_directory_uri() .'/framework/admin/assets/img/bg/bg19.png')
                        ),
                        'default'   => 'bg12'
                    ),                             
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'mora' ),
        'id'         => 'admin-social',
        'icon'       => 'el-icon-network',
        'fields'     => array(
                   array(
                        'id'        => 'mora_social_intro',
                        'type'      => 'info',
                        'title'  => esc_html__('Social Options.', 'mora'),
                        'desc'      => esc_html__('Set your social network references. Add your links for popular platforms like Twitter and Facebook. If you don`t want to include a social icon in the list, just leave the textfield empty.).', 'mora')
                    ),
                    array(
                        'id'        => 'rss',
                        'type'      => 'text',
                        'title'     => esc_html__('Your RSS Feed address', 'mora'),
                        'default'   => 'http://feeds.feedburner.com/EnvatoNotes'
                    ),   
                    array(
                        'id'        => 'facebook',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Facebook page/profile URL', 'mora'),
                        'default'   => 'http://www.facebook.com/envato'
                    ),  
                    array(
                        'id'        => 'twitter',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Twitter URL', 'mora'),
                        'default'   => 'http://twitter.com/envato'
                    ),  
                    array(
                        'id'        => 'flickr',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Flickr Page URL', 'mora'),
                    ),    
                    array(
                        'id'        => 'google-plus',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Google Plus Page URL', 'mora'),
                    ),  
                    array(
                        'id'        => 'dribbble',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Dribbble Profile URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'pinterest',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Pinterest URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'linkedin',
                        'type'      => 'text',
                        'title'     => esc_html__('Your LinkedIn Profile URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'skype',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Skype Username', 'mora'),
                    ), 
                    array(
                        'id'        => 'github-alt',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Github URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'youtube',
                        'type'      => 'text',
                        'title'     => esc_html__('Your YouTube URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'vimeo-square',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Vimeo Page URL', 'mora'),
                    ), 
                    array(
                        'id'        => 'instagram',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Instagram Profile URL', 'mora'),
                    ),

                    array(
                        'id'        => 'tumblr',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Tumblr URL', 'mora'),
                    ),   

                    array(
                        'id'        => 'behance',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Behance Profile URL', 'mora'),
                    ),                      

                    array(
                        'id'        => 'vk',
                        'type'      => 'text',
                        'title'     => esc_html__('Your VK URL', 'mora'),
                    ), 

                    array(
                        'id'        => 'xing',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Xing URL', 'mora'),
                    ),   
                    array(
                        'id'        => 'soundcloud',
                        'type'      => 'text',
                        'title'     => esc_html__('Your SoundCloud URL', 'mora'),
                    ),    
                    array(
                        'id'        => 'codepen',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Codepen URL', 'mora'),
                    ),                                                                                              
                    array(
                        'id'        => 'yelp',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Yelp URL', 'mora'),
                    ),   
                    array(
                        'id'        => 'slideshare',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Slideshare URL', 'mora'),
                    ),        
                    array(
                        'id'        => 'houzz',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Houzz URL', 'mora'),
                    ),   
                    array(
                        'id'        => '500px',
                        'type'      => 'text',
                        'title'     => esc_html__('Your 500px URL', 'mora'),
                    ),    
                    array(
                        'id'        => 'tripadvisor',
                        'type'      => 'text',
                        'title'     => esc_html__('Your Tripadvisor URL', 'mora'),
                    ),                                                        

                    array(
                        'id'        => 'mora_header_social',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Icons in Header', 'mora'),
                        'desc'  => esc_html__('Enable/Disable social icons for the header. If enabled, the social icons block will be displayed in the header nav bar.', 'mora'),
                        'default'   => 0,
                        'on'        => 'On',
                        'off'       => 'Off'
                    ),                     
        )
    ) );


if ( class_exists( 'Woocommerce' ) ) {  
   Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'WooCommerce', 'mora' ),
        'id'         => 'admin-woocommerce',
        'icon'       => 'el-icon-shopping-cart',
        'fields'     => array(
                      array(
                            'id'        => 'mora_woo_layout',
                            'type'      => 'image_select',
                            'title'     => __('Sidebar Position for the Shop Page', 'mora'),
                            'subtitle'  => __('Select a sidebar position for the Shop page.', 'mora'),
                            'options'   => array(
                                'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                'no-sidebar' => array('alt' => 'No Sidebar',  'img' => ReduxFramework::$_url . 'assets/img/1col.png')
                            ),
                            'default'   => 'sidebar-right'
                        ),  
                        array(
                            'id'        => 'mora_woo_sidebar',
                            'type'      => 'select',
                            'title'     => __('Sidebar Name for Shop Page', 'mora'),
                            'subtitle'  => __('Select the sidebar which will be applied to the shop page, if the shop page layout defined from the option from above is set to a sidebar.', 'mora'),
                            'data'      => 'sidebars',
                            'default' => 'sidebar',
                        ),
                    array(
                        'id'        => 'mora_woo_products_per_row',
                        'type'      => 'select',
                        'title'     => __('Products per Row', 'mora'),
                        'subtitle'  => __('Set how many products would you like to display on a single row. In other words, how many columns will the shop page have?', 'mora'),
                        'options'   => array('2' => '2',  '3' => '3', '4' => '4', '6' => '6'),
                        'default'   => '3',
                    ),   
                    array(
                        'id'        => 'mora_woo_products_per_page',
                        'type'      => 'slider',
                        'title'     => __('Products per Page', 'mora'),
                        'subtitle'  => __('Set how many products would you like to display on a page.', 'mora'),
                        'desc'      => esc_html__('Use numbers only', 'mora'),
                        'default'       => 9,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 50,
                        'display_value' => 'text'                           
                    ),                                         
                ),
        )
   );
}


    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom CSS & JS', 'mora' ),
        'id'         => 'admin-custom-code',
        'icon'       => 'el-icon-edit',
        'fields'     => array(
                    array(
                        'id'        => 'mora_more_css',
                        'type'      => 'ace_editor',
                        'mode'      => 'css',
                        'theme'     => 'chrome',
                        'title'     => esc_html__('Custom CSS', 'mora'),
                        'desc'  => esc_html__('Quickly add some CSS to your theme by adding it to this block.', 'mora'),
                        'validate'  => 'css',
                        'options'   => array('minLines' => 12, 'useWorker' => false, 'fontSize' => 13)
                    ),

                    array(
                        'id'        => 'mora_header_custom_js',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Header Custom JS', 'mora'),
                        'desc'  => esc_html__('Paste your JavaScript code here. Use this field to quickly add JS code snippets before </head>.', 'mora'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'options'   => array('minLines' => 12, 'fontSize' => 13),
                        'default'   => ""
                    ),                      

                    array(
                        'id'        => 'mora_footer_custom_js',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('Footer Custom JS', 'mora'),
                        'desc'  => esc_html__('Paste your JavaScript code here. Use this field to quickly add JS code snippets.', 'mora'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'options'   => array('minLines' => 12, 'fontSize' => 13),
                        'default'   => ""
                    ),                    

        )
    ) );

    /*
     * <--- END SECTIONS
     */