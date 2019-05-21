<?php
/**
 * @version    1.6
 * @package    VG Greek
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<?php if (! is_page_template('page-templates/front-page.php')) : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'greek'), 'after' => '</div>', 'pagelink' => '<span>%</span>')); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link(esc_html__('Edit', 'greek'), '<span class="edit-link">', '</span>'); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->