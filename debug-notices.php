<?php
/*
Plugin Name:       Debug Notices
Plugin URI:        https://github.com/afragen/debug-notices/
Description:       This plugin is used for displaying specific debug data.
Version:           0.1.0
Author:            Andy Fragen
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/afragen/debug-notices
GitHub Branch:     master
*/

add_action( 'wp_head', 'fragen_debug_notices' );
//add_action( 'admin_head', 'fragen_debug_notices' );

function fragen_debug_notices() {
	global $wp_query;
	$current_screen = null;

	if ( function_exists( 'get_current_screen' ) && isset( get_current_screen()->id ) ) {
		$current_screen = get_current_screen()->id;
	}
	if ( isset( $wp_query->query_vars['post_type'] ) ) {
		$post_type = $wp_query->query_vars['post_type'];
	}
	if ( empty( $post_type ) ) {
		return false;
	}

	$script = "<script type='text/javascript'>
		jQuery(document).ready( function($) {
			$('header').prepend('<br /><strong>Debug Notices</strong>";
	$script .= '<p>Post Type: ' . $post_type . '</p>';
	if ( $current_screen ) {
		$script .= '<p>Current Screen: ' . $current_screen . '</p>';
	}
	$script .= "'); }); </script>";

	echo $script;

}

