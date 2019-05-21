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
 
class Custom_Ajax_search_widget extends WP_Widget{
	function __construct(){
		global $codenegar_aas;
		parent::__construct(
			'codenegar_ajax_search',
			esc_html__('Ajax AutoSuggest', 'vg-greek'),
			array('description' => esc_html__('Ajax AutoSuggest Form', 'vg-greek'))
		);
	}

	public function form($instance){ // Backend widget form, instance is user posted data
		global $codenegar_aas;
		$defaults = array(
			'title'		  => esc_html__('Search', 'vg-greek'),
			'placeholder' => esc_html__('Type Keyword...', 'vg-greek'),
			'max_width' => esc_html__('350', 'vg-greek')
		);
		$instance = codenegar_parse_args($instance, $defaults);
		extract($instance); // Extract array to multiple variables
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>" ><?php esc_html_e('Title', 'vg-greek'); ?>:</label>
			<input class="widefat"
				id = "<?php echo esc_attr($this->get_field_id('title')); ?>"
				name = "<?php echo esc_attr($this->get_field_name('title')); ?>"
				value = "<?php if(isset($title)) echo esc_attr($title); ?>" 
			/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('placeholder')); ?>" ><?php esc_html_e('Placeholder', 'vg-greek'); ?>:</label>
			<input class="widefat"
				id = "<?php echo esc_attr($this->get_field_id('placeholder')); ?>"
				name = "<?php echo esc_attr($this->get_field_name('placeholder')); ?>"
				value = "<?php if(isset($placeholder)) echo esc_attr($placeholder); ?>" 
			/>
		</p>
		<?php 
	}

	public function widget($args, $instance){ // Frontend widget form
		global $codenegar_aas;
		$defaults = array(
			'title'		  => esc_html__('Search', 'vg-greek'),
			'placeholder' => esc_html__('Type Keyword...', 'vg-greek'),
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
				<form id="codenegar_ajax_search_form" data-full_search_url="<?php echo esc_url($codenegar_aas->options->full_search_url); ?>" action="<?php echo esc_url(home_url('/')); ?>" method="get">
					<div class="ajax_autosuggest_form_wrapper">
						<label class="ajax_autosuggest_form_label"><?php echo esc_html($title); ?></label>
						<input name="s" class="ajax_autosuggest_input" type="text"  value="<?php echo esc_attr($value); ?>" style="width: 95%;" placeholder="<?php echo esc_attr($placeholder); ?>" autocomplete="off" />
						<button class="btn btn-primary ajax_autosuggest_submit" type="submit" id="wsearchsubmit"><i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
			
			<?php
		echo $after_widget;
	}
}

?>