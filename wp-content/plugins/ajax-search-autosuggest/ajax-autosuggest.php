<?php
/*
 Plugin Name: AJAX AutoSuggest
 Plugin URI: http://codenegar.com/go/aas
 Description: Get realtime suggestions of WordPress posts, pages and non builtin types (Products, Series,...)
 Author: Farhad Ahmadi
 Version: 1.9.8
 Author URI: http://codenegar.com/
*/

 /**
 * CodeNegar wordPress AJAX AutoSuggest core class
 *
 * Contains core methods, hooks, filters,...
 */

class CodeNegar_ajax_autosuggest {
	
	public $version = '20150622';
	public $commit_version = '71'; // Git repository commit version
	public $path = '';
	public $url = '';
	public $text_domain = 'ajax-autosuggest';
	public $options; // PHP stdClass
	public $security = 'CodeNegar-ajax-autosuggest-string';
	public $file = '';
	public $helper; // CodeNegar_wp_helper object
	
	function __construct() {
		$this->file = __FILE__;
		$this->path = dirname($this->file) . '/';
		$this->url = WP_PLUGIN_URL . "/" . plugin_basename(dirname(__FILE__)) . '/'; 
		require_once($this->path . 'helper.php');
		$this->helper = new CodeNegar_wp_helper();
	}
	
	public function version() {
		return $this->version;
	}
	
	public function plugins_loaded(){
		load_plugin_textdomain($this->text_domain, false, dirname(plugin_basename($this->file)) . '/languages/');
	}
	
	public function activate() {
		$options = get_option('codenegar_ajax_autosuggest');
		$defaults = $this->helper->default_options();
		$merged = codenegar_parse_args($options, $defaults);
		update_option('codenegar_ajax_autosuggest', $merged);
	}
	
	public function initialize() {
		$merged = $this->get_options();
		$this->options = $this->helper->array_to_object($merged);
		$this->helper->activate_thumbnail();
		$this->helper->add_image_size();
		$this->helper->register_sidebar();
		$this->helper->register_shortcode();
		if((in_array('page', (array)$merged['post_types']))){ // If "page" type is checked so make it publicly queryable
			$this->helper->make_pages_publicly_queryable(); 
		}
	}

	public function get_options(){
		$options = get_option('codenegar_ajax_autosuggest');
		$defaults = $this->helper->default_options();
		if(isset($options['post_types']) && count((array) $options['post_types'])>0){
			unset($defaults['post_types']); // removes default post types because user selected its own
		}
		return $merged = codenegar_parse_args($options, $defaults);
		// return $this->helper->array_to_object($merged);
	}
	
	public function show_admin_menu(){
		include $this->path . 'options.php';
	}
	
	public function admin_menu(){
		add_submenu_page('options-general.php', __('Ajax AutoSuggest', $this->text_domain), __('Ajax AutoSuggest', $this->text_domain), 'administrator', 'ajax_autosuggest_options', array(&$this, 'show_admin_menu'));
	}
    
	public function add_to_header(){
    	if(!empty($this->options->custom_css)){
    	  echo '<style type="text/css" media="screen">' . $this->options->custom_css . '</style>';
    	}
        if(!empty($this->options->custom_js)){
    	  echo '<script type="text/javascript">' . $this->options->custom_js . '</script>';
    	}
	}
	
	public function register_frontend_assets(){
		// Add frontend assets in footer
		//wp_register_style('codenegar-ajax-search-style', $this->url . 'css/style.php');
		wp_register_script('codenegar-ajax-search-migrate',  $this->url . 'js/migrate.js', array('jquery'), false, true);
		wp_register_script('codenegar-ajax-search-script-core',  $this->url . 'js/autocomplete.js', array('jquery'), false, true);
		wp_register_script('codenegar-ajax-search-script',  $this->url . 'js/script.js', array(), false, true);
	}
	
	public function register_admin_assets(){
		// Add admin assets in footer
		wp_register_style('codenegar-ajax-search-admin-style', $this->url . 'css/admin.css');
		wp_register_script('codenegar-ajax-search-jscolor', $this->url . 'js/jscolor/jscolor.js', array(), false, true);
		wp_register_script('codenegar-ajax-search-numeric', $this->url . 'js/numeric.js', array('jquery'), false, true);
		wp_register_script('codenegar-ajax-search-admin', $this->url . 'js/admin.js', array(), false, true);
	}
	
	public function load_frontend_assets() {
		//$this->helper->add_css();
		//wp_enqueue_style('codenegar-ajax-search-style');
		wp_enqueue_script('codenegar-ajax-search-migrate');
		wp_enqueue_script('codenegar-ajax-search-script-core');
		wp_enqueue_script('codenegar-ajax-search-script');
		$this->script_config();
	}
	
	public function head(){
		$this->helper->add_css();
	}
	
	public function script_config(){
		$config = (array) $this->options;
		$config['nonce'] = wp_create_nonce($this->security);
		$config['ajax_url'] = admin_url('admin-ajax.php');
		wp_localize_script('codenegar-ajax-search-script', 'codenegar_aas_config', $config);
	}
	
	public function load_admin_assets() {
		// Load admin assets only in aas option page
		if (isset($_GET['page']) && $_GET['page'] == 'ajax_autosuggest_options') {
			wp_enqueue_script('jquery');
			wp_enqueue_script('codenegar-ajax-search-jscolor');
			wp_enqueue_script('codenegar-ajax-search-numeric');
			wp_enqueue_script('codenegar-ajax-search-admin');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('postbox');
			wp_enqueue_script('underscore');
			wp_enqueue_style('codenegar-ajax-search-admin-style');
		}
	}
	
	public function include_dependency(){
		require_once($this->path . 'widget.php');
		require_once($this->path . 'ajax.php');
		require_once($this->path . 'functions.php');
		require_once($this->path . 'resize.php');
	}
}

// Create an object of CodeNegar Ajax AutoSuggest class
$codenegar_aas = new CodeNegar_ajax_autosuggest();

// Add an activation hook
register_activation_hook($codenegar_aas->file, array(&$codenegar_aas, 'activate'));

// Register frontend/admin scripts and styles
add_action('wp_enqueue_scripts', array(&$codenegar_aas, 'register_frontend_assets'));
add_action('admin_init', array(&$codenegar_aas, 'register_admin_assets'));

// Make plugin translation ready
add_action('plugins_loaded', array(&$codenegar_aas,'plugins_loaded'));

// actions to hook Plugin to Wordpress
add_action('init', array(&$codenegar_aas, 'initialize'));
add_action('admin_menu', array(&$codenegar_aas, 'admin_menu'));

// Load frontend/admin scripts and styles
add_action('wp_enqueue_scripts', array(&$codenegar_aas, 'load_frontend_assets'));
add_action('admin_enqueue_scripts', array(&$codenegar_aas, 'load_admin_assets'));

// Includes dependency scripts
$codenegar_aas->include_dependency();

// User and Admin AJAX actions
add_action('wp_ajax_ajax_autosuggest_get_search_results', 'ajax_autosuggest_get_search_results' );
add_action('wp_ajax_nopriv_ajax_autosuggest_get_search_results', 'ajax_autosuggest_get_search_results');
add_action('wp_head', array(&$codenegar_aas, 'head'));

add_filter('posts_search', 'codenegar_posts_search_handler', 100, 2 );

// Adds custom user CSS & JS to header
add_action('wp_head', array(&$codenegar_aas,'add_to_header'));
?>