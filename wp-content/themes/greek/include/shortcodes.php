<?php
//Shortcodes for Visual Composer

add_action('vc_before_init', 'greek_vc_shortcodes');
function greek_vc_shortcodes() {
	//Brand logos
	vc_map(array(
		"name" => esc_html__("Brand Logos", "greek"),
		"base" => "ourbrands",
		"class" => "",
		"category" => esc_html__("greek", "greek"),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Number of rows", "greek"),
				"param_name" => "rowsnumber",
				"value" => array(
						'one'	=> 'one',
						'two'	=> 'two',
						'four'	=> 'four',
					),
			),
		)
	));
	
	//Icons
	vc_map(array(
		"name" => esc_html__("FontAwesome Icon", "greek"),
		"base" => "vinageckoicon",
		"class" => "",
		"category" => esc_html__("greek", "greek"),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "",
				"class" => "",
				"heading" => esc_html__("FontAwesome Icon", "greek"),
				"description" => wp_kses(__("<a href=\"http://fortawesome.github.io/Font-Awesome/cheatsheet/\" target=\"_blank\">Go here</a> to get icon class. Example: fa-search", "greek"), array('a' => array('href' => array(),'title' => array(), 'target' => array()))),
				"param_name" => "icon",
				"value" => esc_html__("fa-search", "greek"),
			),
		)
	));
}
?>