<?php
/**
 * Template Name: Shop Template
 *
 * Description: Shop Template
 *
* @package    VG Greek
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
if (! defined('ABSPATH')) exit; // Exit if accessed directly

greek_get_header(); ?>
<?php
global $greek_options, $greek_showcountdown, $greek_productrows;

$greek_showcountdown = false;
$greek_productrows = 1;
?>
<div class="main-container page-shop">
	<div class="page-content">
		<div class="container">
			<?php if($greek_options['opening_img'] != '') { ?>
				<div class="greek-banner banner-category"><a href="<?php echo esc_html($greek_options['cat_banner_link']); ?>"><img src="<?php echo esc_url($greek_options['cat_banner_img']['url']); ?>" alt=""></a></div>
			<?php } ?>
			<div class="row">
			
				<?php if($greek_options['sidebar_pos']=='left' || !isset($greek_options['sidebar_pos'])) :?>
					<?php get_sidebar('category'); ?>
				<?php endif; ?>
				<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-category')) : ?>col-md-9<?php endif; ?>">
					<?php greek_breadcrumb(); ?>
					<div class="default-shop">
						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('content', 'page'); ?>
						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
				<?php if($greek_options['sidebar_pos']=='right') :?>
					<?php get_sidebar('category'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php greek_get_footer(); ?>