<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */

function wpwebapp_settings_field_button_class_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_class]" id="button-class" value="<?php echo esc_attr( $options['button_class'] ); ?>"><br>
	<label class="description" for="button-class"><?php _e( 'Example: <code>btn btn-blue</code>. Default: None.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_text_pw_forgot]" id="button-text-pw-forgot" value="<?php echo esc_attr( $options['button_text_pw_forgot'] ); ?>"><br>
	<label class="description" for="button-text-pw-forgot"><?php _e( 'Default: <code>Reset Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_button_text_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[button_text_pw_reset]" id="button-text-pw-reset" value="<?php echo esc_attr( $options['button_text_pw_reset'] ); ?>"><br>
	<label class="description" for="button-text-pw-reset"><?php _e( 'Default: <code>Set New Password</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[forgot_pw_url]" id="forgot-pw-url" value="<?php echo esc_url( $options['forgot_pw_url'] ); ?>"><br>
	<label class="description" for="forgot-pw-url"><?php _e( 'Default: None', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_forgot_pw_url_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[forgot_pw_url_text]" id="forgot-pw-url-text" value="<?php echo esc_attr( $options['forgot_pw_url_text'] ); ?>"><br>
	<label class="description" for="forgot-pw-url-text"><?php _e( 'Default: <code>(forgot password)</code>', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_custom_layout_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_reset[custom_layout_pw_forgot]" id="custom-layout" cols="50" rows="10"><?php echo esc_textarea( $options['custom_layout_pw_forgot'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br>
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br>
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br>
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}

function wpwebapp_settings_field_custom_layout_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_reset[custom_layout_pw_reset]" id="custom-layout" cols="50" rows="10"><?php echo esc_textarea( $options['custom_layout_pw_reset'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add fields to the layout:', 'wpwebapp' ); ?><br>
		<?php _e( 'Alert', 'wpwebapp' ); ?> - <code>%alert</code><br>
		<?php _e( 'Password', 'wpwebapp' ); ?> - <code>%password</code><br>
		<?php _e( 'Password Confirm', 'wpwebapp' ); ?> - <code>%password-confirm</code><br>
		<?php _e( 'Submit Button', 'wpwebapp' ); ?> - <code>%submit</code>
	</label>
	<?php
}

function wpwebapp_settings_field_disable_pw_reset_email() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<label for="email-disable-pw-reset">
		<input type="checkbox" name="wpwebapp_plugin_options_pw_reset[email_disable_pw_reset]" id="email-disable-pw-reset" <?php checked( 'on', $options['email_disable_pw_reset'] ); ?>>
		<?php _e( 'Disable the email WordPress sends site Admins whenever a user changes/resets their password', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_pw_reset_email_from() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[pw_reset_email_from]" id="pw-reset-email-from" value="<?php echo esc_attr( $options['pw_reset_email_from'] ); ?>"><br>
	<label class="description" for="pw-reset-email-from"><?php _e( '<code>name</code>, not: <code>name@domain.com</code>. Default: <code>passwordreset</code>.', 'wpwebapp' ); ?></label>
	<?php
}

function wpwebapp_settings_field_pw_reset_email_subject() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<input type="text" name="wpwebapp_plugin_options_pw_reset[pw_reset_email_subject]" id="pw-reset-email-subject" value="<?php echo esc_attr( $options['pw_reset_email_subject'] ); ?>"><br>
	<label class="description" for="pw-reset-email-subject"><?php _e( 'Default', 'wpwebapp' ); ?>: <code><?php _e( 'Default', 'Password reset for [App Name]', 'wpwebapp' ); ?></code></label>
	<?php
}

function wpwebapp_settings_field_pw_reset_email_message() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_pw_reset[pw_reset_email_message]" id="pw-reset-email-message" cols="50" rows="10"><?php echo esc_textarea( $options['pw_reset_email_message'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Use the following variables to add content to the message:', 'wpwebapp' ); ?><br>
		<?php _e( 'Username', 'wpwebapp' ); ?> - <code>%username</code><br>
		<?php _e( 'Reset URL', 'wpwebapp' ); ?> - <code>%url</code><br>
		<?php _e( 'Default: ', 'wpwebapp' ); ?> <code><?php _e( 'We received a request to reset the password for your [App Name] account [username]. To reset your password, click on the link below (or copy and paste the URL into your browser): [Reset URL]. If this was a mistake, just ignore this email.', 'wpwebapp' ); ?></code>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_pw_reset() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_pw_reset' );
	$defaults = array(
		'button_class' => '',
		'button_text_pw_forgot' => '',
		'button_text_pw_reset' => '',
		'forgot_pw_url' => '',
		'forgot_pw_url_text' => '',
		'custom_layout_pw_forgot' => '',
		'custom_layout_pw_reset' => '',
		'email_disable_pw_reset' => 'on',
		'pw_reset_email_from' => '',
		'pw_reset_email_subject' => '',
		'pw_reset_email_message' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_pw_reset', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_pw_reset( $input ) {

	$output = array();

	if ( isset( $input['button_class'] ) && ! empty( $input['button_class'] ) )
		$output['button_class'] = wp_filter_nohtml_kses( $input['button_class'] );

	if ( isset( $input['button_text_pw_forgot'] ) && ! empty( $input['button_text_pw_forgot'] ) )
		$output['button_text_pw_forgot'] = wp_filter_nohtml_kses( $input['button_text_pw_forgot'] );

	if ( isset( $input['button_text_pw_reset'] ) && ! empty( $input['button_text_pw_reset'] ) )
		$output['button_text_pw_reset'] = wp_filter_nohtml_kses( $input['button_text_pw_reset'] );

	if ( isset( $input['forgot_pw_url'] ) && ! empty( $input['forgot_pw_url'] ) )
		$output['forgot_pw_url'] = wp_filter_nohtml_kses( $input['forgot_pw_url'] );

	if ( isset( $input['forgot_pw_url_text'] ) && ! empty( $input['forgot_pw_url_text'] ) )
		$output['forgot_pw_url_text'] = wp_filter_post_kses( $input['forgot_pw_url_text'] );

	if ( isset( $input['custom_layout_pw_forgot'] ) && ! empty( $input['custom_layout_pw_forgot'] ) )
		$output['custom_layout_pw_forgot'] = wp_filter_post_kses( $input['custom_layout_pw_forgot'] );

	if ( isset( $input['custom_layout_pw_reset'] ) && ! empty( $input['custom_layout_pw_reset'] ) )
		$output['custom_layout_pw_reset'] = wp_filter_post_kses( $input['custom_layout_pw_reset'] );

	if ( isset( $input['email_disable_pw_reset'] ) )
		$output['email_disable_pw_reset'] = 'on';

	if ( isset( $input['pw_reset_email_from'] ) && ! empty( $input['pw_reset_email_from'] ) )
		$output['pw_reset_email_from'] = wp_filter_nohtml_kses( $input['pw_reset_email_from'] );

	if ( isset( $input['pw_reset_email_subject'] ) && ! empty( $input['pw_reset_email_subject'] ) )
		$output['pw_reset_email_subject'] = wp_filter_nohtml_kses( $input['pw_reset_email_subject'] );

	if ( isset( $input['pw_reset_email_message'] ) && ! empty( $input['pw_reset_email_message'] ) )
		$output['pw_reset_email_message'] = wp_filter_nohtml_kses( $input['pw_reset_email_message'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_pw_reset', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_pw_reset() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Reset Password Form', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Users who forget their password can provide their username or email address to have a reset URL sent to them. Reset URLs are only good for 24 hours by default and are unique to the user (better for security). After clicking the link, users get to pick their own new password and get logged right in. Add a password reset form to your app with a shortcode in your WordPress content editor or a function in your theme template files.', 'wpwebapp' ) ?></p>

		<ul>
			<li><?php _e( 'Shortcode', 'wpwebapp' ) ?>: <code>[wpwa_forgot_pw_form]</code></li>
			<li><?php _e( 'Function', 'wpwebapp' ) ?>: <code>&lt;?php echo wpwebapp_form_pw_forgot_and_reset(); ?&gt;</code></li>
		</ul>

		<h3><?php _e( 'Settings', 'wpwebapp' ) ?></h3>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_pw_reset' );
				do_settings_sections( 'wpwebapp_plugin_options_pw_reset' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_pw_reset() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'wpwebapp_plugin_options_validate_pw_reset' );

	// Fields
	add_settings_section( 'forms', '',  '__return_false', 'wpwebapp_plugin_options_pw_reset' );
	add_settings_field( 'button_class', __( 'Button Class', 'wpwebapp' ) . '<div class="description">' . __( 'Class to apply to form submit buttons.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_class_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'button_text_pw_forgot', __( 'Forgot Password Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to send a password reset email.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_forgot', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'button_text_pw_reset', __( 'Password Reset Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the button to change a password after a reset.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_button_text_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'forgot_pw_url', __( 'Forgot Password URL', 'wpwebapp' ) . '<div class="description">' . __( 'A link to the "forgot password" page.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'forgot_pw_url_text', __( 'Forgot Password URL Text', 'wpwebapp' ) . '<div class="description">' . __( 'Text for the "forgot password" URL (only shown if URL is set).', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_forgot_pw_url_text', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'custom_layout_pw_forgot', __( 'Custom Layout PW Forgot', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the forgot password form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_pw_forgot', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'custom_layout_pw_reset', __( 'Custom Layout PW Reset', 'wpwebapp' ) . '<div class="description">' . __( 'Customize the layout of the password reset form with your own markup.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_custom_layout_pw_reset', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'email_disable_pw_reset', __( 'Disable Admin Email', 'wpwebapp' ), 'wpwebapp_settings_field_disable_pw_reset_email', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'pw_reset_email_from', __( 'Reset Email From Address', 'wpwebapp' ) . '<div class="description">' . __( 'Email account to send password reset emails to the user from.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_reset_email_from', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'pw_reset_email_subject', __( 'Reset Email Subject', 'wpwebapp' ) . '<div class="description">' . __( 'Subject of password reset emails sent to the user.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_reset_email_subject', 'wpwebapp_plugin_options_pw_reset', 'forms' );
	add_settings_field( 'pw_reset_email_message', __( 'Reset Email Message', 'wpwebapp' ) . '<div class="description">' . __( 'Content of password reset emails sent to the user.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_pw_reset_email_message', 'wpwebapp_plugin_options_pw_reset', 'forms' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_pw_reset' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_pw_reset() {
	add_submenu_page( 'wpwa_options', __( 'Reset Password Form', 'wpwebapp' ), __( 'Reset Password Form', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_pw_reset', 'wpwebapp_plugin_options_render_page_pw_reset' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_pw_reset' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_pw_reset( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_pw_reset', 'wpwebapp_option_page_capability_pw_reset' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get class for form submit buttons
function wpwebapp_get_form_button_class_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['button_class'];
}

// Get text for forgot password submit button
function wpwebapp_get_pw_forgot_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['button_text_pw_forgot'] === '' ) {
		return __( 'Reset Password', 'wpwebapp' );
	} else {
		return $options['button_text_pw_forgot'];
	}
}

// Get text for password reset submit button
function wpwebapp_get_pw_reset_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['button_text_pw_reset'] === '' ) {
		return __( 'Set New Password', 'wpwebapp' );
	} else {
		return $options['button_text_pw_reset'];
	}
}

// Get URL of forgot password form
function wpwebapp_get_pw_forgot_url() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['forgot_pw_url'];
}

// Get text for forgot password link on login form
function wpwebapp_get_pw_forgot_url_text() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['forgot_pw_url_text'] === '' ) {
		return '(' . __( 'forgot password', 'wpwebapp' ) . ')';
	} else {
		return $options['forgot_pw_url_text'];
	}
}

// Get custom layout pw forgot
function wpwebapp_get_form_signup_custom_layout_pw_forgot() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['custom_layout_pw_forgot'];
}

// Get custom layout pw reset
function wpwebapp_get_form_signup_custom_layout_pw_reset() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['custom_layout_pw_reset'];
}

// Get setting for disabling password change notification emails (yes/no)
function wpwebapp_get_email_disable_password_change() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['email_disable_pw_reset'];
}

// Get password reset email from address
function wpwebapp_get_pw_reset_email_from() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['pw_reset_email_from'] === '' ) {
		return 'passwordreset';
	} else {
		return $options['pw_reset_email_from'];
	}
}

// Get password reset email subject
function wpwebapp_get_pw_reset_email_subject( $site_name ) {
	$options = wpwebapp_get_plugin_options_pw_reset();
	if ( $options['pw_reset_email_subject'] === '' ) {
		return 'Password reset for ' . $site_name;
	} else {
		return $options['pw_reset_email_subject'];
	}
}

// Get password reset email message
function wpwebapp_get_pw_reset_email_message() {
	$options = wpwebapp_get_plugin_options_pw_reset();
	return $options['pw_reset_email_message'];
}

?>