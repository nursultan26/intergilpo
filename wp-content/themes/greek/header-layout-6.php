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
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>

<?php global $woocommerce, $greek_options; ?>

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if(! function_exists('has_site_icon') || ! has_site_icon()) {  ?>
<?php if(isset($greek_options['opt-favicon']['url'])) :?>
<link rel="icon" type="image/png" href="<?php echo esc_url($greek_options['opt-favicon']['url']);?>">
<?php endif; ?>
<?php } ?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php if($greek_options['share_head_code']!='') {
	echo wp_kses($greek_options['share_head_code'], array(
		'script' => array(
			'type' 	=> array(),
			'src' 	=> array(),
			'async' => array()
		),
	));
} ?>
<?php 
	// HieuJa get Preset Color Option
	$presetopt = greek_get_preset();
	// HieuJa end block
?>
<?php wp_head(); ?>
</head>

<!-- Body Start Block -->
<body <?php body_class(); ?>>

<!-- Page Loader Block -->
<?php if($greek_options['greek_loading']) : ?>
<div id="pageloader">
	<div id="loader"></div>
	<div class="loader-section left"></div>
	<div class="loader-section right"></div>
</div>
<?php endif; ?>

<div id="yith-wcwl-popup-message" style="display:none;"><div id="yith-wcwl-message"></div></div>
<div class="wrapper box-layout <?php if($greek_options['page_style']=='box'){echo 'box-layout';}?>">

	<!-- Top Header -->
	<div class="top-wrapper">
		<div class="header-container <?php echo esc_attr($greek_options['topbar_style']); ?>">
			<div class="top-bar <?php if(is_admin_bar_showing()) { echo 'logedin'; } ?>">
				<div class="container">
					<div id="top">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="top-info">
									<?php
										if(is_user_logged_in()) {
											echo sprintf(esc_html__('Welcome back, %s', 'greek'), wp_get_current_user()->display_name);
										} else {
											esc_html_e('Default welcome message!', 'greek');
										}
									?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="topbar-menu">
									<?php wp_nav_menu(array('theme_location' => 'top-menu', 'container_class' => 'top-menu-container', 'menu_class' => 'nav-menu')); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="header">
				<div class="container">
					<div class="row">
						<?php if (class_exists('Custom_Ajax_search_widget')) { ?>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="top-search">
								  <?php ajax_autosuggest_form(); ?>
							</div>		
						</div>		
						<?php } ?>
						
						<div class="col-lg-4 col-md-4 col-sm-4 sp-logo">
						<?php if(!empty($greek_options['logo_main']['url'])){ ?>
							<div class="logo">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
									<img src="<?php echo esc_url($greek_options['logo_main']['url']); ?>" alt="" />
								</a>
							</div>
						<?php } elseif(!empty($greek_options['logo_text'])) {?>
							<h1 class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php echo esc_html($greek_options['logo_text']); ?></a></h1>
						<?php } else { ?>
							<div class="logo">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/images/presets/preset'. $presetopt .'/logo.png' ); ?>" alt="" />
								</a>
							</div>
						<?php } ?>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<?php if(class_exists('WC_Widget_Cart')) { ?>
							<div class="top-cart">
								<?php the_widget('Custom_WC_Widget_Cart', array('title' => $greek_options['mini_cart_title'])); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Menu -->
	<div class="sp-menu">
		<div class="container">
			<div class="menu-wrapper">
				<div id="header-menu" class="header-menu visible-large">
					<?php echo wp_nav_menu(array("theme_location" => "primary")); ?>
				</div>
				<div class="visible-small">
					<div class="mbmenu-toggler"><span><?php echo esc_html($greek_options['title_mobile_menu']); ?></span><span class="mbmenu-icon"></span></div>
					<div class="nav-container">
						<?php wp_nav_menu(array('theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>