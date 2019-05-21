<?php
/* Post Type Register */
function vgwc_posttype_register()
{
	$labels = array(
		'name' 					=> _x('VG WooCarousel', 'vgwc'),
		'singular_name' 		=> _x('VG WooCarousel', 'vgwc'),
		'add_new' 				=> _x('VG New Carousel', 'vgwc'),
		'add_new_item' 			=> __('VG New Carousel'),
		'edit_item' 			=> __('Edit Carousel'),
		'new_item' 				=> __('VG New Carousel'),
		'view_item' 			=> __('VG View Carousel'),
		'search_items' 			=> __('Search Carousel'),
		'not_found' 			=>  __('Nothing found'),
		'not_found_in_trash' 	=> __('Nothing found in Trash'),
		'parent_item_colon' 	=> ''
	);
 
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
		'menu_icon' 			=> null,
		'rewrite' 				=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'supports' 				=> array('title'),
		'menu_icon' 			=> vgwc_plugin_url . 'includes/images/icon-carousel.png',
	);

	register_post_type('vgwc', $args);
}
add_action('init', 'vgwc_posttype_register');


/* Meta Boxes */
function meta_boxes_vgwc()
{
	$screens = array('vgwc');
	foreach($screens as $screen)
	{
		add_meta_box('vgwc_metabox',__('Woocommerce Products Carousel Options', 'vgwc'), 'meta_boxes_vgwc_input', $screen);
	}
}
add_action('add_meta_boxes', 'meta_boxes_vgwc');


/* Meta Boxed Input */
function meta_boxes_vgwc_input($post)
{
	global $post;
	
	wp_nonce_field('meta_boxes_vgwc_input', 'meta_boxes_vgwc_input_nonce');
	
	$vgwc_class_sufix 	= get_post_meta($post->ID, 'vgwc_class_sufix', true);
	$vgwc_class_sufix	= (empty($vgwc_class_sufix)) ? "" : sanitize_text_field($vgwc_class_sufix);
	
	$vgwc_theme 		= get_post_meta($post->ID, 'vgwc_theme', true);
	$vgwc_theme			= (empty($vgwc_theme)) ? "default" : sanitize_text_field($vgwc_theme);
	
	$vgwc_bg_image 		= get_post_meta($post->ID, 'vgwc_bg_image', true);
	$vgwc_bg_image		= (empty($vgwc_bg_image)) ? "" : sanitize_text_field($vgwc_bg_image);
	
	$vgwc_isbg_color 	= get_post_meta($post->ID, 'vgwc_isbg_color', true);
	$vgwc_isbg_color	= intval($vgwc_isbg_color);
	
	$vgwc_bg_color 		= get_post_meta($post->ID, 'vgwc_bg_color', true);
	$vgwc_bg_color		= (empty($vgwc_bg_color)) ? "#F1F1F1" : sanitize_text_field($vgwc_bg_color);
	
	$vgwc_wmargin 		= get_post_meta($post->ID, 'vgwc_wmargin', true);
	$vgwc_wmargin		= (empty($vgwc_wmargin)) ? "0px 0px" : sanitize_text_field($vgwc_wmargin);
	
	$vgwc_wpadding 		= get_post_meta($post->ID, 'vgwc_wpadding', true);
	$vgwc_wpadding		= (empty($vgwc_wpadding)) ? "10px 5px" : sanitize_text_field($vgwc_wpadding);
	
	$vgwc_imargin 		= get_post_meta($post->ID, 'vgwc_imargin', true);
	$vgwc_imargin		= (empty($vgwc_imargin)) ? "0px 5px" : sanitize_text_field($vgwc_imargin);
	
	$vgwc_ipadding 		= get_post_meta($post->ID, 'vgwc_ipadding', true);
	$vgwc_ipadding		= (empty($vgwc_ipadding)) ? "10px 10px" : sanitize_text_field($vgwc_ipadding);
	
	$vgwc_isibg_color 	= get_post_meta($post->ID, 'vgwc_isibg_color', true);
	$vgwc_isibg_color	= intval($vgwc_isibg_color);
	
	$vgwc_ibg_color 	= get_post_meta($post->ID, 'vgwc_ibg_color', true);
	$vgwc_ibg_color		= (empty($vgwc_ibg_color)) ? "#ffffff" : sanitize_text_field($vgwc_ibg_color);
	
	$vgwc_itext_color 	= get_post_meta($post->ID, 'vgwc_itext_color', true);
	$vgwc_itext_color	= (empty($vgwc_itext_color)) ? "#333333" : sanitize_text_field($vgwc_itext_color);
	
	$vgwc_ilink_color 	= get_post_meta($post->ID, 'vgwc_ilink_color', true);
	$vgwc_ilink_color	= (empty($vgwc_ilink_color)) ? "#0088cc" : sanitize_text_field($vgwc_ilink_color);
	
	
	$vgwc_row_carousel 	= get_post_meta($post->ID, 'vgwc_row_carousel', true);
	$vgwc_row_carousel	= (empty($vgwc_row_carousel)) ? 1 : intval($vgwc_row_carousel);
	
	$vgwc_items_visible = get_post_meta($post->ID, 'vgwc_items_visible', true);
	$vgwc_items_visible	= (empty($vgwc_items_visible)) ? 4 : intval($vgwc_items_visible);
	
	$vgwc_desktop_number 	= get_post_meta($post->ID, 'vgwc_desktop_number', true);
	$vgwc_desktop_number	= (empty($vgwc_desktop_number)) ? "[1170,4]" : sanitize_text_field($vgwc_desktop_number);
	
	$vgwc_sdesktop_number 	= get_post_meta($post->ID, 'vgwc_sdesktop_number', true);
	$vgwc_sdesktop_number	= (empty($vgwc_sdesktop_number)) ? "[980,3]" : sanitize_text_field($vgwc_sdesktop_number);
	
	$vgwc_tablet_number 	= get_post_meta($post->ID, 'vgwc_tablet_number', true);
	$vgwc_tablet_number		= (empty($vgwc_tablet_number)) ? "[800,3]" : sanitize_text_field($vgwc_tablet_number);
	
	$vgwc_stablet_number 	= get_post_meta($post->ID, 'vgwc_stablet_number', true);
	$vgwc_stablet_number	= (empty($vgwc_stablet_number)) ? "[650,2]" : sanitize_text_field($vgwc_stablet_number);
	
	$vgwc_mobile_number 	= get_post_meta($post->ID, 'vgwc_mobile_number', true);
	$vgwc_mobile_number		= (empty($vgwc_mobile_number)) ? "[450,1]" : sanitize_text_field($vgwc_mobile_number);
	
	$vgwc_slide_speed 		= get_post_meta($post->ID, 'vgwc_slide_speed', true);
	$vgwc_slide_speed		= (empty($vgwc_slide_speed)) ? "200" : sanitize_text_field($vgwc_slide_speed);
	
	$vgwc_page_speed 		= get_post_meta($post->ID, 'vgwc_page_speed', true);
	$vgwc_page_speed		= (empty($vgwc_page_speed)) ? "800" : sanitize_text_field($vgwc_page_speed);
	
	$vgwc_rewind_speed 		= get_post_meta($post->ID, 'vgwc_rewind_speed', true);
	$vgwc_rewind_speed		= (empty($vgwc_rewind_speed)) ? "1000" : sanitize_text_field($vgwc_rewind_speed);
	
	$vgwc_enable_autoplay 	= get_post_meta($post->ID, 'vgwc_enable_autoplay', true);
	$vgwc_enable_autoplay	= intval($vgwc_enable_autoplay);
	
	$vgwc_auto_speed 		= get_post_meta($post->ID, 'vgwc_auto_speed', true);
	$vgwc_auto_speed		= (empty($vgwc_auto_speed)) ? "5000" : sanitize_text_field($vgwc_auto_speed);
	
	$vgwc_stop_hover 		= get_post_meta($post->ID, 'vgwc_stop_hover', true);
	$vgwc_stop_hover		= intval($vgwc_stop_hover);
	
	$vgwc_next_preview 		= get_post_meta($post->ID, 'vgwc_next_preview', true);
	$vgwc_next_preview		= intval($vgwc_next_preview);
	
	$vgwc_scroll_page 		= get_post_meta($post->ID, 'vgwc_scroll_page', true);
	$vgwc_scroll_page		= intval($vgwc_scroll_page);
	
	$vgwc_pagination 		= get_post_meta($post->ID, 'vgwc_pagination', true);
	$vgwc_pagination		= intval($vgwc_pagination);
	
	$vgwc_pagination_number = get_post_meta($post->ID, 'vgwc_pagination_number', true);
	$vgwc_pagination_number	= intval($vgwc_pagination_number);
	
	$vgwc_mouse_drag 		= get_post_meta($post->ID, 'vgwc_mouse_drag', true);
	$vgwc_mouse_drag		= intval($vgwc_mouse_drag);
	
	$vgwc_touch_drag 		= get_post_meta($post->ID, 'vgwc_touch_drag', true);
	$vgwc_touch_drag		= intval($vgwc_touch_drag);
	
	$vgwc_left_offset		= get_post_meta($post->ID, 'vgwc_left_offset', true);
	$vgwc_left_offset		= (empty($vgwc_left_offset)) ? "0" : sanitize_text_field($vgwc_left_offset);
	
	
	$vgwc_category 			= get_post_meta($post->ID, 'vgwc_category', true);
	$vgwc_category			= (empty($vgwc_category)) ? "all" : sanitize_text_field($vgwc_category);
	
	$vgwc_carousel_type 	= get_post_meta($post->ID, 'vgwc_carousel_type', true);
	$vgwc_carousel_type		= (empty($vgwc_carousel_type)) ? "latest" : sanitize_text_field($vgwc_carousel_type);
	
	$vgwc_number_products 	= get_post_meta($post->ID, 'vgwc_number_products', true);
	$vgwc_number_products	= (empty($vgwc_number_products)) ? 12 : intval($vgwc_number_products);
	
	$vgwc_product_name 		= get_post_meta($post->ID, 'vgwc_product_name', true);
	$vgwc_product_name		= intval($vgwc_product_name);
	
	$vgwc_product_image 	= get_post_meta($post->ID, 'vgwc_product_image', true);
	$vgwc_product_image		= intval($vgwc_product_image);
	
	$vgwc_image_size 		= get_post_meta($post->ID, 'vgwc_image_size', true);
	$vgwc_image_size		= (empty($vgwc_image_size)) ? "shop_catalog" : sanitize_text_field($vgwc_image_size);
	
	$vgwc_product_desc 		= get_post_meta($post->ID, 'vgwc_product_desc', true);
	$vgwc_product_desc		= intval($vgwc_product_desc);
	
	$vgwc_desc_lenght 		= get_post_meta($post->ID, 'vgwc_desc_lenght', true);
	$vgwc_desc_lenght		= (empty($vgwc_desc_lenght)) ? "200" : sanitize_text_field($vgwc_desc_lenght);
	
	$vgwc_product_price 	= get_post_meta($post->ID, 'vgwc_product_price', true);
	$vgwc_product_price		= intval($vgwc_product_price);
	
	$vgwc_add_cart 			= get_post_meta($post->ID, 'vgwc_add_cart', true);
	$vgwc_add_cart			= intval($vgwc_add_cart);
	
	$vgwc_bbg_color 		= get_post_meta($post->ID, 'vgwc_bbg_color', true);
	$vgwc_bbg_color			= (empty($vgwc_bbg_color)) ? "#23b2dd" : sanitize_text_field($vgwc_bbg_color);
	
	$vgwc_btext_color 		= get_post_meta($post->ID, 'vgwc_btext_color', true);
	$vgwc_btext_color		= (empty($vgwc_btext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_btext_color);
	
	$vgwc_product_rating 	= get_post_meta($post->ID, 'vgwc_product_rating', true);
	$vgwc_product_rating	= intval($vgwc_product_rating);
	
	$vgwc_product_label 	= get_post_meta($post->ID, 'vgwc_product_label', true);
	$vgwc_product_label		= intval($vgwc_product_label);
	
	$vgwc_salebg_color 		= get_post_meta($post->ID, 'vgwc_salebg_color', true);
	$vgwc_salebg_color		= (empty($vgwc_salebg_color)) ? "#23B2DD" : sanitize_text_field($vgwc_salebg_color);
	
	$vgwc_saletext_color 	= get_post_meta($post->ID, 'vgwc_saletext_color', true);
	$vgwc_saletext_color	= (empty($vgwc_saletext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_saletext_color);
	
	$vgwc_hotbg_color 		= get_post_meta($post->ID, 'vgwc_hotbg_color', true);
	$vgwc_hotbg_color		= (empty($vgwc_hotbg_color)) ? "##FF0000" : sanitize_text_field($vgwc_hotbg_color);
	
	$vgwc_hottext_color 	= get_post_meta($post->ID, 'vgwc_hottext_color', true);
	$vgwc_hottext_color		= (empty($vgwc_hottext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_hottext_color);
?>
    <div class="vn-settings">
		
		<!-- Shortcode Block -->
		<div class="option-box shortcode-block">
			<p class="option-title"><?php esc_html_e("Shortcode", "vgwc"); ?></p>
			<p class="option-info"><?php esc_html_e("Copy this shortcode and paste on page or post where you want to display carousel.", "vgwc"); ?><br /><?php esc_html_e("Use PHP code to your themes file to display carousel.", "vgwc"); ?></p>
			<textarea cols="50" rows="1" onClick="this.select();" >[vgwc <?php echo 'id="'.$post->ID.'"';?>]</textarea>
			<br /><br />
			<?php esc_html_e("PHP Code", "vgwc"); ?>:<br />
			<textarea cols="50" rows="1" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[vgwc id='; echo "'".$post->ID."']"; echo '"); ?>'; ?></textarea>  
		</div>
		
		
		<!-- Tab Header Block -->
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active"><?php esc_html_e("Global Setting", "vgwc"); ?></li>
            <li nav="2" class="nav2"><?php esc_html_e("Carousel Setting", "vgwc"); ?></li>
            <li nav="3" class="nav3"><?php esc_html_e("WooCommerce Setting", "vgwc"); ?></li>
        </ul>
        
		<!-- Tab Content Block -->
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
				<div class="control-group">
					<div class="control-label"><label><?php _e('Widget Class Suffix', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_class_sufix" value="<?php echo esc_attr($vgwc_class_sufix); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Carousel Theme', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<select name="vgwc_theme">							
							<?php
								$vgwc_all_themes = vgwc_get_all_themes();
								foreach($vgwc_all_themes as $key => $theme) {
									echo '<option value="'.$theme.'"'.(($vgwc_theme == $theme) ? ' selected="selected"' : '').'>'.$theme.'</option>';
								}
							?>
						</select>
					</div>
				</div>
								
				<div class="control-group hidden">
					<div class="control-label"><label><?php _e('Background Image', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<select name="vgwc_bg_image">
							<option><?php _e('No Background', 'vgwc'); ?></option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Use Background Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_isbg_color"<?php echo !$vgwc_isbg_color ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_isbg_color"<?php echo $vgwc_isbg_color ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Background Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_bg_color" id="vgwc_bg_color" value="<?php echo esc_attr($vgwc_bg_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Widget Margin', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_wmargin" value="<?php echo esc_attr($vgwc_wmargin); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Widget Padding', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_wpadding" value="<?php echo esc_attr($vgwc_wpadding); ?>" /></div>
				</div>
				
				<hr>
				<div class="control-group">
					<div class="control-label"><label><?php _e('Item Margin', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_imargin" value="<?php echo esc_attr($vgwc_imargin); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Item Padding', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_ipadding" value="<?php echo esc_attr($vgwc_ipadding); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Use Item Background Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">							
							<input type="radio" value="0" name="vgwc_isibg_color"<?php echo !$vgwc_isibg_color ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_isibg_color"<?php echo $vgwc_isibg_color ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Item Background Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_ibg_color" id="vgwc_ibg_color" value="<?php echo esc_attr($vgwc_ibg_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Item Text Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_itext_color" id="vgwc_itext_color" value="<?php echo esc_attr($vgwc_itext_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Item Link Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_ilink_color" id="vgwc_ilink_color" value="<?php echo esc_attr($vgwc_ilink_color); ?>" />
					</div>
				</div>
            </li>
			
            <li style="display: none;" class="box2 tab-box ">
				<div class="control-group">
					<div class="control-label"><label><?php _e('Row of Carousel', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_row_carousel" value="<?php echo esc_attr($vgwc_row_carousel); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Items Visible', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_items_visible" value="<?php echo esc_attr($vgwc_items_visible); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Desktop - Column Number', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_desktop_number" value="<?php echo esc_attr($vgwc_desktop_number); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('S Desktop - Column Number', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_sdesktop_number" value="<?php echo esc_attr($vgwc_sdesktop_number); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Tablet - Column Number', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_tablet_number" value="<?php echo esc_attr($vgwc_tablet_number); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('S Tablet - Column Number', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_stablet_number" value="<?php echo esc_attr($vgwc_stablet_number); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Mobile - Column Number', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_mobile_number" value="<?php echo esc_attr($vgwc_mobile_number); ?>" /></div>
				</div>
				
				<hr>
				<div class="control-group">
					<div class="control-label"><label><?php _e('Slide Speed', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_slide_speed" value="<?php echo esc_attr($vgwc_slide_speed); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Pagination Speed', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_page_speed" value="<?php echo esc_attr($vgwc_page_speed); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Rewind Speed', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_rewind_speed" value="<?php echo esc_attr($vgwc_rewind_speed); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('AutoPlay', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">							
							<input type="radio" value="0" name="vgwc_enable_autoplay"<?php echo !$vgwc_enable_autoplay ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_enable_autoplay"<?php echo $vgwc_enable_autoplay ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group hidden">
					<div class="control-label"><label><?php _e('AutoPlay Speed', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_auto_speed" value="<?php echo esc_attr($vgwc_auto_speed); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Stop On Hover', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_stop_hover"<?php echo !$vgwc_stop_hover ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_stop_hover"<?php echo $vgwc_stop_hover ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Next & Preview Buttons', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_next_preview"<?php echo !$vgwc_next_preview ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_next_preview"<?php echo $vgwc_next_preview ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Scroll Per Page', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_scroll_page"<?php echo !$vgwc_scroll_page ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_scroll_page"<?php echo $vgwc_scroll_page ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Pagination', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_pagination"<?php echo !$vgwc_pagination ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_pagination"<?php echo $vgwc_pagination ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Pagination Numbers', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_pagination_number"<?php echo !$vgwc_pagination_number ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_pagination_number"<?php echo $vgwc_pagination_number ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Mouse Drag', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_mouse_drag"<?php echo !$vgwc_mouse_drag ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_mouse_drag"<?php echo $vgwc_mouse_drag ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Touch Drag', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_touch_drag"<?php echo !$vgwc_touch_drag ? ' checked="checked"' : ""; ?>>
							<label><?php _e('No', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_touch_drag"<?php echo $vgwc_touch_drag ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Yes', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Left Offset', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_left_offset" value="<?php echo esc_attr($vgwc_left_offset); ?>" /></div>
				</div>
            </li>
			
            <li style="display: none;" class="box3 tab-box ">
				<div class="control-group">
					<div class="control-label"><label><?php _e('Category to Filter', 'vgwc'); ?>:</label></div>
					<div class="controls">						
						<select class="dropdown" name="vgwc_category[]" multiple="true">						
							<option value="0"<?php echo ($vgwc_category == 'all') ? ' selected="selected"' : ""; ?>><?php _e('All Categories', 'vgwc'); ?></option>
							<?php 
								$vgwc_categories = explode(",", $vgwc_category);
								echo vgwc_rent_list_categories(0, $vgwc_categories);
							?>							
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Carousel Type', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<select class="dropdown" name="vgwc_carousel_type">
							<option value="latest"<?php echo ($vgwc_carousel_type == 'latest') ? ' selected="selected"' : ""; ?>><?php _e('Latest Published', 'vgwc'); ?></option>
							<option value="older"<?php echo ($vgwc_carousel_type == 'older') ? ' selected="selected"' : ""; ?>><?php _e('Older Published', 'vgwc'); ?></option>
							<option value="featured"<?php echo ($vgwc_carousel_type == 'featured') ? ' selected="selected"' : ""; ?>><?php _e('Feature Products', 'vgwc'); ?></option>
							<option value="onsale"<?php echo ($vgwc_carousel_type == 'onsale') ? ' selected="selected"' : ""; ?>><?php _e('OnSale Products', 'vgwc'); ?></option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Number of Products', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_number_products" value="<?php echo esc_attr($vgwc_number_products); ?>" /></div>
				</div>
				
				<hr>
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Name', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_product_name"<?php echo !$vgwc_product_name ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_name"<?php echo $vgwc_product_name ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Rating', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">							
							<input type="radio" value="0" name="vgwc_product_rating"<?php echo !$vgwc_product_rating ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_rating"<?php echo $vgwc_product_rating ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Image', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_product_image"<?php echo !$vgwc_product_image ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_image"<?php echo $vgwc_product_image ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Image Size', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<select name="vgwc_image_size">
							<option value="shop_thumbnail"<?php echo ($vgwc_image_size == 'shop_thumbnail') ? ' selected="selected"' : ""; ?>><?php _e('Thumbnail', 'vgwc'); ?></option>
							<option value="shop_catalog"<?php echo ($vgwc_image_size == 'shop_catalog') ? ' selected="selected"' : ""; ?>><?php _e('Medium', 'vgwc'); ?></option>
							<option value="shop_single"<?php echo ($vgwc_image_size == 'shop_single') ? ' selected="selected"' : ""; ?>><?php _e('Large', 'vgwc'); ?></option>
						</select>
					</div>
				</div>
				
				<div class="control-group hidden">
					<div class="control-label"><label><?php _e('Product Description', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_product_desc"<?php echo !$vgwc_product_desc ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_desc"<?php echo $vgwc_product_desc ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group hidden">
					<div class="control-label"><label><?php _e('Description Lenght', 'vgwc'); ?>:</label></div>
					<div class="controls"><input type="text" size="20" name="vgwc_desc_lenght" value="<?php echo esc_attr($vgwc_desc_lenght); ?>" /></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Price', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_product_price"<?php echo !$vgwc_product_price ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_price"<?php echo $vgwc_product_price ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Add To Cart Button', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_add_cart"<?php echo !$vgwc_add_cart ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_add_cart"<?php echo $vgwc_add_cart ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Button Backgound Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_bbg_color" id="vgwc_bbg_color" value="<?php echo esc_attr($vgwc_bbg_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Button Text Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_btext_color" id="vgwc_btext_color" value="<?php echo esc_attr($vgwc_btext_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Product Label', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<fieldset class="radio btn-group btn-group-yesno">
							<input type="radio" value="0" name="vgwc_product_label"<?php echo !$vgwc_product_label ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Hide', 'vgwc'); ?></label>
							<input type="radio" value="1" name="vgwc_product_label"<?php echo $vgwc_product_label ? ' checked="checked"' : ""; ?>>
							<label><?php _e('Show', 'vgwc'); ?></label>
						</fieldset>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Sale - Backgound Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_salebg_color" id="vgwc_salebg_color" value="<?php echo esc_attr($vgwc_salebg_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Sale - Text Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_saletext_color" id="vgwc_saletext_color" value="<?php echo esc_attr($vgwc_saletext_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Featured - Backgound Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_hotbg_color" id="vgwc_hotbg_color" value="<?php echo esc_attr($vgwc_hotbg_color); ?>" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><label><?php _e('Featured - Text Color', 'vgwc'); ?>:</label></div>
					<div class="controls">
						<input type="text" name="vgwc_hottext_color" id="vgwc_hottext_color" value="<?php echo esc_attr($vgwc_hottext_color); ?>" />
					</div>
				</div>
            </li>
        </ul>
    </div>
<?php
}

/* Meta Boxed Save */
function meta_boxes_vgwc_save($post_id)
{

	// Check if our nonce is set.
	if(! isset($_POST['meta_boxes_vgwc_input_nonce']))
		return $post_id;

	$nonce = $_POST['meta_boxes_vgwc_input_nonce'];

	// Verify that the nonce is valid.
	if(! wp_verify_nonce($nonce, 'meta_boxes_vgwc_input'))
		return $post_id;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return $post_id;

	
	/* OK, its safe for us to save the data now. */
	$vgwc_class_sufix 	= $_POST['vgwc_class_sufix'];
	$vgwc_class_sufix	= (empty($vgwc_class_sufix)) ? "" : sanitize_text_field($vgwc_class_sufix);
	update_post_meta($post_id, 'vgwc_class_sufix', $vgwc_class_sufix);
	
	$vgwc_theme 		= $_POST['vgwc_theme'];
	$vgwc_theme			= (empty($vgwc_theme)) ? "all" : sanitize_text_field($vgwc_theme);
	update_post_meta($post_id, 'vgwc_theme', $vgwc_theme);
	
	$vgwc_bg_image 		= $_POST['vgwc_bg_image'];
	$vgwc_bg_image		= (empty($vgwc_bg_image)) ? "" : sanitize_text_field($vgwc_bg_image);
	update_post_meta($post_id, 'vgwc_bg_image', $vgwc_bg_image);
	
	$vgwc_isbg_color 	= $_POST['vgwc_isbg_color'];
	$vgwc_isbg_color	= intval($vgwc_isbg_color);
	update_post_meta($post_id, 'vgwc_isbg_color', $vgwc_isbg_color);
	
	$vgwc_bg_color 		= $_POST['vgwc_bg_color'];
	$vgwc_bg_color		= (empty($vgwc_bg_color)) ? "#F1F1F1" : sanitize_text_field($vgwc_bg_color);
	update_post_meta($post_id, 'vgwc_bg_color', $vgwc_bg_color);
	
	$vgwc_wmargin 		= $_POST['vgwc_wmargin'];
	$vgwc_wmargin		= (empty($vgwc_wmargin)) ? "0px 0px" : sanitize_text_field($vgwc_wmargin);
	update_post_meta($post_id, 'vgwc_wmargin', $vgwc_wmargin);
	
	$vgwc_wpadding 		= $_POST['vgwc_wpadding'];
	$vgwc_wpadding		= (empty($vgwc_wpadding)) ? "10px 5px" : sanitize_text_field($vgwc_wpadding);
	update_post_meta($post_id, 'vgwc_wpadding', $vgwc_wpadding);
	
	$vgwc_imargin 		= $_POST['vgwc_imargin'];
	$vgwc_imargin		= (empty($vgwc_imargin)) ? "0px 5px" : sanitize_text_field($vgwc_imargin);
	update_post_meta($post_id, 'vgwc_imargin', $vgwc_imargin);
	
	$vgwc_ipadding 		= $_POST['vgwc_ipadding'];
	$vgwc_ipadding		= (empty($vgwc_ipadding)) ? "10px 10px" : sanitize_text_field($vgwc_ipadding);
	update_post_meta($post_id, 'vgwc_ipadding', $vgwc_ipadding);
	
	$vgwc_isibg_color 	= $_POST['vgwc_isibg_color'];
	$vgwc_isibg_color	= intval($vgwc_isibg_color);
	update_post_meta($post_id, 'vgwc_isibg_color', $vgwc_isibg_color);
	
	$vgwc_ibg_color 	= $_POST['vgwc_ibg_color'];
	$vgwc_ibg_color		= (empty($vgwc_ibg_color)) ? "#ffffff" : sanitize_text_field($vgwc_ibg_color);
	update_post_meta($post_id, 'vgwc_ibg_color', $vgwc_ibg_color);
	
	$vgwc_itext_color 	= $_POST['vgwc_itext_color'];
	$vgwc_itext_color	= (empty($vgwc_itext_color)) ? "#333333" : sanitize_text_field($vgwc_itext_color);
	update_post_meta($post_id, 'vgwc_itext_color', $vgwc_itext_color);
	
	$vgwc_ilink_color 	= $_POST['vgwc_ilink_color'];
	$vgwc_ilink_color	= (empty($vgwc_ilink_color)) ? "#0088cc" : sanitize_text_field($vgwc_ilink_color);
	update_post_meta($post_id, 'vgwc_ilink_color', $vgwc_ilink_color);
	
	
	$vgwc_row_carousel 	= $_POST['vgwc_row_carousel'];
	$vgwc_row_carousel	= (empty($vgwc_row_carousel)) ? 1 : intval($vgwc_row_carousel);
	update_post_meta($post_id, 'vgwc_row_carousel', $vgwc_row_carousel);
	
	$vgwc_items_visible = $_POST['vgwc_items_visible'];
	$vgwc_items_visible	= (empty($vgwc_items_visible)) ? 4 : intval($vgwc_items_visible);
	update_post_meta($post_id, 'vgwc_items_visible', $vgwc_items_visible);
	
	$vgwc_desktop_number 	= $_POST['vgwc_desktop_number'];
	$vgwc_desktop_number	= (empty($vgwc_desktop_number)) ? "[1170,4]" : sanitize_text_field($vgwc_desktop_number);
	update_post_meta($post_id, 'vgwc_desktop_number', $vgwc_desktop_number);
	
	$vgwc_sdesktop_number 	= $_POST['vgwc_sdesktop_number'];
	$vgwc_sdesktop_number	= (empty($vgwc_sdesktop_number)) ? "[980,3]" : sanitize_text_field($vgwc_sdesktop_number);
	update_post_meta($post_id, 'vgwc_sdesktop_number', $vgwc_sdesktop_number);
	
	$vgwc_tablet_number 	= $_POST['vgwc_tablet_number'];
	$vgwc_tablet_number		= (empty($vgwc_tablet_number)) ? "[800,3]" : sanitize_text_field($vgwc_tablet_number);
	update_post_meta($post_id, 'vgwc_tablet_number', $vgwc_tablet_number);
	
	$vgwc_stablet_number 	= $_POST['vgwc_stablet_number'];
	$vgwc_stablet_number	= (empty($vgwc_stablet_number)) ? "[650,2]" : sanitize_text_field($vgwc_stablet_number);
	update_post_meta($post_id, 'vgwc_stablet_number', $vgwc_stablet_number);
	
	$vgwc_mobile_number 	= $_POST['vgwc_mobile_number'];
	$vgwc_mobile_number		= (empty($vgwc_mobile_number)) ? "[450,1]" : sanitize_text_field($vgwc_mobile_number);
	update_post_meta($post_id, 'vgwc_mobile_number', $vgwc_mobile_number);
	
	$vgwc_slide_speed 		= $_POST['vgwc_slide_speed'];
	$vgwc_slide_speed		= (empty($vgwc_slide_speed)) ? "200" : sanitize_text_field($vgwc_slide_speed);
	update_post_meta($post_id, 'vgwc_slide_speed', $vgwc_slide_speed);
	
	$vgwc_page_speed 		= $_POST['vgwc_page_speed'];
	$vgwc_page_speed		= (empty($vgwc_page_speed)) ? "800" : sanitize_text_field($vgwc_page_speed);
	update_post_meta($post_id, 'vgwc_page_speed', $vgwc_page_speed);
	
	$vgwc_rewind_speed 		= $_POST['vgwc_rewind_speed'];
	$vgwc_rewind_speed		= (empty($vgwc_rewind_speed)) ? "1000" : sanitize_text_field($vgwc_rewind_speed);
	update_post_meta($post_id, 'vgwc_rewind_speed', $vgwc_rewind_speed);
	
	$vgwc_enable_autoplay 	= $_POST['vgwc_enable_autoplay'];
	$vgwc_enable_autoplay	= intval($vgwc_enable_autoplay);
	update_post_meta($post_id, 'vgwc_enable_autoplay', $vgwc_enable_autoplay);
	
	$vgwc_auto_speed 		= $_POST['vgwc_auto_speed'];
	$vgwc_auto_speed		= (empty($vgwc_auto_speed)) ? "5000" : sanitize_text_field($vgwc_auto_speed);
	update_post_meta($post_id, 'vgwc_auto_speed', $vgwc_auto_speed);
	
	$vgwc_stop_hover 		= $_POST['vgwc_stop_hover'];
	$vgwc_stop_hover		= intval($vgwc_stop_hover);
	update_post_meta($post_id, 'vgwc_stop_hover', $vgwc_stop_hover);
	
	$vgwc_next_preview 		= $_POST['vgwc_next_preview'];
	$vgwc_next_preview		= intval($vgwc_next_preview);
	update_post_meta($post_id, 'vgwc_next_preview', $vgwc_next_preview);
	
	$vgwc_scroll_page 		= $_POST['vgwc_scroll_page'];
	$vgwc_scroll_page		= intval($vgwc_scroll_page);
	update_post_meta($post_id, 'vgwc_scroll_page', $vgwc_scroll_page);
	
	$vgwc_pagination 		= $_POST['vgwc_pagination'];
	$vgwc_pagination		= intval($vgwc_pagination);
	update_post_meta($post_id, 'vgwc_pagination', $vgwc_pagination);
	
	$vgwc_pagination_number = $_POST['vgwc_pagination_number'];
	$vgwc_pagination_number	= intval($vgwc_pagination_number);
	update_post_meta($post_id, 'vgwc_pagination_number', $vgwc_pagination_number);
	
	$vgwc_mouse_drag 		= $_POST['vgwc_mouse_drag'];
	$vgwc_mouse_drag		= intval($vgwc_mouse_drag);
	update_post_meta($post_id, 'vgwc_mouse_drag', $vgwc_mouse_drag);
	
	$vgwc_touch_drag 		= $_POST['vgwc_touch_drag'];
	$vgwc_touch_drag		= intval($vgwc_touch_drag);
	update_post_meta($post_id, 'vgwc_touch_drag', $vgwc_touch_drag);
	
	$vgwc_left_offset		= $_POST['vgwc_left_offset'];
	$vgwc_left_offset		= (empty($vgwc_left_offset)) ? "0" : sanitize_text_field($vgwc_left_offset);
	update_post_meta($post_id, 'vgwc_left_offset', $vgwc_left_offset);
	
	
	$vgwc_category 			= $_POST['vgwc_category'];
	$vgwc_category 			= (is_array($vgwc_category)) ? implode(",", $vgwc_category) : $vgwc_category;	
	$vgwc_category			= (empty($vgwc_category)) ? "all" : sanitize_text_field($vgwc_category);
	update_post_meta($post_id, 'vgwc_category', $vgwc_category);
	
	$vgwc_carousel_type 	= $_POST['vgwc_carousel_type'];
	$vgwc_carousel_type		= (empty($vgwc_carousel_type)) ? "latest" : sanitize_text_field($vgwc_carousel_type);
	update_post_meta($post_id, 'vgwc_carousel_type', $vgwc_carousel_type);
	
	$vgwc_number_products 	= $_POST['vgwc_number_products'];
	$vgwc_number_products	= intval($vgwc_number_products);
	update_post_meta($post_id, 'vgwc_number_products', $vgwc_number_products);
	
	$vgwc_product_name 		= $_POST['vgwc_product_name'];
	$vgwc_product_name		= intval($vgwc_product_name);
	update_post_meta($post_id, 'vgwc_product_name', $vgwc_product_name);
	
	$vgwc_product_image 	= $_POST['vgwc_product_image'];
	$vgwc_product_image		= intval($vgwc_product_image);
	update_post_meta($post_id, 'vgwc_product_image', $vgwc_product_image);
	
	$vgwc_image_size 		= $_POST['vgwc_image_size'];
	$vgwc_image_size		= (empty($vgwc_image_size)) ? "shop_catalog" : sanitize_text_field($vgwc_image_size);
	update_post_meta($post_id, 'vgwc_image_size', $vgwc_image_size);
	
	$vgwc_product_desc 		= $_POST['vgwc_product_desc'];
	$vgwc_product_desc		= intval($vgwc_product_desc);
	update_post_meta($post_id, 'vgwc_product_desc', $vgwc_product_desc);
	
	$vgwc_desc_lenght 		= $_POST['vgwc_desc_lenght'];
	$vgwc_desc_lenght		= (empty($vgwc_desc_lenght)) ? "200" : sanitize_text_field($vgwc_desc_lenght);
	update_post_meta($post_id, 'vgwc_desc_lenght', $vgwc_desc_lenght);
	
	$vgwc_product_price 	= $_POST['vgwc_product_price'];
	$vgwc_product_price		= intval($vgwc_product_price);
	update_post_meta($post_id, 'vgwc_product_price', $vgwc_product_price);
	
	$vgwc_add_cart 			= $_POST['vgwc_add_cart'];
	$vgwc_add_cart			= intval($vgwc_add_cart);
	update_post_meta($post_id, 'vgwc_add_cart', $vgwc_add_cart);
	
	$vgwc_bbg_color 		= $_POST['vgwc_bbg_color'];
	$vgwc_bbg_color			= (empty($vgwc_bbg_color)) ? "#23b2dd" : sanitize_text_field($vgwc_bbg_color);
	update_post_meta($post_id, 'vgwc_bbg_color', $vgwc_bbg_color);
	
	$vgwc_btext_color 		= $_POST['vgwc_btext_color'];
	$vgwc_btext_color		= (empty($vgwc_btext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_btext_color);
	update_post_meta($post_id, 'vgwc_btext_color', $vgwc_btext_color);
	
	$vgwc_product_rating 	= $_POST['vgwc_product_rating'];
	$vgwc_product_rating	= intval($vgwc_product_rating);
	update_post_meta($post_id, 'vgwc_product_rating', $vgwc_product_rating);
	
	$vgwc_product_label 	= $_POST['vgwc_product_label'];
	$vgwc_product_label		= intval($vgwc_product_label);
	update_post_meta($post_id, 'vgwc_product_label', $vgwc_product_label);
	
	$vgwc_salebg_color 		= $_POST['vgwc_salebg_color'];
	$vgwc_salebg_color		= (empty($vgwc_salebg_color)) ? "#23B2DD" : sanitize_text_field($vgwc_salebg_color);
	update_post_meta($post_id, 'vgwc_salebg_color', $vgwc_salebg_color);
	
	$vgwc_saletext_color 	= $_POST['vgwc_saletext_color'];
	$vgwc_saletext_color	= (empty($vgwc_saletext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_saletext_color);
	update_post_meta($post_id, 'vgwc_saletext_color', $vgwc_saletext_color);
	
	$vgwc_hotbg_color 		= $_POST['vgwc_hotbg_color'];
	$vgwc_hotbg_color		= (empty($vgwc_hotbg_color)) ? "##FF0000" : sanitize_text_field($vgwc_hotbg_color);
	update_post_meta($post_id, 'vgwc_hotbg_color', $vgwc_hotbg_color);
	
	$vgwc_hottext_color 	= $_POST['vgwc_hottext_color'];
	$vgwc_hottext_color		= (empty($vgwc_hottext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_hottext_color);
	update_post_meta($post_id, 'vgwc_hottext_color', $vgwc_hottext_color);
}
add_action('save_post', 'meta_boxes_vgwc_save');