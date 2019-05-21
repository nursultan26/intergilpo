<?php
if (!defined('ABSPATH')) exit('No direct script access allowed');

/**
 * CodeNegar wordPress AJAX AutoSuggest AJAX
 *
 * Contains AJAX codes
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author      Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */


function ajax_autosuggest_get_search_results() {
	global $codenegar_aas;
	if($codenegar_aas->options->enable_token =='true'){
		check_ajax_referer($codenegar_aas->security, 'security');
	}
	$q = $codenegar_aas->helper->prepare_parameter($_REQUEST['q']);
	if(strlen($q)<$codenegar_aas->options->min_chars){
		die();
	}
	$tags = str_replace(" ", ",", $q);
	$q = apply_filters('get_search_query', $q); // apply filters to search query
	$post_types = (isset($codenegar_aas->options->post_types) && count((array)$codenegar_aas->options->post_types)>0) ? (array) $codenegar_aas->options->post_types : array('post');
	$args = array(
		's' => $q,
		'posts_per_page' => $codenegar_aas->options->no_of_results,
		'orderby' => $codenegar_aas->options->order_by,
		'order' => $codenegar_aas->options->order,
		'post_type' => $post_types, // Array of selected post types
		'post_status' => 'publish',
		'exclude' => (array) $codenegar_aas->options->excluded_ids, // Array of excluded ids
		'category__not_in' => (array) $codenegar_aas->options->excluded_cats, // Array of excluded cat ids
        //'tag' => $tags,
	);
	
	$q = urlencode($q); // encodes search string to be used in a query part of URL
	$query_results = new WP_Query($args); // get_posts uses WP_Query to we can send its parameters

	if(!$query_results || count($query_results)==0){
		?>
		<a href="<?php echo esc_url(add_query_arg('s', $q, home_url('/'))); ?>" class="ajax_autosuggest_more"><?php echo $codenegar_aas->options->no_results_try_full_search_text; ?></a>|||
		<?php
		die();
	}
	
	// Save results to array
	$results = array();
	global $post;
	$counter = 0;
	$description_limit = $codenegar_aas->options->description_limit;
	$title_limit = $codenegar_aas->options->title_limit;
	$this_post_type_title = __('Results', $codenegar_aas->text_domain);
	foreach($query_results->get_posts() as $post):	setup_postdata($post);
		if($codenegar_aas->options->split_results_by_type =='true'){
			$this_post_type_name = get_post_type();
			$this_post_type_title = $codenegar_aas->options->title->$this_post_type_name;
		}
		$results[$this_post_type_title][$counter] ['URL'] =  get_permalink();
		$item_title = "";

		// Some languages use special characters and shouldn't be converted in HTML Entities
		$item_title = html_entity_decode($item_title, ENT_QUOTES, 'UTF-8');

		if($title_limit>0){
			$item_title = $codenegar_aas->helper->limit_str(get_the_title(), $title_limit);
			$item_title = apply_filters('aas_result_title', $item_title, get_the_id());
		}
		$results[$this_post_type_title][$counter] ['title'] = $item_title;
		$description = "";
		if($description_limit>0){
			$description = get_the_excerpt();
			if(empty($description)){
				$description = get_the_content();
			}

			// Execute shortcodes and apply shortcodes
			$description = apply_filters('the_content', $description);

			// Execute all shortcodes in contetns
			$description = do_shortcode($description);

			// Remove any possible remaning shortcode
			$description = strip_shortcodes($description);

			// Remove hidden text
			$description = codenegar_strip_html_tags($description);

			// Apply custom filters
			$description = apply_filters('aas_result_description', $description, get_the_id());
		}
		$results[$this_post_type_title][$counter] ['text'] = $codenegar_aas->helper->limit_str($description, $description_limit);
		if($codenegar_aas->options->thumb_image_display =='true'){
			$results[$this_post_type_title][$counter] ['image'] = $codenegar_aas->helper->post_image();
		}
		$counter++;
	endforeach;
	?>
	
<?php
	//$builtin_query_url = esc_url(add_query_arg('s', $q, home_url('/')));
	$builtin_query_url = str_replace("%q%", $q, $codenegar_aas->options->full_search_url);
	foreach ($results as $post_type => $result) {
		$post_type_name = array_search($post_type, (array) $codenegar_aas->options->title);
		if($post_type_name){
			$post_type_query_url = esc_url(add_query_arg('post_type', $post_type_name, $builtin_query_url));
			?>
			<a class="ajax_autosuggest_category ajax_autosuggest_clickable" href="<?php echo $post_type_query_url; ?>" data-q="<?php echo $q; ?>"><?php echo $post_type; ?></a>|||
			<?php
		}elseif($codenegar_aas->options->display_result_title == 'true'){
			?>
			<span class="ajax_autosuggest_category" data-q="<?php echo $q; ?>"><?php echo $post_type; ?></span>|||
			<?php
		}

		foreach ($result as $item){
			?>
			<a href="<?php echo $item['URL']; ?>" class="ajax_autosuggest_result">
			<?php
				if($codenegar_aas->options->thumb_image_display == 'true'){ ?>
				<img alt="" width="<?php echo $codenegar_aas->options->thumb_image_width; ?>" height="<?php echo $codenegar_aas->options->thumb_image_height; ?>" class="ajax_autosuggest_image" src="<?php echo $item['image']; ?>" />
			<?php } ?>
				<span class="searchheading"><?php echo $codenegar_aas->helper->remove_illegal($item['title']); ?></span>
				<span class="ajax_autosuggest_item_description"><?php if(empty($item['text'])) echo "&nbsp;"; else echo $codenegar_aas->helper->remove_illegal($item['text']); ?></span>
			</a>|||
			<?php
		}
	}
if($codenegar_aas->options->display_more_bar == 'true'){
	?>
      <a href="<?php echo $builtin_query_url; ?>" class="ajax_autosuggest_more"><?php echo $codenegar_aas->options->try_full_search_text; ?></a>|||
     
	<?php 
}else{
	?>
	
	<?php 
}
die();
}
?>