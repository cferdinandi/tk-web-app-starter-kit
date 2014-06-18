<?php

/* ======================================================================

	WordPress for Web Apps Password Change Form
	Functions to create and process the password reset form.

 * ====================================================================== */

// Get user profile data
function wpwebapp_get_user_profile_info() {
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	$gravatar_size = wpwebapp_get_gravatar_size();
	return array(
		'gravatar' => get_avatar($user_id, $gravatar_size),
		'name' => get_user_meta($user_id, 'wpwa_user_name', true),
		'about' => get_user_meta($user_id, 'wpwa_user_about', true),
		'location' => get_user_meta($user_id, 'wpwa_user_location', true),
		'email' => get_user_meta($user_id, 'wpwa_user_email', true),
		'website' => get_user_meta($user_id, 'wpwa_user_website', true),
		'twitter' => get_user_meta($user_id, 'wpwa_user_twitter', true),
		'facebook' => get_user_meta($user_id, 'wpwa_user_facebook', true),
		'linkedin' => get_user_meta($user_id, 'wpwa_user_linkedin', true),
	);
}


// Create & Display Change Password Form
function wpwebapp_form_user_profile() {

	if ( is_user_logged_in() ) {

		// Variables
		$alert = stripslashes( wpwebapp_get_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_user_profile' ) );
		$submit_text = stripslashes( wpwebapp_get_user_profile_text() );
		$submit_class = esc_attr( wpwebapp_get_form_button_class_user_profile() );
		$profile_fields = wpwebapp_get_user_profile_field_types();
		$value = wpwebapp_get_user_profile_info();
		$custom_layout = stripslashes( wpwebapp_get_user_profile_custom_layout() );

		if ( $custom_layout === '' ) {

			$contact_label_text = esc_attr( wpwebapp_get_contact_info_label() );
			$field_gravatar = $field_name = $field_about = $field_location = $field_email = $field_website = $field_twitter = $field_facebook = $field_linkedin = '';
			if ( wpwebapp_get_gravatar_text() === '' ) {
				$field_gravatar_text = '<p>' . __( 'Update your profile photo at <a target="_blank" href="https://gravatar.com/">Gravatar.com</a>.' ) . '</p>';
			} else {
				$field_gravatar_text = stripslashes( wpwebapp_get_gravatar_text() );
			}

			if ( $profile_fields['gravatar'] === 'on' ) {
				if ( wpwebapp_get_gravatar_image_link() === 'on' ) {
					$field_gravatar = '<a target="_blank" href="https://gravatar.com/">' . $value['gravatar'] . '</a><br>' . $field_gravatar_text;
				} else {
					$field_gravatar = $value['gravatar'] . '<br>' . $field_gravatar_text;
				}
			}

			if ( $profile_fields['name'] === 'on' ) {
				$field_name = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-name', __( 'Name', 'wpwebapp' ), esc_attr($value['name']) );
			}

			if ( $profile_fields['about'] === 'on' ) {
				$field_about = wpwebapp_form_field_text_area_plus( 'wpwebapp-user-profile-about', __( 'Biography', 'wpwebapp' ), esc_attr($value['about']) );
			}

			if ( $profile_fields['location'] === 'on' ) {
				$field_location = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-location', __( 'Location', 'wpwebapp'), esc_attr($value['location']) );
			}

			if ( $profile_fields['email'] === 'on' ) {
				$field_email = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-email', __( 'Email (public)', 'wpwebapp' ), esc_attr($value['email']) );
			}

			if ( $profile_fields['website'] === 'on' ) {
				$field_website = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-website', __( 'Website', 'wpwebapp' ), esc_attr($value['website']) );
			}

			if ( $profile_fields['twitter'] === 'on' ) {
				$field_twitter = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-twitter', __( 'Twitter', 'wpwebapp' ), '@' . esc_attr($value['twitter']) );
			}

			if ( $profile_fields['facebook'] === 'on' ) {
				$field_facebook = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-facebook', __( 'Facebook', 'wpwebapp' ), esc_attr($value['facebook']) );
			}

			if ( $profile_fields['linkedin'] === 'on' ) {
				$field_linkedin = wpwebapp_form_field_text_input_plus( 'text', 'wpwebapp-user-profile-linkedin', __( 'LinkedIn', 'wpwebapp' ), esc_attr($value['linkedin']) );
			}

			if ( $contact_label_text !== '' ) {
				$contact_label = '<h2>' . esc_attr( $contact_label_text ) . '</h2>';
			}

			$form =
				$alert .
				'<form class="form-wpwebapp" id="wpwebapp-form-user-profile" name="wpwebapp-form-user-profile" action="" method="post">' .
					// fields
					$field_gravatar .
					$field_name .
					$field_about .
					$field_location .
					$contact_label .
					$field_email .
					$field_website .
					$field_twitter .
					$field_facebook .
					$field_linkedin .
					wpwebapp_form_field_submit_plus( 'wpwebapp-update-profile-submit', $submit_class, $submit_text, 'wpwebapp-update-profile-process-nonce', 'wpwebapp-update-profile-process' ) .
				'</form>';

		} else {
			$add_fields = array(
				'%alert' => $alert,
				'%gravatar' => $value['gravatar'],
				'%name' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-name', __( 'Name', 'wpwebapp' ), esc_attr($value['name']) ),
				'%about' => wpwebapp_form_field_text_area( 'wpwebapp-user-profile-about', __( 'Biography', 'wpwebapp' ), esc_attr($value['about']) ),
				'%location' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-location', __( 'Location', 'wpwebapp'), esc_attr($value['location']) ),
				'%email' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-email', __( 'Email (public)', 'wpwebapp' ), esc_attr($value['email']) ),
				'%website' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-website', __( 'Website', 'wpwebapp' ), esc_attr($value['website']) ),
				'%twitter' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-twitter', __( 'Twitter', 'wpwebapp' ), '@' . esc_attr($value['twitter']) ),
				'%facebook' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-facebook', __( 'Facebook', 'wpwebapp' ), esc_attr($value['facebook']) ),
				'%linkedin' => wpwebapp_form_field_text_input( 'text', 'wpwebapp-user-profile-linkedin', __( 'LinkedIn', 'wpwebapp' ), esc_attr($value['linkedin']) ),
				'%submit' => wpwebapp_form_field_submit( 'wpwebapp-update-profile-submit', $submit_class, $submit_text, 'wpwebapp-update-profile-process-nonce', 'wpwebapp-update-profile-process' ),
			);
			$custom_layout = strtr( $custom_layout, $add_fields );
			$form =
				'<form class="form-wpwebapp" id="wpwebapp-form-user-profile" name="wpwebapp-form-user-profile" action="" method="post">' .
					$custom_layout .
				'</form>';
		}


	} else {
		$form = '<p>' . __( 'You must be logged in to update a profile.', 'wpwebapp' ) . '</p>';
	}

	return $form;

}
add_shortcode( 'wpwa_user_profile_form', 'wpwebapp_form_user_profile' );


// Process Update Profile Form
function wpwebapp_process_update_profile() {
	if ( isset( $_POST['wpwebapp-update-profile-process'] ) ) {
		if ( wp_verify_nonce( $_POST['wpwebapp-update-profile-process'], 'wpwebapp-update-profile-process-nonce' ) ) {

			// User variables
			global $current_user;
			get_currentuserinfo();
			$referer = esc_url_raw( wpwebapp_get_url() );
			$user_id = $current_user->ID;

			// Profile variables
			// TODO: Determine appropriate sanitization
			$field_name = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-name'] );
			$field_about = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-about'] );
			$field_location = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-location'] );
			$field_email = sanitize_email( $_POST['wpwebapp-user-profile-email'] );
			$field_website = esc_url_raw( $_POST['wpwebapp-user-profile-website'] );
			$field_twitter = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-twitter'] );
			$field_facebook = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-facebook'] );
			$field_linkedin = wp_filter_nohtml_kses( $_POST['wpwebapp-user-profile-linkedin'] );

			// Alert Messages
			$alert_success = wpwebapp_get_alert_profile_update_success();
			$alert_failure = wpwebapp_get_alert_profile_update_failure();

			// Update settings
			if ( isset($field_name) ) {
				update_user_meta( $user_id, 'wpwa_user_name', $field_name );
			}

			if ( isset($field_about) ) {
				update_user_meta( $user_id, 'wpwa_user_about', $field_about );
			}

			if ( isset($field_location) ) {
				update_user_meta( $user_id, 'wpwa_user_location', $field_location );
			}

			if ( isset($field_email) && is_email($field_email) ) {
				update_user_meta( $user_id, 'wpwa_user_email', $field_email );
			}

			if ( isset($field_website) ) {
				update_user_meta( $user_id, 'wpwa_user_website', $field_website );
			}

			if ( isset($field_twitter) ) {
				if ( strpos( $field_twitter, 'twitter.com/#!/' ) !== false ) {
					$field_twitter = str_replace( 'http://twitter.com/#!/', '', $field_twitter );
					$field_twitter = str_replace( 'https://twitter.com/#!/', '', $field_twitter );
				} elseif ( strpos( $field_twitter, 'twitter.com/' ) !== false  ) {
					$field_twitter = str_replace( 'http://twitter.com/', '', $field_twitter );
					$field_twitter = str_replace( 'https://twitter.com/', '', $field_twitter );
				} elseif ( strpos( $field_twitter, '@' ) !== false  ) {
					$field_twitter = str_replace( '@', '', $field_twitter );
				}
				update_user_meta( $user_id, 'wpwa_user_twitter', $field_twitter );
			}

			if ( isset($field_facebook) ) {
				if ( strpos( $field_facebook, 'facebook.com/' ) !== false ) {
					$field_facebook = str_replace( 'http://facebook.com/', '', $field_facebook );
					$field_facebook = str_replace( 'https://facebook.com/', '', $field_facebook );
				}
				update_user_meta( $user_id, 'wpwa_user_facebook', $field_facebook );
			}

			if ( isset($field_linkedin) ) {
				if ( strpos( $field_linkedin, 'www.linkedin.com/in/' ) !== false ) {
					$field_linkedin = str_replace( 'http://www.linkedin.com/in/', '', $field_linkedin );
					$field_linkedin = str_replace( 'https://www.linkedin.com/in/', '', $field_linkedin );
				}
				update_user_meta( $user_id, 'wpwa_user_linkedin', $field_linkedin );
			}

			wpwebapp_set_alert_message( 'wpwebapp_alert', 'wpwebapp_alert_user_profile', $alert_success );
			wp_safe_redirect( $referer, 302 );
			exit;

		} else {
			die( 'Security check' );
		}
	}
}
add_action('init', 'wpwebapp_process_update_profile');


// Add user profile fields to backend
function wpwebapp_add_user_profile_to_backend( $user ) {
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	?>

		<h3>WordPress for Web Apps User Profile Info</h3>
		<table class="form-table">
			<tr>
				<th><label for="wpwa-name">Name</label></th>
				<td>
					<input type="text" name="wpwa-name" id="wpwa-name" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_name', true) ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-about">About</label></th>
				<td>
					<textarea name="wpwa-about" id="wpwa-about" rows="5" cols="30"><?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_about', true) ); ?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-location">Location</label></th>
				<td>
					<input type="text" name="wpwa-location" id="wpwa-location" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_location', true) ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-email">Public Email</label></th>
				<td>
					<input type="text" name="wpwa-email" id="wpwa-email" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_email', true) ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-website">Website</label></th>
				<td>
					<input type="text" name="wpwa-website" id="wpwa-website" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_website', true) ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-twitter">Twitter</label></th>
				<td>
					<input type="text" name="wpwa-twitter" id="wpwa-twitter" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_twitter', true) ); ?>" class="regular-text">
				</td>
			</tr>
			<tr>
				<th><label for="wpwa-facebook">Facebook</label></th>
				<td>
					<input type="text" name="wpwa-facebook" id="wpwa-facebook" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_facebook', true) ); ?>" class="regular-text">
				</td>
			</tr>

			<tr>
				<th><label for="wpwa-linkedin">LinkedIn</label></th>
				<td>
					<input type="text" name="wpwa-linkedin" id="wpwa-linkedin" value="<?php echo esc_attr( get_user_meta($user_id, 'wpwa_user_linkedin', true) ); ?>" class="regular-text">
				</td>
			</tr>
		</table>

	<?php
}
add_action( 'show_user_profile', 'wpwebapp_add_user_profile_to_backend' );
add_action( 'edit_user_profile', 'wpwebapp_add_user_profile_to_backend' );


// Save backend profile updates
function wpwebapp_save_user_profile_from_backend( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	update_user_meta( $user_id, 'wpwa_user_name', $_POST['wpwa-name'] );
	update_user_meta( $user_id, 'wpwa_user_about', $_POST['wpwa-about'] );
	update_user_meta( $user_id, 'wpwa_user_location', $_POST['wpwa-location'] );
	update_user_meta( $user_id, 'wpwa_user_email', $_POST['wpwa-email'] );
	update_user_meta( $user_id, 'wpwa_user_website', $_POST['wpwa-website'] );
	update_user_meta( $user_id, 'wpwa_user_twitter', $_POST['wpwa-twitter'] );
	update_user_meta( $user_id, 'wpwa_user_facebook', $_POST['wpwa-facebook'] );
	update_user_meta( $user_id, 'wpwa_user_linkedin', $_POST['wpwa-linkedin'] );
}
add_action( 'personal_options_update', 'wpwebapp_save_user_profile_from_backend' );
add_action( 'edit_user_profile_update', 'wpwebapp_save_user_profile_from_backend' );

?>