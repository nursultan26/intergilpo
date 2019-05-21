 /**
 * CodeNegar wordPress AJAX AutoSuggest scripts
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
jQuery(document).ready(function($) {
	var excluded_ids = $("#excluded_ids");
    if(excluded_ids.val()=="0"){
		excluded_ids.val("");
	}
	
	$(".integer").numeric({ decimal: false, negative: false });
	postboxes.add_postbox_toggles(pagenow);
});