<?php
if (!defined('ABSPATH')) exit('No direct script access allowed');

 /**
 * CodeNegar wordPress AJAX AutoSuggest options page
 *
 * Generates options page
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author     	Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
 
// Assets are loaded by hook

global $codenegar_aas;

$is_secure = false;

if(isset($_POST['ajax_autosuggest_submit'])){
	$is_secure = wp_verify_nonce($_REQUEST['security'], $codenegar_aas->security);
}

if(isset($_POST['ajax_autosuggest_submit']) && $is_secure) {
	$codenegar_ajax_search = array();
	$_POST['post_types'] = (isset($_POST['post_types']) && count((array)$_POST['post_types'])>0) ? $_POST['post_types'] : array('post');
	$codenegar_ajax_search['no_of_results'] = $codenegar_aas->helper->prepare_parameter($_POST['no_of_results'], true);
	$codenegar_ajax_search['description_limit'] = $codenegar_aas->helper->prepare_parameter($_POST['description_limit'], true);
	$codenegar_ajax_search['title_limit'] = $codenegar_aas->helper->prepare_parameter($_POST['title_limit'], true);
	$codenegar_ajax_search['excluded_ids'] = $codenegar_aas->helper->prepare_parameter(explode(',', $_POST['excluded_ids']), true);
	$codenegar_ajax_search['excluded_cats'] = $codenegar_aas->helper->prepare_parameter(explode(',', $_POST['excluded_cats']), true);
	$codenegar_ajax_search['full_search_url'] = $codenegar_aas->helper->prepare_parameter($_POST['full_search_url'], false);
	$codenegar_ajax_search['min_chars'] = $codenegar_aas->helper->prepare_parameter($_POST['min_chars'], false);
	$codenegar_ajax_search['ajax_delay'] = $codenegar_aas->helper->prepare_parameter($_POST['ajax_delay'], false);
	$codenegar_ajax_search['cache_length'] = $codenegar_aas->helper->prepare_parameter($_POST['cache_length'], false);
	$codenegar_ajax_search['post_types'] = $codenegar_aas->helper->prepare_parameter($_POST['post_types'], false);
	$codenegar_ajax_search['order_by'] = $codenegar_aas->helper->prepare_parameter($_POST['order_by'], false);
	$codenegar_ajax_search['order'] = $codenegar_aas->helper->prepare_parameter($_POST['order'], false);
	$codenegar_ajax_search['split_results_by_type'] = (isset($_POST['split_results_by_type']) && $_POST['split_results_by_type'] =='checked')? 'true': 'false';
    $codenegar_ajax_search['search_tags'] = (isset($_POST['search_tags']) && $_POST['search_tags'] =='checked')? 'true': 'false';
    $codenegar_ajax_search['search_comments'] = (isset($_POST['search_comments']) && $_POST['search_comments'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['get_first_image'] = (isset($_POST['get_first_image']) && $_POST['get_first_image'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['force_resize_first_image'] = (isset($_POST['force_resize_first_image']) && $_POST['force_resize_first_image'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['default_image'] = $codenegar_aas->helper->prepare_parameter($_POST['default_image'], false);
	$codenegar_ajax_search['search_image'] = $codenegar_aas->helper->prepare_parameter($_POST['search_image'], false);
	$codenegar_ajax_search['try_full_search_text'] = $codenegar_aas->helper->prepare_parameter($_POST['try_full_search_text'], false);
	$codenegar_ajax_search['no_results_try_full_search_text'] = $codenegar_aas->helper->prepare_parameter($_POST['no_results_try_full_search_text'], false);
	$codenegar_ajax_search['thumb_image_display'] = (isset($_POST['thumb_image_display']) && $_POST['thumb_image_display'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['thumb_image_width'] = $codenegar_aas->helper->prepare_parameter($_POST['thumb_image_width'], false);
	$codenegar_ajax_search['thumb_image_height'] = $codenegar_aas->helper->prepare_parameter($_POST['thumb_image_height'], false);
	$codenegar_ajax_search['thumb_image_crop'] = (isset($_POST['thumb_image_crop']) && $_POST['thumb_image_crop'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['display_more_bar'] = (isset($_POST['display_more_bar']) && $_POST['display_more_bar'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['display_result_title'] = (isset($_POST['display_result_title']) && $_POST['display_result_title'] =='checked')? 'true': 'false';
	$codenegar_ajax_search['enable_token'] = (isset($_POST['enable_token']) && $_POST['enable_token'] =='checked')? 'true': 'false';
	
	// Color settings
	$codenegar_ajax_search['color']['results_even_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['results_even_bar'], false);
	$codenegar_ajax_search['color']['results_odd_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['results_odd_bar'], false);
	$codenegar_ajax_search['color']['results_even_text'] = $codenegar_aas->helper->prepare_parameter($_POST['results_even_text'], false);
	$codenegar_ajax_search['color']['results_odd_text'] = $codenegar_aas->helper->prepare_parameter($_POST['results_odd_text'], false);
	$codenegar_ajax_search['color']['results_hover_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['results_hover_bar'], false);
	$codenegar_ajax_search['color']['results_hover_text'] = $codenegar_aas->helper->prepare_parameter($_POST['results_hover_text'], false);
	$codenegar_ajax_search['color']['seperator_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['seperator_bar'], false);
	$codenegar_ajax_search['color']['seperator_hover_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['seperator_hover_bar'], false);
	$codenegar_ajax_search['color']['seperator_text'] = $codenegar_aas->helper->prepare_parameter($_POST['seperator_text'], false);
	$codenegar_ajax_search['color']['seperator_hover_text'] = $codenegar_aas->helper->prepare_parameter($_POST['seperator_hover_text'], false);
	$codenegar_ajax_search['color']['more_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['more_bar'], false);
	$codenegar_ajax_search['color']['more_hover_bar'] = $codenegar_aas->helper->prepare_parameter($_POST['more_hover_bar'], false);
	$codenegar_ajax_search['color']['more_text'] = $codenegar_aas->helper->prepare_parameter($_POST['more_text'], false);
	$codenegar_ajax_search['color']['more_hover_text'] = $codenegar_aas->helper->prepare_parameter($_POST['more_hover_text'], false);
	$codenegar_ajax_search['color']['box_border'] = $codenegar_aas->helper->prepare_parameter($_POST['box_border'], false);
	$codenegar_ajax_search['color']['box_background'] = $codenegar_aas->helper->prepare_parameter($_POST['box_background'], false);
	$codenegar_ajax_search['color']['box_text'] = $codenegar_aas->helper->prepare_parameter($_POST['box_text'], false);
	
    $codenegar_ajax_search['custom_css'] = $codenegar_aas->helper->prepare_parameter($_POST['custom_css'], false);
	$codenegar_ajax_search['custom_js'] = $codenegar_aas->helper->prepare_parameter($_POST['custom_js'], false);
    
	// Title settings
	foreach($_POST['post_type_text'] as $name=>$title){
		$codenegar_ajax_search['title'][$name] = $codenegar_aas->helper->prepare_parameter($title, false);
	}
	
	// Store array of settings to database
	update_option('codenegar_ajax_autosuggest',$codenegar_ajax_search);
	
	?>
	<div class="updated"><p><?php _e("Changes Saved.", $codenegar_aas->text_domain); ?></p></div>
	<?php
}

if (isset($_POST['ajax_autosuggest_submit']) && !$is_secure){
	?>
	<div class="error"><p><?php _e('Security check failed.', $codenegar_aas->text_domain); ?></p></div>
	<?php
}

$codenegar_ajax_autosuggest_options = get_option('codenegar_ajax_autosuggest');
$defaults = $codenegar_aas->helper->default_options();

if(isset($codenegar_ajax_autosuggest_options['post_types']) && count((array) $codenegar_ajax_autosuggest_options['post_types'])>0){
	unset($defaults['post_types']); // removes default post types because user selected its own
}
$codenegar_ajax_autosuggest_options = codenegar_parse_args($codenegar_ajax_autosuggest_options, $defaults);
?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2><?php _e('Ajax AutoSuggest', $codenegar_aas->text_domain); ?></h2>
<form method="post">
<div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
	<div  class="handlediv"></div>
	<h3 class="hndle"><span><?php _e('Search And Results', $codenegar_aas->text_domain); ?></span></h3>
	<div class="inside" > 
   <label><?php _e('Types of results', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
   <div class="post-types-container">
   <?php
	$post_types = $codenegar_aas->helper->get_post_types();
	
	  foreach ($post_types as $post_type ) {
		$checked = (in_array($post_type, (array) $codenegar_ajax_autosuggest_options['post_types'])) ? 'checked="checked"' : "";
		echo '<input type="checkbox" name="post_types[]" value="' . $post_type . '" ' . $checked  . ' /> ' . $post_type . "&nbsp;&nbsp;&nbsp;({$codenegar_ajax_autosuggest_options['title'][$post_type]})" . '<br />';
	  }
   ?>
   </div>
	<br />
	<label for="split_results_by_type"><?php _e('Split results by post type', $codenegar_aas->text_domain); ?>:</label><input name="split_results_by_type" id="split_results_by_type" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['split_results_by_type']=='true') echo 'checked="checked"'; ?>>
    <br />
    <br />
    <label for="search_tags"><?php _e('Search posts/produtcs tags', $codenegar_aas->text_domain); ?>:</label><input name="search_tags" id="search_tags" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['search_tags']=='true') echo 'checked="checked"'; ?>>
   <div style="">
    <br />
    <label for="search_comments" style=""><?php _e('Search comments', $codenegar_aas->text_domain); ?>:</label><input name="search_comments" id="search_comments" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['search_comments']=='true') echo 'checked="checked"'; ?>>
   </div>
    
	<br />
	<br />
	<br />
	<label for="order_by"><?php _e('Order by', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<select name="order_by">
		<option  value="ID" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'ID'): ?> selected="selected"<?php endif; ?>><?php _e('ID', $codenegar_aas->text_domain); ?></option>
		<option  value="author" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'author'): ?> selected="selected"<?php endif; ?>><?php _e('Author', $codenegar_aas->text_domain); ?></option>
		<option  value="title" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'title'): ?> selected="selected"<?php endif; ?>><?php _e('Title', $codenegar_aas->text_domain); ?></option>
		<option  value="name" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'name'): ?> selected="selected"<?php endif; ?>><?php _e('Name', $codenegar_aas->text_domain); ?></option>
		<option  value="date" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'date'): ?> selected="selected"<?php endif; ?>><?php _e('Date', $codenegar_aas->text_domain); ?></option>
		<option  value="modified" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'modified'): ?> selected="selected"<?php endif; ?>><?php _e('Modified Date', $codenegar_aas->text_domain); ?></option>
		<option  value="rand" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'rand'): ?> selected="selected"<?php endif; ?>><?php _e('Random', $codenegar_aas->text_domain); ?></option>
		<option  value="comment_count" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'comment_count'): ?> selected="selected"<?php endif; ?>><?php _e('Comment Count', $codenegar_aas->text_domain); ?></option>
		<option  value="none" <?php if($codenegar_ajax_autosuggest_options['order_by'] == 'none'): ?> selected="selected"<?php endif; ?>><?php _e('None', $codenegar_aas->text_domain); ?></option>
	</select>
	<select name="order">
		<option  value="ASC" <?php if($codenegar_ajax_autosuggest_options['order'] == 'ASC'): ?> selected="selected"<?php endif; ?>><?php _e('Ascending', $codenegar_aas->text_domain); ?></option>
		<option  value="DESC" <?php if($codenegar_ajax_autosuggest_options['order'] == 'DESC'): ?> selected="selected"<?php endif; ?>><?php _e('Descending', $codenegar_aas->text_domain); ?></option>
	</select>
	<br />
	<br />
	<label for="no_of_results"><?php _e('Max number of results', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="no_of_results" name="no_of_results" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['no_of_results']; ?>" />
	<br />
	<br />
	<label for="min_chars"><?php _e('Minimum characters', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="min_chars" name="min_chars" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['min_chars']; ?>" />
	<br />
	<br />
	<label for="ajax_delay"><?php _e('Ajax delay', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="ajax_delay" name="ajax_delay" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['ajax_delay']; ?>" /><span class="padleft"><?php _e('Milliseconds', $codenegar_aas->text_domain); ?></span>
	<br />
	<br />
	<label for="cache_length"><?php _e('Cache length', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="cache_length" name="cache_length" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['cache_length']; ?>" />
	<br />
	<br />
	<label for="description_limit"><?php _e('Result description limit', $codenegar_aas->text_domain); ?><span id="form_label"></span></label>
	<input id="description_limit" name="description_limit" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['description_limit']; ?>" /><span class="padleft"><?php _e('Characters', $codenegar_aas->text_domain); ?></span>
	<br />
	<br />
	<label for="title_limit"><?php _e('Result title limit', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="title_limit" name="title_limit" type="text" class="integer small-text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['title_limit']; ?>" /><span class="padleft"><?php _e('Characters', $codenegar_aas->text_domain); ?></span>
	<br />
	<br />
	<label for="excluded_ids"><?php _e('Excluded IDs', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="excluded_ids" name="excluded_ids" class="regular-text" type="text" size="55" value="<?php echo implode(', ', $codenegar_ajax_autosuggest_options['excluded_ids']); ?>" /><span class="padleft"><?php _e('Seperate IDs with comma. eg: 2, 18, 300', $codenegar_aas->text_domain); ?></span>
	<br />
	<br />
	<label for="excluded_cats"><?php _e('Excluded Category IDs', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="excluded_cats" name="excluded_cats" class="regular-text" type="text" size="55" value="<?php echo implode(', ', $codenegar_ajax_autosuggest_options['excluded_cats']); ?>" /><span class="padleft"><?php _e('Seperate IDs with comma. eg: 2, 18, 300', $codenegar_aas->text_domain); ?></span>
	<br />
	<br />
	<label for="full_search_url"><?php _e('Full Search URL', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="full_search_url" name="full_search_url" class="regular-text" type="text" size="55" value="<?php echo $codenegar_ajax_autosuggest_options['full_search_url']; ?>" /><span class="padleft"><?php _e('%q% will be replaced by search keyword.', $codenegar_aas->text_domain); ?></span>
	</div>
	</div>
	</div>
 <div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
	<div  class="handlediv"></div>
	<h3 class="hndle"><span><?php _e('Thumbnail', $codenegar_aas->text_domain); ?></span></h3>
	<div class="inside" >
	
	<label for="thumb_image_display"><?php _e('Display Thumbnail', $codenegar_aas->text_domain); ?>:</label>
	<input name="thumb_image_display" id="thumb_image_display" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['thumb_image_display']=='true') echo 'checked="checked"'; ?>>
	<br />
	<br />
	<label for="thumb_image_width"><?php _e('Width', $codenegar_aas->text_domain); ?>:</label>
	<input name="thumb_image_width" id="thumb_image_width" class="small-text integer" type="text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['thumb_image_width']; ?>"><span class="padleft"><?php _e('px', $codenegar_aas->text_domain); ?></span>
	<br/>
	<br/>
	<label for="thumb_image_height"><?php _e('Height', $codenegar_aas->text_domain); ?>:</label>
	<input name="thumb_image_height" id="thumb_image_height" class="small-text integer" type="text" size="3" value="<?php echo $codenegar_ajax_autosuggest_options['thumb_image_height']; ?>"><span class="padleft"><?php _e('px', $codenegar_aas->text_domain); ?></span>
	<br/>
	<br/>
	<label for="get_first_image"><?php _e('Get first post image', $codenegar_aas->text_domain); ?>:</label>
	<input name="get_first_image" id="get_first_image" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['get_first_image']=='true') echo 'checked="checked"'; ?>>
	<br />
	<br />
	<label for="force_resize_first_image"><?php _e('Force resize first post image', $codenegar_aas->text_domain); ?>:</label><input name="force_resize_first_image" id="force_resize_first_image" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['force_resize_first_image']=='true') echo 'checked="checked"'; ?>>
	<br/>
	<br/>
	<label for="thumb_image_crop"><?php _e('Crop', $codenegar_aas->text_domain); ?>:</label>
	<input name="thumb_image_crop" id="thumb_image_crop" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['thumb_image_crop']=='true') echo 'checked="checked"'; ?>>
	<br />
	<br />
	<label for="default_image"><?php _e('Default image', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<?php
	$codenegar_aas->helper->image_upload_field($codenegar_ajax_autosuggest_options['default_image'], 'default_image');
	?>
	
	<br />
	</div>
	</div>
	</div>
	
	
	<div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
		<div  class="handlediv"></div>
		<h3 class="hndle"><span><?php _e('Search elements', $codenegar_aas->text_domain); ?></span></h3>
		<div class="inside" >
		<label for="display_more_bar"><?php _e('Display more bar', $codenegar_aas->text_domain); ?>:</label>
		<input name="display_more_bar" id="display_more_bar" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['display_more_bar']=='true') echo 'checked="checked"'; ?>>
		
		<br/>
		<br/>
		<label for="display_result_title"><?php _e('Display result title', $codenegar_aas->text_domain); ?>:</label>
		<input name="display_result_title" id="display_result_title" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['display_result_title']=='true') echo 'checked="checked"'; ?>>
		<br />
		<br />

        <label for="enable_token"><?php _e('Enable token', $codenegar_aas->text_domain); ?>:</label>
        <input name="enable_token" id="enable_token" value="checked" type="checkbox" <?php if($codenegar_ajax_autosuggest_options['enable_token']=='true') echo 'checked="checked"'; ?>>
        <br/>
        <br/>

		<label for="search_image"><?php _e('Search Image', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
		<?php
		$codenegar_aas->helper->image_upload_field($codenegar_ajax_autosuggest_options['search_image'], 'search_image');
		?>
		</div>
	</div>
</div>
	
	
	
 <div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
	<div  class="handlediv"></div>
	<h3 class="hndle"><span><?php _e('Color', $codenegar_aas->text_domain); ?></span></h3>
	<div class="inside" >
	<label for="results_even_bar"><?php _e('Results - even bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_even_bar" name="results_even_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_even_bar']; ?>" />
	<br />
	<br />
	<label for="results_odd_bar"><?php _e('Results - odd bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_odd_bar" name="results_odd_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_odd_bar']; ?>" />
	<br />
	<br />
	<label for="results_hover_bar"><?php _e('Results - hover bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_hover_bar" name="results_hover_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_hover_bar']; ?>" />
	<br />
	<br />
	<label for="results_even_text"><?php _e('Results - even text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_even_text" name="results_even_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_even_text']; ?>" />
	<br />
	<br />
	<label for="results_odd_text"><?php _e('Results - odd text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_odd_text" name="results_odd_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_odd_text']; ?>" />
	<br />
	<br />
	<label for="results_hover_text"><?php _e('Results - hover text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="results_hover_text" name="results_hover_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['results_hover_text']; ?>" />
	<br />
	<br />
	<label for="seperator_bar"><?php _e('Separator - bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="seperator_bar" name="seperator_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['seperator_bar']; ?>" />
	<br />
	<br />
	<label for="seperator_hover_bar"><?php _e('Separator - hover bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="seperator_hover_bar" name="seperator_hover_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['seperator_hover_bar']; ?>" />
	<br />
	<br />
	<label for="seperator_text"><?php _e('Separator - text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="seperator_text" name="seperator_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['seperator_text']; ?>" />
	<br />
	<br />
	<label for="seperator_hover_text"><?php _e('Separator - hover text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="seperator_hover_text" name="seperator_hover_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['seperator_hover_text']; ?>" />
	<br />
	<br />
	<label for="more_bar"><?php _e('More - bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="more_bar" name="more_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['more_bar']; ?>" />
	<br />
	<br />
	<label for="more_hover_bar"><?php _e('More - hover bar', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="more_hover_bar" name="more_hover_bar" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['more_hover_bar']; ?>" />
	<br />
	<br />
	<label for="more_text"><?php _e('More - text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="more_text" name="more_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['more_text']; ?>" />
	<br />
	<br />
	<label for="more_hover_text"><?php _e('More - hover text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="more_hover_text" name="more_hover_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['more_hover_text']; ?>" />
	<br />
	<br />
	<label for="box_border"><?php _e('Search box - border', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="box_border" name="box_border" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['box_border']; ?>" />
	
	<br />
	<br />
	<label for="box_background"><?php _e('Search box - background', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="box_background" name="box_background" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['box_background']; ?>" />
	
	<br />
	<br />
	<label for="box_text"><?php _e('Search box - text', $codenegar_aas->text_domain); ?>:<span id="form_label"></span></label>
	<input id="box_text" name="box_text" type="text" size="20" class="color" value="<?php echo $codenegar_ajax_autosuggest_options['color']['box_text']; ?>" />
	
	<?php wp_nonce_field($codenegar_aas->security, 'security') ?>
	<br />
	</div>
	</div>
</div>
<div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
		<div  class="handlediv"></div>
		<h3 class="hndle"><span><?php _e('Title', $codenegar_aas->text_domain); ?></span></h3>
		<div class="inside" >
		<label for="try_full_search_text"><?php _e('Try Full Search...', $codenegar_aas->text_domain); ?><span id="form_label"></span></label>
		<input id="try_full_search_text" class="regular-text" name="try_full_search_text" type="text" size="30" value="<?php echo $codenegar_ajax_autosuggest_options['try_full_search_text']; ?>">
		<br><br>
		<label for="no_results_try_full_search_text"><?php _e('No Results! Try Full Search...', $codenegar_aas->text_domain); ?><span id="form_label"></span></label>
		<input id="no_results_try_full_search_text" class="regular-text" name="no_results_try_full_search_text" type="text" size="30" value="<?php echo $codenegar_ajax_autosuggest_options['no_results_try_full_search_text']; ?>">
		<?php
		$post_types = $codenegar_aas->helper->get_post_types();
		foreach ($post_types as $name=>$title ) {
		?>
		<br />
		<br />
		<label for="post_type_text_<?php echo $name; ?>"><?php echo $name; ?>:<span id="form_label"></span></label>
		<input id="post_type_text_<?php echo $name; ?>" class="regular-text" name="post_type_text[<?php echo $name; ?>]" type="text" size="30" value="<?php echo $codenegar_ajax_autosuggest_options['title'][$name]; ?>" />
		<?php
		 }
	   ?>
		</div>
	</div>
</div>

<div id="poststuff" class="metabox-holder" >
	<div class="postbox" >
		<div  class="handlediv"></div>
		<h3 class="hndle"><span><?php _e('Other options', $codenegar_aas->text_domain); ?></span></h3>
		<div class="inside" >
        <br />
        <br />
        <label><?php _e('Custom CSS', $codenegar_aas->text_domain); ?>:<span id="postform"></span></label>
        <textarea cols="90" rows="5" spellcheck='false' name="custom_css" style="background-image: none; background-position: 0% 0%; background-repeat: repeat repeat;"><?php echo $codenegar_ajax_autosuggest_options['custom_css']; ?></textarea>
        <br />
        <br />
        <label><?php _e('Custom JavaScript', $codenegar_aas->text_domain); ?>:<span id="postform"></span></label>
        <textarea cols="90" rows="5" spellcheck='false' name="custom_js" style="background-image: none; background-position: 0% 0%; background-repeat: repeat repeat;"><?php echo $codenegar_ajax_autosuggest_options['custom_js']; ?></textarea>
		</div>
	</div>
</div>


	<tr valign="top">
	<th scope="row"></th>
		<td><p class="submit"><input type="submit" name="ajax_autosuggest_submit" class="button-primary" value="<?php _e('Save Changes', $codenegar_aas->text_domain); ?>" /></p></td>
	</tr>
</form>
</div>