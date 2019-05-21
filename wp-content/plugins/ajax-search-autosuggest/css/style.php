<?php

 /**
 * CodeNegar wordPress AJAX AutoSuggest scripts
 *
 * Generates CSS stylesheet based on plugin options
 *
 * @package    	Wordpress Ajax AutoSuggest
 * @author     	Farhad Ahmadi <ahm.farhad@gmail.com>
 * @license     http://codecanyon.net/licenses
 * @link		http://codenegar.com/go/aas
 * @version    	1.9
 */

global $codenegar_aas;
?>
.ajax_autosuggest_suggestions {
	border-width: 1px;
	border-color: #<?php echo $codenegar_aas->options->color->box_border; ?> !important;
	border-style: solid;
	width: 190px;
	background-color: #a0a0a0;
	font-size: 10px;
	line-height: 14px;
	border: none !important;
}
.ajax_autosuggest_suggestions a {
	display: block; 
	clear: left;
	text-decoration: none;
}
.ajax_autosuggest_suggestions a img {
	float: left;
	padding: 3px 5px;
}
.ajax_autosuggest_suggestions a .searchheading {
	display: block;
	font-weight: bold;
	padding-top: 5px;
}
.ajax_autosuggest_suggestions .ac_odd a {
	color: #<?php echo $codenegar_aas->options->color->results_odd_text; ?>;
}
.ajax_autosuggest_suggestions .ac_even a {
	color: #<?php echo $codenegar_aas->options->color->results_even_text; ?>;
}
.ajax_autosuggest_suggestions .ajax_autosuggest_category {
	font-size: 12px;
	padding: 5px;
	display: block;
	background-color: #<?php echo $codenegar_aas->options->color->more_bar; ?> !important;
	color: #<?php echo $codenegar_aas->options->color->seperator_text; ?> !important;
}

.ac_over a.ajax_autosuggest_category{
	color: #<?php echo $codenegar_aas->options->color->seperator_hover_text; ?> !important;
	background-color: <?php echo $codenegar_aas->options->color->seperator_hover_bar; ?> !important;
}

.ajax_autosuggest_suggestions .ajax_autosuggest_more {
	padding: 5px;
	display: block;
	background-color: #<?php echo $codenegar_aas->options->color->more_bar; ?> !important;
	color: #<?php echo $codenegar_aas->options->color->more_text; ?> !important;
	background-image: url(<?php echo $codenegar_aas->url ?>/image/arrow.png);
	background-repeat: no-repeat;
	background-position: 99% 50%;
	cursor: pointer;
}
.ac_over a.ajax_autosuggest_more{
	color: #<?php echo $codenegar_aas->options->color->more_hover_text; ?> !important;
	background-color: #<?php echo $codenegar_aas->options->color->more_hover_bar; ?> !important;
}
.ajax_autosuggest_suggestions .ajax_autosuggest_more a {
	height: auto;
	color: #<?php echo $codenegar_aas->options->color->more_text; ?> !important;
}
.ajax_autosuggest_image {
	margin: 2px;
}
.ajax_autosuggest_result {
	padding-left: 5px;
}
.ajax_autosuggest_indicator {
	background: url('<?php echo $codenegar_aas->url ?>/image/indicator.gif') no-repeat scroll 100% 50% #FFF !important;
}
.ajax_autosuggest_suggestions {
	padding: 0px;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}
.ajax_autosuggest_suggestions ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}
<?php
if(false && $codenegar_aas->options->display_more_bar != 'true'){ // disabled for now
?>
.ajax_autosuggest_suggestions li:last-child {
	padding-bottom: 1px;
}
<?php
}
?>
.ajax_autosuggest_suggestions li {
	margin: 0px;
	cursor: pointer;
	display: block;
	font: menu;
	font-size: 12px;
	line-height: 16px;
	overflow: hidden;
}
.ac_odd {
	background-color: #<?php echo $codenegar_aas->options->color->results_odd_bar; ?>;
}
.ac_even {
	background-color: #<?php echo $codenegar_aas->options->color->results_even_bar; ?>;
}
.ac_over {
	background-color: #<?php echo $codenegar_aas->options->color->results_hover_bar; ?>;
	color: #<?php echo $codenegar_aas->options->color->results_hover_text; ?> !important;
}
.ac_over a, .ac_over a span {
	color: #<?php echo $codenegar_aas->options->color->results_hover_text; ?> !important;
}
.ajax_autosuggest_input{
	width: 88% !important;
	height: 29px !important;
	border: none !important;
	background-color: #<?php echo $codenegar_aas->options->color->box_background; ?> !important;
	outline: none;
	box-shadow: 0px 0px 0px #FFF !important;
	-moz-box-shadow: 0px 0px 0px #FFF !important;
	-webkit-box-shadow: 0px 0px 0px #FFF !important;
	text-indent: 5px !important;
	margin: 0 !important;
	padding: 0 !important;
	overflow: hidden;
	float: left;
	line-height: 29px;
	vertical-align: middle;
	color: #<?php echo $codenegar_aas->options->color->box_text; ?> !important;
}
.ajax_autosuggest_wrapper{
	width: 100%;
}

.ajax_autosuggest_suggestions{
	box-shadow: #888888 5px 10px 10px;
	-webkit-box-shadow: #888888 5px 10px 10px;
}
.ajax_autosuggest_submit, .ajax_autosuggest_submit:hover, .ajax_autosuggest_submit:active, .ajax_autosuggest_submit:visited{
	cursor: pointer;
	height: 27px;
	width: 27px;
	overflow: hidden;
	background: transparent url('<?php echo $codenegar_aas->options->search_image; ?>') no-repeat scroll !important;
	float: right;
	font-size: 100%;
	-webkit-appearance: none;
	outline: none;
	position: absolute;
	right: 1px;
	top: 1px;
	background-color: transparent;
	border: none ;
	border-radius: 0 !important;
	padding: 0 !important;
	margin: 0 !important;
	display: block !important;
}
.ajax_autosuggest_form_wrapper{
	width: 100%;
	border: 1px solid #<?php echo $codenegar_aas->options->color->box_border; ?> !important;
	height: 29px !important;
	background-color: #<?php echo $codenegar_aas->options->color->box_background; ?> !important;
	position: relative;
}
.ajax_autosuggest_item_description{
	padding-right: 2px;
	padding-left: 2px;
}

.ajax_autosuggest_form_label{
	display: none;
}