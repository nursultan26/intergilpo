<?php
/**
 * Template Name: Home Shop 1 Template
 *
 * Description: Home Shop 1 template
 *
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
<div class="main-container front-page">
	<div class="page-content">
		<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</div>
<?php greek_get_footer(); ?>