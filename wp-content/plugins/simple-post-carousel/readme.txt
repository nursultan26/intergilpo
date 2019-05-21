=== Plugin Name ===
Contributors: Saikat Shankhari
Tags: post carouse, simple post carousel, ajax post carousel
Requires at least: 3.0.1
Tested up to: 4.0.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Ajax based simple post carousel shortcode plugin.

== Description ==

This plugin allows you to use the shortcode `[simple_post_carousel]` that outputs list of posts as a carousel. You can show posts from any category that you specify in the shortcode attribute.

Instead of loading all posts at a time, this plugin comes with an ajax based previous/next navigation that pulls posts via ajax call.

Currently the plugin comes with very simplicity as it's name described. Currently it has only two attributes for customization.

* cat: Category ID from where you want to pull posts for the carousel.
* items: Number of items in the carouse. 

You can use the shortcode in this way: `[simple_post_carousel cat="x" items="y"]`

== Installation ==

1. Upload `simple-post-carousel` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add [simple_post_carousel] shortcode to the page/post you want to show the carousel.

== Frequently Asked Questions ==

= How to use this shortcode in template =
`<?php 
	if( class_exists( 'Simple_Post_Carousel' ) ) {
		echo do_shortcode( '[simple_post_carousel cat="x" items="y"]' );
	}
?>`


== Changelog ==

= 1.0 =
* Released first version.

= 1.1 =
* Minor css issue fix.
