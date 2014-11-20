<?php

	/**
	 * Include WP for Web App styles in the header
	 */
	function wpwebapp_add_styles() {
		?>
			<style>
				.wpwebapp-signup-name-field {
					display: none;
					visibility: hidden;
				}
			</style>
		<?php
	}
	add_action('wp_head', 'wpwebapp_add_styles', 30);