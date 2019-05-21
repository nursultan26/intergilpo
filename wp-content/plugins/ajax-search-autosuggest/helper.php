<?php
if (!defined('ABSPATH')) exit('No direct script access allowed');

 /**
 * CodeNegar wordPress helper class
 *
 * Contains some Wordpress functions to help building plugin
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author     	Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
class CodeNegar_wp_helper{
	
	function __construct(){
		
	}
	
	/**
	* Converts string to int and makes sure string parameters are safe
	* @param string/int/array $input, user input value
	* @param boolean $is_int, force convert to int 
	* @return string/int safe parameter
	*/
	
	public function prepare_parameter($input, $is_int=false){
	
		if(is_array($input)){
			foreach($input as $key=>$value){
				if($is_int){
					$input[$key] = intval($value);
				}else{
					$input[$key] = trim(stripslashes(strip_tags($value)));
				}
			}
		}else{
			if($is_int){
				$input = intval($input);
			}else{
				$input = trim(stripslashes(strip_tags($input)));
			}
		}
		return $input;
	}
	
	/**
	* Adds "featured image" to current theme
	*/
	
	public function activate_thumbnail(){
		 add_theme_support('post-thumbnails');
	}
	
	/**
	* Return limit length of a Wordpress post
	* @param int $limit, number of maximum characters to return
	* @return string limited character of current wordpress post
	*/
	
	public function limit_str($str, $limit=100) {
        $str = trim(strip_tags($str));
		$str = strip_shortcodes($str);
		$excerpt = mb_substr($str,0,$limit);
		if (strlen($excerpt)<strlen($str)) {
			$excerpt .= '...';
		}
		return $excerpt;
	}
	
	/**
	* Finds image from current processing Wordpress post content
	* @return string image url
	*/
	
	public function post_image(){
		global $post, $codenegar_aas;
		if(has_post_thumbnail()) {
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$thumbnail_attributes = wp_get_attachment_image_src( $post_thumbnail_id, 'search-thumbnail', false );
			return $thumbnail_attributes[0];
		}else{
			$post_image = '';
			if($codenegar_aas->options->get_first_image =='true'){
				global $post, $posts;
				ob_start();
				ob_end_clean();
				preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				$post_image = (isset($matches[1][0]))? $matches[1][0]: "";
				if($codenegar_aas->options->force_resize_first_image =='true' && !empty($post_image)){ // Force resize
						$url = $post_image;
						$width = $codenegar_aas->options->thumb_image_width;
						$height = $codenegar_aas->options->thumb_image_height;
						$crop = $codenegar_aas->options->thumb_image_crop;
						$retina = false;
						$image = matthewruddy_image_resize($url, $width, $height, $crop, $retina);
						if (is_wp_error($image)){
							$post_image = '';
						} else {
							$post_image = $image['url'];
						}
				}
			}
			if(empty($post_image)) {
				$post_image = $codenegar_aas->options->default_image;
			}
			return $post_image;
		}
	}
	
	/**
	* Adds new Wordpress Thumbnail size for using in search resultsl
	*/
	
	public function add_image_size(){
		global $codenegar_aas;
		add_image_size( 'search-thumbnail', $codenegar_aas->options->thumb_image_width, $codenegar_aas->options->thumb_image_height,  (boolean) ($codenegar_aas->options->thumb_image_crop=='true') );
	}
	
	/**
	* Removes characters that cause problem in result compiling
	*/
	
	public function remove_illegal($input){
		$illegal = array("|||");
		return str_replace($illegal, "", $input);
	}
	
	/**
	* Finds installed Wordpress post types
	* @return array of queryable post types
	*/
	
	public function get_post_types(){
		$args=array(
		  'public'   => true,
		  'publicly_queryable' => true,
		  'exclude_from_search' => false,
		  'publicly_queryable' => true,
		  '_builtin' => false,
		); 
		$output = 'names';
		$operator = 'and';
		$post_types = get_post_types($args,$output,$operator);
		
		// Add builtin post types
		$post_types['page'] = 'page';
		$post_types['post'] = 'post';
		ksort($post_types);
		return $post_types;
	}
	
	/**
	* Registers a sidebar for using widget anywhere
	*/
	
	public function register_sidebar(){
		global $codenegar_aas;
		if ( function_exists('register_sidebar') )
			register_sidebar(array(
				'name'=>__('Ajax AutoSuggest Holder', $codenegar_aas->text_domain),
				'id' => 'codenegar_ajax_autosuggest_seidebar',
				'description' => __('Add "Ajax AutoSuggest" here and use shortcode [ajax_autosuggest_form] or function  <?php ajax_autosuggest_form(); ?>.', $codenegar_aas->text_domain),
				'before_widget' => '<div id="codenegar_ajax_search_widget">',
				'after_widget' => "</div>",
				'before_title' => '<h3 id="codenegar_ajax_autosuggest_seidebar_title">',
				'after_title' => "</h3>"
			));
	}
	
	/**
	* Registers a shortcode for using widget anywhere
	*/
	
	public function shortcode(){
		ob_start();
		dynamic_sidebar("codenegar_ajax_autosuggest_seidebar");
		return ob_get_clean();
	}
	
	/**
	* Registers a shortcode for using widget anywhere
	*/
	
	public function register_shortcode(){
		add_shortcode("ajax_autosuggest_form", array(&$this, 'shortcode'));
	}
	
	/**
	* Converts stdClass to array
	* @return array of input
	*/
	
	public function object_to_array($input){
		if (is_object($input)) {
			$input = get_object_vars($input);
		}
		if (is_array($input)) {
			return array_map(array(&$this, 'object_to_array'), $input);
		}
		else {
			return $input;
		}
	}
	
	/**
	* Converts array to stdClass
	* @return stdClass of input
	*/
	
	public function array_to_object($input){
		if (is_array($input)) {
			return (object) array_map(array(&$this, 'array_to_object'), $input);
		}
		else {
			return $input;
		}
	}
	
	/**
	* By default pages are not queryable, this method make pages queryable
	*/
	
	public function make_pages_publicly_queryable(){
		global $wp_post_types;
		$wp_post_types['page']->publicly_queryable = true;
	}
	
	/**
	* HTML code needed for wordpress native uploader
	*/
	
	function image_upload_field($value='', $name='') {
		global $codenegar_aas;
	?>
		
		<input id="<?php echo $name; ?>" type="text" size="90" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
		<input id="<?php echo $name; ?>_button" type="button" value="<?php _e('Upload Image', $codenegar_aas->text_domain); ?>" />
		
		<script type='text/javascript' >
		jQuery(document).ready(function() {

			jQuery('#<?php echo $name; ?>_button').click(function() {
				formfield = jQuery('#<?php echo $name; ?>').attr('name');
				tb_show('', 'media-upload.php?post_id=1&flash=0&simple_slideshow=true&TB_iframe=true');
				return false;
			});

			window.send_to_editor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				jQuery('#<?php echo $name; ?>').val(imgurl);
				tb_remove();
			}
		});
		</script>
		
	<?php
	}
	
	/**
	* AJAX AutoSuggest default options
	* @return array of default options
	*/
	
	public function default_options(){
		$defaults = array(
			'no_of_results' => 6,
			'description_limit' => 60,
			'title_limit' => 20,
			'excluded_ids' => array(),
			'excluded_cats' => array(),
			'full_search_url' => esc_url(add_query_arg('s', '%q%', home_url('/'))),
			'min_chars' => 3,
			'ajax_delay' => 400,
			'cache_length' => 100,
			'post_types' => array_values($this->get_post_types()),
			'order_by' => 'title',
			'order' => 'DESC',
			'split_results_by_type' => 'true',
            'search_tags' => 'false',
            'search_comments' => 'false',
			'get_first_image' => 'true',
			'force_resize_first_image' => 'true',
			'default_image' => WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/' . 'image/default.png',
			'search_image' => WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/' . 'image/btn.gif',
			'thumb_image_display' => 'true',
			'thumb_image_width' => 50,
			'thumb_image_height' => 50,
			'thumb_image_crop' => 'true',
			'display_more_bar' => 'true',
			'display_result_title' => 'true',
			'enable_token' => 'true',
            'custom_css' => '',
            'custom_js' => '',
            'try_full_search_text' => 'Try Full Search...',
            'no_results_try_full_search_text' => 'No Results! Try Full Search...',
			'color'=>array(
					'results_even_bar'=> 'EBEBEB',
					'results_odd_bar'=> 'FFFFFF',
					'results_even_text'=> '000000',
					'results_odd_text'=> '000000',
					'results_hover_bar'=> '2271a9',
					'results_hover_text'=> 'FFFFFF',
					'seperator_bar'=> 'A0A0A0',
					'seperator_hover_bar'=> 'A0A0A0',
					'seperator_text'=> 'FFFFFF',
					'seperator_hover_text'=> 'FFFFFF',
					'more_bar'=> 'A0A0A0',
					'more_hover_bar'=> 'A0A0A0',
					'more_text'=> 'FFFFFF',
					'more_hover_text'=> 'FFFFFF',
					'box_border'=> 'c2c2c2',
					'box_background'=> 'FFFFFF',
					'box_text'=> '000000',
					),
			'title'=> $this->default_post_types()
		);
		return $defaults;
	}
	
	/**
	* WordPress installed post types with their human title
	* @return array of installed post types
	*/
	
	public function default_post_types(){
		$post_types = $this->get_post_types();
		global $wp_post_types;
		foreach($post_types as $name=>$title){
			if(isset($wp_post_types[$name]->labels->menu_name)){
				$post_types[$name] = $wp_post_types[$name]->labels->menu_name;
			}else{
				$post_types[$name] = ucfirst($name);
			}
		}
		return $post_types;
	}
	
	public function add_css(){
		global $codenegar_aas;
		ob_start();
		include $codenegar_aas->path . 'css/style.php';
		$css = ob_get_clean();
		//wp_add_inline_style('codenegar-aas-inline-style', $css); // for some reason it doesn't work
		$css = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$css)))));
		echo '<style type="text/css">' . $css .'</style>';
	}
}
?>