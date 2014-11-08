<?php

/* ======================================================================

	WordPress for Web Apps Delete Account Form
	Functions to create and process the delete account button.

 * ====================================================================== */


// Create & Display Delete Account Form
function wpwebapp_form_delete_account() {

	if ( is_user_logged_in() ) {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_delete_account' ) );
		$submit_text = stripslashes( wpwebapp_get_delete_account_text() );
		$submit_class = esc_attr( wpwebapp_get_delete_account_button_class() );
		$custom_layout = stripslashes( wpwebapp_get_delete_account_custom_layout() );

		if ( $custom_layout === '' ) {
			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-delete-account" name="wpwebapp-form-delete-account" action="" method="post">' .
					wpwebapp_form_field_text_input_plus( 'password', 'wpwebapp-delete-password', __( 'Password ', 'wpwebapp' ) ) .
					wpwebapp_form_field_submit( 'wpwebapp-delete-account-submit', $submit_class, $submit_text, 'wpwebapp-delete-account-process-nonce', 'wpwebapp-delete-account-process' ) .
				'</form>';
		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%password' => wpwebapp_form_field_text_input( 'password', 'wpwebapp-delete-password', __( 'Password', 'wpwebapp' ) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-delete-account-submit', $submit_class, $submit_text, 'wpwebapp-delete-account-process-nonce', 'wpwebapp-delete-account-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-delete-account" name="wpwebapp-form-delete-account" action="" method="post">' .
					$custom_layout .
				'</form>';
		}

	} else {
		$form = '<p>' . __( 'You have to be logged in to delete your account.', 'wpwebapp' ) . '</p>';
	}

	return $form;

}
add_shortcode( 'wpwa_delete_account_form', 'wpwebapp_form_delete_account' );



// Process Delete Account Form
function wpwebapp_process_delete_account() {
	if ( isset( $_POST['wpwebapp-delete-account-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-delete-account-process'], 'wpwebapp-delete-account-process-nonce' ) ) {

			// Delete account variables
			require_once(ABSPATH.'wp-admin/includes/user.php' );
			global $current_user;
			$referer = esc_url_raw( wpwebapp_get_url() );
			$redirect = esc_url_raw( wpwebapp_get_delete_account_url() );
			$user_id = $current_user->ID;
			$user_pw = $current_user->user_pass;
			$pw = wp_filter_nohtml_kses( $_POST['wpwebapp-delete-password'] );

			// Alert Messages
			$alert_all_fields = wpwebapp_get_alert_empty_fields();
			$alert_incorrect_pw = wpwebapp_get_alert_pw_incorrect();

			// Validate and authenticate password
			if ( $pw === '' ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_delete_account', $alert_all_fields );
				wp_safe_redirect( $referer, 302 );
				exit;
			} else if ( !wp_check_password( $pw, $user_pw, $user_id ) ) {
				wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_delete_account', $alert_incorrect_pw );
				wp_safe_redirect( $referer, 302 );
				exit;
			}

			// If no errors, delete current user's account
			wp_delete_user( $user_id );
			wp_safe_redirect( $redirect, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action( 'init', 'wpwebapp_process_delete_account' );
