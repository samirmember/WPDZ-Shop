<?php
$merchant = $_POST['merchant'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$orderid = $_POST['orderid'];
$subject = $_POST['subject'];
$language = $_POST['language'];
$paiementid = $_POST['paiementid'];
$authcode = $_POST['authcode'];
$payer_email = $_POST['ref1'];

$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_purchase (id_purchase, subject, amount, currency, id_user, payer_email, date_purchase, paiementid, authcode, payment_method, state_purchase)
			VALUES(".$orderid.", '".$subject."', '".$amount."', '".$currency."', ".$current_user->ID.", '".$payer_email."', now(), '".$paiementid."', '".$authcode."', 'ePay', 'Validated')");
$mycart = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user =".$current_user->ID);
	foreach ($mycart as $product){	
		$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_product_purchase (id_purchase, id_product, quantity)
			VALUES(".$orderid.", ".$product->id_product.", ".$product->quantite.")");
	}
$delete = $wpdb->query("DELETE FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user = ".$current_user->ID);
?>