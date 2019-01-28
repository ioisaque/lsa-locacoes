<?php
/**
 * Version: 4.12.2
 * @package Meta Box
 */

if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once get_template_directory() . '/framework/meta-box/meta-box/inc/loader.php';
	$loader = new RWMB_Loader;
	$loader->init();
}
