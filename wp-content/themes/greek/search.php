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

global $greek_options;

greek_get_header();
?>
<?php 
$bloglayout = 'blog-sidebar';
if(isset($greek_options['layout']) && $greek_options['layout']!=''){
	$bloglayout = $greek_options['layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$bloglayout = $_GET['layout'];
}
$blogsidebar = 'right';
if(isset($greek_options['sidebarblog_pos']) && $greek_options['sidebarblog_pos']!=''){
	$blogsidebar = $greek_options['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$blogsidebar = $_GET['sidebar'];
}
switch($bloglayout) {
	case 'nosidebar':
		$blogclass = 'blog-nosidebar';
		$blogcolclass = 12;
		$blogsidebar = 'none';
		break;
	case 'fullwidth':
		$blogclass = 'blog-fullwidth';
		$blogcolclass = 12;
		$blogsidebar = 'none';
		break;
	default:
		$blogclass = 'blog-sidebar';
		$blogcolclass = 9;
}
?>
<div class="main-container page-wrapper">
	<div class="blog_header"><?php esc_html_e('Blog', 'greek'); ?></div>
	
	<div class="container">
		<?php greek_breadcrumb(); ?>
		
		<div class="row">
			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-xs-12 <?php echo 'col-md-'.$blogcolclass; ?>">
			
				<div class="page-content blog-page <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php if (have_posts()) : ?>
						
						<header class="archive-header">
							<h1 class="archive-title"><?php printf(esc_html__('Search Results for: %s', 'greek'), '<span>' . get_search_query() . '</span>'); ?></h1>
						</header><!-- .archive-header -->

						<?php /* Start the Loop */ ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('content', get_post_format()); ?>
						<?php endwhile; ?>

						<div class="pagination">
							<?php greek_pagination(); ?>
						</div>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'greek'); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'greek'); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

					<?php endif; ?>
				</div>
			</div>
			
			<?php if($blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
		
	</div>
</div>
<?php greek_get_footer(); ?>