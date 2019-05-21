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
 
if (post_password_required())
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if (have_comments()) : ?>
		<h3 class="comments-title">
			<?php
				printf(_n('1 comment', '%1$s comments', get_comments_number(), 'greek'),
					number_format_i18n(get_comments_number()));
			?>
		</h3>

		<ol class="commentlist">
			<?php wp_list_comments(array('callback' => 'greek_comment', 'style' => 'ol')); ?>
		</ol><!-- .commentlist -->

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
		<div class="pagination">
			<?php paginate_comments_links(); ?>
		</div>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if (! comments_open() && get_comments_number()) : ?>
		<p class="nocomments"><?php esc_html_e('Comments are closed.' , 'greek'); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->