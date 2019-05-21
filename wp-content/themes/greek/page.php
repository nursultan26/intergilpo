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
<div class="main-container default-page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php greek_breadcrumb(); ?>
			</div>
			<?php if($greek_options['sidebarse_pos']=='left'  || !isset($greek_options['sidebarse_pos'])) :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
			<div class="col-xs-12 <?php if (is_active_sidebar('sidebar-page')) : ?>col-md-9<?php endif; ?>">
				<div class="page-content default-page">
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('content', 'page'); ?>
						<?php comments_template('', true); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php if($greek_options['sidebarse_pos']=='right') :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php greek_get_footer(); ?>