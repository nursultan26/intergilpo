<?php
/**
 * Plugin Name: Simple Post Carousel
 * Plugin URI: http://plugins.svn.wordpress.org/simple-post-carousel/
 * Description: Simple responsive ajax post carousel shortcode plugin. This plugin will display number of specifed posts as an ajax based carousel from a specified category.
 * Version: 1.1.0
 * Author: Saikat Shankhari
 * Author URI: http://wpthemecluster.com
 * License: GPL2
 */

/**
 * Copyright 2014  Saikat Shankhari  (email : saikat.shankhari@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */



class Simple_Post_Carousel {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Custom scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

		/**
		 * Add shortcode
		 * @uses [simple_post_carousel cat=1 items=3]
		 */
		add_shortcode( 'simple_post_carousel', array( $this, 'shortcode' ) );

		// Ajax hooks
		add_action( 'wp_ajax_spc_load_posts', array( $this, 'ajax_load_posts' ) );
		add_action( 'wp_ajax_nopriv_spc_load_posts', array( $this, 'ajax_load_posts' ) );
	}


	/**
	 * Generate Carousel Mockup 
	 * @param  WP_Query $query 
	 */
	private function generate_carosel_html( $query ) {
		?>
		<div class="spc-container">
			<?php if( $query->max_num_pages > 1 ) :	?>
				<div class="spc-nav">
					<span data-items="<?php echo $query->query_vars['posts_per_page']; ?>"></span>
					<span data-cat="<?php echo $query->query_vars['cat']; ?>"></span>
					<span data-maxpages="<?php echo $query->max_num_pages; ?>"></span>
					<span class="spc-loading"></span>
					<a href="#" class="spc-prev" data-dir="prev">Previous</a>
					<a href="#" class="spc-next" data-dir="next">Next</a>
				</div>
			<?php endif; ?>
			<ul class="spc-list">
				<?php $this->generate_list_html( $query ); ?>				
			</ul>			
		</div>
		<?php
	}

	/**
	 * Generate post list for carousel
	 * @param  WP_Query $query
	 */
	private function generate_list_html( WP_Query $query ) { 
		global $post; 
		if( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post(); ?>
				<li>
					<div class="spc-post">
						<div class="image-block">
							<a href="<?php the_permalink(); ?>">
							<?php 
								if( has_post_thumbnail( $post->ID ) ) {
									echo get_the_post_thumbnail( $post->ID, 'large' );
								}
							?>
							</a>
						</div>
						<div class="text-block">
							<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="introtext"><?php echo substr( get_the_excerpt(), 0, 100 ); ?></div>
							<div class="info">
								<div class="blog-author">
									By <?php echo get_the_author(); ?>
								</div>
								<div class="diver"> - </div>
								<div class="blog-time">
									<span class="blog-date"><?php echo get_the_date('d'); ?></span>				
									<span class="blog-month"><?php echo get_the_date('M'); ?></span>
									<span class="blog-year"><?php echo get_the_date('Y'); ?></span>
								</div>
							</div>
							<a class="morebutton" href="<?php the_permalink(); ?>">Read more</a>
						</div>
					</div>
				</li>					
		<?php
			}
			wp_reset_postdata();
		}			
	}
	
	/**
	 * Load front-end scripts
	 */
	public function load_scripts() {
		wp_register_style( 
			'spc_style',
			plugins_url( 'css/spc.css', __FILE__ )
		);

		wp_register_script(
			'spc_js',
			plugins_url( 'js/spc.js', __FILE__ ),
			array( 'jquery' ),
			false,
			true
		);

		wp_localize_script( 'spc_js', 'spcwp', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_style( 'spc_style' );
		wp_enqueue_script( 'spc_js' );
	}
	
	/**
	 * Post Carousel Shortcode
	 * @return string HTML
	 */
	public function shortcode( $atts ) {
		$atts = shortcode_atts(
			array( 
				'cat' 	=> 1,
				'items' => 3,
			),
			$atts
		);

		$query = new WP_Query(array(
			'post_type' 		=> 'post',
			'posts_per_page' 	=> $atts['items'],
			'cat'				=> $atts['cat'],
		));

		ob_start();
		$this->generate_carosel_html( $query );		
		$content = ob_get_contents();
		ob_clean();

		return $content;
	}
	
	/**
	 * Ajax post loading based on navigation clicked.
	 */
	public function ajax_load_posts() {
		if( isset( $_POST['action'] ) && $_POST['action'] == 'spc_load_posts' ) {
			$query = new WP_Query(array(
				'post_type' 		=> 'post',
				'posts_per_page'	=> $_POST['items'],
				'cat'				=> $_POST['cat'],
				'paged'				=> $_POST['paged'],
			));
			$this->generate_list_html( $query );
			die();
		}
	}

}

new Simple_Post_Carousel();