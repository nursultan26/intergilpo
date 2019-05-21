<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $greek_showcountdown, $greek_productrows, $greek_productsfound, $greek_options;

//product columns
if(isset($greek_options['product_columns'])){
	$greek_columns = esc_html($greek_options['product_columns']);
} else {
	$greek_columns = 3;
}

//hide countdown on category page, show on all others
if(!isset($greek_showcountdown)) {
	$greek_showcountdown = true;
}

// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if (empty($woocommerce_loop['columns']))
	$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', $greek_columns);

// Ensure visibility
if (! $product || ! $product->is_visible())
	return;

// Extra post classes
$classes = array();

// Extra post classes
if (0 == ($woocommerce_loop['loop']) % $woocommerce_loop['columns'] || 0 == $woocommerce_loop['columns']) {
 $classes[] = 'first';
}
if (0 == ($woocommerce_loop['loop'] + 1) % $woocommerce_loop['columns']) {
 $classes[] = 'last';
}

$count   = $product->get_rating_count();

if($woocommerce_loop['columns']==3 || $woocommerce_loop['columns']==4) {
	$colwidth = 12/$woocommerce_loop['columns'];
} else {
	$colwidth = 4;
}

$classes[] = ' item-col col-xs-6 col-sm-'.$colwidth ;?>

<?php if ((0 == ($woocommerce_loop['loop'] - 1) % 2) && ($woocommerce_loop['columns'] == 2)) {
	if($greek_productrows!=1){
		echo '<div class="group">';
	}
} ?>

<div <?php post_class($classes); ?>>
	<div class="product-wrapper">
		<?php do_action('woocommerce_before_shop_loop_item'); ?>
		<?php if ($product->is_on_sale()) : ?>
			<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale"><span class="sale-bg"></span><span class="sale-text">' . esc_html__('Sale', 'greek') . '</span></span>', $post, $product); ?>
		<?php endif; ?>
		<?php if ($product->is_featured()) : ?>
			<?php echo apply_filters('woocommerce_featured_flash', '<span class="lbfeatured"><span class="hot-bg"></span><span class="hot-text">' . esc_html__('Hot', 'greek') . '</span></span>', $post, $product); ?>
		<?php endif; ?>
		<div class="list-col4">
			<div class="product-image">
				<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
					<?php 
					echo $product->get_image('shop_catalog', array('class'=>'primary_image'));
					/* 
					$attachment_ids = $product->get_gallery_image_ids();
					if ($attachment_ids) {
						echo wp_get_attachment_image($attachment_ids[0], apply_filters('single_product_small_thumbnail_size', 'shop_catalog'), false, array('class'=>'secondary_image'));
					} */
					?>
					<span class="shadow"></span>
				</a>
				<?php if(($greek_options['quick_view']) == true) { ?>
				<div class="quick-wrapper">
					<a class="quickview quick-view" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Быстрый просмотр', 'greek');?></a>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="list-col8">
			<div class="gridview">
				<h2 class="product-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="ratings"><?php echo $product->get_rating_html(); ?> <?php echo $product->get_review_count(). esc_html__(" review(s)", "greek"); ?></div>
				<div class="price-box"><?php echo $product->get_price_html(); ?></div>
				<div class="actions">
					<div class="action-buttons">
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
						</div>
						<div class="add-to-links">
							<?php if (class_exists('YITH_WCWL')) {
								echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
							} ?>
							<?php if(class_exists('YITH_Woocompare')) {
								echo do_shortcode('[yith_compare_button]');
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="listview">
				<h2 class="product-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="ratings"><?php echo $product->get_rating_html(); ?> <?php echo $product->get_review_count(). esc_html__(" review(s)", "greek"); ?></div>
				<div class="price-box"><?php echo $product->get_price_html(); ?></div>
				<div class="product-desc"><?php the_excerpt(); ?></div>
				<div class="actions">
					<div class="action-buttons">
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
						</div>
						<div class="add-to-links">
							<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
							<?php echo do_shortcode('[yith_compare_button]') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php //do_action('woocommerce_after_shop_loop_item'); ?>
	</div>
</div>
<?php if (((0 == $woocommerce_loop['loop'] % 2 || $greek_productsfound == $woocommerce_loop['loop']) && $woocommerce_loop['columns'] == 2)) { /* for odd case: $greek_productsfound == $woocommerce_loop['loop'] */
	if($greek_productrows!=1){
		echo '</div>';
	}
} ?>