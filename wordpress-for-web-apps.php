<?php

/* ======================================================================

	Plugin Name: WordPress for Web Apps
	Plugin URI: https://github.com/cferdinandi/web-app-starter-kit/
	Description: Transform WordPress into a web app engine. Adjust your settings under <a href="admin.php?page=plugin_options">Web App Options</a>.
	Version: 4.0
	Author: Chris Ferdinandi
	Author URI: http://gomakethings.com
	License: MIT

	TODO:
		* Check button class namespacing in menu render and "get" functions

 * ====================================================================== */

// Helpers
// Functions used throughout the plugin
require_once( dirname( __FILE__) . '/admin/wpwebapp-helpers.php' );
require_once( dirname( __FILE__) . '/admin/wpwebapp-options.php' );

// Security
require_once( dirname( __FILE__) . '/security/wpwebapp-options-security.php' );
require_once( dirname( __FILE__) . '/security/wpwebapp-security.php' );

// User Access
require_once( dirname( __FILE__) . '/user-access/wpwebapp-options-user-access.php' );
require_once( dirname( __FILE__) . '/user-access/wpwebapp-user-access.php' );

// Navigation
require_once( dirname( __FILE__) . '/navigation/wpwebapp-options-navigation.php' );
require_once( dirname( __FILE__) . '/navigation/wpwebapp-navigation.php' );

// Alerts
require_once( dirname( __FILE__) . '/alerts/wpwebapp-options-alerts.php' );

// Login Form
require_once( dirname( __FILE__) . '/forms-login/wpwebapp-options-form-login.php' );
require_once( dirname( __FILE__) . '/forms-login/wpwebapp-form-login.php' );

// Signup Form
require_once( dirname( __FILE__) . '/forms-signup/wpwebapp-options-form-signup.php' );
require_once( dirname( __FILE__) . '/forms-signup/wpwebapp-form-signup.php' );

// PW Reset Form
require_once( dirname( __FILE__) . '/forms-pw-reset/wpwebapp-options-form-pw-reset.php' );
require_once( dirname( __FILE__) . '/forms-pw-reset/wpwebapp-form-pw-reset.php' );

// User Profile Form
require_once( dirname( __FILE__) . '/forms-user-profile/wpwebapp-options-form-user-profile.php' );
require_once( dirname( __FILE__) . '/forms-user-profile/wpwebapp-form-user-profile.php' );

// PW Change Form
require_once( dirname( __FILE__) . '/forms-pw-change/wpwebapp-options-form-pw-change.php' );
require_once( dirname( __FILE__) . '/forms-pw-change/wpwebapp-form-pw-change.php' );

// Email Change Form
require_once( dirname( __FILE__) . '/forms-email-change/wpwebapp-options-form-email-change.php' );
require_once( dirname( __FILE__) . '/forms-email-change/wpwebapp-form-email-change.php' );

// Delete Account Button
require_once( dirname( __FILE__) . '/forms-delete-account/wpwebapp-options-form-delete-account.php' );
require_once( dirname( __FILE__) . '/forms-delete-account/wpwebapp-form-delete-account.php' );

// Instructions
require_once( dirname( __FILE__) . '/instructions/wpwebapp-options-logout-links.php' );
require_once( dirname( __FILE__) . '/instructions/wpwebapp-options-usernames.php' );

?>