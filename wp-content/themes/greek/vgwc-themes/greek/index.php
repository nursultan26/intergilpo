<?php
function vgwc_body_greek($post_id)
{
	global $vgwc_wp_query;
	
	/* Load Config Values */
	$vgwc_class_sufix 	= get_post_meta($post_id, 'vgwc_class_sufix', true);
	$vgwc_class_sufix	= (empty($vgwc_class_sufix)) ? "" : sanitize_text_field($vgwc_class_sufix);
	
	$vgwc_bg_image 		= get_post_meta($post_id, 'vgwc_bg_image', true);
	$vgwc_bg_image		= (empty($vgwc_bg_image)) ? "" : sanitize_text_field($vgwc_bg_image);
	
	$vgwc_isbg_color 	= get_post_meta($post_id, 'vgwc_isbg_color', true);
	$vgwc_isbg_color	= intval($vgwc_isbg_color);
	
	$vgwc_bg_color 		= get_post_meta($post_id, 'vgwc_bg_color', true);
	$vgwc_bg_color		= (empty($vgwc_bg_color)) ? "#F1F1F1" : sanitize_text_field($vgwc_bg_color);
	
	$vgwc_wmargin 		= get_post_meta($post_id, 'vgwc_wmargin', true);
	$vgwc_wmargin		= (empty($vgwc_wmargin)) ? "0px 0px" : sanitize_text_field($vgwc_wmargin);
	
	$vgwc_wpadding 		= get_post_meta($post_id, 'vgwc_wpadding', true);
	$vgwc_wpadding		= (empty($vgwc_wpadding)) ? "10px 5px" : sanitize_text_field($vgwc_wpadding);
	
	$vgwc_imargin 		= get_post_meta($post_id, 'vgwc_imargin', true);
	$vgwc_imargin		= (empty($vgwc_imargin)) ? "0px 5px" : sanitize_text_field($vgwc_imargin);
	
	$vgwc_ipadding 		= get_post_meta($post_id, 'vgwc_ipadding', true);
	$vgwc_ipadding		= (empty($vgwc_ipadding)) ? "10px 10px" : sanitize_text_field($vgwc_ipadding);
	
	$vgwc_isibg_color 	= get_post_meta($post_id, 'vgwc_isibg_color', true);
	$vgwc_isibg_color	= intval($vgwc_isibg_color);
	
	$vgwc_ibg_color 	= get_post_meta($post_id, 'vgwc_ibg_color', true);
	$vgwc_ibg_color		= (empty($vgwc_ibg_color)) ? "#ffffff" : sanitize_text_field($vgwc_ibg_color);
	
	$vgwc_itext_color 	= get_post_meta($post_id, 'vgwc_itext_color', true);
	$vgwc_itext_color	= (empty($vgwc_itext_color)) ? "#333333" : sanitize_text_field($vgwc_itext_color);
	
	$vgwc_ilink_color 	= get_post_meta($post_id, 'vgwc_ilink_color', true);
	$vgwc_ilink_color	= (empty($vgwc_ilink_color)) ? "#0088cc" : sanitize_text_field($vgwc_ilink_color);
	
	
	$vgwc_row_carousel 	= get_post_meta($post_id, 'vgwc_row_carousel', true);
	$vgwc_row_carousel	= (empty($vgwc_row_carousel)) ? 1 : intval($vgwc_row_carousel);
	
	$vgwc_items_visible = get_post_meta($post_id, 'vgwc_items_visible', true);
	$vgwc_items_visible	= (empty($vgwc_items_visible)) ? 4 : intval($vgwc_items_visible);
	
	$vgwc_desktop_number 	= get_post_meta($post_id, 'vgwc_desktop_number', true);
	$vgwc_desktop_number	= (empty($vgwc_desktop_number)) ? "[1170,4]" : sanitize_text_field($vgwc_desktop_number);
	
	$vgwc_sdesktop_number 	= get_post_meta($post_id, 'vgwc_sdesktop_number', true);
	$vgwc_sdesktop_number	= (empty($vgwc_sdesktop_number)) ? "[980,3]" : sanitize_text_field($vgwc_sdesktop_number);
	
	$vgwc_tablet_number 	= get_post_meta($post_id, 'vgwc_tablet_number', true);
	$vgwc_tablet_number		= (empty($vgwc_tablet_number)) ? "[800,3]" : sanitize_text_field($vgwc_tablet_number);
	
	$vgwc_stablet_number 	= get_post_meta($post_id, 'vgwc_stablet_number', true);
	$vgwc_stablet_number	= (empty($vgwc_stablet_number)) ? "[650,2]" : sanitize_text_field($vgwc_stablet_number);
	
	$vgwc_mobile_number 	= get_post_meta($post_id, 'vgwc_mobile_number', true);
	$vgwc_mobile_number		= (empty($vgwc_mobile_number)) ? "[450,1]" : sanitize_text_field($vgwc_mobile_number);
	
	$vgwc_slide_speed 		= get_post_meta($post_id, 'vgwc_slide_speed', true);
	$vgwc_slide_speed		= (empty($vgwc_slide_speed)) ? "200" : sanitize_text_field($vgwc_slide_speed);
	
	$vgwc_page_speed 		= get_post_meta($post_id, 'vgwc_page_speed', true);
	$vgwc_page_speed		= (empty($vgwc_page_speed)) ? "800" : sanitize_text_field($vgwc_page_speed);
	
	$vgwc_rewind_speed 	= get_post_meta($post_id, 'vgwc_rewind_speed', true);
	$vgwc_rewind_speed	= (empty($vgwc_rewind_speed)) ? "1000" : sanitize_text_field($vgwc_rewind_speed);
	
	$vgwc_enable_autoplay 	= get_post_meta($post_id, 'vgwc_enable_autoplay', true);
	$vgwc_enable_autoplay	= intval($vgwc_enable_autoplay);
	$vgwc_enable_autoplay	= ($vgwc_enable_autoplay) ? 'true' : 'false';
	
	$vgwc_auto_speed 	= get_post_meta($post_id, 'vgwc_auto_speed', true);
	$vgwc_auto_speed	= (empty($vgwc_auto_speed)) ? "5000" : sanitize_text_field($vgwc_auto_speed);
	
	$vgwc_stop_hover 	= get_post_meta($post_id, 'vgwc_stop_hover', true);
	$vgwc_stop_hover	= intval($vgwc_stop_hover);
	$vgwc_stop_hover	= ($vgwc_stop_hover) ? 'true' : 'false';
	
	$vgwc_next_preview 	= get_post_meta($post_id, 'vgwc_next_preview', true);
	$vgwc_next_preview	= intval($vgwc_next_preview);
	$vgwc_next_preview	= ($vgwc_next_preview) ? 'true' : 'false';
	
	$vgwc_scroll_page 	= get_post_meta($post_id, 'vgwc_scroll_page', true);
	$vgwc_scroll_page	= intval($vgwc_scroll_page);
	$vgwc_scroll_page	= ($vgwc_scroll_page) ? 'true' : 'false';
	
	$vgwc_pagination 	= get_post_meta($post_id, 'vgwc_pagination', true);
	$vgwc_pagination	= intval($vgwc_pagination);
	$vgwc_pagination	= ($vgwc_pagination) ? 'true' : 'false';
	
	$vgwc_pagination_number = get_post_meta($post_id, 'vgwc_pagination_number', true);
	$vgwc_pagination_number	= intval($vgwc_pagination_number);
	$vgwc_pagination_number	= ($vgwc_pagination_number) ? 'true' : 'false';
	
	$vgwc_mouse_drag 	= get_post_meta($post_id, 'vgwc_mouse_drag', true);
	$vgwc_mouse_drag	= intval($vgwc_mouse_drag);
	$vgwc_mouse_drag	= ($vgwc_mouse_drag) ? 'true' : 'false';
	
	$vgwc_touch_drag 	= get_post_meta($post_id, 'vgwc_touch_drag', true);
	$vgwc_touch_drag	= intval($vgwc_touch_drag);
	$vgwc_touch_drag	= ($vgwc_touch_drag) ? 'true' : 'false';
	
	$vgwc_left_offset 	= get_post_meta($post_id, 'vgwc_left_offset', true);
	$vgwc_left_offset	= (empty($vgwc_left_offset)) ? "-15" : sanitize_text_field($vgwc_left_offset);
	
	
	$vgwc_category 		= get_post_meta($post_id, 'vgwc_category', true);
	$vgwc_category		= (empty($vgwc_category)) ? 'all' : sanitize_text_field($vgwc_category);
	
	$vgwc_carousel_type = get_post_meta($post_id, 'vgwc_carousel_type', true);
	$vgwc_carousel_type	= (empty($vgwc_carousel_type)) ? "latest" : sanitize_text_field($vgwc_carousel_type);
	
	$vgwc_number_products 	= get_post_meta($post_id, 'vgwc_number_products', true);
	$vgwc_number_products	= (empty($vgwc_number_products)) ? 12 : intval($vgwc_number_products);
	
	$vgwc_product_name 	= get_post_meta($post_id, 'vgwc_product_name', true);
	$vgwc_product_name	= intval($vgwc_product_name);
	
	$vgwc_product_image = get_post_meta($post_id, 'vgwc_product_image', true);
	$vgwc_product_image	= intval($vgwc_product_image);
	
	$vgwc_image_size 	= get_post_meta($post_id, 'vgwc_image_size', true);
	$vgwc_image_size	= (empty($vgwc_image_size)) ? "medium" : sanitize_text_field($vgwc_image_size);
	
	$vgwc_product_desc 	= get_post_meta($post_id, 'vgwc_product_desc', true);
	$vgwc_product_desc	= intval($vgwc_product_desc);
	
	$vgwc_desc_lenght 	= get_post_meta($post_id, 'vgwc_desc_lenght', true);
	$vgwc_desc_lenght	= (empty($vgwc_desc_lenght)) ? "200" : sanitize_text_field($vgwc_desc_lenght);
	
	$vgwc_product_price = get_post_meta($post_id, 'vgwc_product_price', true);
	$vgwc_product_price	= intval($vgwc_product_price);
	
	$vgwc_add_cart 		= get_post_meta($post_id, 'vgwc_add_cart', true);
	$vgwc_add_cart		= intval($vgwc_add_cart);
	
	$vgwc_bbg_color 	= get_post_meta($post_id, 'vgwc_bbg_color', true);
	$vgwc_bbg_color		= (empty($vgwc_bbg_color)) ? "#0088cc" : sanitize_text_field($vgwc_bbg_color);
	
	$vgwc_btext_color 	= get_post_meta($post_id, 'vgwc_btext_color', true);
	$vgwc_btext_color	= (empty($vgwc_btext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_btext_color);
	
	$vgwc_product_rating 	= get_post_meta($post_id, 'vgwc_product_rating', true);
	$vgwc_product_rating	= intval($vgwc_product_rating);
	
	$vgwc_product_label 	= get_post_meta($post_id, 'vgwc_product_label', true);
	$vgwc_product_label		= intval($vgwc_product_label);
	
	$vgwc_salebg_color 		= get_post_meta($post_id, 'vgwc_salebg_color', true);
	$vgwc_salebg_color		= (empty($vgwc_salebg_color)) ? "#23B2DD" : sanitize_text_field($vgwc_salebg_color);
	
	$vgwc_saletext_color 	= get_post_meta($post_id, 'vgwc_saletext_color', true);
	$vgwc_saletext_color	= (empty($vgwc_saletext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_saletext_color);
	
	$vgwc_hotbg_color 		= get_post_meta($post_id, 'vgwc_hotbg_color', true);
	$vgwc_hotbg_color		= (empty($vgwc_hotbg_color)) ? "##FF0000" : sanitize_text_field($vgwc_hotbg_color);
	
	$vgwc_hottext_color 	= get_post_meta($post_id, 'vgwc_hottext_color', true);
	$vgwc_hottext_color		= (empty($vgwc_hottext_color)) ? "#FFFFFF" : sanitize_text_field($vgwc_hottext_color);
	
	/* Query Data */
	switch($vgwc_carousel_type) {
		case "older":
			$args = array(
				'post_type' 		=> 'product',
				'post_status' 		=> 'publish',
				'orderby' 			=> 'date',
				'order' 			=> 'ASC',
				'posts_per_page' 	=> $vgwc_number_products,
			);
			$args = ($vgwc_category == 'all') ? $args : array_merge($args, array("product_cat" => $vgwc_category));
		break;
		case "featured":
			$args = array(
				'post_type' 	=> 'product',
				'post_status' 	=> 'publish',
				'meta_query' 	=> array(
					array(
						'key' 	=> '_featured',
						'value' => 'yes',
				)),
				'posts_per_page' 	=> $vgwc_number_products,
			);
			$args = ($vgwc_category == 'all') ? $args : array_merge($args, array("product_cat" => $vgwc_category));
		break;
		case "onsale":
			$args = array(
				'post_type' 		=> 'product',
				'post_status' 		=> 'publish',
				'order' 			=> 'asc',
				'posts_per_page' 	=> $vgwc_number_products,
				'meta_query' 		=> array(
					array(
					'key' => '_visibility',
					'value' => array('catalog', 'visible'),
					'compare' => 'IN'
					),
					array(
					'key' => '_sale_price',
					'value' => 0,
					'compare' => '>',
					'type' => 'NUMERIC'
					)
				)
			);
			$args = ($vgwc_category == 'all') ? $args : array_merge($args, array("product_cat" => $vgwc_category));
		break;
		case "latest":
		default:
			$args = array(
				'post_type' 		=> 'product',
				'post_status' 		=> 'publish',
				'orderby' 			=> 'date',
				'order' 			=> 'DESC',
				'posts_per_page' 	=> $vgwc_number_products,
			);
			$args = ($vgwc_category == 'all') ? $args : array_merge($args, array("product_cat" => $vgwc_category));
		break;
	}	
	$vgwc_wp_query 		= new WP_Query($args);
	$vgwc_total_items 	= count($vgwc_wp_query->posts);
	$vgwc_total_loop 	= ceil($vgwc_total_items/$vgwc_row_carousel);
	$vgwc_key_loop   	= 0;
	
	/* Start HTML & CSS & Javascript */
	$vgwc_css = $vgwc_html = $vgwc_script = '';
	
	/* HTML Block */
	$vgwc_html .= '<div id="vgwc-wrapper'.$post_id.'" class="vgwc-wrapper theme-greek owl-carousel '.$vgwc_class_sufix.'">';
		if($vgwc_total_items)
		{
			for($i = 0; $i < $vgwc_total_loop; $i ++)
			{
				$vgwc_html .= '<div class="vgwc-item">';
				for($m = 0; $m < $vgwc_row_carousel; $m ++)
				{
					$vgwc_post_id = $vgwc_wp_query->posts[$vgwc_key_loop]->ID;
					if(!isset($vgwc_post_id)) continue;
					
					$vgwc_wp_query->the_post($vgwc_post_id); global $product;
					
					$vgwc_key_loop 	= $vgwc_key_loop + 1;
					$vgwc_featured 	= $product->is_featured();
					$vgwc_onsale	= $product->is_on_sale();
					$vgwc_thumb 	 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $vgwc_image_size);
					$vgwc_thumb_url = $vgwc_thumb['0'];
					$vgwc_currency 	= get_woocommerce_currency_symbol();
					$vgwc_price 	= $product->get_price_html();
					$vgwc_rating	= $product->get_rating_html();
					$vgwc_review	= $product->get_review_count() . esc_html__(" review(s)", "greek");
					
					$vgwc_html .= '<div class="vgwc-item-i">';
						global $greek_options;
						if($vgwc_product_image)
						{
							$vgwc_html .= '<div class="vgwc-image-block">';
								$vgwc_html .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
									$vgwc_html .= '<img alt="'.get_the_title().'" src="'.$vgwc_thumb_url.'" />';
								$vgwc_html .= '</a>';
								$vgwc_html .= ($vgwc_product_label && $vgwc_featured) ? '<div class="vgwc-label vgwc-featured">'.esc_html__("Hot", "greek").'</div>' : "";
								$vgwc_html .= ($vgwc_product_label && $vgwc_onsale) ? '<div class="vgwc-label vgwc-onsale">'.esc_html__("Sale", "greek").'</div>' : "";
								if(isset($greek_options['quick_view'])) {
									if(($greek_options['quick_view']) == true) {
										$vgwc_html .= '<div class="quick-wrapper">';
										$vgwc_html .= '<a class="quick-view quickview" data-quick-id="'.$vgwc_post_id.'" href="'.get_permalink().'" title="'.get_the_title().'">';
											$vgwc_html .= esc_html__("Быстрый просмотр", "greek");
										$vgwc_html .= '</a>';
										$vgwc_html .= '</div>';
									}
								}
							$vgwc_html .= '</div>';
						}
						
						if($vgwc_product_name || $vgwc_product_rating || $vgwc_product_price || $vgwc_add_cart)
						{
							$vgwc_html .= '<div class="vgwc-text-block">';
							
								if($vgwc_product_name)
								{
									$vgwc_html .= '<h3 class="vgwc-product-title">';
										$vgwc_html .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
											$vgwc_html .= get_the_title();
										$vgwc_html .= '</a>';
									$vgwc_html .= '</h3>';
								}
								
								if($vgwc_product_rating)
								{
									$vgwc_html .= '<div class="vgwc-product-rating">'.$vgwc_rating.' '.$vgwc_review.'</div>';
								}
								
								if($vgwc_product_price)
								{
									$vgwc_html .= '<div class="vgwc-product-price">'.$vgwc_price.'</div>';
								}
								
								if($vgwc_add_cart || class_exists('YITH_WCWL') || class_exists('YITH_Woocompare'))
								{
									$vgwc_html .= '<div class="vgwc-button-group">';
										if($vgwc_add_cart) {
											$vgwc_html .= '<div class="vgwc-add-to-cart">'.do_shortcode('[add_to_cart id="'.get_the_ID().'"]').'</div>';
										}
										if(class_exists('YITH_WCWL') || class_exists('YITH_Woocompare')) {
											$vgwc_html .= '<div class="add-to-links">';
												if(class_exists('YITH_WCWL')){
													$vgwc_html .= '<div class="vgwc-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')).'</div>';
												}
												if(class_exists('YITH_Woocompare')) {
													$vgwc_html .= '<div class="vgwc-compare">'.do_shortcode('[yith_compare_button]').'</div>';
												}
											$vgwc_html .= '</div>';
										}
									$vgwc_html .= '</div>';
								}
								
							$vgwc_html .= '</div>';
						}
					$vgwc_html .= '</div>';					
				}
				$vgwc_html .= '</div>';				
			}
			$product    = "";
		}
		else
		{
			return esc_html__("No item found. Please check your config!", "greek");
		}
	$vgwc_html .= '</div>';
	
	/* Reset Query */
	wp_reset_query();
	
	/* Javascript Block */
	if($vgwc_total_items)
	{
		$vgwc_script = '
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#vgwc-wrapper'.$post_id.'").owlCarousel({
				items: 				'.$vgwc_items_visible.',
				itemsDesktop: 		'.$vgwc_desktop_number.',
				itemsDesktopSmall: 	'.$vgwc_sdesktop_number.',
				itemsTablet: 		'.$vgwc_tablet_number.',
				itemsTabletSmall: 	'.$vgwc_stablet_number.',
				itemsMobile: 		'.$vgwc_mobile_number.',				
				slideSpeed: 		'.$vgwc_slide_speed.',
				paginationSpeed: 	'.$vgwc_page_speed.',
				rewindSpeed: 		'.$vgwc_rewind_speed.',				
				autoPlay: 			'.$vgwc_enable_autoplay.',
				stopOnHover: 		'.$vgwc_stop_hover.',				
				navigation: 		'.$vgwc_next_preview.',
				scrollPerPage: 		'.$vgwc_scroll_page.',
				pagination: 		'.$vgwc_pagination.',
				paginationNumbers: 	'.$vgwc_pagination_number.',
				mouseDrag: 			'.$vgwc_mouse_drag.',
				touchDrag: 			'.$vgwc_touch_drag.',
				navigationText: 	["'.esc_html__("Prev", "greek").'", "'.esc_html__("Next", "greek").'"],
				leftOffSet: 		'.$vgwc_left_offset.',
			});
		});
		</script>';
	}
	
	return $vgwc_css . $vgwc_html . $vgwc_script;
}