<?php
function wpdzshop_epay_successfull() {
	global $user_ID;
	global $current_user;
	global $wpdb;
	include 'frontend/shortcodes/wpdzshop-epay-successfull.php';
	return true;
}
add_shortcode( 'wpdzshop_epay_successfull', 'wpdzshop_epay_successfull' );
function wpdzshop_epay_notify_successfull() {
	global $user_ID;
	global $current_user;
	global $wpdb;
	include 'frontend/shortcodes/wpdzshop-epay-notify-successfull.php';
	// return true;
}
add_shortcode( 'wpdzshop_epay_notify_successfull', 'wpdzshop_epay_notify_successfull' );


function wpdzshop_paypal_successfull() {
	global $user_ID;
	global $current_user;
	global $wpdb;
	include 'frontend/shortcodes/wpdzshop-paypal-successfull.php';
	// return true;
}
add_shortcode( 'wpdzshop_paypal_successfull', 'wpdzshop_paypal_successfull' );
function wpdzshop_paypal_notify_successfull() {
	global $user_ID;
	global $current_user;
	global $wpdb;
	include 'frontend/shortcodes/wpdzshop-paypal-notify-successfull.php';
	// return true;
}
add_shortcode( 'wpdzshop_paypal_notify_successfull', 'wpdzshop_paypal_notify_successfull' );

function wpdzshop_cart() {
	global $user_ID;
	global $current_user;
	global $wpdb;
	include 'frontend/shortcodes/wpdzshop-cart.php';
	// return true;
}
add_shortcode( 'wpdzshop_showcart', 'wpdzshop_cart' );