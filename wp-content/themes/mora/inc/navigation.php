<?php
/*

Posts Navigation Function

*/
function mora_navigation($mora_pages = '', $mora_range = 2)
{
	$mora_show_items = ($mora_range * 2)+1; 

	global $paged;
	if(empty($paged)) $paged = 1;

	if($mora_pages == '')
	{
		global $wp_query, $mora_blog_query;
		if (is_page_template('template-blog.php')) {
			$mora_pages = $mora_blog_query->max_num_pages;
		}
		else $mora_pages = $wp_query->max_num_pages;
		if(!$mora_pages)
		{
		 $mora_pages = 1;
		}
	}  

	if(1 != $mora_pages)
		{
		echo "<div class=\"pagenav\">";
		if($paged > 2 && $paged > $mora_range+1 && $mora_show_items < $mora_pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>".esc_html__('&laquo;', 'mora')."</a>";
		if($paged > 1 && $mora_show_items < $mora_pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>".esc_html__('&lsaquo;', 'mora')."</a>";

		for ($i=1; $i <= $mora_pages; $i++)
		{
			if (1 != $mora_pages &&( !($i >= $paged+$mora_range+1 || $i <= $paged-$mora_range-1) || $mora_pages <= $mora_show_items ))
				{
					 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
				}
		}

		if ($paged < $mora_pages && $mora_show_items < $mora_pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">".esc_html__('&rsaquo;', 'mora')."</a>";
		if ($paged < $mora_pages-1 &&  $paged+$mora_range-1 < $mora_pages && $mora_show_items < $mora_pages) echo "<a href='".esc_url(get_pagenum_link($mora_pages))."'>".esc_html__('&raquo;', 'mora')."</a>";
		echo "</div>\n";
		}
	}
?>