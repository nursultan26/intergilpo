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
 
get_header('error');
?>
	<div class="page-404">
		<div class="search-form">
			<h3><?php esc_html_e('PAGE NOT FOUND', 'greek'); ?></h3>
			<label><?php esc_html_e('Search our website', 'greek');?></label>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>
<?php get_footer('error'); ?>