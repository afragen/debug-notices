<?php
/*
Plugin Name:       Debug Notices
Plugin URI:        https://github.com/afragen/debug-notices/
Description:       This plugin is used for displaying specific debug data.
Version:           0.4.0
Author:            Andy Fragen
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/afragen/debug-notices
GitHub Branch:     master
*/

add_action( 'wp_head', 'fragen_debug_notices' );
add_action( 'admin_head', 'fragen_debug_notices' );

function fragen_debug_notices() {
	global $wp_query;

	if ( function_exists( 'get_current_screen' ) && isset( get_current_screen()->id ) ) {
		$current_screen = get_current_screen()->id;
	}
	if ( isset( $wp_query->query_vars['post_type'] ) ) {
		$post_type = $wp_query->query_vars['post_type'];
	}

	if ( empty( $current_screen ) && empty( $post_type ) ) {
		return false;
	}

	if ( is_admin() ) {
		$script = "<script type='text/javascript'>
		jQuery(document).ready( function($) {
			$('body').prepend('<br /><strong>Debug Notices</strong><br />";
	} else {
		$script = "<script type='text/javascript'>
		jQuery(document).ready( function($) {
			$('header').prepend('<br /><strong>Debug Notices</strong><br />";
	}
	if ( ! empty( $post_type ) ) {
		$script .= 'Post Type: ' . $post_type . '<br />';
		$post_types = array( 'tribe_events', 'tribe_organizer', 'tribe_venue' );
		$test  = in_array( $wp_query->query_vars['post_type'], $post_types, true ) ? 'true' : 'false';
		$test2 = in_array( $wp_query->query_vars['post_type'], $post_types, false ) ? 'true' : 'false';
		$script .= 'Category Colors Test 1: ' . $test . '<br />';
		$script .= 'Category Colors Test 2: ' . $test2 . '<br />';
	}

	if ( ! empty( $current_screen ) ) {
		$script .= 'Current Screen: ' . $current_screen . '<br />';
	}
	$script .= "'); }); </script>";

	echo $script;

}

