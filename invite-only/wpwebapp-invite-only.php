<?php

/* ======================================================================

	WordPress for Web App Invite-Only
	Functions to manage and process invite-only sites and apps.

 * ====================================================================== */


/* ======================================================================
	VERIFY INVITATION
	Compare sign-up email against invited emails.
 * ====================================================================== */

function wpwebapp_verify_invite_status( $email ) {

	$invitees = wpwebapp_get_invitees();

	foreach ( $invitees as $invitee ) {
		if ( strcasecmp( trim( $email ),  trim( $invitee ) ) == 0 ) {
			return true;
		}
	}

	return false;

}
