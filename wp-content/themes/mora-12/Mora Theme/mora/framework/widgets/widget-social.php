<?php
/******************************************
/* Social Widget
******************************************/
class mora_Social_Widget extends WP_Widget {

    private $mora_networks = array('facebook', 'twitter', 'google', 'instagram', 'pinterest', 'bloglovin', 'linkedin', 'dribbble', 'youtube', 'vimeo', 'flickr', 'github', 'tumblr', 'behance', 'soundcloud', 'email', 'rss');  
              
    /** constructor */
    public function __construct() {
        parent::__construct(
          'mora_social_widget', 
          esc_html__('Mora - Social', 'mora'),
          array (
            'description' => esc_html__( 'Social block widget', 'mora' )
          )
          );
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance) {   
        extract( $args );
        $mora_title = apply_filters('widget_title', $instance['title'] );

        foreach($this->mora_networks as $mora_network) {
          $$mora_network = $instance[$mora_network];
        }

        echo ''. $args['before_widget'];

        if ( $mora_title ) { 
          echo '' .$args['before_title'] . esc_attr($mora_title) . $args['after_title'];     
        }
          ?>                
            <ul id="dt-social-widget">
            <?php

            $mora_ext = '';
            if('on' == $instance['mora_newtab'] ) {
              $mora_ext = 'target="_blank"';
            }
            foreach($this->mora_networks as $mora_network) {
              if($$mora_network != '') { 

                if($mora_network == 'bloglovin') { 
                  echo '<li class="dt-social-'.$mora_network.'"><a href="'.$$mora_network.'" '.$mora_ext.'><i class="fa fa-heart"></i></a></li>';
                }
                else if($mora_network == 'email') { 
                  echo '<li class="dt-social-'.$mora_network.'"><a href="mailto:'.$$mora_network.'" '.$mora_ext.'><i class="fa fa-envelope-o"></i></a></li>';
                }
                else {
                  echo '<li class="dt-social-'.$mora_network.'"><a href="'.$$mora_network.'" '.$mora_ext.'><i class="fa fa-'.$mora_network.'"></i></a></li>';                
                }
              }
            }      
        ?>        
            </ul><!--end social-widget-->
                
          <?php 
          echo ''. $args['after_widget'];
    }

    /** @see WP_Widget::update */
    public function update($new_instance, $old_instance) {          
    
      $instance = $old_instance;

      $instance['title'] = strip_tags($new_instance['title']);

      foreach($this->mora_networks as $mora_network) {
        $instance[$mora_network] = strip_tags($new_instance[$mora_network]);
      }   

      $instance['mora_newtab'] = $new_instance['mora_newtab'];
      
      return $instance;
    }

    /** @see WP_Widget::form */
    public function form($instance) {

        $defaults = array();
        foreach($this->mora_networks as $mora_network) {
          $defaults[$mora_network] = '';
        } 
        $defaults['title'] = esc_html__('Connect with Us', 'mora');
        $defaults['mora_newtab'] = 'on';
        $instance = wp_parse_args( (array) $instance, $defaults );  

        $mora_title = $instance['title'];
        ?>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title: ', 'mora'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($mora_title); ?>" />
        </p>

        <?php
        foreach($this->mora_networks as $mora_network) {
          $$mora_network = $instance[$mora_network]; 
          ?>
         <p>
          <label for="<?php echo esc_attr($this->get_field_id($mora_network)); ?>"><?php echo esc_html(ucfirst($mora_network)); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id($mora_network)); ?>" name="<?php echo esc_attr($this->get_field_name($mora_network)); ?>" type="text" value="<?php echo esc_attr($$mora_network); ?>" />
        </p>
          <?php
        }  
        ?>
        <p>
          <input class="checkbox" type="checkbox" <?php checked($instance['mora_newtab'], 'on'); ?> id="<?php echo ''. $this->get_field_id('mora_newtab'); ?>" name="<?php echo ''. $this->get_field_name('mora_newtab'); ?>" /> 
          <label for="<?php echo ''. $this->get_field_id('mora_newtab'); ?>">Open links in a new tab</label>
        </p>   
    <?php     
    }

} // class mora_Social_Widget
// register Social widget
add_action( 'widgets_init', function(){
     register_widget( 'mora_Social_Widget' );
});
?>