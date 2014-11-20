<?php

/**
 * WP Session Manager
 * @descripton Prototype session management for WordPress.
 * @version 1.2.0
 * @author Eric Mann
 * @link http://jumping-duck.com/wordpress/plugins
 * @link http://eamann.com
 * @license GPLv2+
 */

// let users change the session cookie name
if( ! defined( 'WP_SESSION_COOKIE' ) ) {
	define( 'WP_SESSION_COOKIE', '_wp_session' );
}

if ( ! class_exists( 'Recursive_ArrayAccess' ) ) {
	include 'includes/class-recursive-arrayaccess.php';
}

// Include utilities class
if ( ! class_exists( 'WP_Session_Utils' ) ) {
	include 'includes/class-wp-session-utils.php';
}

// Include WP_CLI routines early
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	include 'includes/wp-cli.php';
}

// Only include the functionality if it's not pre-defined.
if ( ! class_exists( 'WP_Session' ) ) {
	include 'includes/class-wp-session.php';
	include 'includes/wp-session.php';
}
