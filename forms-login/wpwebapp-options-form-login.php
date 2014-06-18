<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_button_class_login() {
	$options = wpwebapp_get_plugin_options_forms_login();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_login[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>"><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_login() {
	$options = wpwebapp_get_plugin_options_forms_login();
	?>
	<input type="text" name="wpwebapp_plugin_options_forms_login[button_text_login]" id="button-text-login" value="<?php echo esc_attr( $options['button_text_login'] ); ?>"><br>
	<label class="description" for="button-text-login"><?php _e( 'Default: <code>Login</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_custom_layout_login() {
	$options = wpwebapp_get_plugin_options_forms_login();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_forms_login[custom_layout]" id="custom-layout" cols="50" rows="10"><?php echo esc_textarea( $options['custom_layout'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br>
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br>
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br>
		<?php _e( 'Password', 'wpwebapp' ); ?> - <code>%password</code><br>
		<?php _e( 'Remember Me', 'wpwebapp' ); ?> - <code>%rememberme</code><br>
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_forms_login() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_forms_login' );
	$defaults = array(
		'button_class' => '',
		'button_text_login' => '',
		'custom_layout' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_forms_login', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_forms_login( $input ) {

	$output = array();

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text_login'] ) && ! empty( $input['button_text_login'] ) )
		$output['button_text_login'] = wp_filter_nohtml_kses( $input['button_text_login'] );

	if ( isset( $input['custom_layout'] ) && ! empty( $input['custom_layout'] ) )
		$output['custom_layout'] = wp_filter_post_kses( $input['custom_layout'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_forms_login', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_forms_login() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Login Form', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'WordPress for Web Apps lets users login with either their username or their email address. Don\'t remember your username? No problem! Add a login form to your app with a shortcode in your WordPress content editor or a function in your theme template files.', 'wpwebapp' ) ?></p>

		<ul>
			<li><?php _e( 'Shortcode', 'wpwebapp' ) ?>: <code>[wpwa_login_form]</code></li>
			<li><?php _e( 'Function', 'wpwebapp' ) ?>: <code>&lt;?php echo wpwebapp_form_login(); ?&gt;</code></li>
		</ul>

		<h3><?php _e( 'Settings', 'wpwebapp' ) ?></h3>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_forms_login' );
				do_settings_sections( 'wpwebapp_plugin_options_forms_login' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_forms_login() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_forms_login', 'wpwebapp_plugin_options_forms_login', 'wpwebapp_plugin_options_validate_forms_login' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_forms_login' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_login', 'wpwebapp_plugin_options_forms_login', 'forms' );
	add_settings_field( 'button_text_login', __( 'Login Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the login button.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_login', 'wpwebapp_plugin_options_forms_login', 'forms' );
	add_settings_field( 'custom_layout', __( 'Custom Layout', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_login', 'wpwebapp_plugin_options_forms_login', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_forms_login' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_forms_login() {
	add_submenu_page( 'wpwa_options', __( 'Login Form', 'wpwebapp' ), __( 'Login Form', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_forms_login', 'wpwebapp_plugin_options_render_page_forms_login' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_forms_login' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_forms_login( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_forms_login', 'wpwebapp_option_page_capability_forms_login' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class_login() {
	$options = wpwebapp_get_plugin_options_forms_login();
	return $options['button_class'];
}

// Get text for login submit button
function wpwebapp_get_form_login_text() {
	$options = wpwebapp_get_plugin_options_forms_login();
	if ( $options['button_text_login'] === '' ) {
		return __( 'Login', 'wpwebapp' );
	} else {
		return $options['button_text_login'];
	}
}

// Get custom layout
function wpwebapp_get_form_login_custom_layout() {
	$options = wpwebapp_get_plugin_options_forms_login();
	return $options['custom_layout'];
}

?>