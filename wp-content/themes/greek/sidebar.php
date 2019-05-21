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

<?php if (is_active_sidebar('sidebar-1')) : ?>
	<div id="secondary" class="col-xs-12 col-md-3 sidebar-blog">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div><!-- #secondary -->
<?php endif; ?>