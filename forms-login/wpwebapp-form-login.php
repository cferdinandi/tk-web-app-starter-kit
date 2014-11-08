<?php

/* ======================================================================

	WordPress for Web Apps Login Form
	Functions to create and process the login form.

 * ====================================================================== */


// Create & Display Login Form
function wpwebapp_form_login() {

	if ( is_user_logged_in() ) {
		$form = '<p>' . __( 'You\'re already logged in.', 'wpwebapp' ) . '</p>';
	} else {

		// Variables
		$forgot_pw_url = esc_url_raw( wpwebapp_get_pw_forgot_url() );
		$forgot_pw_text = stripslashes( wpwebapp_get_pw_forgot_url_text() );
		$submit_text = stripslashes( wpwebapp_get_form_login_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_login() );
		$custom_layout = stripslashes( wpwebapp_get_form_login_custom_layout() );
		$forgot_pw = ( empty( $forgot_pw_url ) ? '' : '<span class="text-small"><a href="' . $forgot_pw_url . '" tabindex="999">' . $forgot_pw_text . '</a></span>' );

		// Get alert
		$wp_session = WP_Session::get_instance();
		$username = esc_attr( $wp_session['wpwebapp_credentials_login_username'] );
		$alert = stripslashes( $wp_session['wpwebapp_alert_login'] );
		unset( $wp_session['wpwebapp_credentials_login_username'] );
		unset( $wp_session['wpwebapp_alert_login'] );

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-login" name="wpwebapp-form-login" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-username', __( 'Username or Email', 'wpwebapp' ), $username ) .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-password', __( 'Password ', 'wpwebapp' ) . $forgot_pw ) .
					wpwebapp_form_field_checkbox_plus( 'wpwebapp-rememberme', __( 'Remember Me', 'wpwebapp' ), 'rememberme', 'checked' ) .
					wpwebapp_form_field_submit_plus( 'wpwebapp-login-submit', $submit_class, $submit_text, 'wpwebapp-login-process-nonce', 'wpwebapp-login-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%username' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-username', __( 'Username or Email', 'wpwebapp' ), $username ),
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-password', __( 'Password ', 'wpwebapp' ) ),
				'%forgotpw' => $forgot_pw,
				'%rememberme' => wpwebapp_form_field_checkbox( 'wpwebapp-rememberme', __( 'Remember Me', 'wpwebapp' ), 'rememberme' ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-login-submit', $submit_class, $submit_text, 'wpwebapp-login-process-nonce', 'wpwebapp-login-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-login" name="wpwebapp-form-login" action="" method="post">' .
					$custom_layout .
				'</form>';
		}

	}

	return $form;

}
add_shortcode( 'wpwa_login_form', 'wpwebapp_form_login' );



// Process Login Form
function wpwebapp_process_login() {
	if ( isset( $_POST['wpwebapp-login-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-login-process'], 'wpwebapp-login-process-nonce' ) ) {

			// Login variables
			$referer = esc_url_raw( wpwebapp_get_url() );
			$username = sanitize_user( $_POST['wpwebapp-username'] );
			$password = wp_filter_nohtml_kses( $_POST['wpwebapp-password'] );
			$rememberme = ( isset( $_POST['wpwebapp-rememberme'] ) ? true : false );

			// Alerts
			$wp_session = WP_Session::get_instance();
			$alert_login = stripslashes( wpwebapp_get_alert_login_incorrect() );

			// If login is an email, get username
			if ( is_email( $username ) ) {
				$user = get_user_by( 'email', $username );
				$user_id = $user->ID;
				$user_data = get_userdata( $user_id );
				$username = $user_data->user_login;
			}

			// Authenticate User
			$credentials = array();
			$credentials['user_login'] = $username;
			$credentials['user_password'] = $password;
			$credentials['remember'] = $rememberme;
			$login = wp_signon( $credentials);

			// If errors
			if ( is_wp_error( $login ) ) {
				$wp_session['wpwebapp_credentials_login_username'] = $username;
				$wp_session['wpwebapp_alert_login'] = $alert_login;
			}

			wp_safe_redirect( $referer, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_login');
