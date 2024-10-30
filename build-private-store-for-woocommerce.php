<?php
/**
* Plugin Name: Build Private Store For Woocommerce
* Description: This plugin allows create OC Private Store For Woocommerce plugin.
* Version: 1.0
* Copyright: 2023
* Text Domain: build-private-store-for-woocommerce
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	exit('-1');
}
if (!defined('BPSFW_PLUGIN_DIR')) {
  define('BPSFW_PLUGIN_DIR',plugins_url('', __FILE__));
}
      
//Load all includes files
include_once('main/backend/bpsfw-backend.php');
include_once('main/frontend/bpsfw-frontend.php');
include_once('main/backend/bpsfw-common.php');
include_once('main/resource/bpsfw-load-js-css.php');
include_once('main/resource/bpsfw-language.php');
include_once('main/resource/bpsfw-load-my-plugin.php');
include_once('main/resource/bpsfw-installation-require.php');

function BPSFWP_support_and_rating_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ($plugin_file_name !== plugin_basename(__FILE__)) {
      return $links_array;
    }

    $links_array[] = '<a href="https://www.plugin999.com/support/">'. __('Support', 'build-private-store-for-woocommerce') .'</a>';
    $links_array[] = '<a href="https://wordpress.org/support/plugin/build-private-store-for-woocommerce/reviews/?filter=5">'. __('Rate the plugin ★★★★★', 'build-private-store-for-woocommerce') .'</a>';

    return $links_array;

}
add_filter( 'plugin_row_meta', 'BPSFWP_support_and_rating_links', 10, 4 );