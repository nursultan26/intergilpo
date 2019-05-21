<?php
/**
 * @version    1.6
 * @package    VG Greek
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright(C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */

//Require plugins
require_once get_template_directory(). '/class-tgm-plugin-activation.php';

function greek_register_required_plugins() {

    $plugins = array(
		array(
            'name'               => esc_html__('VinaGecko Helper', 'greek'),
            'slug'               => 'vinagecko-helper',
            'source'             => get_template_directory() . '/plugins/vinagecko-helper.zip',
            'required'           => true,
            'external_url'       => '',
     ),
		array(
            'name'               => esc_html__('VG WooCarousel', 'greek'),
            'slug'               => 'vg-woocarousel',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/vg-woocarousel.zip'),
            'required'           => true,
            'external_url'       => '',
     ),
		array(
            'name'               => esc_html__('Mega Main Menu', 'greek'),
            'slug'               => 'mega_main_menu',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/mega_main_menu.zip'),
            'required'           => true,
            'external_url'       => '',
     ),
        array(
            'name'               => esc_html__('Simple Post Carousel', 'greek'),
            'slug'               => 'simple-post-carousel',
            'source'             => get_template_directory() . '/plugins/simple-post-carousel.zip',
            'required'           => true,
            'external_url'       => '',
     ),
		array(
            'name'               => esc_html__('Revolution Slider', 'greek'),
            'slug'               => 'revslider',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/revslider.zip'),
            'required'           => true,
            'external_url'       => '',
     ),
		array(
            'name'               => esc_html__('Visual Composer', 'greek'),
            'slug'               => 'js_composer',
            'source'             => esc_url('http://wordpress.vinagecko.net/l/js_composer.zip'),
            'required'           => true,
            'external_url'       => '',
     ),
	 array(
		'name'      		 => esc_html__('WordPress AJAX Search & AutoSuggest Plugin', 'greek'),
		'slug'     			 => 'ajax-search-autosuggest',
		'required' 			 => true,
		'source'             => esc_url('http://wordpress.vinagecko.net/l/ajax-autosuggest-plugin.zip'),
		'external_url'       => '',
	),
		
        // Plugins from the WordPress Plugin Repository.
		array(
            'name'               => esc_html__('Shortcodes Ultimate', 'greek'),
            'slug'               => 'shortcodes-ultimate',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
     ),
		array(
            'name'               => esc_html__('Redux Framework', 'greek'),
            'slug'               => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
     ),
        array(
            'name'      => esc_html__('Contact Form 7', 'greek'),
            'slug'      => 'contact-form-7',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('MailPoet Newsletters', 'greek'),
            'slug'      => 'wysija-newsletters',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('Projects', 'greek'),
            'slug'      => 'projects-by-woothemes',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('TinyMCE Advanced', 'greek'),
            'slug'      => 'tinymce-advanced',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('TweetScroll Widget', 'greek'),
            'slug'      => 'tweetscroll-widget',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('Widget Importer & Exporter', 'greek'),
            'slug'      => 'widget-importer-exporter',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('WooCommerce', 'greek'),
            'slug'      => 'woocommerce',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('YITH WooCommerce Compare', 'greek'),
            'slug'      => 'yith-woocommerce-compare',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('YITH WooCommerce Wishlist', 'greek'),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('YITH WooCommerce Zoom Magnifier', 'greek'),
            'slug'      => 'yith-woocommerce-zoom-magnifier',
            'required'  => true,
     ),
		array(
            'name'      => esc_html__('Image Widget', 'greek'),
            'slug'      => 'image-widget',
            'required'  => true,
     ),
 );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__('Install Required Plugins', 'greek'),
            'menu_title'                      => esc_html__('Install Plugins', 'greek'),
            'installing'                      => esc_html__('Installing Plugin: %s', 'greek'), // %s = plugin name.
            'oops'                            => esc_html__('Something went wrong with the plugin API.', 'greek'),
            'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link'                   => _n_noop('Begin activating plugin', 'Begin activating plugins'),
            'return'                          => esc_html__('Return to Required Plugins Installer', 'greek'),
            'plugin_activated'                => esc_html__('Plugin activated successfully.', 'greek'),
            'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'greek'), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
     )
 );

    tgmpa($plugins, $config);

}
add_action('tgmpa_register', 'greek_register_required_plugins'); 

//Init the Redux Framework
if(class_exists('ReduxFramework') && !isset($redux_demo) && file_exists(get_template_directory().'/theme-config.php')) {
    require_once(get_template_directory().'/theme-config.php');
}

//Add Woocommerce support
add_theme_support('woocommerce');
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals');

//Override woocommerce widgets
function greek_override_ajaxsearch_autosuggest_widgets() {
	//Show mini cart on all pages
	if ( class_exists( 'Ajax_search_widget' ) ) {
		unregister_widget( 'Ajax_search_widget' ); 
		include_once( get_template_directory() . '/include/ajax-search-autosuggest.php' );
		register_widget( 'Custom_Ajax_search_widget' );
	}
}
add_action( 'widgets_init', 'greek_override_ajaxsearch_autosuggest_widgets', 15 );

//Override woocommerce widgets
function greek_override_woocommerce_widgets() {
	//Show mini cart on all pages
	if(class_exists('WC_Widget_Cart')) {
		unregister_widget('WC_Widget_Cart'); 
		include_once(get_template_directory() . '/woocommerce/class-wc-widget-cart.php');
		register_widget('Custom_WC_Widget_Cart');
	}
}
add_action('widgets_init', 'greek_override_woocommerce_widgets', 15);

// Ensure cart contents update when products are added to the cart via AJAX(place the following in functions.php)
function greek_woocommerce_header_add_to_cart_fragment($fragments) {
	ob_start();
	?>
	
	<span class="mcart-number"><?php echo WC()->cart->cart_contents_count; ?></span>
	
	<?php
	$fragments['span.mcart-number'] = ob_get_clean();
	
	return $fragments;
} 
add_filter('woocommerce_add_to_cart_fragments', 'greek_woocommerce_header_add_to_cart_fragment');

//Change price html
function greek_woo_price_html($price,$product){
	// return $product->price;
	if($product->price > 0) {
		if($product->price && isset($product->regular_price) &&($product->price!=$product->regular_price)) {
			$from = $product->regular_price;
			$to = $product->price;
			
			return '<span class="old-price">'.((is_numeric($from)) ? woocommerce_price($from) : $from) .'</span><span class="special-price">'.((is_numeric($to)) ? woocommerce_price($to) : $to) .'</span>';
		} else {
			$to = $product->price;
			
			return '<span class="special-price">' .((is_numeric($to)) ? woocommerce_price($to) : $to) . '</span>';
		}
	} else {
		return '<span class="special-price">0</span>';
	}
}
add_filter('woocommerce_get_price_html', 'greek_woo_price_html', 100, 2);

// Add image to category description
function greek_woocommerce_category_image() {
	if(is_product_category()){
		global $wp_query;
		
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
		$image = wp_get_attachment_url($thumbnail_id);
		
		if($image) {
			echo '<p class="category-image-desc"><img src="' . esc_url($image) . '" alt="" /></p>';
		}
	}
}
add_action('woocommerce_archive_description', 'greek_woocommerce_category_image', 2);

// Change products per page
function greek_woo_change_per_page() {
	global $greek_options;
	
	return $greek_options['product_per_page'];
}
add_filter('loop_shop_per_page', 'greek_woo_change_per_page', 20);

//Limit number of products by shortcode [products]
//add_filter('woocommerce_shortcode_products_query', 'greek_woocommerce_shortcode_limit');
function greek_woocommerce_shortcode_limit($args) {
	global $greek_options, $greek_productsfound;
	
	if(isset($greek_options['shortcode_limit']) && $args['posts_per_page']==-1) {
		$args['posts_per_page'] = $greek_options['shortcode_limit'];
	}
	
	$greek_productsfound = new WP_Query($args);
	$greek_productsfound = $greek_productsfound->post_count;
	
	return $args;
}

//Change number of related products on product page. Set your own value for 'posts_per_page'
function greek_woo_related_products_limit($args) {
	global $product, $greek_options;
	$args['posts_per_page'] = $greek_options['related_amount'];

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'greek_woo_related_products_limit');

//move message to top
remove_action('woocommerce_before_shop_loop', 'wc_print_notices', 10);
add_action('woocommerce_show_message', 'wc_print_notices', 10);

//Single product organize
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_show_related_products', 'woocommerce_output_related_products', 20);

//remove rating
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

//Display social sharing on product page
function greek_woocommerce_social_share(){
	global $greek_options;
?>
	<div class="share_buttons">
		<?php if($greek_options['share_code']!='') {
			echo wp_kses($greek_options['share_code'], array(
				'div' => array(
					'class' => array()
				),
				'span' => array(
					'class' => array(),
					'displayText' => array()
				),
			));
		} ?>
	</div>
<?php
}
add_action('woocommerce_share', 'greek_woocommerce_social_share', 35);

//Display stock status on product page
function greek_product_stock_status(){
	global $product;
	?>
	<div class="stock-status">
		<?php if($product->is_in_stock()){ ?>
			<span><?php esc_html_e('In stock', 'greek');?></span>
		<?php } else { ?>
			<span><?php esc_html_e('Out of stock', 'greek');?></span>
		<?php } ?>
	</div>
	<?php
}
add_action('woocommerce_single_product_summary', 'greek_product_stock_status', 20); 
 
//Show countdown on product page
function greek_product_countdown(){
	global $product;
	?>
	<div class="count-down">
		<div class="actions">
			<div class="action-buttons">
				<div class="add-to-links">
					<?php echo do_shortcode('[yith_compare_button]') ?>
					<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
				</div>
				<?php echo '<div class="sharefriend"><a href="mailto: yourfriend@domain.com?Subject=Checkout this product: '.$product->get_title().'">'.esc_html__('Email your friend', 'greek').'</a></div>'; ?>
			</div>
		</div>
		<div class="counter">
			<?php
			$countdown = false;
			$sale_end = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
			/* simple product */
			if($sale_end){
				$countdown = true;
				$sale_end = date('Y/m/d',(int)$sale_end);
				?>
				<div class="countbox hastime" data-time="<?php echo esc_attr($sale_end); ?>"></div>
			<?php } ?>
			<?php /* variable product */
			if($product->get_children()){
				$vsale_end = array();
				
				foreach($product->get_children() as $pvariable){
					$vsale_end[] =(int)get_post_meta($pvariable, '_sale_price_dates_to', true);
					
					if(get_post_meta($pvariable, '_sale_price_dates_to', true)){
						$countdown = true;
					}
				}
				if($countdown){
					/* get the latest time */
						$vsale_end_date = max($vsale_end);
						$vsale_end_date = date('Y/m/d', $vsale_end_date);
						?>
						<div class="countbox hastime" data-time="<?php echo esc_attr($vsale_end_date); ?>"></div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php
}
//add_action('woocommerce_single_product_summary', 'greek_product_countdown', 15); 
 
//Show buttons wishlist, compare, email on product page
function greek_product_buttons(){
	global $product;
	?>
	<div class="actions">
		<div class="action-buttons">
			<div class="add-to-links">
				<?php echo do_shortcode('[yith_compare_button]') ?>
				<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
			</div>
			<?php echo '<div class="sharefriend"><a href="mailto: yourfriend@domain.com?Subject=Checkout this product: '.$product->get_title().'">'.esc_html__('Email your friend', 'greek').'</a></div>'; ?>
		</div>
	</div>
	<?php
}
add_action('woocommerce_single_product_summary', 'greek_product_buttons', 30);


//Project organize
remove_action('projects_before_single_project_summary', 'projects_template_single_title', 10);
add_action('projects_single_project_summary', 'projects_template_single_title', 5);
remove_action('projects_before_single_project_summary', 'projects_template_single_short_description', 20);
remove_action('projects_before_single_project_summary', 'projects_template_single_gallery', 40);
add_action('projects_single_project_gallery', 'projects_template_single_gallery', 40);
//projects list
remove_action('projects_loop_item', 'projects_template_loop_project_title', 20); 
 
//Change search form
function greek_search_form($form) {
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = esc_html__('Поиск...', 'greek');
	}
	
	$form = '<form role="search" method="get" id="blogsearchform" class="searchform" action="' . esc_url(home_url('/')). '" >
	<div class="form-input">
		<input class="input_text" type="text" value="'.esc_attr($search_str).'" name="s" id="search_input" />
		<button class="button" type="submit" id="blogsearchsubmit"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="post" />
		</div>
	</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#search_input").focus(function(){
			if(jQuery(this).val()=="'.esc_html__('Поиск...', 'greek').'"){
				jQuery(this).val("");
			}
		});
		jQuery("#search_input").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'.esc_html__('Поиск...', 'greek').'");
			}
		});
		jQuery("#blogsearchsubmit").click(function(){
			if(jQuery("#search_input").val()=="'.esc_html__('Поиск...', 'greek').'" || jQuery("#search_input").val()==""){
				jQuery("#search_input").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter('get_search_form', 'greek_search_form'); 
 
//Change woocommerce search form
function greek_woo_search_form($form) {
	global $wpdb;
	
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = esc_html__('Поиск товаров...', 'greek');
	}
	
	$form = '<form role="search" method="get" id="searchform" action="'.esc_url(home_url('/')).'">';
		$form .= '<div>';
			$form .= '<input type="text" value="'.esc_attr($search_str).'" name="s" id="ws" placeholder="" />';
			$form .= '<button class="btn btn-primary" type="submit" id="wsearchsubmit"><i class="fa fa-search"></i></button>';
			$form .= '<input type="hidden" name="post_type" value="product" />';
		$form .= '</div>';
	$form .= '</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#ws").focus(function(){
			if(jQuery(this).val()=="'.esc_html__('Поиск товаров...', 'greek').'"){
				jQuery(this).val("");
			}
		});
		jQuery("#ws").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'.esc_html__('Поиск товаров...', 'greek').'");
			}
		});
		jQuery("#wsearchsubmit").click(function(){
			if(jQuery("#ws").val()=="'.esc_html__('Поиск товаров...', 'greek').'" || jQuery("#ws").val()==""){
				jQuery("#ws").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter('get_product_search_form', 'greek_woo_search_form'); 
 
//Add breadcrumbs
function greek_breadcrumb() {
	global $post;
	echo '<div class="breadcrumbs">';
    if(!is_home()) {
        echo '<a href="';
        echo esc_url(home_url('/'));
        echo '">';
        echo esc_html__('Главная', 'greek');
        echo '</a><span class="separator">/</span>';
        if(is_category() || is_single()) {
            the_category(' <span class="separator">/</span> ');
            if(is_single()) {
                echo '<span class="separator">/</span>';
                the_title();
            }
        } elseif(is_page()) {
            if($post->post_parent){
				$anc = get_post_ancestors($post->ID);
				$title = get_the_title();
				foreach($anc as $ancestor) {
					$output = '<a href="'.esc_url(get_permalink($ancestor)).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a><span class="separator">/</span>';
				}
				echo $output;
				echo '<span title="'.$title.'"> '.$title.'</span>';
			} else {
				echo '<span> '.get_the_title().'</span>';
			}
        }
		elseif(is_tag()) {single_tag_title();}
		elseif(is_day()) {echo "<span>". esc_html__('Archive for', 'greek'); the_time('F jS, Y'); echo'</span>';}
		elseif(is_month()) {echo "<span>". esc_html__('Archive for', 'greek'); the_time('F, Y'); echo'</span>';}
		elseif(is_year()) {echo "<span>". esc_html__('Archive for', 'greek'); the_time('Y'); echo'</span>';}
		elseif(is_author()) {echo "<span>". esc_html__('Author Archive', 'greek').'</span>';}
		elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>". esc_html__('Blog Archives', 'greek').'</span>';}
		elseif(is_search()) {echo "<span>". esc_html__('Search Results', 'greek').'</span>';}
	} else {
		echo '<a href="';
        echo esc_url(home_url('/'));
        echo '">';
        echo esc_html__('Главная', 'greek');
        echo '</a><span class="separator">/</span>';
		esc_html_e('Blog', 'greek');
	}
	echo '</div>';
}
function greek_limitStringByWord($string, $maxlength, $suffix = '') {

	if(function_exists('mb_strlen')) {
		// use multibyte functions by Iysov
		if(mb_strlen($string)<=$maxlength) return $string;
		$string = mb_substr($string, 0, $maxlength);
		$index = mb_strrpos($string, ' ');
		if($index === FALSE) {
			return $string;
		} else {
			return mb_substr($string, 0, $index).$suffix;
		}
	} else { // original code here
		if(strlen($string)<=$maxlength) return $string;
		$string = substr($string, 0, $maxlength);
		$index = strrpos($string, ' ');
		if($index === FALSE) {
			return $string;
		} else {
			return substr($string, 0, $index).$suffix;
		}
	}
} 
// Set up the content width value based on the theme's design and stylesheet.
if(! isset($content_width))
	$content_width = 625; 


function greek_setup() {
	/*
	 * Makes greek Themes available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on VinaGecko, use a find and replace
	 * to change 'greek' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('greek', get_template_directory() . '/languages');

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// This theme supports a variety of post formats.
	add_theme_support('post-formats', array('image', 'gallery', 'video', 'audio'));

	// Register menus
	register_nav_menu('primary', esc_html__('Primary Menu', 'greek'));
	register_nav_menu('top-menu', esc_html__('Top Menu', 'greek'));
	register_nav_menu('mobilemenu', esc_html__('Mobile Menu', 'greek'));

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support('custom-background', array(
		'default-color' => 'e6e6e6',
	));
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');
	
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support('post-thumbnails');

	set_post_thumbnail_size(1170, 9999); // Unlimited height, soft crop
	add_image_size('greek-category-thumb', 870, 580, true); //(cropped)
	add_image_size('greek-post-thumb', 300, 200, true); //(cropped)
	add_image_size('greek-post-thumbwide', 570, 352, true); //(cropped)
}
add_action('after_setup_theme', 'greek_setup'); 
 
function greek_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if('off' !== _x('on', 'Open Sans font: on or off', 'greek')) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x('no-subset', 'Open Sans font: add new subset(greek, cyrillic, vietnamese)', 'greek');

		if('cyrillic' == $subset)
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif('greek' == $subset)
			$subsets .= ',greek,greek-ext';
		elseif('vietnamese' == $subset)
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg($query_args, "$protocol://fonts.googleapis.com/css");
	}

	return $font_url;
}
 
function greek_scripts_styles() {
	global $wp_styles, $wp_scripts, $greek_options;
	
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments(when in use).
	*/
	
	if(is_singular() && comments_open() && get_option('thread_comments'))
		wp_enqueue_script('comment-reply');
	
	if(!is_admin()) {
		// Add Bootstrap JavaScript
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true);
		
		// Add jQuery Cookie
		wp_enqueue_script('jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '1.4.1', true);		
		
		// Add Fancybox
		wp_enqueue_script('greek-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);
		wp_enqueue_style('greek-fancybox-css', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), '2.1.5');
		wp_enqueue_script('greek-fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.js', array('jquery'), '1.0.5', true);
		wp_enqueue_style('greek-fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.css', array(), '1.0.5');
				
		//Superfish
		wp_enqueue_script('greek-superfish-js', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true);
	
		//Add Shuffle js
		wp_enqueue_script('greek-modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true);
		wp_enqueue_script('greek-shuffle-js', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true);
		
		// Add owl.carousel files
		wp_enqueue_script('owl.carousel', 	get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));
		wp_enqueue_style('owl.carousel', 	get_template_directory_uri() . '/css/owl.carousel.css');
		wp_enqueue_style('owl.theme', 		get_template_directory_uri() . '/css/owl.theme.css');
		
		// Add theme.js file
		wp_enqueue_script('greek-theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20140826', true);
	}
	
	$font_url = greek_get_font_url();
	if(! empty($font_url))
		wp_enqueue_style('greek-fonts', esc_url_raw($font_url), array(), null);
	
	if(!is_admin()) {
		// Loads our main stylesheet.
		wp_enqueue_style('greek-style', get_stylesheet_uri());

		// Load fontawesome css
		wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0');
		
		// Load bootstrap css
		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2.0');
	}
	// Compile Less to CSS
	
	// HieuJa get Preset Color Option
	$presetopt = greek_get_preset();
	// HieuJa end block
	
	if($greek_options['enable_less']){
		$themevariables = array(
			'heading_font'=> $greek_options['headingfont']['font-family'],
			'body_font'=> $greek_options['bodyfont']['font-family'],
			'heading_color'=> $greek_options['headingfont']['color'],
			'text_color'=> $greek_options['bodyfont']['color'],
			'primary_color' => $greek_options['primary_color'],
			'rate_color' => $greek_options['rate_color'],
		);
		switch($presetopt) {
			case 2:
				$themevariables['primary_color'] = $greek_options['primary2_color'];
				$themevariables['rate_color'] = $greek_options['rate2_color'];
			break;
			case 3:
				$themevariables['primary_color'] = $greek_options['primary3_color'];
				$themevariables['rate_color'] = $greek_options['rate3_color'];
			break;
			case 4:
				$themevariables['primary_color'] = $greek_options['primary4_color'];
				$themevariables['rate_color'] = $greek_options['rate4_color'];
			break;
		}
		if(function_exists('compileLessFile')){
			compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
			compileLessFile('compare.less', 'compare'.$presetopt.'.css', $themevariables);
			compileLessFile('ie.less', 'ie'.$presetopt.'.css', $themevariables);
		}
	}
	
	if(!is_admin()) {
		// Load main theme css style
		wp_enqueue_style('greek-css', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array(), '1.0.0');
		//Compare CSS
		wp_enqueue_style('greek-css', get_template_directory_uri() . '/css/compare'.$presetopt.'.css', array(), '1.0.0');
		// Loads the Internet Explorer specific stylesheet.
		wp_enqueue_style('greek-ie', get_template_directory_uri() . '/css/ie'.$presetopt.'.css', array('greek-style'), '20152907');
		$wp_styles->add_data('greek-ie', 'conditional', 'lte IE 9');
	}
	if($greek_options['enable_sswitcher']){
		// Add styleswitcher.js file
		wp_enqueue_script('greek-styleswitcher-js', get_template_directory_uri() . '/js/styleswitcher.js', array(), '20140826', true);
		// Load styleswitcher css style
		wp_enqueue_style('greek-styleswitcher-css', get_template_directory_uri() . '/css/styleswitcher.css', array(), '1.0.0');
	}
	if(is_rtl()) {
		wp_enqueue_style('greek-rtl', get_template_directory_uri() . '/rtl.css', array(), '1.0.0');
	}
}
add_action('wp_enqueue_scripts', 'greek_scripts_styles');

//Include
if(!class_exists('greek_widgets') && file_exists(get_template_directory().'/include/vinawidgets.php')) {
    require_once(get_template_directory().'/include/vinawidgets.php');
}
if(file_exists(get_template_directory().'/include/styleswitcher.php')) {
    require_once(get_template_directory().'/include/styleswitcher.php');
}
if(file_exists(get_template_directory().'/include/wooajax.php')) {
    require_once(get_template_directory().'/include/wooajax.php');
}
if(file_exists(get_template_directory().'/include/shortcodes.php')) {
    require_once(get_template_directory().'/include/shortcodes.php');
}
 
function greek_mce_css($mce_css) {
	$font_url = greek_get_font_url();

	if(empty($font_url))
		return $mce_css;

	if(! empty($mce_css))
		$mce_css .= ',';

	$mce_css .= esc_url_raw(str_replace(',', '%2C', $font_url));

	return $mce_css;
}
add_filter('mce_css', 'greek_mce_css'); 

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since VinaGecko 1.0
 */
function greek_page_menu_args($args) {
	if(! isset($args['show_home']))
		$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'greek_page_menu_args');

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since VinaGecko 1.0
 */
function greek_widgets_init() {
	
	register_sidebar(array(
		'name' => esc_html__('Blog Sidebar', 'greek'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Sidebar on blog page', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Category Sidebar', 'greek'),
		'id' => 'sidebar-category',
		'description' => esc_html__('Sidebar on product category page', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Product Sidebar', 'greek'),
		'id' => 'sidebar-product',
		'description' => esc_html__('Sidebar on product page', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Pages Sidebar', 'greek'),
		'id' => 'sidebar-page',
		'description' => esc_html__('Sidebar on content pages', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Widget Bottom 1', 'greek'),
		'id' => 'bottom-1',
		'class' => 'bottom-1',
		'description' => esc_html__('Widget on bottom 1', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="bottom-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Bottom 2', 'greek'),
		'id' => 'bottom-2',
		'class' => 'bottom-2',
		'description' => esc_html__('Widget on bottom 2', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="bottom-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Bottom 3', 'greek'),
		'id' => 'bottom-3',
		'class' => 'bottom-3',
		'description' => esc_html__('Widget on bottom 3', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="bottom-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Bottom 4', 'greek'),
		'id' => 'bottom-4',
		'class' => 'bottom-4',
		'description' => esc_html__('Widget on bottom 4', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="bottom-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	
	register_sidebar(array(
		'name' => esc_html__('Widget Footer 1', 'greek'),
		'id' => 'footer-1',
		'description' => esc_html__('Widget on footer 1', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="footer-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Footer 2', 'greek'),
		'id' => 'footer-2',
		'description' => esc_html__('Widget on footer 2', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="footer-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Footer 3', 'greek'),
		'id' => 'footer-3',
		'description' => esc_html__('Widget on footer 3', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="footer-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Footer 4', 'greek'),
		'id' => 'footer-4',
		'description' => esc_html__('Widget on footer 4', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="footer-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__('Widget Footer 5', 'greek'),
		'id' => 'footer-5',
		'description' => esc_html__('Widget on footer 5', 'greek'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="footer-static-title"><h4>',
		'after_title' => '</h4></div>',
	));
}
add_action('widgets_init', 'greek_widgets_init');

if(! function_exists('greek_content_nav')) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since VinaGecko 1.0
 */
function greek_content_nav($html_id) {
	global $wp_query;

	$html_id = esc_attr($html_id);

	if($wp_query->max_num_pages > 1) : ?>
		<nav id="<?php echo esc_attr($html_id); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php esc_html_e('Post navigation', 'greek'); ?></h3>
			<div class="nav-previous"><?php next_posts_link(wp_kses(__('<span class="meta-nav">&larr;</span> Older posts', 'greek'), array('span' => array()))); ?></div>
			<div class="nav-next"><?php previous_posts_link(wp_kses(__('Newer posts <span class="meta-nav">&rarr;</span>', 'greek'), array('span' => array()))); ?></div>
		</nav><!-- #<?php echo esc_attr($html_id); ?> .navigation -->
	<?php endif;
}
endif;

if(! function_exists('greek_pagination')) :
/* Pagination */
function greek_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => wp_kses(__('<i class="fa fa-chevron-left"></i>', 'greek'), array('i' => array())),
		'next_text'    => wp_kses(__('<i class="fa fa-chevron-right"></i>', 'greek'), array('i' => array())),
	));
}
endif;

if(! function_exists('greek_entry_meta')) :
function greek_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list(esc_html__(', ', 'greek'));

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list('', esc_html__(', ', 'greek'));
	
	$date = sprintf('<time class="entry-date" datetime="%3$s">%4$s</time>',
		esc_url(get_permalink()),
		esc_attr(get_the_time()),
		esc_attr(get_the_date('c')),
		esc_html(get_the_date())
	);

	$author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		esc_attr(sprintf(esc_html__('View all posts by %s', 'greek'), get_the_author())),
		get_the_author()
	);
	
	$num_comments =(int)get_comments_number();
	$write_comments = '';
	if(comments_open()) {
		if($num_comments == 0) {
			$comments = esc_html__('0 comments', 'greek');
		} elseif($num_comments > 1) {
			$comments = $num_comments . esc_html__(' comments', 'greek');
		} else {
			$comments = esc_html__('1 comment', 'greek');
		}
		$write_comments = '<a href="' . esc_url(get_comments_link()) .'">'. $comments.'</a>';
	}

	// Translators: 1 is author's name, 2 is date, 3 is the tags and 4 is comments.

	$utility_text = wp_kses(__('Posted by %1$s<span class="separator">/</span>%2$s<span class="separator">/</span>%3$s<span class="tagslist"><span class="separator">/</span>%4$s</span>', 'greek'), array('span' => array()));
	
	printf($utility_text, $author, $categories_list, $write_comments, $tag_list);
}
endif;

function greek_entry_meta_small() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list(esc_html__(', ', 'greek'));

	$author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		esc_attr(sprintf(esc_html__('View all posts by %s', 'greek'), get_the_author())),
		get_the_author()
	);
	
	$num_comments =(int)get_comments_number();
	$write_comments = '';
	if(comments_open()) {
		if($num_comments == 0) {
			$comments = esc_html__('0 Comments', 'greek');
		} elseif($num_comments > 1) {
			$comments = $num_comments . esc_html__(' Comments', 'greek');
		} else {
			$comments = esc_html__('1 Comment', 'greek');
		}
		$write_comments = '<a href="' . esc_url(get_comments_link()) .'">'. $comments.'</a>';
	}
	
	$utility_text = wp_kses(__('Posted by %1$s<span class="separator">/</span>%2$s<span class="separator">/</span>%3$s', 'greek'), array('span' => array()));

	printf($utility_text, $author, $categories_list, $write_comments);
}

function greek_add_meta_box() {

	$screens = array('post');

	foreach($screens as $screen) {

		add_meta_box(
			'greek_post_intro_section',
			esc_html__('Post featured content', 'greek'),
			'greek_meta_box_callback',
			$screen
		);
	}
}
add_action('add_meta_boxes', 'greek_add_meta_box');

function greek_meta_box_callback($post) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field('greek_meta_box', 'greek_meta_box_nonce');

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta($post->ID, '_greek_meta_value_key', true);

	echo '<label for="greek_post_intro">';
	esc_html_e('This content will be used to replace the featured image, use shortcode here', 'greek');
	echo '</label><br />';
	//echo '<textarea id="greek_post_intro" name="greek_post_intro" rows="5" cols="50" />' . esc_attr($value) . '</textarea>';
	wp_editor($value, 'greek_post_intro', $settings = array());
	
	
}

function greek_save_meta_box_data($post_id) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if(! isset($_POST['greek_meta_box_nonce'])) {
		return;
	}

	// Verify that the nonce is valid.
	if(! wp_verify_nonce($_POST['greek_meta_box_nonce'], 'greek_meta_box')) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check the user's permissions.
	if(isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

		if(! current_user_can('edit_page', $post_id)) {
			return;
		}

	} else {

		if(! current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if(! isset($_POST['greek_post_intro'])) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field($_POST['greek_post_intro']);

	// Update the meta field in the database.
	update_post_meta($post_id, '_greek_meta_value_key', $my_data);
}
add_action('save_post', 'greek_save_meta_box_data');

if(! function_exists('greek_comment')) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own greek_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since VinaGecko 1.0
 */
function greek_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch($comment->comment_type) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_html_e('Pingback:', 'greek'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('(Edit)', 'greek'), '<span class="edit-link">', '</span>'); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar($comment, 50); ?>
			</div>
			<div class="comment-info">
				<header class="comment-meta comment-author vcard">
					<?php
						
						printf('<cite><b class="fn">%1$s</b> %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							($comment->user_id === $post->post_author) ? '<span>' . esc_html__('Post author', 'greek') . '</span>' : ''
						);
						printf('<time datetime="%1$s">%2$s</time>',
							get_comment_time('c'),
							/* translators: 1: date, 2: time */
							sprintf(esc_html__('%1$s at %2$s', 'greek'), get_comment_date(), get_comment_time())
						);
					?>
					<div class="reply">
						<?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'greek'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</div><!-- .reply -->
				</header><!-- .comment-meta -->
				<?php if('0' == $comment->comment_approved) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'greek'); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link(esc_html__('Edit', 'greek'), '<p class="edit-link">', '</p>'); ?>
				</section><!-- .comment-content -->
			</div>
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
if(! function_exists('before_comment_fields') &&  ! function_exists('after_comment_fields')) :
//Change comment form
function greek_before_comment_fields() {
	echo '<div class="comment-input">';
}
add_action('comment_form_before_fields', 'greek_before_comment_fields');

function greek_after_comment_fields() {
	echo '</div>';
}
add_action('comment_form_after_fields', 'greek_after_comment_fields');

endif; 
 
function greek_customize_register($wp_customize) {
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}
add_action('customize_register', 'greek_customize_register');

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since VinaGecko 1.0
 */
 
add_action('wp_enqueue_scripts', 'wcqi_enqueue_polyfill');
function wcqi_enqueue_polyfill() {
    wp_enqueue_script('wcqi-number-polyfill');
}

// Remove Redux Ads
function my_custom_admin_styles() {
?>
<style type="text/css">
.rAds {
	display: none !important;
}
</style>
<?php
}
add_action('admin_head', 'my_custom_admin_styles');

/* Remove Redux Demo Link */
function removeDemoModeLink()
{
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));    
    }
}
add_action('init', 'removeDemoModeLink');

// HieuJa add specific class
function greek_add_query_vars_filter($vars){
	$vars[] = "ilayout";
	$vars[] = "preset";
	return $vars;
}
add_filter('query_vars', 'greek_add_query_vars_filter');

// Get value from URL and set Cookie, Class Subffix
function greek_body_class($classes)
{	
	global $greek_options;
	
	// Set Class Layout for Body Tag
	$classes[] = greek_get_layout();
	
	// Set Class Preset Color for Body Tag
	$classes[] = "preset-" . greek_get_preset();
	
	return $classes;
}
add_filter('body_class', 'greek_body_class');

// Override get_header function
function greek_get_header()
{
	// Set Cookie for Layout and Preset Color
	greek_set_layout_preset_color();
	
	// Reset Layout and Preset Color
	greek_reset_layout_preset_color();
	
	// Get Header Name
	$header = greek_get_layout();
	
	get_header($header);	
}

// Override get_footer function
function greek_get_footer()
{
	// Get Footer Name
	$footer = greek_get_layout();
	
	get_footer($footer);	
}

// HieuJa get Layout
function greek_get_layout()
{
	global $greek_options;
	
	$ilayout = get_query_var('ilayout', '');
	if(!empty($ilayout)) {
		$layout = $ilayout;
	}
	else {
		$pageLayout = isset($_COOKIE['page-layout']) ? $_COOKIE['page-layout'] : "";
		$layout     = (!empty($pageLayout)) ? $pageLayout : $greek_options['page_layout'];
	}
	
	return $layout;
}

// HieuJa get Preset Color
function greek_get_preset()
{
	global $greek_options;
	
	$preset = get_query_var('preset', '');
	if(!empty($preset)) {
		$presetColor = $preset;
	}
	else {
		$presetColor = isset($_COOKIE['preset-color']) ? $_COOKIE['preset-color'] : "";
		$presetColor = ((!empty($presetColor)) ? $presetColor : $greek_options['preset_option']);
	}
	
	return $presetColor;
}

// HieuJa set Cookie for Layout and Preset Color
function greek_set_layout_preset_color()
{
	// Set Layout Style
	$ilayout = get_query_var('ilayout', '');
	if(!empty($ilayout)) {
		setcookie('page-layout', $ilayout, strtotime('+1 day'), '/');
	}
	
	// Set Preset Color
	$preset = get_query_var('preset', '');
	if(!empty($preset)) {
		setcookie('preset-color', $preset, strtotime('+1 day'), '/');
	}
	
	return true;
}

// HieuJa reset Layout Option and Preset Color
function greek_reset_layout_preset_color()
{
	global $greek_options;
	
	$requestURI = $_SERVER['REQUEST_URI'];
	$homeURL	= home_url('/');
	$isHomePage = strpos($homeURL, $requestURI);
	
	if($requestURI == '/' || $isHomePage !== false) 
	{
		$pageLayout  = isset($_COOKIE['page-layout']) ? $_COOKIE['page-layout'] : $greek_options['page_layout'];
		$presetColor = isset($_COOKIE['preset-color']) ? $_COOKIE['preset-color'] : $greek_options['preset_option'];
		if($pageLayout != $greek_options['page_layout'] 
		|| $presetColor != $greek_options['preset_option']) {
			setcookie('page-layout', $greek_options['page_layout'], strtotime('+1 day'), '/');
			setcookie('preset-color', $greek_options['preset_option'], strtotime('+1 day'), '/');
			wp_redirect(home_url());
			exit;
		}
	}
}
add_action('init', 'greek_reset_layout_preset_color');