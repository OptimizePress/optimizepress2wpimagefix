<?php

/*
Plugin Name: OptimizePress 2 Images fix
Plugin URI: http://www.optimizepress.com
Description: This plugin deregister CSS stylesheets that were causing issues and registers new ones
Version: 1.1
Author: Luka Peharda
Author URI: http://www.optimizepress.com
*/

function op_le_body_class($classes)
{
	if (is_page()) {
		global $wp_query;
		$page_id = $wp_query->get_queried_object_id();
		if ('Y' === get_post_meta($page_id, '_optimizepress_pagebuilder', true) && !in_array('op-live-editor-page', $classes)) {
			$classes[] = 'op-live-editor-page';
		}
	}

	return $classes;
}

function op_fix_image_css()
{
	if (defined('OP_SN')) {
		wp_register_style(OP_SN . '-wp', plugins_url('wp.css', __FILE__), array(), '1.0.0', false);
		wp_enqueue_style(OP_SN . '-wp');	
	}
}

add_filter('body_class', 'op_le_body_class', 1);
add_action('wp_head', 'op_fix_image_css', 7);