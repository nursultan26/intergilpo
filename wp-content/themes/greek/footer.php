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

			<!-- Bottom -->
			<?php if (is_active_sidebar('bottom-1') || is_active_sidebar('bottom-2') || is_active_sidebar('bottom-3') || is_active_sidebar('bottom-4')) : ?>
			<div class="vina-bottom">
				<div class="container">
					<div class="row">
						<?php if (is_active_sidebar('bottom-1')) : ?>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<?php 
								dynamic_sidebar('bottom-1');
							?>
						</div>
						<?php endif; ?>
						<?php if (is_active_sidebar('bottom-2')) : ?>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<?php 
								dynamic_sidebar('bottom-2');
							?>
						</div>
						<?php endif; ?>
						<?php if (is_active_sidebar('bottom-3')) : ?>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<?php 
								dynamic_sidebar('bottom-3');
							?>
						</div>
						<?php endif; ?>
						<?php if (is_active_sidebar('bottom-4')) : ?>
						<div class="col-lg-3 col-md-3 col-sm-3">
							<?php 
								dynamic_sidebar('bottom-4');
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Social -->
			<?php if(isset($greek_options['ftsocial_icons']) || isset($greek_options['menu-link'])) { ?>
			<div class="bottom-link">
				<div class="container">
					<div class="row">
						<?php
							if(isset($greek_options['ftsocial_icons'])) { ?>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<?php
							if(isset($greek_options['ftsocial_icons'])) {
								echo '<ul class="social-icons">';
								foreach($greek_options['ftsocial_icons'] as $key=>$value) {
									if($value!=''){
										if($key=='vimeo'){
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
										} else {
											echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
										}
									}
								}
								echo '</ul>';
							}
							?>
						</div>
						<?php } ?>
						<?php if ((isset($greek_options['menu-link'])) && ($greek_options['menu-link']!='')){ ?>
						<div class="col-lg-8 col-md-8 col-sm-8 menu-link">
							<?php 
								$menu3_object = wp_get_nav_menu_object($greek_options['menu-link']);
								$menu3_args = array(
								'menu_class'      => 'nav_menu',
								'menu'         => $greek_options['menu-link'],
							); ?>
							<div class="menu-bottom">
								<?php wp_nav_menu($menu3_args); ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<!-- Footer -->
			<div class="footer">
				<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5')) : ?>
				<div class="top-footer">
					<div class="container">
						<div class="row">
							<?php if (is_active_sidebar('footer-1')) : ?>
							<div class="col-lg-4 col-md-4 col-sm-4 footer-block1">
								<?php dynamic_sidebar('footer-1'); ?>
							</div>
							<?php endif; ?>
							<?php if (is_active_sidebar('footer-2')) : ?>
							<div class="col-lg-2 col-md-2 col-sm-2 footer-block2">
								<?php dynamic_sidebar('footer-2'); ?>
							</div>
							<?php endif; ?>
							<?php if (is_active_sidebar('footer-3')) : ?>
							<div class="col-lg-2 col-md-2 col-sm-2 footer-block3">
								<?php dynamic_sidebar('footer-3'); ?>
							</div>
							<?php endif; ?>
							<?php if (is_active_sidebar('footer-4')) : ?>
							<div class="col-lg-2 col-md-2 col-sm-2 footer-block4">
								<?php dynamic_sidebar('footer-4'); ?>
							</div>
							<?php endif; ?>
							<?php if (is_active_sidebar('footer-5')) : ?>
							<div class="col-lg-2 col-md-2 col-sm-2 footer-block5">
								<?php dynamic_sidebar('footer-5'); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="bottom-footer">
					<div class="container">
						<div class="row">
							<?php if($greek_options['copyright_show']) { ?>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="copyright">
									<?php esc_html_e('Copyright ©  2015', 'greek'); ?> <a href="<?php echo esc_html($greek_options['copyright-link']); ?>"><?php echo esc_html_e($greek_options['copyright-author']); ?></a><?php esc_html_e('. All Rights Reserved.', 'greek'); ?>
								</div>
							</div>
							<?php } ?>
							<?php if(!empty($greek_options['footer_payment']['url'])){ ?>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<img class="payment" src="<?php echo esc_url($greek_options['footer_payment']['url']); ?>" alt="" />
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .page -->
	</div><!-- .wrapper -->
	<div class="to-top"><i class="fa fa-chevron-up"></i></div>
	<?php if($greek_options['newsletter_show']) { ?>
	<?php
	if (isset($greek_options['newsletter_form']) && $greek_options['newsletter_form']!="") {
		if(class_exists('WYSIJA_NL_Widget')){ ?>
			<div class="popupshadow"></div>
			<div id="newsletterpopup" class="vinagecko-modal newsletterpopup">
				<span class="close-popup"></span>
				<div class="nl-bg">
					<?php
					the_widget('WYSIJA_NL_Widget', array(
						'title' => esc_html($greek_options['newsletter_title']),
						'form' => (int)$greek_options['newsletter_form'],
						'id_form' => 'newsletter1_popup',
						'success' => '',
					));
					?>
				</div>
			</div>
		<?php }
	}
	?>
	<?php } ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_footer(); ?>
</body>
</html>