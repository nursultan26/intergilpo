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
<div class="main-container page-category">
	<div class="container">
		<?php greek_breadcrumb(); ?>
		
		<div class="row">
			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-1')) : ?><?php echo 'col-md-'.$blogcolclass; ?><?php endif; ?>">
			
				<div class="page-content blog-page <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
				
					<?php if (have_posts()) : ?>
						<header class="archive-header">
							<h1 class="archive-title"><?php printf(esc_html__('Category Archives: %s', 'greek'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>

						<?php if (category_description()) : // Show an optional category description ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
						</header><!-- .archive-header -->

						<?php
						/* Start the Loop */
						while (have_posts()) : the_post();

							/* Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part('content', get_post_format());

						endwhile;
						?>
						
						<div class="pagination">
							<?php greek_pagination(); ?>
						</div>
						
					<?php else : ?>
						<?php get_template_part('content', 'none'); ?>
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