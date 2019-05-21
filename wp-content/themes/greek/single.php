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
		$blogclass = 'blog-fullwidth';
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
<div class="main-container page-category page-wrapper">
	<div class="container">
		<?php greek_breadcrumb(); ?>
		<div class="row">

			<?php if($blogsidebar=='left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<div class="col-xs-12 col-md-<?php echo (is_active_sidebar('sidebar-1')) ? $blogcolclass : 12 ; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($blogclass); if($blogsidebar=='left') {echo ' left-sidebar'; } if($blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('content', get_post_format()); ?>

						<?php comments_template('', true); ?>
						
						<nav class="nav-single">
							<span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'greek') . '</span> %title'); ?></span>
							<span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'greek') . '</span>'); ?></span>
						</nav>
						
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			
			<?php if($blogsidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php greek_get_footer(); ?>