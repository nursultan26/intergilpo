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
<?php global $greek_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if (! post_password_required() && ! is_attachment()) : ?>
	<div class="post-thumbnail">
		<?php 
		if (is_single()) {
			the_post_thumbnail();
		} else { 
			if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('greek-category-thumb'); ?></a>
		<?php }
		}
		?>
	</div>
	<?php endif; ?>
	<div class="postinfo-wrapper">
		<div class="post-date">
			<?php echo '<span class="day">'.get_the_date('d', $post->ID).'</span><span class="month">'.get_the_date('M', $post->ID).' '.get_the_date('Y', $post->ID).'</span>' ;?>
			<?php if (is_single()) : ?>
				<?php if(function_exists('vinagecko_blog_sharing')) { ?>
					<div class="social-sharing"><?php vinagecko_blog_sharing(); ?></div>
				<?php } ?>
			<?php endif; ?>
		</div>
		
		<div class="post-info">
			<header class="entry-header">
				<?php if (is_single()) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
				<?php endif; ?>
			</header>
			
			<?php if (is_single()) : ?>
				<div class="entry-meta">
					<?php greek_entry_meta(); ?>
				</div>
			<?php endif; ?>
			
			<?php if (is_single()) : ?>
				<div class="entry-content">
					<?php the_content(wp_kses(__('Continue reading <span class="meta-nav">&rarr;</span>', 'greek'), array('span' => array()))); ?>
					<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'greek'), 'after' => '</div>', 'pagelink' => '<span>%</span>')); ?>
				</div>
			<?php else : ?>
				<div class="entry-summary">
					<?php the_content(wp_kses(__('Continue reading <span class="meta-nav">&rarr;</span>', 'greek'), array('span' => array()))); ?>
				</div>
			<?php endif; ?>
			
			<?php if (!is_single()) : ?>
				<footer class="entry-meta-small">
					<?php if (is_sticky() && is_home() && ! is_paged()) : ?>
						<?php greek_entry_meta(); ?>
					<?php else : ?>
						<?php greek_entry_meta_small(); ?>
					<?php endif; ?>
				</footer>
			<?php endif; ?>
			
			<?php if (is_single()) : ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						$author_bio_avatar_size = apply_filters('greek_author_bio_avatar_size', 68);
						echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
						?>
					</div>
					<div class="author-description">
						<h2><?php printf(wp_kses(__('About the Author: <a href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'" rel="author">%s</a>', 'greek'), array('a' => array('href' => array(),'title' => array()))), get_the_author()); ?></h2>
						<p><?php the_author_meta('description'); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</article>