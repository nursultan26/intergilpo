<?php
/**
 * Template Name: Full Width
 *
* Description: Full Width template
 *
 * @package    Greek
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright (C) 2015 VinaGecko.com. All Rights Reserved.
 */
global $greek_options;

greek_get_header();
?>
<div class="main-container full-width">

	<div class="page-content">

		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('content', 'page'); ?>
		<?php endwhile; // end of the loop. ?>

	</div>
</div>
<?php greek_get_footer(); ?>