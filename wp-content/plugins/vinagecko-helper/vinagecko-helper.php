<?php
/**
 * Plugin Name: VinaGecko Helper
 * Plugin URI: http://vinagecko.com/
 * Description: The helper plugin for VinaGecko themes.
 * Version: 1.0.0
 * Author: VinaGecko
 * Author URI: http://vinagecko.com/
 * Text Domain: vinagecko
 * License: GPL/GNU.
 /*  Copyright 2014  VinaGecko  (email : support@vinagecko.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// Add shortcodes
function vinagecko_brands_shortcode( $atts ) {
	global $greek_options;
	$brand_index = 0;
	$brandfound=count($greek_options['brand_logos']);

	$atts = shortcode_atts( array('rowsnumber' => '1'), $atts, 'ourbrands' );

	$rowsnumber = $atts['rowsnumber'];

	$html = '';
	
	if($greek_options['brand_logos']) {
		$html .= '<div class="brands-carousel rows-'.$rowsnumber.'">';
			foreach($greek_options['brand_logos'] as $brand) {
				$brand_index ++;
				
				switch ($rowsnumber) {
					case "one":
						$html .= '<div class="group">';
						break;
					case "two":
						if ( (0 == ( $brand_index - 1 ) % 2 ) || $brand_index == 1) {
							$html .= '<div class="group">';
						}
						break;
					case "four":
						if ( (0 == ( $brand_index - 1 ) % 4 ) || $brand_index == 1) {
							$html .= '<div class="group">';
						}
						break;
				}
				
				$html .= '<div class="brands-inner">';
				$html .= '<a href="'.$brand['url'].'" title="'.$brand['title'].'">';
					$html .= '<img src="'.$brand['image'].'" alt="'.$brand['title'].'" />';
				$html .= '</a>';
				$html .= '</div>';
				
				switch ($rowsnumber) {
					case "one":
						$html .= '</div>';
						break;
					case "two":
						if ( ( ( 0 == $brand_index % 2 || $brandfound == $brand_index ))  ) { /* for odd case: $greek_productsfound == $woocommerce_loop['loop'] */
							$html .= '</div>';
						}
						break;
					case "four":
						if ( ( ( 0 == $brand_index % 4 || $brandfound == $brand_index ))  ) { /* for odd case: $greek_productsfound == $woocommerce_loop['loop'] */
							$html .= '</div>';
						}
						break;
				}

			}
		$html .= '</div>';
	}
	
	return $html;
}
add_shortcode( 'ourbrands', 'vinagecko_brands_shortcode' );

function vinagecko_icon_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'icon' => ''
	), $atts, 'greek_icon' );
	
	$html = '<i class="fa '.$atts['icon'].'"></i>';
	
	
	return $html;
}
add_shortcode( 'vinageckoicon', 'vinagecko_icon_shortcode' );

//Add less compiler
function compileLessFile($input, $output, $params) {
    // include lessc.inc
    require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
	
	$less = new lessc;
	$less->setVariables($params);
	
    // input and output location
    $inputFile = get_template_directory().'/less/'.$input;
    $outputFile = get_template_directory().'/css/'.$output;

    $less->compileFile($inputFile, $outputFile);
}

function vinagecko_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>') {
 
	if(is_int($post)) {
		// get the post object of the passed ID
		$post = get_post($post);
	} elseif(!is_object($post)) {
		return false;
	}
 
	if(has_excerpt($post->ID)) {
		$the_excerpt = $post->post_excerpt;
		return apply_filters('the_content', $the_excerpt);
	} else {
		$the_excerpt = $post->post_content;
	}
 
	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
	$excerpt_waste = array_pop($the_excerpt);
	$the_excerpt = implode($the_excerpt);
 
	return apply_filters('the_content', $the_excerpt);
}

function vinagecko_blog_sharing() {
	global $post, $greek_options;
	
	$share_url = get_permalink( $post->ID );
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	$postimg = $large_image_url[0];
	$posttitle = get_the_title( $post->ID );
	?>
	<div class="widget widget_socialsharing_widget">
		<h3 class="widget-title"><?php if(isset($greek_options['blog_share_title'])) { echo esc_html($greek_options['blog_share_title']); } else { _e('Share this post', 'greek'); } ?></h3>
		<ul class="social-icons">
			<li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		</ul>
	</div>
	<?php
}

function vinagecko_product_sharing() {

	if(isset($_POST['data'])) { // for the quickview
		$postid = intval( $_POST['data'] );
	} else {
		$postid = get_the_ID();
	}
	
	$share_url = get_permalink( $postid );

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
	$postimg = $large_image_url[0];
	$posttitle = get_the_title( $postid );
	?>
	<div class="widget widget_socialsharing_widget">
		<h3 class="widget-title"><?php if(isset($greek_options['product_share_title'])) { echo esc_html($greek_options['product_share_title']); } else { _e('Share this product', 'greek'); } ?></h3>
		<ul class="social-icons">
			<li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
		</ul>
	</div>
	<?php
}