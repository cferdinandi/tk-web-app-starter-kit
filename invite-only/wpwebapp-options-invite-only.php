<?php

/* ======================================================================

	WordPress for Web App Create Plugin Options
	Used to create the settings menu.

 * ====================================================================== */


/* ======================================================================
	FIELDS
	Create the option fields.
 * ====================================================================== */


function wpwebapp_settings_field_is_invite_only() {
	$options = wpwebapp_get_plugin_options_invite_only();
	?>
	<label for="is-invite-only">
		<input type="checkbox" name="wpwebapp_plugin_options_invite_only[is_invite_only]" id="is-invite-only" <?php checked( 'on', $options['is_invite_only'] ); ?>>
		<?php _e( 'Require an invitation to sign-up', 'wpwebapp' ); ?>
	</label>
	<?php
}

function wpwebapp_settings_field_invitees() {
	$options = wpwebapp_get_plugin_options_invite_only();
	?>
	<textarea class="large-text" type="text" name="wpwebapp_plugin_options_invite_only[invitees]" id="invitees" cols="50" rows="10"><?php echo esc_textarea( $options['invitees'] ); ?></textarea>
	<label class="description">
		<?php _e( 'Enter each email address on a new line.', 'wpwebapp' ); ?>
	</label>
	<?php
}





/* ======================================================================
	DEFAULTS
	The defaults for each field.
 * ====================================================================== */

// Get the current options from the database.
// If none are specified, use these defaults.
function wpwebapp_get_plugin_options_invite_only() {
	$saved = (array) get_option( 'wpwebapp_plugin_options_invite_only' );
	$defaults = array(
		'is_invite_only' => 'off',
		'invitees' => '',
	);

	$defaults = apply_filters( 'wpwebapp_default_plugin_options_invite_only', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}





/* ======================================================================
	SANITIZATION & VALIDATION
	Validate and sanitize inputs before adding to the database.
 * ====================================================================== */

// Sanitize and validate updated plugin options
function wpwebapp_plugin_options_validate_invite_only( $input ) {

	$output = array();

	if ( isset( $input['is_invite_only'] ) )
		$output['is_invite_only'] = 'on';

	if ( isset( $input['invitees'] ) && ! empty( $input['invitees'] ) )
		$output['invitees'] = wp_filter_post_kses( $input['invitees'] );

	return apply_filters( 'wpwebapp_plugin_options_validate_invite_only', $output, $input );
}



/* ======================================================================
	MENU
	Create the options menu.
 * ====================================================================== */

// Create plugin options menu
// The content that's rendered on the menu page.
function wpwebapp_plugin_options_render_page_invite_only() {
	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php _e( 'Invite-Only', 'wpwebapp' ); ?></h2>
		<?php settings_errors(); ?>

		<p><?php _e( 'Make your website or app invite-only.', 'wpwebapp' ) ?></p>

		<h3><?php _e( 'Settings', 'wpwebapp' ) ?></h3>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'wpwebapp_options_invite_only' );
				do_settings_sections( 'wpwebapp_plugin_options_invite_only' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


// Register the plugin options page and its fields
function wpwebapp_plugin_options_init_invite_only() {

	// Register a setting and its sanitization callback
	register_setting( 'wpwebapp_options_invite_only', 'wpwebapp_plugin_options_invite_only', 'wpwebapp_plugin_options_validate_invite_only' );

	// Fields
	add_settings_section( 'invite-only', '',  '__return_false', 'wpwebapp_plugin_options_invite_only' );
	add_settings_field( 'is_invite_only', __( 'Invite-Only?', 'wpwebapp' ), 'wpwebapp_settings_field_is_invite_only', 'wpwebapp_plugin_options_invite_only', 'invite-only' );
	add_settings_field( 'invitees', __( 'Invitees', 'wpwebapp' ) . '<div class="description">' . __( 'Email addresses of the people who can join.', 'wpwebapp' ) . '</div>', 'wpwebapp_settings_field_invitees', 'wpwebapp_plugin_options_invite_only', 'invite-only' );

}
add_action( 'admin_init', 'wpwebapp_plugin_options_init_invite_only' );



// Add the plugin options page to the admin menu
function wpwebapp_plugin_options_add_page_invite_only() {
	add_submenu_page( 'wpwa_options', __( 'Invite-Only', 'wpwebapp' ), __( 'Invite-Only', 'wpwebapp' ), 'edit_theme_options', 'wpwebapp_plugin_options_invite_only', 'wpwebapp_plugin_options_render_page_invite_only' );
}
add_action( 'admin_menu', 'wpwebapp_plugin_options_add_page_invite_only' );



// Restrict access to the plugin options page to admins
function wpwebapp_option_page_capability_invite_only( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_wpwebapp_options_invite_only', 'wpwebapp_option_page_capability_invite_only' );




/* ======================================================================
	GET SETTINGS
	Methods to get settings in other plugin functions.
 * ====================================================================== */

// Get role restrictions for WordPress backend access
function wpwebapp_get_is_invite_only() {
	$options = wpwebapp_get_plugin_options_invite_only();
	return $options['is_invite_only'];
}

// Get default page access setting
function wpwebapp_get_invitees() {
	$options = wpwebapp_get_plugin_options_invite_only();
	$invitees = $options['invitees'];
	$invitees = trim($invitees);
	$invitees = explode("\n", $invitees);
	return $invitees;
}

?>