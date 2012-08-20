<?php
function CurrentPageURL() {
	$pageURL = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
	$pageURL .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	return $pageURL;
}

//Check if there is a PAYPAL Page, and get the ID of the Page
function whereIsPaypal() {
	$whereismypaypalpage = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content = '[wpdzshop_paypal_notify_successfull]' AND post_status='publish'");
	$message=true;
	if ($whereismypaypalpage == null) {
		$message="Vous n'avez pas encore de page de validation pour paypal. Vous pouvez en ajouter en créant une page avec le contenu [wpdzshop_paypal_notify_successfull]";
	}
	return $message;
}
?>