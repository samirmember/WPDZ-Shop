<?php
//Check if there is a CART, and get the ID of the CART
$whereismyepaypage = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content = '[wpdzshop_epay_successfull]' AND post_status='publish'");
$message="";
if ($whereismyepaypage == null) {
	$message="Vous n'avez pas encore de page de validation pour ePay. Vous pouvez en ajouter en créant une page avec le contenu [wpdzshop_epay_successfull]";
	?>
	<span class="message"><?php echo $message; ?></span>
	<?php
} else {
	$merchant = $_POST['merchant'];
	$amount = $_POST['amount'];
	$currency = $_POST['currency'];
	$orderid = $_POST['orderid'];
	$subject = $_POST['subject'];
	$language = $_POST['language'];
	$paiementid = $_POST['paiementid'];
	$authcode = $_POST['authcode'];
	$payer_email = $_POST['ref1'];
	// $md5hash = $_POST['md5hash'];
	// $sessionid = $_POST['sessionid'];


	$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_purchase (id_purchase, subject, amount, currency, id_user, payer_email, date_purchase, paiementid, authcode, payment_method, state_purchase)
				VALUES(".$orderid.", '".$subject."', '".$amount."', '".$currency."', ".$current_user->ID.", '".$payer_email."', now(), '".$paiementid."', '".$authcode."', 'ePay', 'Validated')");
	$mycart = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user =".$current_user->ID);
		foreach ($mycart as $product){		
			$wpdb->query("INSERT INTO ".$wpdb->prefix."wpdzshop_product_purchase (id_purchase, id_product, quantity)
				VALUES(".$orderid.", ".$product->id_product.", ".$product->quantite.")");
		}
	$delete = $wpdb->query("DELETE FROM ".$wpdb->prefix."wpdzshop_cart WHERE id_user = ".$current_user->ID);
	?>
	<h2>ePay Order</h2>
	<br/>
	You have order <strong>"<?php echo $subject;?>"</strong> using your ePay account
	<br/><br/>
	Any Problem contact us:<br/>
	<?php echo get_option('shop_email'); ?>
	<br/>
	<?php echo get_option('shop_tel'); 
}?>