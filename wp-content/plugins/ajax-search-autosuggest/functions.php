<?php
if (!defined('ABSPATH')) exit('No direct script access allowed');

 /**
 * CodeNegar wordPress AJAX AutoSuggest functions
 *
 * Contains non object oriented function
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author     	Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9.8
 */
 
function ajax_autosuggest_form(){
	echo do_shortcode('[ajax_autosuggest_form]');
}

function codenegar_posts_search($search, &$wp_query, $seach_comments=true, $search_tags=true){
    global $wpdb;
 
    if (empty($search)){
        return $search;
    }
    
    $terms = $wp_query->query_vars['s'];
    $terms = str_replace('  ', ' ', $terms); // Remove double spaces
    $words = explode(' ', $terms);
    if($words === FALSE || count($words) == 0){
        return $search;
    }

    // Clear the default generated where condition,
    // we will add it in the following
    $search = '';
    foreach( $words as $word ) {
        // %word% to search all phrases that contain 'word'
        $word = '%' . $word . '%';
        $sql = " AND ((wp_posts.post_title LIKE '%s') OR (wp_posts.post_content LIKE '%s')";
        // Prevent SQL injection
        $sql = $wpdb->prepare($sql, $word, $word);
        $search .= $sql;
            
        if($seach_comments){
            $sql = " OR EXISTS ( SELECT * FROM wp_comments WHERE comment_post_ID = wp_posts.ID AND comment_content LIKE '%s' )";
            $sql = $wpdb->prepare($sql, $word);
            $search .= $sql;
        }
        
        if($search_tags){
            $sql = " OR EXISTS (
                    SELECT * FROM wp_terms
                    INNER JOIN wp_term_taxonomy
                        ON wp_term_taxonomy.term_id = wp_terms.term_id
                    INNER JOIN wp_term_relationships
                        ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                    WHERE (taxonomy = 'post_tag' OR taxonomy = 'product_tag')
                        AND object_id = wp_posts.ID
                        AND wp_terms.name LIKE '%s'
                        )
                    )";
            $sql = $wpdb->prepare($sql, $word);
            $search .= $sql;
        }
    }

    return $search;
}

function codenegar_posts_search_handler($search, &$wp_query){
    global $codenegar_aas;

    if(!isset($codenegar_aas->options->search_tags)){
        $codenegar_aas->options = $codenegar_aas->helper->array_to_object($codenegar_aas->get_options());
    }

    $search_tags = (boolean) ($codenegar_aas->options->search_tags == 'true');
    $search_comments = (boolean) ($codenegar_aas->options->search_comments == 'true');

    if(!$search_comments && !$search_tags){
        return $search;
    }
    
    return codenegar_posts_search($search, $wp_query, $search_comments, $search_tags);
}

if(!function_exists('codenegar_parse_args')){

	function codenegar_parse_args($args, $defaults = ''){
		if ( is_object( $args ) )
			$r = get_object_vars( $args );
		elseif ( is_array( $args ) )
			$r =& $args;
		else{
            $r = array();
			wp_parse_str( $args, $r ); // second parameter is output
        }
		if ( is_array( $defaults ) )
			return codenegar_array_merge( $defaults, $r );
		return $r;
	}
}

if(!function_exists('codenegar_array_merge')){

	function codenegar_array_merge(){
		$params = func_get_args();
		$merged = array_shift($params); // using first array as base
	 
		foreach ($params as $array){
			foreach ($array as $key => $value){
				if (isset($merged[$key]) && is_array($value) && is_array($merged[$key])){
					$merged[$key] = codenegar_array_merge($merged[$key], $value);
				}
				else{
					$merged[$key] = $value;
				}
			}
		}
		return $merged;
	}
}

function codenegar_remove_white_space($str) {
    $result = $str;
    foreach (array(
    "  ", " \t",  " \r",  " \n",
    "\t\t", "\t ", "\t\r", "\t\n",
    "\r\r", "\r ", "\r\t", "\r\n",
    "\n\n", "\n ", "\n\t", "\n\r",
    ) as $replacement) {
    $result = str_replace($replacement, $replacement[0], $result);
    }
    return $str !== $result ? codenegar_remove_white_space($result) : $result;
}

function codenegar_strip_html_tags($str){
    $str = preg_replace('/(<|>)\1{2}/is', '', $str);
    $str = preg_replace(
        array(
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            ),
        "", // Empty string
        $str );
    $str = codenegar_remove_white_space($str);
    $str = strip_tags($str);
    return $str;
}
?>