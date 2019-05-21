<?php
/*
Plugin Name: VG WooCarousel
Plugin URI: http://themeforest.net/user/vinawebsolutions/portfolio
Description: Products Carousel for WooCommerce. You can set unlimited carousel anywhere via short-codes and easy admin setting.
Author: VinaWebSolutions
Version: 1.3
Author URI: http://themeforest.net/user/vinawebsolutions/portfolio
*/

/* If this file is called directly, abort. */
if(!defined('WPINC')) {
	die;
}

/* Defined Global Variants */
define('vgwc_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');
define('vgwc_plugin_dir', plugin_dir_path(__FILE__));
define('vgwc_is_admin', is_admin());

/* Require Once Library */
require_once(plugin_dir_path(__FILE__) . 'includes/vgwc-meta.php');
require_once(plugin_dir_path(__FILE__) . 'includes/vgwc-functions.php');

/* Load Init Scripts */
function vgwc_init_scripts()
{
	// load js, css for fontend
	if(!vgwc_is_admin)
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('owl.carousel', 	plugins_url('/includes/js/owl.carousel.js' , __FILE__) , array('jquery'));
		wp_enqueue_style('owl.carousel', 	vgwc_plugin_url . 'includes/css/owl.carousel.css');
		wp_enqueue_style('owl.theme', 		vgwc_plugin_url. 'includes/css/owl.theme.css');
	}
	
	// load css, js for backend
	if(vgwc_is_admin)
	{
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('vgwc_color_picker', plugins_url('/includes/js/color-picker.js', __FILE__), array('wp-color-picker'), false, true);
		wp_enqueue_style('vnadmin', 	vgwc_plugin_url . 'vnadmin/css/vnadmin.css');
		wp_enqueue_script('vnadmin', 	plugins_url('vnadmin/js/vnadmin.js' , __FILE__) , array('jquery'));
	}
}
add_action("init", "vgwc_init_scripts");


/* Add Action Upload Function and Filter for Shortcode */
add_action('admin_enqueue_scripts', 'wp_enqueue_media');
add_filter('widget_text', 'do_shortcode');

/* Register Activation */
function vgwc_activation()
{
	$vgwc_version= "1.0";
	update_option('vgwc_version', $vgwc_version);
	
	$vgwc_customer_type= "commercial";
	update_option('vgwc_customer_type', $vgwc_customer_type);

}
register_activation_hook(__FILE__, 'vgwc_activation');


/* Display Carousel */
function vgwc_display($atts, $content = null) 
{
	$atts 			= shortcode_atts(array('id' => ""), $atts);
	$post_id 		= $atts['id'];
	$vgwc_theme 	= get_post_meta($post_id, 'vgwc_theme', true);
	
	if(empty($vgwc_theme)) return __("Carousel ID: {$post_id} not found!", "vgwc");
	
	$vgwc_theme 	= vgwc_get_theme_path($vgwc_theme);
	$vgwc_display 	= "";
	
	require_once($vgwc_theme["dir"] . "/index.php");
	wp_enqueue_style('vgwc-style-carousel', $vgwc_theme["url"] . '/style.css');
	$vgwc_display .= call_user_func($vgwc_theme["func"], $post_id);
	
	return $vgwc_display;
}
add_shortcode('vgwc', 'vgwc_display');


/* Register Admin Menu */
function vgwc_menu_settings(){
	include(plugin_dir_path(__FILE__) . 'vgwc-settings.php');	
}

function vgwc_menu_init() {
	add_submenu_page('edit.php?post_type=vgwc', __('About VGWC', 'menu-wpt'), __('About VGWC', 'menu-wpt'), 'manage_options', 'vgwc_menu_settings', 'vgwc_menu_settings');	
}
add_action('admin_menu', 'vgwc_menu_init');