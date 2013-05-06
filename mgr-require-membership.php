<?php
/*
Plugin Name: Require Membership
Description: Crazy-simple way to require people to log in to view your content.
Version: 1.0
Author: Bigdawggi
Author URI: http://bigdawggi.com
*/

function bd_require_membership() {
	if (defined('DOING_CRON') && DOING_CRON) { return; }
	if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) { return; }

	if (
		!is_user_logged_in()
		&& !preg_match('|^/wp-login\.php|', $_SERVER['REQUEST_URI'])
	) {
		wp_redirect(wp_login_url());
		exit;
	}
}
add_action('wp_loaded', 'bd_require_membership');
