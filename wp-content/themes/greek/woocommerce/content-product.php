<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

global $greek_options;

$webLayout = greek_get_layout();

switch($webLayout)
{
	case "layout-1":
		require(get_template_directory() . "/woocommerce/content-product-layout-1.php");
	break;
	case "layout-2":
		require(get_template_directory() . "/woocommerce/content-product-layout-2.php");
	break;
	case "layout-3":
		require(get_template_directory() . "/woocommerce/content-product-layout-3.php");
	break;
	case "layout-4":
		require(get_template_directory() . "/woocommerce/content-product-layout-4.php");
	break;
	case "layout-5":
		require(get_template_directory() . "/woocommerce/content-product-layout-5.php");
	break;
	case "layout-6":
		require(get_template_directory() . "/woocommerce/content-product-layout-6.php");
	break;
	default:
		require(get_template_directory() . "/woocommerce/content-product-layout-1.php");
	break;
}