<?php

// Check if Visual Composer is installed
if ( ! defined( 'WPB_VC_VERSION' ) ) {
   // Display notice that Visual Composer is required
   add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
   return;
}

if (class_exists('WPBMap')) {

$add_css_animation = array(
  "type" => "dropdown",
  "heading" => __("CSS Animation", "js_composer"),
  "param_name" => "dt_animation",
  "admin_label" => true,
  "value" => array("No" => '', "fadeIn" => "wow fadeIn", "fadeInDown" => "wow fadeInDown", "fadeInDownBig" => "wow fadeInDownBig", "fadeInLeft" => "wow fadeInLeft", "fadeInLeftBig" => "wow fadeInLeftBig", "fadeInRight" => "wow fadeInRight", "fadeInRightBig" => "wow fadeInRightBig", "fadeInUp" => "wow fadeInUp", "fadeInUpBig" => "wow fadeInUpBig", "fadeOut" => "wow fadeOut", "fadeOutDown" => "wow fadeOutDown", "fadeOutDownBig" => "wow fadeOutDownBig", "fadeOutLeft" => "wow fadeOutLeft", "fadeOutLeftBig" => "wow fadeOutLeftBig", "fadeOutRight" => "wow fadeOutRight", "fadeOutRightBig" => "wow fadeOutRightBig", "fadeOutUp" => "wow fadeOutUp", "fadeOutUpBig" => "wow fadeOutUpBig", "flipInX" => "wow flipInX", "flipInY" => "wow flipInY", "flipOutX" => "wow flipOutX", "flipOutY" => "wow flipOutY", "lightSpeedIn" => "wow lightSpeedIn", "lightSpeedOut" => "wow lightSpeedOut", "rotateIn" => "wow rotateIn", "rotateInDownLeft" => "wow rotateInDownLeft", "rotateInDownRight" => "wow rotateInDownRight", "rotateInUpLeft" => "wow rotateInUpLeft", "rotateInUpRight" => "wow rotateInUpRight", "rotateOut" => "wow rotateOut", "rotateOutDownLeft" => "wow rotateOutDownLeft", "rotateOutDownRight" => "wow rotateOutDownRight", "rotateOutUpLeft" => "wow rotateOutUpLeft", "rotateOutUpRight" => "wow rotateOutUpRight", "hinge" => "wow hinge", "rollIn" => "wow rollIn", "rollOut" => "wow rollOut", "zoomIn" => "wow zoomIn", "zoomInDown" => "wow zoomInDown", "zoomInLeft" => "wow zoomInLeft", "zoomInRight" => "wow zoomInRight", "zoomInUp" => "wow zoomInUp", "zoomOut" => "wow zoomOut", "zoomOutDown" => "wow zoomOutDown", "zoomOutLeft" => "wow zoomOutLeft", "zoomOutRight" => "wow zoomOutRight", "zoomOutUp" => "wow zoomOutUp", "slideInDown" => "wow slideInDown", "slideInLeft" => "wow slideInLeft", "slideInRight" => "wow slideInRight", "slideInUp" => "wow slideInUp", "slideOutDown" => "wow slideOutDown", "slideOutLeft" => "wow slideOutLeft", "slideOutRight" => "wow slideOutRight", "slideOutUp" => "wow slideOutUp", "bounce" => "wow bounce", "flash" => "wow flash", "pulse" => "wow pulse", "rubberBand" => "wow rubberBand", "shake" => "wow shake", "swing" => "wow swing", "tada" => "wow tada", "wobble" => "wow wobble", "jello" => "wow jello", "bounceIn" => "wow bounceIn", "bounceInDown" => "wow bounceInDown", "bounceInLeft" => "wow bounceInLeft", "bounceInRight" => "wow bounceInRight", "bounceInUp" => "wow bounceInUp", "bounceOut" => "wow bounceOut", "bounceOutDown" => "wow bounceOutDown", "bounceOutLeft" => "wow bounceOutLeft", "bounceOutRight" => "wow bounceOutRight", "bounceOutUp" => "wow bounceOutUp"),
  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. They`re based on the <a href='https://github.com/matthieua/WOW' target='_blank'>Wow Project</a>. Note: Works only in modern browsers.", "js_composer")
);

$css_animation_delay = array(
  "type" => "textfield",
  "heading" => __("CSS Animation Delay", "js_composer"),
  "param_name" => "dt_animation_delay",
      "dependency" => Array('element' => "dt_animation", 'not_empty' => true),
      "description" => __("Set a value for delaying the animation(seconds). You could use, for example, 0.1 to delay it with 0.1 seconds or 3 to delay it with 3 seconds. ", "js_composer")
);

if(function_exists('vc_add_param')) {
   vc_add_param('vc_column_inner', $add_css_animation);
   vc_add_param('vc_column_inner', $css_animation_delay);

   vc_add_param('vc_column', $add_css_animation);
   vc_add_param('vc_column', $css_animation_delay);   
}

$attributes = array(
    array(
      "type" => "colorpicker",
      "heading" => __('Background Color', 'js_composer'),
      "param_name" => "dt_color",
      "dependency" => Array('element' => "parallax", 'not_empty' => true),
      "description" => __("You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white ", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __('Background Color Opacity', 'js_composer'),
      "param_name" => "dt_color_opacity",
      "dependency" => Array('element' => "parallax", 'not_empty' => true),
      "description" => __("Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 70 ", "js_composer")
    ),    
    array(
      "type" => "dropdown",
      "heading" => __('Text Color Scheme', 'js_composer'),
      "param_name" => "dt_text_scheme",
      "dependency" => Array('element' => "parallax", 'not_empty' => true),
      "description" => __("Pick a color scheme for the content text. 'Light Text' looks good on dark bg images while 'Dark Text' looks good on light images.", "js_composer"),
      "value" => array(
                        __("Dark Text", 'js_composer') => 'lighter-overlay',
                        __("Light Text", 'js_composer') => 'darker-overlay'
                      )      
    ),
);
vc_add_params( 'vc_row', $attributes );

$row_settings = array (
  'front_enqueue_css' => plugins_url('assets/css/delicious-extend-vc.css', __FILE__),
);
vc_map_update( 'vc_row', $row_settings );

if (function_exists('vc_map')) {


vc_map( array(
   "name" => __("Info Line", "js_composer"),
   "weight" => 16,
   "base" => "dt-project-info",
   "icon" => plugins_url('assets/images/vc_icons/lightbulb.png', __FILE__),
   "description" => "Small piece of info",
   "class" => "info_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title"
      ),
      array(
         "type" => "dropdown",
         "heading" => __('Content Type', 'js_composer'),
         "param_name" => "content_type",
         "save_always" => true,
         "value" => array(
                           __("Plain Text", 'js_composer') => 'is-text',
                           __("Linked Text", 'js_composer') => 'is-link',
                         )      
      ), 
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Text", "js_composer"),
         "dependency" => array('element' => "content_type", 'value' => 'is-text'),
         "param_name" => "text"
      ),          
      array(
         "type" => "vc_link",
         "heading" => __('URL Address', 'js_composer'),
         "dependency" => array('element' => "content_type", 'value' => 'is-link'),
         "param_name" => "link"    
      )                
   )
) );

vc_map( array(
   "name" => __("Quote", "js_composer"),
   "weight" => 16,
   "base" => "dt-quote",
   "icon" => plugins_url('assets/images/vc_icons/lightbulb.png', __FILE__),
   "description" => "A dose of inspiration for visitors",
   "class" => "quote_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textarea",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Quote Text", "js_composer"),
         "param_name" => "text"
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Quote Author", "js_composer"),
         "param_name" => "author"
      ),
      array(
         "type" => "dropdown",
         "heading" => __('Size', 'js_composer'),
         "param_name" => "size",
         "value" => array(
                           __("Small", 'js_composer') => 'small',
                           __("Medium", 'js_composer') => 'medium',
                           __("Large", 'js_composer') => 'large'
                         )      
      ),     
      array(
         "type" => "dropdown",
         "heading" => __('Alignment', 'js_composer'),
         "param_name" => "alignment",
         "value" => array(
                           __("Left", 'js_composer') => 'left',
                           __("Center", 'js_composer') => 'center'
                         )      
      )                
   )
) );

vc_map( array(
   "name" => __("Interest Tab", "js_composer"),
   "weight" => 16,
   "base" => "dt-interest",
   "icon" => plugins_url('assets/images/vc_icons/interest-tab.png', __FILE__),
   "description" => "Interest Tab for navigation.",
   "class" => "interest_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title"
      ),
      array(
         "type" => "textarea",
         "class" => "",
         "heading" => __("Subtitle", "js_composer"),
         "param_name" => "subtitle"
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("URL", "js_composer"),
         "param_name" => "link",
         "description" => __("Set the link of the tab.", "js_composer")
      ),      
      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Background Color", "js_composer"),
         "param_name" => "bg_color",
         "value" => '#444444',
         "description" => __("Set the background color of the tab.", "js_composer")
      ),                    
      array(
         "type" => "dropdown",
         "heading" => __('Text Color Scheme', 'js_composer'),
         "param_name" => "color_scheme",
         "value" => array(
                           __("Light", 'js_composer') => 'light-tab',
                           __("Dark", 'js_composer') => 'dark-tab'
                         )      
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Extra Class Name", "js_composer"),
         "param_name" => "class",
         "description" => __("If you wish to style a tab differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
      )           
         
   )
) );


vc_map( array(
   "name" => __("Process Item", "js_composer"),
   "weight" => 15,
   "base" => "dt-process-item",
   "icon" => plugins_url('assets/images/vc_icons/process.png', __FILE__),
   "description" => "Your process with style",
   "class" => "process_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title",
         "description"  => __("Title of the Process Item", "js_composer"),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number", "js_composer"),
         "param_name" => "symbol",
         "description"  => __("Ex: 01 or 02", "js_composer"),         
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Style", "js_composer"),
         "param_name" => "style",
         "value" => array(__("Style 1", "js_composer") => "normal", __("Style 2", "js_composer") => "alternative" ),
         "description" => __("Set the style of the process item.", "js_composer"),
      ),            
      array(
         "type" => "textarea_html",
         "class" => "",
         "heading" => __("Content", "js_composer"),
         "param_name" => "content",
         "description"  => __("Description of the process.", "js_composer"),         
      )              
   )
) );



vc_map( array(
   "name" => __("Fun Fact", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/numeric_stepper.png', __FILE__),
   "base" => "dt-funfact",
   "weight" => 15,
   "description" => "Values counting to a specified target",
   "class" => "fact_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Value", "js_composer"),
         "param_name" => "data_to",
         "description" => __("Enter the value of the funfact. Ex: 34", "js_composer"),
         ),
      array(
         "type" => "textfield",
         "heading" => __("Decimals of the Value Number", "js_composer"),
         "param_name" => "data_decimals",
         "value" => 0,
         "description" => __("If you want to display the number with decimals, just insert how many decimals the number should have. Also, make sure that your number was introduced with decimals. For example, setting decimals to 2 and a number to 45.27 will properly display the number.", "js_composer"),
         ),      
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("FunFact Text", "js_composer"),
         "param_name" => "funfact_text",
         "description" => __("Enter a text for the fact. Ex: 'Projects Completed'.", "js_composer"),
      ),      
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Speed", "js_composer"),
         "param_name" => "data_speed",
         "value" => 2000,
         "description" => __("Speed for the animation(milliseconds).", "js_composer"),
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Add Left Border(optional)?", "js_composer"),
         "param_name" => "border_left",
         "value" => array(__("No, thanks!", "js_composer") => 0, __("Yes, please", "js_composer") => 1 ),
         "description" => __("You can add a left border to the fun fact.", "js_composer"),
      ),      
   )
) );



vc_map( array(
   "name" => __("Section Title", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/text.png', __FILE__),
   "weight" => 21,
   "base" => "dt-section-title",
   "class" => "title_extended",
   "description" => "Set a title and subtitle with style",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Section Title", "js_composer"),
         "param_name" => "title",
         "description" => "Define a title for the section"
      ),
      array(
         "type" => "textarea",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Section Subtitle", "js_composer"),
         "param_name" => "subtitle",
         "description" => "Define a subtitle for the section(optional)"
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Style", "js_composer"),
         "param_name" => "style",
         "save_always" => true,
         "std" => "style-1",  
         "value" => array(__("Style 1", "js_composer") => 'style-1' , __("Style 2", "js_composer") => 'style-2' , __("Style 3", "js_composer") => 'style-3' ),
         "description" => __("Set the style of the section title. There are slightly differences between styles. If you want to change them, use CSS.", "js_composer"),
      ),         
      array(
         "type" => "dropdown",
         "heading" => __("Alignment", "js_composer"),
         "param_name" => "alignment",
         "save_always" => true,
         "std" => "title-center",
         "value" => array(__("Center", "js_composer") => 'title-center' , __("Left", "js_composer") => '' ),
         "description" => __("Display the title aligned to left or centered.", "js_composer"),
      ),   
      array(
         "type" => "dropdown",
         "heading" => __("Size", "js_composer"),
         "param_name" => "size",
         "save_always" => true,
         "std" => "section-title-big",  
         "value" => array(__("Big", "js_composer") => 'section-title-big' , __("Small", "js_composer") => 'section-title-small' ),
         "description" => __("Set the size of the section title.", "js_composer"),
      ),                        
   )
) );


vc_map( array(
   "name" => __("Team Member", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/team_member_icon.png', __FILE__),
   "weight" => 12,
   "base" => "dt-team-member",
   "class" => "title_extended",
   "description" => "Member intros for your team.",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "attach_image",
         "heading" => __("Thumbnail", "js_composer"),
         "param_name" => "member_thumbnail",
         "description" => __("Upload an image for the team member. ", "js_composer")
      ),   
      array(
         "type" => "dropdown",
         "heading" => __("Style", "js_composer"),
         "param_name" => "member_style",
         "save_always" => true,
         "std" => "style-1",  
         "value" => array(__("Style 1 - Content in Thumbnail", "js_composer") => 'style-1' , __("Style 2 - Content Under Thumbnail", "js_composer") => 'style-2', __("Style 3 - Content in Thumbnail + Title under.", "js_composer") => 'style-3', __("Style 4 - Content in Lightbox + Title under.", "js_composer") => 'style-4' ),
         "description" => __("Set the style of the team member widget.", "js_composer"),
      ),                  
      array(
         "type" => "textfield",
         "heading" => __("Thumbnail size(Optional)", "js_composer"),
         "param_name" => "member_thumb_size",
         "description" => __("Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size. Recommended: 600x800", "js_composer")
      ),          
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Name", "js_composer"),
         "param_name" => "member_title",
         "description" => __("Usually, First Name + Second Name", "js_composer"),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Company Position", "js_composer"),
         "param_name" => "member_position",
         "description" => __("Position in the company. Ex: CEO", "js_composer"),
      ),
      array(
         "type" => "textarea_html",
         "class" => "",
         "heading" => __("Member Description(optional)", "js_composer"),
         "param_name" => "content",
         "description" => __("Best to use with Style 4.", "js_composer"),
      ),      
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Email Address", "js_composer"),
         "param_name" => "member_mail",
         "description" => __("Optional. Ex: member@company.com", "js_composer"),
      ),     
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Twitter URL", "js_composer"),
         "param_name" => "member_twitter",
         "description" => __("Optional. Ex: http://www.twitter.com/deliciousthemes", "js_composer"),
      ),     
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Facebook URL", "js_composer"),
         "param_name" => "member_facebook",
         "description" => __("Optional. Ex: http://www.facebook.com/deliciousthemes", "js_composer"),
      ),       
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("LInkedin URL", "js_composer"),
         "param_name" => "member_linkedin",
         "description" => __("Optional. Ex: http://www.linkedin.com/deliciousthemes", "js_composer"),
      ),          
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Google+ URL", "js_composer"),
         "param_name" => "member_google",
         "description" => __("Optional. Ex: http://plus.google.com/deliciousthemes", "js_composer"),
      ),  
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Pinterest URL", "js_composer"),
         "param_name" => "member_pinterest",
         "description" => __("Optional. Ex: http://www.pinterest.com/deliciousthemes", "js_composer"),
      ),   
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Instagram URL", "js_composer"),
         "param_name" => "member_instagram",
         "description" => __("Optional. Ex: http://www.instagram.com/deliciousthemes", "js_composer"),
      ),    
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom URL", "js_composer"),
         "param_name" => "member_custom",
         "description" => __("Optional. Ex: http://www.google.com", "js_composer"),
      ),                                                   
   )
) );


// Social Block

vc_map( array(
   "name" => __("Social Block", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/share.png', __FILE__),
   "base" => "dt-social-block",
   "description" => "Sharing on social networks widget",
   "weight" => 16,
   "class" => "social_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title before the social block (optional)", "js_composer"),
         "param_name" => "title",
         "description" => __("If you want to set a title for the social block, add it above. Something like 'Share this post' will work very well. Icons included in the social block: twitter, facebook, pinterest, google+, delicious and linkedin.", "js_composer")
      ),    
      array(
         "type" => "dropdown",
         "heading" => __("Alignment", "js_composer"),
         "param_name" => "alignment",
         "value" => array(__("Left", "js_composer") => 'align-left', __("Center", "js_composer")  => 'align-center'),
         "save_always" => true,
         "std" => "align-left",         
      ),           
   )
) );



// Portfolio Grid

$portfolio_categs = get_terms('portfolio_cats', array('hide_empty' => false));
$portfolio_cats_array = array();
$dt_placebo = array('No Thanks!' => '');
$term_vals = array();
foreach($portfolio_categs as $portfolio_categ) {
  $term_vals[$portfolio_categ->name] = delicious_get_taxonomy_cat_ID($portfolio_categ->name);
	$portfolio_cats_array[$portfolio_categ->name] = $portfolio_categ->name;
}
$dt_initial_filter = $dt_placebo + $term_vals;

vc_map( array(
   "name" => __("Portfolio Grid", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/folder_picture.png', __FILE__),
   "base" => "dt-portfolio-grid",
   "description" => "Masonry grid layout for portfolio items",
   "weight" => 20,
   'front_enqueue_js' => plugins_url('assets/js/custom/custom-isotope-portfolio.js', __FILE__),
   "class" => "portfolio_grid_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array(    
      array(
         'type' => 'radio_image_box',
         'heading' => __('Layout','js_composer'),
         'param_name' => 'dt_portf_style',
         "save_always" => true,
         "admin_label" => true,
         'value' => 'grid',
         "std" => "grid",   
         'options' => array(
            'grid' => plugins_url('assets/images/grid.png',__FILE__),
            'masonry' => plugins_url('assets/images/masonry.png',__FILE__),
            'hd' => plugins_url('assets/images/video.png',__FILE__),
            'regular' => plugins_url('assets/images/regular.png',__FILE__),
            'portrait' => plugins_url('assets/images/portrait.png',__FILE__),
         ),
         'css' => array(
            'width' => '62px',
            'height' => '62px',
            'background-repeat' => 'repeat',
            'background-size' => 'cover'
         ),
         "description" => __("Select the layout of the images inside the portfolio section. HD means high-definition and sets thumbnails to a 16:9 aspect ratio.", "js_composer")
      ),                            
      array(
         "type" => "dropdown",
         "heading" => __("Gap", "js_composer"),
         "param_name" => "dt_gap",
         "value" => array('0px' => '0', '2px' => '1', '4px' => '2', '6px' => '3', '8px' => '4', '10px' => '5', '12px' => '6', '14px' => '7', '16px' => '8', '18px' => '9', '20px' => '10', '22px' => '11', '24px' => '12', '26px' => '13', '28px' => '14', '30px' => '15', '32px' => '16', '34px' => '17', '36px' => '18', '38px' => '19', '40px' => '20'),
        "save_always" => true,
        "admin_label" => true,
        "std" => "5",         
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Select gap between grid elements.", "js_composer")
      ),                                           
      array(
         "type" => "textfield",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Number of Items to Display", "js_composer"),
         "param_name" => "number",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => 10,
         "description" => __("Set how many portfolio items would you like to include in the grid. Use '-1' to include all your items.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Thumbnail Text Mood", "js_composer"),
         "param_name" => "caption_mood",
         "value" => array(__("Light Bg / Black Text", "js_composer") => 'light-captions', __("Dark Bg / White Text", "js_composer")  => 'dark-captions'),
        "save_always" => true,
        "std" => "light-captions",         
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Select the mood of the captions on thumbnail.", "js_composer")
      ),      
      array(
         "type" => "dropdown",
         "heading" => __("Thumbnail Text Position", "js_composer"),
         "param_name" => "caption_position",
         "value" => array(__("Text on Thumbnail", "js_composer") => 'text-on-thumbnail', __("Text under Thumbnail", "js_composer")  => 'text-under-thumbnail'),
        "save_always" => true,
        "std" => "text-on-thumbnail",         
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Select the position of thumbnail text.", "js_composer")
      ),          
      array(
         "type" => "dropdown",
         "heading" => __("Display Style", "js_composer"),
         "param_name" => "distyle",
         "value" => array(__("All", "js_composer") => 'all', __("Load More Button", "js_composer")  => 'load-more-btn', __("Infinite Loading", "js_composer")  => 'load-more-infinite'),
        "save_always" => true,
        "admin_label" => true,
        "std" => "all",         
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Select display style for grid", "js_composer")
      ),        
      array(
         "type" => "textfield",
         "heading" => __("Load More + keyword", "js_composer"),
         "param_name" => "dt_load_more",
         "value" => "Load More +",
         "dependency" => Array('element' => "distyle", 'value' => 'load-more-btn'),
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Replace the Load More button string.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Load More Button 'Loading...' keyword", "js_composer"),
         "param_name" => "dt_loading",
         "dependency" => Array('element' => "distyle", 'value' => 'load-more-btn'),
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => "Loading...",
         "description" => __("Replace the 'Loading...' string of the load more button state.", "js_composer")
      ),      
      array(
         "type" => "textfield",
         "heading" => __("Infinite Scroll Loading... keyword", "js_composer"),
         "param_name" => "dt_infinite_loader",
         "dependency" => Array('element' => "distyle", 'value' => 'load-more-infinite'),
         "value" => "Loading...",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Replace the 'Loading...' string for infinite scrolling state.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "heading" => __("'No More Projects' keyword string", "js_composer"),
         "param_name" => "dt_no_projects_left",
         "dependency" => Array('element' => "distyle", 'value' => array('load-more-infinite', 'load-more-btn')),
         "value" => "No more projects to show",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Set another string for when there are no more projects to be loaded.", "js_composer")
      ),  


      array(
         "type" => "checkbox",
         "class" => "",
         "heading" =>  __("Portfolio Categories", "js_composer"),
         "param_name" => "categories",
         "value" => $portfolio_cats_array,
         "description" => __("Select from which categories to display projects(mandatory).", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),

      array(
         "type" => "dropdown",
         "heading" => __("Order By:", "js_composer"),
         "param_name" => "dt_orderby",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => array(__("Date", "js_composer") => 'date', __("Name", "js_composer") => 'name', __("ID", "js_composer") => 'id', __("Last Modified Date", "js_composer") => 'modified', __("Random", "js_composer") => 'rand'),
         "description" => __("Order the projects in the grid.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),  

      array(
         "type" => "dropdown",
         "heading" => __("Order:", "js_composer"),
         "param_name" => "dt_order",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => array(__("Descending", "js_composer") => 'DESC', __("Ascending", "js_composer") => 'ASC'),
         "description" => __("Set the direction order.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),     

      array(
         "type" => "dropdown",
         "heading" => __("Show Trigger Button?", "js_composer"),
         "param_name" => "cat_trigger",
         "value" => array(__("No Thanks!", "js_composer") => 'trigger-off', __("Yes Please!", "js_composer")  => 'trigger-on'),
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Show a trigger button for the filters.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),          

      array(
         "type" => "dropdown",
         "heading" => __("Trigger Button State", "js_composer"),
         "param_name" => "cat_trigger_state",
         "value" => array(__("Idle", "js_composer") => 'idle', __("Active", "js_composer")  => 'active'),
         "dependency" => Array('element' => "cat_trigger", 'value' => 'trigger-on'),
         "save_always" => true,
         "std" => 'idle',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
         "description" => __("Set the trigger state. Active - shows the filters. Idle - Doesn`t show the filters.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),    
      array(
         "type" => "textfield",
         "heading" => __("Trigger keyword", "js_composer"),
         "param_name" => "cat_trigger_keyword",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "dependency" => Array('element' => "cat_trigger", 'value' => 'trigger-on'),
         "value" => "Filter",
         "description" => __("Replace the 'Filter' string for the trigger button.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),        

      array(
         "type" => "textfield",
         "heading" => __("Keyword for All Projects Filter", "js_composer"),
         "param_name" => "allword",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => "All",
         "description" => __("You can replace the default 'All' keyword for the initial filter with another one. If you want to hide it, you can do it with this CSS code: .all-projects {  display: none !important; }", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),
      array(
         "type" => "dropdown",
         "heading" => __("'All' filter position.", "js_composer"),
         "param_name" => "allbam",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => array(__("At the beginning", "js_composer") => '', __("At the end", "js_composer") => 'on-the-end'),
         "description" => __("Set where the 'All' filter should be displayed: at the beginning or at the end of the filter list.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),      
      array(
         "type" => "dropdown",
         "heading" => __("Set Another Initial Filter", "js_composer"),
         "param_name" => "initial_word",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => $dt_initial_filter,
         "description" => __("You can set the portfolio grid to display projects from a certain category, on the initial state. If you want to reorder the categories, use <a href='http://goo.gl/kCYZ0L'>this plugin</a>", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Hide Filters", "js_composer"),
         "param_name" => "hide_filters",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "value" => array(__("No", "js_composer") => '', __("Yes", "js_composer") => 'dt-hide-filters'),
         "description" => __("Hide the filters from the grid.", "js_composer"),
         'group' => __( 'Filters options', 'js_composer' ),
      ),  

      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Mobile", "js_composer"),
         "param_name" => "dt_columns_mobile",
         "value" => "2",
         "description" => __("Set the grid`s number of columns for mobile devices. Screens smaller than 480px ", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Tablets", "js_composer"),
         "param_name" => "dt_columns_tablet",
         "value" => "3",
         "description" => __("Set the grid`s number of columns for tablet devices. Screens between 768px and 1024px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Small Laptop Screens", "js_composer"),
         "param_name" => "dt_columns_small_laptop",
         "value" => "4",
         "description" => __("Set the grid`s number of columns for small laptops. Screens between 1024px and 1280px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Regular Laptop Screens", "js_composer"),
         "param_name" => "dt_columns_laptop",
         "value" => "4",
         "description" => __("Set the grid`s number of columns for regular laptops. Screens between 1280px and 1440px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on PCs", "js_composer"),
         "param_name" => "dt_columns_pc",
         "value" => "6",
         "description" => __("Set the grid`s number of columns for PCs. Screens between 1440px and 1800px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Big Screen Monitors", "js_composer"),
         "param_name" => "dt_columns_big_pc",
         "value" => "6",
         "description" => __("Set the grid`s number of columns for big screen monitors. Screens with a resolution bigger than 1800px ", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),                                                                  	  
   )
) );


// Blog Carousel

$blog_cats = get_terms('category', array('hide_empty' => false));
$cats_array = array();
foreach($blog_cats as $blog_cat) {
   $cats_array[$blog_cat->name] = $blog_cat->slug;
}

vc_map( array(
   "name" => __("Blog Carousel", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/newspaper_add.png', __FILE__),
   "base" => "dt-blog-carousel",
   "weight" => 19,
   "description" => "Blog Posts Carousel",
   "class" => "blog_carousel_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of Blog Posts to Display. Use '-1' to include all your items.", "js_composer"),
         "param_name" => "number",
         "value" => 10,
         "description" => __("Set how many blog items would you like to include in the carousel.", "js_composer")
      ),
    array(
      "type" => "dropdown",
      "heading" => __("Columns", "js_composer"),
      "param_name" => "columns",
      "admin_label" => true,
      "value" => array("2" => "2", "3" => "3", "4" => "4"),
      "save_always" => true,
      "std" => 3,      
      "description" => __("Select blog carousel columns.", "js_composer")
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Select Categories", "js_composer"),
      "param_name" => "categories",
      "value" => $cats_array,
     "description" => __("Select from which categories to display blog posts(mandatory).", "js_composer")     
    ),
   array(
      "type" => "dropdown",
      "heading" => __("Sliding Direction", "js_composer"),
      "param_name" => "dt_rtl",
      "value" => array(__("LTR", "js_composer") => 'false' , __("RTL", "js_composer") => 'true' ),
      "description" => __("Set the direction of the slider: LTR(Left to Right) or RTL(Right to Left).", "js_composer"),
   ),   
      array(
         "type" => "textfield",
         "heading" => __("Carousel Speed", "js_composer"),
         "param_name" => "speed",
         "description" => __("Define the speed of the slider in milliseconds. Default is set to false (no automatic sliding). To have a carousel which automatically changes slides, use an integer value inside the textfield(ex: 5000).", "js_composer")
      ),         
   )
) );


// Blog Grid

$blog_cats = get_terms('category', array('hide_empty' => false));
$cats_array = array();
foreach($blog_cats as $blog_cat) {
   $cats_array[$blog_cat->name] = $blog_cat->slug;
}

vc_map( array(
   "name" => __("Blog Grid", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/newspaper_add.png', __FILE__),
   "base" => "dt-blog-grid",
   "weight" => 19,
   "description" => "Blog Posts Grid",
   "class" => "blog_grid_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of Blog Posts to Display. Use '-1' to include all your items.", "js_composer"),
         "param_name" => "number",
         "value" => 6,
         "description" => __("Set how many blog items would you like to include in the grid.", "js_composer")
      ),
    array(
      "type" => "dropdown",
      "heading" => __("Columns", "js_composer"),
      "param_name" => "columns",
      "admin_label" => true,
      "value" => array("2" => "2", "3" => "3", "4" => "4"),
      "save_always" => true,
      "std" => 3,      
      "description" => __("Select blog grid columns.", "js_composer")
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Select Categories", "js_composer"),
      "param_name" => "categories",
      "value" => $cats_array,
     "description" => __("Select from which categories to display blog posts(mandatory).", "js_composer")     
    ),      
   )
) );



// List styles

vc_map( array(
   "name" => __("List", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/text_list_bullets.png', __FILE__),
   "description" => "List element with icon style",
   "base" => "dt-list",
   "weight" => 15,
   "class" => "list_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array(
      array(
         "type" => "textfield",
         "admin_label" => true,
         "class" => "",
         "heading" => __("Icon Name", "js_composer"),
         "param_name" => "icon",
         "value" => "check",
         "description" => __("Please set an icon for the custom list. The entire list of icons can be found at <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>FontAwesome project page</a>. For example, if an icon is named 'fa-angle-right', the value you have to add inside the field is 'angle-right'.", "js_composer")
      ),   
      array(
         "type" => "textarea_html",
         "class" => "",
		     "admin_label" => true,
         "heading" => __("List Rows", "js_composer"),
         "param_name" => "content",
         "value" => "<ul><li>Lorem ipsum</li><li>Consectetur adipisicing</li><li>Ullamco laboris</li><li>Quis nostrud exercitation</li>",
         "description" => __("Create your list using the WordPress default functionality.", "js_composer")
      )
   )
) );



// Clients
vc_map( array(
   "name" => __("Clients Slider", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/tie.png', __FILE__),
   "base" => "dt-clients",
   "weight" => 14,
   "description" => "Slider for clients/partners logos",
   "class" => "clients_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array(   
      array(
         "type" => "attach_images",
         "class" => "",
		     "admin_label" => true,
         "heading" => __("Upload Images", "js_composer"),
         "param_name" => "images",
         "value" => "",
         "description" => __("Upload the images for your clients.", "js_composer")
      ),
      array(
         "type" => "exploded_textarea",
         "class" => "",
         "heading" => __("Clients Links", "js_composer"),
         "param_name" => "links",
         "value" => "",
         "description" => __("Enter links for each client here. Divide links with linebreaks (Enter).", "js_composer")
      ),      
      array(
         "type" => "textfield",
         "heading" => __("Image size(Optional)", "js_composer"),
         "param_name" => "thumb_size",
         "description" => __("Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size. Recommended: full", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("No. of Rows", "js_composer"),
        "param_name" => "rows",
        "admin_label" => true,
        "value" => array("1" => "1", "2" => "2", "3" => "3"),
        "description" => __("Select how many rows the carousel should have.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Big Desktop Screens", "js_composer"),
         "param_name" => "big_desktop_items",
         "value"  => 6,
         "description" => __("Set how many clients to display side by side on big desktops.", "js_composer")
      ),       
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Regular Desktop Screens", "js_composer"),
         "param_name" => "desktop_items",
         "value"  => 6,
         "description" => __("Set how many clients to display side by side on regular desktops.", "js_composer")
      ),    
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Small Desktop Screens", "js_composer"),
         "param_name" => "small_desktop_items",
         "value"  => 6,
         "description" => __("Set how many clients to display side by side on regular desktops.", "js_composer")
      ),         
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Tablet Screens", "js_composer"),
         "param_name" => "tablet_items",
         "value"  => 4,
         "description" => __("Set how many clients to display side by side on tablets.", "js_composer")
      ),   
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Big Mobile Screens", "js_composer"),
         "param_name" => "big_mobile_items",
         "value"  => 3,
         "description" => __("Set how many clients to display side by side on big mobile screens.", "js_composer")
      ),                         
      array(
         "type" => "textfield",
         "heading" => __("Items in a Row - Mobile Screens", "js_composer"),
         "param_name" => "mobile_items",
         "value"  => 2,
         "description" => __("Set how many clients the element should display side by side on regular mobile devices.", "js_composer")
      ),   
      array(
         "type" => "textfield",
         "heading" => __("Slider Speed", "js_composer"),
         "param_name" => "speed",
         "description" => __("Define the speed of the slider in milliseconds. Default is set to 5000 (5 seconds). To stop the slider, use 'false' inside the textfield.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Dots Navigation", "js_composer"),
         "param_name" => "dt_dots",
         "value" => array(__("True", "js_composer") => 'true' , __("False", "js_composer") => 'false' ),
         "description" => __("Enable/Disable dots navigation.", "js_composer"),
      ),       
      array(
         "type" => "dropdown",
         "heading" => __("Sliding Direction", "js_composer"),
         "param_name" => "dt_rtl",
         "value" => array(__("LTR", "js_composer") => 'false' , __("RTL", "js_composer") => 'true' ),
         "description" => __("Set the direction of the slider: LTR(Left to Right) or RTL(Right to Left).", "js_composer"),
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Nofollow to links?", "js_composer"),
        "param_name" => "rel",
        "admin_label" => true,
        "value" => array(__("No", "js_composer") => '', __("Yes", "js_composer") => 'nofollow'),
        "description" => __("Add nofollow attribute to links.", "js_composer")
      )                                           
   )
) );




// Progress Bar
vc_map( array(
   "name" => __("Progress Bar", "js_composer"),
   "base" => "dt-skillbar",
   "weight" => 16,
   "description" => "Display your skills with style",
   "icon" => plugins_url('assets/images/vc_icons/progressbar.png', __FILE__),
   "class" => "skillbar_extended",
   'front_enqueue_js' => plugins_url('assets/js/waypoints.min.js', __FILE__),
   "category" => __("Delicious", "js_composer"),
   "params" => array(   

      array(
         "type" => "exploded_textarea",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Graphic values", "js_composer"),
         "param_name" => "values",
         "value" => "90|Development",
         "description" => __("Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Units", "js_composer"),
         "param_name" => "units",
         "value" => "%",
         "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Extra Class Name", "js_composer"),
         "param_name" => "class",
         "description" => __("If you wish to style a skill bar differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
      )              
   )
) );




// Delicious Slider
vc_map( array(
   "name" => __("Delicious Image Slider", "js_composer"),
   "base" => "dt-portfolio-slider",
   "weight" => 18,
   "icon" => plugins_url('assets/images/vc_icons/photos.png', __FILE__),
   "description" => "Gallery with style",
   "class" => "project_slider_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "attach_images",
         "class" => "",
         "admin_label" => true,
         "heading" => __("Upload Images", "js_composer"),
         "param_name" => "images",
         "value" => "",
         "description" => __("Upload your images for the slider.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Image size(Optional)", "js_composer"),
         "param_name" => "thumb_size",
         "description" => __("Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size. Recommended: full", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Lightbox", "js_composer"),
         "param_name" => "slider_lightbox",
         "value" => array(__("Enabled", "js_composer") => 'yes', __("Disabled", "js_composer") => 'no'),
         "description" => __("Choose whether if you want to open the slider images in a ligtbox or not.", "js_composer")
      ),      
      array(
         "type" => "dropdown",
         "heading" => __("LazyLoad Images", "js_composer"),
         "param_name" => "lazyload",
         "value" => array(__("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true'),
         "description" => __("Choose whether if you want to lazy load images or not. For a faster page loading time, set the value to Yes.", "js_composer")
      ),        
      array(
         "type" => "textfield",
         "heading" => __("Slider Speed", "js_composer"),
         "param_name" => "speed",
         "description" => __("Define the speed of the slider in milliseconds. Default is set to 8000 (8 seconds). To stop the slider, use 'false' inside the textfield.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Mobile Screens - No of slides to show", "js_composer"),
         "param_name" => "mobile_slides",
         "value"  => 1,
         "description" => __("Set how many slides the slider should display side by side on mobile devices.", "js_composer")
      ),   
      array(
         "type" => "textfield",
         "heading" => __("Tablet Screens - No of slides to show", "js_composer"),
         "param_name" => "tablet_slides",
         "value"  => 1,
         "description" => __("Set how many slides the slider should display side by side on tablets.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "heading" => __("Desktop Screens - No of slides to show", "js_composer"),
         "param_name" => "desktop_slides",
         "value"  => 1,
         "description" => __("Set how many slides the slider should display side by side on desktops.", "js_composer")
      ),    
      array(
         "type" => "textfield",
         "heading" => __("Margin between slides", "js_composer"),
         "param_name" => "margin",
         "value"  => 0,
         "description" => __("Set the margin between items.", "js_composer")
      ),          
      array(
         "type" => "dropdown",
         "heading" => __("Center", "js_composer"),
         "param_name" => "center",
         "value" => array(__("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true'),
         "save_always" => true,  
         "description" => __("Choose whether if you want to center the first slide or not(works with more than 1 items).", "js_composer")
      ), 
      array(
         "type" => "dropdown",
         "heading" => __("Auto Width?", "js_composer"),
         "param_name" => "autowidth",
         "value" => array(__("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true'),
         "save_always" => true,  
         "description" => __("Choose whether if you want to have the slides with variable width and fixed height or not).", "js_composer")
      ),     
      array(
         "type" => "textfield",
         "heading" => __("Image Height(px)", "js_composer"),
         "param_name" => "imageheight",
         "dependency" => array('element' => "autowidth", 'value' => 'true'),
         "description" => __("Set a height for the images. 300px means that the images will be set to 300px in height.", "js_composer")
      ),                   
      array(
         "type" => "dropdown",
         "heading" => __("Sliding Direction", "js_composer"),
         "param_name" => "dt_rtl",
         "value" => array(__("LTR", "js_composer") => 'false' , __("RTL", "js_composer") => 'true' ),
         "description" => __("Set the direction of the slider: LTR(Left to Right) or RTL(Right to Left).", "js_composer"),
      ),  

   )
) );



// Delicious Image Gallery
vc_map( array(
   "name" => __("Delicious Image Gallery", "js_composer"),
   "base" => "dt-image-gallery",
   "weight" => 18,
   "icon" => plugins_url('assets/images/vc_icons/photos.png', __FILE__),
   'front_enqueue_js' => plugins_url('assets/js/custom/custom-gallery.js', __FILE__),
   "description" => "Gallery with style",
   "class" => "image_gallery_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "dropdown",
         "heading" => __("Gallery Type", "js_composer"),
         "param_name" => "gallery_type",
         "value" => array(__("Gallery without Filters", "js_composer") => 'g-without-filters', __("Gallery with Filters", "js_composer")  => 'g-with-filters'),
        "save_always" => true,
        "std" => "g-without-filters",         
         "description" => __("Select the type of the gallery. With Filters or without filters", "js_composer")
      ),      
      array(
         "type" => "attach_images",
         "class" => "",
         "dependency" => array('element' => "gallery_type", 'value' => 'g-without-filters'),
         "heading" => __("Upload Images", "js_composer"),
         "param_name" => "images",
         "value" => "",
         "description" => __("Upload your images for the slider.", "js_composer")
      ),         
      array(
         'type' => 'param_group',
         'heading' => __( 'Filters', 'js_composer' ),
         "dependency" => array('element' => "gallery_type", 'value' => 'g-with-filters'),
         'param_name' => 'filter_data',
         'value' => urlencode( json_encode( array(
            array(
               'filter_name' => __( 'Landscapes', 'js_composer' ),
            ),
         ) ) ),         
         'params' => array(
            array(
               "type" => "attach_images",
               "class" => "",
               "heading" => __("Upload Images", "js_composer"),
               "param_name" => "filters_images",
               "value" => "",
               "description" => __("Upload your images for the slider.", "js_composer")
            ),
            array(
               'type' => 'textfield',
               'heading' => __( 'Filter', 'js_composer' ),
               'param_name' => 'filter_name',
               "admin_label" => true,
               'description' => __( 'Enter the filter name. Ex: Landscape.', 'js_composer' ),
            ),
 
         ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("Name of the * filter", "js_composer"),
         "param_name" => "gallery_all",
         "value" => 'All',
         "dependency" => array('element' => "gallery_type", 'value' => 'g-with-filters'),
         "description" => __("Set the filter name for the one which displays all images. Default: All", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Gap", "js_composer"),
         "param_name" => "dt_gap",
         "value" => array('0px' => '0', '2px' => '2', '4px' => '4', '6px' => '6', '8px' => '8', '10px' => '10', '12px' => '12', '14px' => '14', '16px' => '16', '18px' => '18', '20px' => '20', '22px' => '22', '24px' => '24', '26px' => '26', '28px' => '28', '30px' => '30', '32px' => '32', '34px' => '34', '36px' => '36', '38px' => '38', '40px' => '40'),
        "save_always" => true,
        "std" => "20",         
         "description" => __("Select gap between images.", "js_composer")
      ),   
      array(
         "type" => "dropdown",
         "heading" => __("LazyLoad Images", "js_composer"),
         "param_name" => "dt_lazyload",
         "value" => array(__("No", "js_composer") => 'no', __("Yes", "js_composer")  => 'yes'),
        "save_always" => true,
        "std" => "no",         
         "description" => __("LazyLoad is a technique for loading images after page load.", "js_composer")
      ),              
      array(
         "type" => "dropdown",
         "heading" => __("Lightbox", "js_composer"),
         "param_name" => "gallery_lightbox",
         "value" => array(__("No", "js_composer") => 'no', __("Yes", "js_composer")  => 'yes'),
        "save_always" => true,
        "std" => "no",         
         "description" => __("Make images clickable and open the bigger versions on click.", "js_composer")
      ),     
      array(
         "type" => "dropdown",
         "heading" => __("Black and White Effect", "js_composer"),
         "param_name" => "grayscale",
         "value" => array(__("No", "js_composer") => 'no', __("Yes", "js_composer")  => 'yes'),
        "save_always" => true,
        "std" => "no",         
         "description" => __("Apply a black and white effect to images.", "js_composer")
      ),                                             
      array(
         "type" => "dropdown",
         "heading" => __("Display Style", "js_composer"),
         "param_name" => "grid_type",
         "value" => array(__("Masonry", "js_composer") => 'is-masonry', __("Tile Grid", "js_composer")  => 'is-grid'),
        "save_always" => true,
        "admin_label" => true,
        "std" => "masonry",         
         "description" => __("Select the style of the gallery", "js_composer")
      ),              
      array(
         "type" => "textfield",
         "heading" => __("Image size(Optional)", "js_composer"),
         "param_name" => "thumb_size",
         "dependency" => array('element' => "grid_type", 'value' => 'is-masonry'),
         "description" => __("Enter image size. Example: thumbnail, medium, large, full. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'full' size. Recommended: full", "js_composer")
      ),

      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Mobile", "js_composer"),
         "param_name" => "dt_columns_mobile",
         "value" => "2",
         "description" => __("Set the gallery`s number of columns for mobile devices. Screens between 480px and 768px.", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Tablets", "js_composer"),
         "param_name" => "dt_columns_tablet",
         "value" => "2",
         "description" => __("Set the gallery`s number of columns for tablet devices. Screens between 768px and 1024px.", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Small Laptop Screens", "js_composer"),
         "param_name" => "dt_columns_small_laptop",
         "value" => "3",
         "description" => __("Set the gallery`s number of columns for small laptops. Screens between 1024px and 1280px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Regular Laptop Screens", "js_composer"),
         "param_name" => "dt_columns_laptop",
         "value" => "3",
         "description" => __("Set the gallery`s number of columns for regular laptops. Screens between 1280px and 1440px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on PCs", "js_composer"),
         "param_name" => "dt_columns_pc",
         "value" => "6",
         "description" => __("Set the gallery`s number of columns for PCs. Screens between 1440px and 1800px", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),  
      array(
         "type" => "textfield",
         "heading" => __("No of Columns on Big Screen Monitors", "js_composer"),
         "param_name" => "dt_columns_big_pc",
         "value" => "6",
         "description" => __("Set the gallery`s number of columns for big screen monitors. Screens with a resolution bigger than 1800px ", "js_composer"),
         'group' => __( 'Responsive options', 'js_composer' ),
      ),           

   )
) );



// Buttons
vc_map( array(
   "name" => __("Delicious Button", "js_composer"),
   "base" => "dt-button",
   "weight" => 10,
   "icon" => plugins_url('assets/images/vc_icons/button_default.png', __FILE__),
   "description" => "Eye catching button",
   "class" => "buttons_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Text on the button", "js_composer"),
         "param_name" => "text",
         "value" => "Button Text",
         "std" => "Button Text",
         "description" => __("Text on the button.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("URL(Link)", "js_composer"),
         "param_name" => "url",
         "description" => __("Button Link.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Color", "js_composer"),
         "admin_label" => true,
         "param_name" => "btn_color",
         "value" => array(__("Orange", "js_composer") => 'orange', __("Yellow", "js_composer") => "yellow", __("Green", "js_composer") => "green", __("Blue", "js_composer") => "bleumarin", __("Rose", "js_composer") => "rose", __("Black", "js_composer") => "black", __("Red", "js_composer") => "red", __("Gray", "js_composer") => "gray", __("White", "js_composer") => "white"),
         "std" => "orange",
         "description" => __("Button color.", "js_composer")
      ),

      array(
         "type" => "dropdown",
         "heading" => __("Size", "js_composer"),
         "param_name" => "size",
         "value" => array(__("Regular", "js_composer") => '', __("Large", "js_composer") => "big"),
         "description" => __("Button Size.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Style", "js_composer"),
         "param_name" => "style",
         "value" => array(__("Bold - Solid button", "js_composer") => '', __("Thin - Border only", "js_composer") => "alt"),
         "description" => __("Button Style.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Shape Style", "js_composer"),
         "param_name" => "shape_style",
         "value" => array(__("Square", "js_composer") => 'square', __("Round", "js_composer") => "round"),
         "description" => __("Button Shape Style.", "js_composer")
      ),      
      array(
         "type" => "dropdown",
         "heading" => __("Target", "js_composer"),
         "param_name" => "target",
         "value" => array(__("Opens the link in the same window", "js_composer") => '', __("Opens the link in a new window", "js_composer") => "yes"),
         "description" => __("Set the target of the button.", "js_composer")
      ),      
      array(
         "type" => "dropdown",
         "heading" => __("Alignment", "js_composer"),
         "param_name" => "alignment",
         "value" => array(__("Left", "js_composer") => 'button-left', __("Center", "js_composer") => "button-center", __("Right", "js_composer") => "button-right"), 
         "description" => __("Button position.", "js_composer")
      ),      
      array(
         "type" => "textfield",
         "heading" => __("Icon", "js_composer"),
         "param_name" => "icon",
         "description" => __("You can use icons from FontAwesome for the button. Visit the <a target='blank' href='http://fontawesome.io/icons/'>Icons List</a> and grab the name of the icon you want to display. Ex: fa-bolt", "js_composer")
      ),  
      array(
         "type" => "dropdown",
         "heading" => __("Icon Position", "js_composer"),
         "param_name" => "icon_right",
         "value" => array(__("Icon on left", "") => '', __("Icon on right", "js_composer") => "icon_right"),
         "description" => __("Display the icon on left or right side of button text.", "js_composer"),
         "dependency" => Array('element' => "icon", 'not_empty' => true)
      ),                              
   )
) );





// Text with Icon
vc_map( array(
   "name" => __("Text with Icon", "js_composer"),
   "base" => "dt-text-icon",
   "weight" => 14,
   "icon" => plugins_url('assets/images/vc_icons/text_with_icon.png', __FILE__),
   "description" => "Text block with eye-catching icon",
   "class" => "twi_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title",
         "value" => "Awesome Title",
         "description" => __("Title of the widget.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Title Style", "js_composer"),
         "param_name" => "tbold",
         "value" => array(__("Thin", "js_composer") => '', __("Bold", "js_composer") => "bold"),
         "description" => __("Pick a style for the widget title.", "js_composer")
      ),      
      array(
         "type" => "textarea_html",
         "heading" => __("Text", "js_composer"),
         "param_name" => "content",
         "value"  => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.",
         "description" => __("Widget text.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Widget Alignment", "js_composer"),
         "param_name" => "align",
         "value" => array(__("Left", "js_composer") => 'left', __("Center", "js_composer") => "center", __("Right", "js_composer") => "right"),
         "description" => __("Set the alignment of the widget content.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Media Type", "js_composer"),
         "param_name" => "media_type",
         "value" => array(__("Font Icon", "js_composer") => 'icon-type', __("Standard Image", "js_composer") => "img-type"),
         "description" => __("Pick the media type you want to use for the widget. Font Icon - use an icon from FontAwesome. Standard Image - upload an image(jpg, png, etc.)", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Icon Name", "js_composer"),
         "param_name" => "dicon",
         "value" => "fa-camera",
         "dependency" => Array('element' => "media_type", 'value' => 'icon-type'),
         "description" => __("You can use icons from FontAwesome or LineIcons. Visit the <a target='blank' href='http://fontawesome.io/icons/'>FontAwesome Icons List</a> and <a href='https://goo.gl/gpGOSG' target='_blank'>ET Line Icons List</a> to grab the name of the icon you want to display. Ex: fa-bolt, icon-phone", "js_composer")
      ),

      array(
         "type" => "dropdown",
         "heading" => __("Icon Style", "js_composer"),
         "param_name" => "istyle",
         "value" => array(__("Bold", "js_composer") => 'bold', __("Thin", "js_composer") => "thin", __("Free", "js_composer") => "free"),
         "dependency" => Array('element' => "dicon", 'not_empty' => true),
         "description" => __("Pick a style for the icon.", "js_composer")
      ),    
      array(
         "type" => "dropdown",
         "heading" => __("Icon Background Shape", "js_composer"),
         "param_name" => "ishape",
         "value" => array(__("Square", "js_composer") => 'square', __("Circle", "js_composer") => "circle"),
         "dependency" => array('element' => 'istyle', 'value' => array('bold', 'thin')),   
         "description" => __("Pick a style for the icon background.", "js_composer")
      ),        
            
      array(
         "type" => "attach_image",
         "heading" => __("Image", "js_composer"),
         "param_name" => "img",
         "dependency" => Array('element' => "media_type", 'value' => 'img-type'),
         "description" => __("Upload an image for the widget.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "heading" => __("Title Link(optional)", "js_composer"),
         "param_name" => "title_link",
         "description" => __("Set a link for the title. Only the title will be clickable.", "js_composer")
      ),      
   )
) );




// Text with Icon
vc_map( array(
   "name" => __("Service Box", "js_composer"),
   "base" => "dt-service-box",
   "weight" => 13,
   "icon" => plugins_url('assets/images/vc_icons/service-box.png', __FILE__),
   "description" => "Service box with eye-catching icon",
   "class" => "sb_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 
      array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title",
         "value" => "Awesome Title",
         "description" => __("Title of the box.", "js_composer")
      ),   
      array(
         "type" => "dropdown",
         "heading" => __("Style", "js_composer"),
         "param_name" => "style",
         "value" => array(__("Style 1", "js_composer") => 'style-1', __("Style 2", "js_composer") => "style-2")
      ),      
      array(
         "type" => "textfield",
         "heading" => __("Link(optional)", "js_composer"),
         "param_name" => "service_link",
         "description" => __("Set a link for the box. The entire box will be clickable.", "js_composer")
      ),        
      array(
         "type" => "textarea_html",
         "heading" => __("Text", "js_composer"),
         "param_name" => "content",
         "value"  => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.",
         "description" => __("Box text.", "js_composer")
      ),

      array(
         "type" => "dropdown",
         "heading" => __("Media Type", "js_composer"),
         "param_name" => "media_type",
         "value" => array(__("Font Icon", "js_composer") => 'icon-type', __("Standard Image", "js_composer") => "img-type"),
         "description" => __("Pick the media type you want to use for the widget. Font Icon - use an icon from FontAwesome or ET Line Font. Standard Image - upload an image(jpg, png, etc.)", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Icon Name", "js_composer"),
         "param_name" => "dicon",
         "value" => "fa-camera",
         "dependency" => Array('element' => "media_type", 'value' => 'icon-type'),
         "description" => __("You can use icons from FontAwesome or LineIcons. Visit the <a target='blank' href='http://fontawesome.io/icons/'>FontAwesome Icons List</a> and <a href='https://goo.gl/gpGOSG' target='_blank'>ET Line Icons List</a> to grab the name of the icon you want to display. Ex: fa-bolt, icon-phone", "js_composer")
      ),
      array(
         "type" => "attach_image",
         "heading" => __("Image", "js_composer"),
         "param_name" => "img",
         "dependency" => Array('element' => "media_type", 'value' => 'img-type'),
         "description" => __("Upload an image for the widget.", "js_composer")
      ),      
      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Background Color", "js_composer"),
         "param_name" => "bg_color",
         "value" => '#fff',
         "description" => __("Set the background color of the tab.", "js_composer")
      ),                    
      array(
         "type" => "dropdown",
         "heading" => __('Color Scheme', 'js_composer'),
         "param_name" => "color_scheme",
         "value" => array(
                           __("Light", 'js_composer') => 'light-service',
                           __("Dark", 'js_composer') => 'dark-service'
                         )      
      ),      
   )
) );




// pricing table

vc_map( array(
   "name" => __("Pricing Table Column", "js_composer"),
   "icon" => plugins_url('assets/images/vc_icons/table_money.png', __FILE__),
   "description" => "Pricing table column element",
   "base" => "dt-pricing-column",
   "weight" => 12,
   "class" => "pricing_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array(  
      array(
         "type" => "textfield",
         "heading" => __("Plan Title", "js_composer"),
         "admin_label" => true,
         "param_name" => "pricing_title",
         "value" => "Basic",
         "description" => __("Set the title of the pricing column plan. Ex: Basic, Professional, Ultimate, etc.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Plan Price", "js_composer"),
         "param_name" => "pricing_price",
         "value" => "19",
         "description" => __("Set the price of the pricing column plan.", "js_composer")
      ),      
      array(
         "type" => "textfield",
         "heading" => __("Plan Price Currency", "js_composer"),
         "param_name" => "pricing_currency",
         "value" => "$",
         "description" => __("Set the price currency of the pricing column plan.", "js_composer")
      ),     
      array(
         "type" => "textfield",
         "heading" => __("Plan Price Interval", "js_composer"),
         "param_name" => "pricing_interval",
         "value" => "month",
         "description" => __("Set the interval of the pricing column plan. Ex: Month, Year, Week, etc.", "js_composer")
      ),       
      array(
         "type" => "textfield",
         "heading" => __("Plan Description", "js_composer"),
         "param_name" => "pricing_tagline",
         "value" => "*perfect for personal usage and testing",
         "description" => __("Set a tagline for the pricing column.", "js_composer")
      ),                        
      array(
         "type" => "exploded_textarea",
         "class" => "",
         "heading" => __("List of Features", "js_composer"),
         "param_name" => "dt_pricing_list",
         "value" => "24/7 Support,Free 10GB Storage,Documentation & Tutorials,Up to 10 Projects,Up to 3 Users",
         "description" => __("Enter the pricing package features. Divide them with linebreaks (Enter).", "js_composer")
      ),    
      array(
         "type" => "textfield",
         "heading" => __("Call to Action Button Text", "js_composer"),
         "param_name" => "pricing_cta",
         "value" => "Sign Up",
         "description" => __("Set the call to action button text.", "js_composer")
      ),            
      array(
         "type" => "textfield",
         "heading" => __("Call to Action Button Link", "js_composer"),
         "param_name" => "pricing_cta_link",
         "value" => "#",
         "description" => __("Set the call to action button link.", "js_composer")
      ),   
      array(
         "type" => "dropdown",
         "heading" => __("Color", "js_composer"),
         "param_name" => "pricing_cta_color",
         "value" => array(__("Orange", "js_composer") => 'orange', __("Yellow", "js_composer") => "yellow", __("Green", "js_composer") => "green", __("Blue", "js_composer") => "bleumarin", __("Rose", "js_composer") => "rose", __("Black", "js_composer") => "black", __("Red", "js_composer") => "red", __("Gray", "js_composer") => "gray", __("White", "js_composer") => "white"),
         "std" => "orange",
         "description" => __("Button color.", "js_composer")
      ),       
      array(
         "type" => "dropdown",
         "heading" => __("Featured Column?", "js_composer"),
         "param_name" => "pricing_featured",
         "value" => array(__("No", "js_composer") => "", __("Yes", "js_composer") => "featured-column"),
         "description" => __("Set the column as featured. It will stand out from the rest of the columns.", "js_composer")
      ),    
   )
) );



// Map element
vc_map( array(
   "name" => __("Delicious Google Map", "js_composer"),
   "base" => "dt-google-map",
   "icon" => plugins_url('assets/images/vc_icons/map.png', __FILE__),
   "description" => "Google Map Widget by DeliciousThemes",
   'front_enqueue_js' => plugins_url('assets/js/custom/custom-map.js', __FILE__),
   "weight" => 13,
   "class" => "gmap_extended",
   "category" => __("Delicious", "js_composer"),
   "params" => array( 

      array(
         "type" => "dropdown",
         "heading" => __("Widget Type", "js_composer"),
         "param_name" => "use_toggle",
         "save_always" => "true",
         "std" => "without-toggle",
         "value" => array(__("Simple Map", "js_composer") => "without-toggle", __("Map with Toggle Button", "js_composer") => "with-toggle"),
         "description" => __("Select the widget style: with or without a toggle button.", "js_composer")
      ), 

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Toggle Text", "js_composer"),
         "param_name" => "toggle_text",
         "dependency" => array('element' => "use_toggle", 'value' => 'with-toggle'),
         "value" => 'Show me the map'
      ),

      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Toggle Text Color", "js_composer"),
         "param_name" => "toggle_color",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "dependency" => array('element' => "use_toggle", 'value' => 'with-toggle'),
         "value" => '#323232',
      ),                  

      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Toggle Background Color", "js_composer"),
         "param_name" => "toggle_bg",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "dependency" => array('element' => "use_toggle", 'value' => 'with-toggle'),
         "value" => '#ffffff',
      ),

      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Toggle Hover/Active Text Color", "js_composer"),
         "param_name" => "toggle_color_hover",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "dependency" => array('element' => "use_toggle", 'value' => 'with-toggle'),
         "value" => '#323232',
      ),      

      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Toggle Hover/Active Background Color", "js_composer"),
         "param_name" => "toggle_bg_hover",
         'edit_field_class' => 'vc_col-sm-6 vc_column',
         "dependency" => array('element' => "use_toggle", 'value' => 'with-toggle'),
         "value" => '#fafafa',
      ),

      array(
         "type" => "textfield",
         "class" => "",
          "admin_label" => true,
         "heading" => __("Location Latitude", "js_composer"),
         "param_name" => "latitude",
         "value" => '40.718091'
      ),
      array(
         "type" => "textfield",
         "class" => "",
          "admin_label" => true,
         "heading" => __("Location Longitude", "js_composer"),
         "param_name" => "longitude",
         "value" => '-73.846236'
      ),
      array(
         "type" => "textfield",
         "class" => "",
          "admin_label" => true,
         "heading" => __("Pin Title", "js_composer"),
         "param_name" => "pin_title",
         "value" => 'Company Headquarters'
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Pin Description", "js_composer"),
         "param_name" => "pin_desc",
         "value" => 'Now that you visited our website, how about <br/> checking out our office too?',
         "description" => __("You can use html tags to split the content in lines.", "js_composer")
      ),
      array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Pin Color", "js_composer"),
         "param_name" => "pin_color",
         "value" => '#323232',
         "description" => __("Set the background color of the pin/marker.", "js_composer")
      ),     
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Map Min Height", "js_composer"),
         "param_name" => "height",
         "description" => __("Leave empty for 100% height. Otherwise, use CSS values like 400px.", "js_composer")
      ),  
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Map Zoom", "js_composer"),
         "param_name" => "zoom",
         "value" => '11',
         "description" => __("Set a zoom value for the map. Default: 15", "js_composer")
      ),      
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Google Map JavaScript API key", "js_composer"),
         "param_name" => "api_key",
         "value" => 'AIzaSyBkk91-NzrqkLvorbaELQgkfsS8L671uvE',
         "save_always" => true,    
         "description" => __("Set an API key for the Google Map. If not set, the map will not work. It`s best to generate one at <a target='_blank' href='https://console.developers.google.com/apis/api/maps_backend/overview'>Google Dev Console</a> ", "js_composer")
      )                                             
   )
) );


vc_map( array(
    "name" => __("Hexagon Services", "js_composer"),
    "base" => "dt_hexagons",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    // "icon" => plugins_url('assets/images/vc_icons/comments.png', __FILE__),
    "as_parent" => array('only' => 'dt_hexagon'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Hexagon", "js_composer"),
    "base" => "dt_hexagon",
    // "icon" => plugins_url('assets/images/vc_icons/testimonial.png', __FILE__),
    "content_element" => true,
    "as_child" => array('only' => 'dt_hexagons'), 
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "icon",
            "description" => __("You can use icons from FontAwesome or LineIcons. Visit the <a target='blank' href='http://fontawesome.io/icons/'>FontAwesome Icons List</a> and <a href='https://goo.gl/gpGOSG' target='_blank'>ET Line Icons List</a> to grab the name of the icon you want to display. Ex: fa-bolt, icon-phone", "js_composer")
        ),      
        array(
            "type" => "textfield",
            "heading" => __("Tooltip Text", "js_composer"),
            "param_name" => "tooltip_text",
            "admin_label" => true,
            "description" => __("Set a tooltip. Ex: Quick Development", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link(Optional)", "js_composer"),
            "param_name" => "link",
            "description" => __("Set a link for the hexagon. Ex: http://google.com", "js_composer")
        ),     
        array(
            "type" => "textfield",
            "heading" => __("Vertical Position(Optional)", "js_composer"),
            "param_name" => "vertical_position",
            "description" => __("px units. You can move the Hexagon up or down using negative and positive values(digits only). For example, to lower the hexagon with 30px, use 30.", "js_composer")
        )             
    )
) );




if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_hexagons extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_dt_hexagon extends WPBakeryShortCode {
    }
}



// process tabs


vc_map( array(
    "name" => __("Process Tabs", "js_composer"),
    "base" => "dt_process_tabs",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    "icon" => plugins_url('assets/images/vc_icons/process-tabs.png', __FILE__),
    "as_parent" => array('only' => 'dt_process_tab'), 
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
       array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Extra class name", "js_composer"),
         "param_name" => "css_class",
         "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "js_composer")
      ), 
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Process Tab", "js_composer"),
    "base" => "dt_process_tab",
    "icon" => plugins_url('assets/images/vc_icons/testimonial.png', __FILE__),
    "content_element" => true,
    "as_child" => array('only' => 'dt_process_tabs'), 
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Tab Title", "js_composer"),
            "param_name" => "tab_title",
            "admin_label" => true,
            "description" => __("Set a title for the tab button.", "js_composer")
        ),      
        array(
            "type" => "textfield",
            "heading" => __("Tab Order Number", "js_composer"),
            "param_name" => "tab_order_no",
            "admin_label" => true,
            "description" => __("Set a number for the tab.(ex: 01).", "js_composer")
        ),
      array(
         "type" => "dropdown",
         "heading" => __("Initial Tab?", "js_composer"),
         "param_name" => "current",
         "value" => array(__("No", "js_composer") => "", __("Yes", "js_composer") => "current"),
         "description" => __("Set this tab as initial(opened tab).", "js_composer")
      ),
        array(
            "type" => "textfield",
            "heading" => __("Content Title", "js_composer"),
            "param_name" => "process_title",
            "description" => __("Set the title of the process. It will appear inside the content.", "js_composer")
        ),     
        array(
            "type" => "textarea_html",
            "heading" => __("Content Body", "js_composer"),
            "param_name" => "content",
            "description" => __("The content body text of the process tab.", "js_composer")
        ),                 
    )
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_process_tabs extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_dt_process_tab extends WPBakeryShortCode {
    }
}



vc_map( array(
    "name" => __("Timeline", "js_composer"),
    "base" => "dt_timeline",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    "icon" => plugins_url('assets/images/vc_icons/timeline.png', __FILE__),
    "as_parent" => array('only' => 'dt_timeline_item'), 
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
      array(
         "type" => "dropdown",
         "heading" => __("Alignment", "js_composer"),
         "param_name" => "dt_alignment",
         "value" => array(__("Center", "js_composer") => 'timeline-center' , __("Left", "js_composer") => 'timeline-left' ),
         "description" => __("Set the alignment of the timeline.", "js_composer"),
      ),           
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Timeline Item", "js_composer"),
    "base" => "dt_timeline_item",
    "icon" => plugins_url('assets/images/vc_icons/testimonial.png', __FILE__),
    "content_element" => true,
    "as_child" => array('only' => 'dt_timeline'), 
    "params" => array(
        // add params same as with any other content element  
        array(
            "type" => "textfield",
            "heading" => __("Item Number", "js_composer"),
            "param_name" => "item_no",
            "admin_label" => true,
            "description" => __("The timeline/process item number.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item Title", "js_composer"),
            "param_name" => "item_title",
            "admin_label" => true,
            "description" => __("The timeline/process item title.", "js_composer")
        ),        
        array(
            "type" => "textarea_html",
            "heading" => __("Item Content", "js_composer"),
            "param_name" => "content",
            "description" => __("Here comes the timeline/process item text.", "js_composer")
        ),                            
    )
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_timeline extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_dt_timeline_item extends WPBakeryShortCode {
    }
}



vc_map( array(
    "name" => __("Delicious Toggle", "js_composer"),
    "base" => "dt_toggle",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    "icon" => plugins_url('assets/images/vc_icons/toggle.png', __FILE__),
    "as_parent" => array('except' => 'dt_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "js_view" => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_toggle extends WPBakeryShortCodesContainer {
    }
}


vc_map( array(
    "name" => __("Testimonials Slider", "js_composer"),
    "base" => "dt_testimonials_slider",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    "icon" => plugins_url('assets/images/vc_icons/comments.png', __FILE__),
    "as_parent" => array('only' => 'dt_testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
      array(
         "type" => "textfield",
         "heading" => __("Slider Speed", "js_composer"),
         "param_name" => "speed",
         "description" => __("Define the speed of the slider in milliseconds. Default is set to false (no automatic sliding). To have a slider which automatically changes slides, use an integer value inside the textfield(ex: 5000).", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Alignment", "js_composer"),
         "param_name" => "dt_alignment",
         "value" => array(__("Center", "js_composer") => 'testimonials-center' , __("Left", "js_composer") => 'testimonials-left' ),
         "description" => __("Set the alignment of the testimonials.", "js_composer"),
      ),       
      array(
         "type" => "dropdown",
         "heading" => __("Sliding Direction", "js_composer"),
         "param_name" => "dt_rtl",
         "value" => array(__("LTR", "js_composer") => 'false' , __("RTL", "js_composer") => 'true' ),
         "description" => __("Set the direction of the slider: LTR(Left to Right) or RTL(Right to Left).", "js_composer"),
      ),        
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Testimonial", "js_composer"),
    "base" => "dt_testimonial",
    "icon" => plugins_url('assets/images/vc_icons/testimonial.png', __FILE__),
    "content_element" => true,
    "as_child" => array('only' => 'dt_testimonials_slider'), 
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textarea_html",
            "heading" => __("Testimonial Content", "js_composer"),
            "param_name" => "content",
            "description" => __("Here comes the testimonial text.", "js_composer")
        ),      
        array(
            "type" => "textfield",
            "heading" => __("Client Name", "js_composer"),
            "param_name" => "client_name",
            "admin_label" => true,
            "description" => __("The name of the client who left the testimonial.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Client Company", "js_composer"),
            "param_name" => "client_company",
            "admin_label" => true,
            "description" => __("The name of the company the client works for.", "js_composer")
        ),
         array(
            "type" => "attach_image",
            "heading" => __("Client Thumbnail(optional)", "js_composer"),
            "param_name" => "client_thumbnail",
            "description" => __("Upload an image for the client. ", "js_composer")
         ),                  
    )
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_testimonials_slider extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_dt_testimonial extends WPBakeryShortCode {
    }
}

vc_map( array(
    "name" => __("Services Grid", "js_composer"),
    "base" => "dt_services_grid",
    "category" => __("Delicious", "js_composer"),
    "weight" => 13,
    "icon" => plugins_url('assets/images/vc_icons/wrench.png', __FILE__),
    "as_parent" => array('only' => 'dt_service'), 
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Services per Row", "js_composer"),
        "param_name" => "items_per_row",
        "save_always" => true,
        "admin_label" => true,
        "value" => array("2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6"),
        "std" => "4",
        "description" => __("Select how many services a row should have.", "js_composer")
      ),
      array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Extra class name", "js_composer"),
         "param_name" => "css_class",
         "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "js_composer")
      ),      
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Service", "js_composer"),
    "base" => "dt_service",
    "icon" => plugins_url('assets/images/vc_icons/wrench.png', __FILE__),
    "content_element" => true,
    "as_child" => array('only' => 'dt_services_grid'), 
    "params" => array(
       array(
         "type" => "textfield",
         "admin_label" => true,
         "heading" => __("Title", "js_composer"),
         "param_name" => "title",
         "description" => __("Title of the service.", "js_composer")
      ),
      array(
         "type" => "textarea_html",
         "heading" => __("Service Text", "js_composer"),
         "param_name" => "content",
         "description" => __("Service item text, which will appear on hover.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Media Type", "js_composer"),
         "param_name" => "media_type",
         "save_always" => true,
         "value" => array(__("Font Icon", "js_composer") => 'icon-type', __("Standard Image", "js_composer") => "img-type"),
         "description" => __("Pick the media type you want to use for the service. Font Icon - use an icon from FontAwesome or LineIcons. Standard Image - upload an image(jpg, png, etc.)", "js_composer")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Icon Name", "js_composer"),
         "param_name" => "dicon",
         "save_always" => true,
         "value" => "fa-camera",
         "dependency" => Array('element' => "media_type", 'value' => 'icon-type'),
         "description" => __("You can use icons from FontAwesome or LineIcons. Visit the <a target='blank' href='http://fontawesome.io/icons/'>FontAwesome Icons List</a> and <a href='https://goo.gl/gpGOSG' target='_blank'>ET Line Icons List</a> to grab the name of the icon you want to display. Ex: fa-bolt, icon-phone", "js_composer")
      ),
  
      array(
         "type" => "attach_image",
         "heading" => __("Image", "js_composer"),
         "param_name" => "img",
         "dependency" => Array('element' => "media_type", 'value' => 'img-type'),
         "description" => __("Upload an image for the service.", "js_composer")
      ),  
    )
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_dt_services_grid extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_dt_service extends WPBakeryShortCode {
    }
}


}

if(function_exists('vc_add_param')) {
   vc_add_param('dt_hexagon', $add_css_animation);
   vc_add_param('dt_hexagon', $css_animation_delay);

   vc_add_param('dt-process-item', $add_css_animation);
   vc_add_param('dt-process-item', $css_animation_delay);   

   vc_add_param('dt-text-icon', $add_css_animation);
   vc_add_param('dt-text-icon', $css_animation_delay);  

   vc_add_param('dt-service-box', $add_css_animation);
   vc_add_param('dt-service-box', $css_animation_delay);     


   vc_add_param('dt_timeline_item', $add_css_animation);
   vc_add_param('dt_timeline_item', $css_animation_delay);       
}


if (function_exists('vc_map_update')) {

   $row_update = array (
     'weight' => 100
   );

   $rev_update = array (
     'weight' => 17
   );   
   $c_update = array (
     'weight' => 13
   );     

   $no_animation = array (
      'admin_label' => false
   );


   vc_map_update('vc_row', $row_update);
   vc_map_update('vc_column_text', $row_update);
   vc_map_update('vc_empty_space', $row_update);
   
   vc_map_update('rev_slider_vc', $rev_update);
   vc_map_update('contact-form-7', $c_update);

} 

}


?>