<?php
/** Breadcrumbs */

function mora_breadcrumbs() {

    $mora_data = mora_dt_data();
 
    $mora_text['home']     = esc_html__('Home', 'mora'); 
    $mora_text['category'] = '%s'; 
    $mora_text['search']   = "%s";
    $mora_text['tag']      = "%s";
    $mora_text['author']   = '%s'; 
    $mora_text['404']      = esc_html__('Error 404', 'mora'); 
 
    $mora_show_current   = 1; 
    $mora_show_on_home   = 0;
    $mora_show_home_link = 1;
    $mora_show_title     = 1;
    $mora_delimiter      = ' <i class="fa fa-angle-right"></i> '; 
    $mora_before         = '<span class="current">';
    $mora_after          = '</span>';
 
    global $post;
    $mora_home_link    = home_url('/');
    $mora_link_before  = '';
    $mora_link_after   = '';
    $mora_link_attr    = '';
    $mora_link         = $mora_link_before . '<a' . $mora_link_attr . ' href="%1$s">%2$s</a>' . $mora_link_after;
    $mora_parent_id    = $mora_parent_id_2 = isset($post) ? $post->post_parent : 0;
    $mora_frontpage_id = get_option('page_on_front');

    $mora_blog_keyword = esc_html__('Blog', 'mora'); 
    $mora_portfolio_keyword = $mora_blog_keyword = esc_html__('Portfolio', 'mora'); 
    if(!empty($mora_data['mora_breadcrumbs_blog_keyword'])) {
        $mora_blog_keyword = $mora_data['mora_breadcrumbs_blog_keyword'];
    }
    if(!empty($mora_data['mora_breadcrumbs_portfolio_keyword'])) {
        $mora_portfolio_keyword = $mora_data['mora_breadcrumbs_portfolio_keyword'];
    }    
 
    if (is_home() || is_front_page()) {
 
        if ($mora_show_on_home == 1) echo '<span class="current">' . $mora_text['home'] . '</span>';
 
    } else {
 
        if ($mora_show_home_link == 1) {
            echo sprintf($mora_link, $mora_home_link, $mora_text['home']);
            if ($mora_frontpage_id == 0 || $mora_parent_id != $mora_frontpage_id) echo ''.$mora_delimiter .'';
        }
 
        if ( is_category() ) {
            $mora_this_cat = get_category(get_query_var('cat'), false);
            if ($mora_this_cat->parent != 0) {
                $mora_cats = get_category_parents($mora_this_cat->parent, TRUE, $mora_delimiter);
                if ($mora_show_current == 0) $mora_cats = preg_replace("#^(.+)$mora_delimiter$#", "$1", $mora_cats);
                $mora_cats = str_replace('<a', $mora_link_before . '<a' . $mora_link_attr, $mora_cats);
                $mora_cats = str_replace('</a>', '</a>' . $mora_link_after, $mora_cats);
                if ($mora_show_title == 0) $mora_cats = preg_replace('/ title="(.*?)"/', '', $mora_cats);
                echo '' .$mora_cats ;
            }
            if ($mora_show_current == 1) echo '' . $mora_before . sprintf($mora_text['category'], single_cat_title('', false)) . $mora_after;
 
        } elseif ( is_search() ) {
            echo '' . $mora_before . sprintf($mora_text['search'], get_search_query()) . $mora_after;
 
        } elseif ( is_day() ) {
            echo sprintf($mora_link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $mora_delimiter;
            echo sprintf($mora_link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $mora_delimiter;
            echo '' . $mora_before . get_the_time('d') . $mora_after;
 
        } elseif ( is_month() ) {
            echo sprintf($mora_link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $mora_delimiter;
            echo '' . $mora_before . get_the_time('F') . $mora_after;
 
        } elseif ( is_year() ) {
            echo '' . $mora_before . get_the_time('Y') . $mora_after;
 
        } elseif ( is_single() && !is_attachment() ) {
             if ( get_post_type() == 'post' ) {
                if(!empty($mora_data['mora_breadcrumbs_blog_url'])) {
                    echo '<a href="' . esc_url($mora_data['mora_breadcrumbs_blog_url']) . '">' . $mora_blog_keyword . '</a> ' . $mora_delimiter . ' ';
                }
                echo '' . $mora_before . get_the_title() . $mora_after;
            }
            else
            if ( get_post_type() == 'portfolio' ) {
                if(!empty($mora_data['mora_breadcrumbs_blog_url'])) {
                    echo '<a href="' . esc_url($mora_data['mora_breadcrumbs_portfolio_url']) . '">' . $mora_portfolio_keyword . '</a> ' . $mora_delimiter . ' ';
                }
                echo '' . $mora_before . get_the_title() . $mora_after;
            }   

             else {
                $mora_cat = get_the_category(); $mora_cat = $mora_cat[0];
                if ($mora_cat->cat_ID != 1) { //Не показывать категорию "Без рубрики"
                    $mora_cats = get_category_parents($mora_cat, TRUE, $mora_delimiter);
                    if ($mora_show_current == 0) $mora_cats = preg_replace("#^(.+)$mora_delimiter$#", "$1", $mora_cats);
                    $mora_cats = str_replace('<a', $mora_link_before . '<a' . $mora_link_attr, $mora_cats);
                    $mora_cats = str_replace('</a>', '</a>' . $mora_link_after, $mora_cats);
                    if ($mora_show_title == 0) $mora_cats = preg_replace('/ title="(.*?)"/', '', $mora_cats);
                    echo '' . $mora_cats;
                }
                if ($mora_show_current == 1) echo '' . $mora_before . get_the_title() . $mora_after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $mora_post_type = get_post_type_object(get_post_type());
            echo '' . $mora_before . $mora_post_type->labels->singular_name . $mora_after;
 
        } elseif ( is_attachment() ) {
            $mora_parent = get_post($mora_parent_id);
            $mora_cat = get_the_category($mora_parent->ID); $mora_cat = $mora_cat[0];
            $mora_cats = get_category_parents($mora_cat, TRUE, $mora_delimiter);
            $mora_cats = str_replace('<a', $mora_link_before . '<a' . $mora_link_attr, $mora_cats);
            $mora_cats = str_replace('</a>', '</a>' . $mora_link_after, $mora_cats);
            if ($mora_show_title == 0) $mora_cats = preg_replace('/ title="(.*?)"/', '', $mora_cats);
            echo '' . $mora_cats;
            printf($mora_link, get_permalink($mora_parent), $mora_parent->post_title);
            if ($mora_show_current == 1) echo '' . $mora_delimiter . $mora_before . get_the_title() . $mora_after;
 
        } elseif ( is_page() && !$mora_parent_id ) {
            if ($mora_show_current == 1) echo '' . $mora_before . get_the_title() . $mora_after;
 
        } elseif ( is_page() && $mora_parent_id ) {
            if ($mora_parent_id != $mora_frontpage_id) {
                $mora_breadcrumbs = array();
                while ($mora_parent_id) {
                    $page = get_page($mora_parent_id);
                    if ($mora_parent_id != $mora_frontpage_id) {
                        $mora_breadcrumbs[] = sprintf($mora_link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $mora_parent_id = $page->post_parent;
                }
                $mora_breadcrumbs = array_reverse($mora_breadcrumbs);
                for ($mora_i = 0; $mora_i < count($mora_breadcrumbs); $mora_i++) {
                    echo '' . $mora_breadcrumbs[$mora_i];
                    if ($mora_i != count($mora_breadcrumbs)-1) echo '' . $mora_delimiter;
                }
            }
            if ($mora_show_current == 1) {
                if ($mora_show_home_link == 1 || ($mora_parent_id_2 != 0 && $mora_parent_id_2 != $mora_frontpage_id)) echo '' . $mora_delimiter;
                echo '' . $mora_before . get_the_title() . $mora_after;
            }
 
        } elseif ( is_tag() ) {
            echo '' . $mora_before . sprintf($mora_text['tag'], single_tag_title('', false)) . $mora_after;
 
        } elseif ( is_author() ) {
            global $author;
            $mora_userdata = get_userdata($author);
            echo '' . $mora_before . sprintf($mora_text['author'], $mora_userdata->display_name) . $mora_after;
 
        } elseif ( is_404() ) {
            echo '' . $mora_before . $mora_text['404'] . $mora_after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo esc_html__('Page', 'mora') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
    }
}
?>