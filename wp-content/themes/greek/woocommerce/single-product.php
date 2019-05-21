<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

greek_get_header(); ?>
<?php global $greek_options; ?>
<div class="main-container page-shop">
	<div class="page-content">
		<div class="container">
			<?php do_action('woocommerce_before_main_content'); ?>
			<div class="row">
				<?php if($greek_options['sidebar_product']=='left' || !isset($greek_options['sidebar_product'])) :?>
					<?php get_sidebar('product'); ?>
				<?php endif; ?>
				<div id="product-content" class="col-xs-12 <?php if (is_active_sidebar('sidebar-product')) : ?>col-md-9<?php endif; ?>">
					<div class="product-view">
						<?php while (have_posts()) : the_post(); ?>

							<?php wc_get_template_part('content', 'single-product'); ?>

						<?php endwhile; // end of the loop. ?>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action('woocommerce_after_main_content');
						?>

						<?php
							/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							//do_action('woocommerce_sidebar');
						?>
					</div>
				</div>
				<?php if($greek_options['sidebar_product']=='right' || !isset($greek_options['sidebar_product'])) :?>
					<?php get_sidebar('product'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php greek_get_footer(); ?>