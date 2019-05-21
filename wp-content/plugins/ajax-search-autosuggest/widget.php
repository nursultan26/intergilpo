<?php
if (!defined('ABSPATH')) exit('No direct script access allowed');

 /**
 * CodeNegar wordPress AJAX AutoSuggest widget
 *
 * Adds widget to used in sidebar
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author      Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
 
class Ajax_search_widget extends WP_Widget{
	function __construct(){
		global $codenegar_aas;
		parent::__construct(
			'codenegar_ajax_search',
			__('Ajax AutoSuggest', $codenegar_aas->text_domain),
			array('description' => __('Ajax AutoSuggest Form', $codenegar_aas->text_domain))
		);
	}

	public function form($instance){ // Backend widget form, instance is user posted data
		global $codenegar_aas;
		$defaults = array(
			'title'		  => __('Search', $codenegar_aas->text_domain),
			'placeholder' => __('Type Keyword...', $codenegar_aas->text_domain),
			'max_width' => __('350', $codenegar_aas->text_domain)
		);
		$instance = codenegar_parse_args($instance, $defaults);
		extract($instance); // Extract array to multiple variables
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>" ><?php _e('Title', $codenegar_aas->text_domain); ?>:</label>
			<input class="widefat"
				id = "<?php echo $this->get_field_id('title'); ?>"
				name = "<?php echo $this->get_field_name('title'); ?>"
				value = "<?php if(isset($title)) echo $title; ?>" 
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('placeholder'); ?>" ><?php _e('Placeholder', $codenegar_aas->text_domain); ?>:</label>
			<input class="widefat"
				id = "<?php echo $this->get_field_id('placeholder'); ?>"
				name = "<?php echo $this->get_field_name('placeholder'); ?>"
				value = "<?php if(isset($placeholder)) echo $placeholder; ?>" 
			/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('max_width'); ?>" ><?php _e('Max width(px)', $codenegar_aas->text_domain); ?>:</label>
			<input class="widefat"
				id = "<?php echo $this->get_field_id('max_width'); ?>"
				name = "<?php echo $this->get_field_name('max_width'); ?>"
				value = "<?php if(isset($max_width)) echo $max_width; ?>" 
			/>
		</p>
		<?php 
	}

	public function widget($args, $instance){ // Frontend widget form
		global $codenegar_aas;
		$defaults = array(
			'title'		  => __('Search', $codenegar_aas->text_domain),
			'placeholder' => __('Type Keyword...', $codenegar_aas->text_domain),
			'max_width' => '350'
		);
		$instance = codenegar_parse_args($instance, $defaults);
	
		extract($instance);
		extract($args);
		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;
		$value = '';
		if(get_search_query()){
			$value = get_search_query();
		}
	?>
	
			<div class="codenegar_ajax_search_wrapper">
				<form id="codenegar_ajax_search_form" data-full_search_url="<?php echo $codenegar_aas->options->full_search_url; ?>" action="<?php echo esc_url(home_url('/')); ?>" method="get">
					<div class="ajax_autosuggest_form_wrapper" style="max-width: <?php echo $max_width; ?>px;">
						<label class="ajax_autosuggest_form_label"><?php echo $title; ?></label>
						<input name="s" class="ajax_autosuggest_input" type="text"  value="<?php echo $value; ?>" style="width: 95%;" placeholder="<?php echo $placeholder; ?>" autocomplete="off" />
						<button style="display: none;" class="ajax_autosuggest_submit"></button>
					</div>
				</form>
			</div>
			
			<?php
		echo $after_widget;
	}
}

function ajax_search_widget_register(){
	register_widget('Ajax_search_widget');
}

add_action('widgets_init', 'ajax_search_widget_register');
?>