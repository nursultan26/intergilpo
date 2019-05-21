 /**
 * CodeNegar wordPress AJAX AutoSuggest scripts
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
 
// JavaScript document
(function($) {
	$(document).ready(function() {
	$(function() {
		$(".ajax_autosuggest_input").cn_autocomplete(codenegar_aas_config.ajax_url, {
			width: $(".ajax_autosuggest_form_wrapper").outerWidth()-2,					
			scroll: false,
			minChars: codenegar_aas_config.min_chars,
			delay: codenegar_aas_config.ajax_delay,
			cacheLength: codenegar_aas_config.cache_length,
			highlight : false,
			matchSubset: false,
            loadingClass: "ajax_autosuggest_indicator",
            resultsClass: "ajax_autosuggest_suggestions",
			max: 1000,
			selectFirst: false,
			extraParams: {action: "ajax_autosuggest_get_search_results", security: codenegar_aas_config.nonce},
			parse: function (data) {
				this.width = $(".ajax_autosuggest_form_wrapper").outerWidth()-2;
				var parsed = [];
				var rows = data.split("|||");
				for (var i=0; i < rows.length; i++) {
					var row = $.trim(rows[i]);
					if (row) {
						parsed[parsed.length] = {
							data: row
						};
					}
				}
				return parsed;
			},
			formatItem: function(item) {				
				return item;
			}
			}).result(function(e, item) {
				var url = $(item).filter("a").attr("href");
				var title = $(item).find(".searchheading").text();
                if(title.length == 0){
					title = $(item).data("q");
				}
                $(".ajax_autosuggest_input").val(title);
				if(typeof url !== "undefined"){
					location.href = $(item).filter("a").attr("href");
				}
			});						
		});
	});
})(jQuery);

(function($) {
$(document).ready(function() {
		$(function() {
			$(".ajax_autosuggest_submit").click(function(e){
				e.preventDefault();
				var $this = $(this);
				var full_search_url = $this.closest("#codenegar_ajax_search_form").attr("data-full_search_url");
				var keyword = $this.siblings(".ajax_autosuggest_input").val();
				full_search_url = full_search_url.replace("%q%", keyword);
				location.href = full_search_url;
			});
		});
	});
})(jQuery);