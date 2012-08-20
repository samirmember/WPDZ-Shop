<?php
$id=$_GET['id'];

// ORDER Validate
if (isset($_GET['validate'])) {

	$valid = $wpdb->query("UPDATE  ".$wpdb->prefix."wpdzshop_purchase SET state_purchase = 'Validated' WHERE id_purchase = $id");
	header ("Location: admin.php?page=wpdz_shop_myorders&do=validated");
	

}
else if (isset($_GET['waiting'])) {
	$valid = $wpdb->query("UPDATE  ".$wpdb->prefix."wpdzshop_purchase SET state_purchase = 'Waiting' WHERE id_purchase = $id");
	header ("Location: admin.php?page=wpdz_shop_myorders&do=waited");
}
else if (isset($_GET['cancel'])) {
	$valid = $wpdb->query("UPDATE  ".$wpdb->prefix."wpdzshop_purchase SET state_purchase = 'Canceled' WHERE id_purchase = $id");
	header ("Location: admin.php?page=wpdz_shop_myorders&do=canceled");
}
//ORDER DELETE
else if (isset($_GET['del'])) {
	$delete = $wpdb->query("DELETE FROM ".$wpdb->prefix."wpdzshop_purchase WHERE id_purchase =".$id);
	$delete2 = $wpdb->query("DELETE FROM ".$wpdb->prefix."wpdzshop_product_purchase WHERE id_purchase =".$id);
	header ("Location: admin.php?page=wpdz_shop_myorders&do=deleted");
}