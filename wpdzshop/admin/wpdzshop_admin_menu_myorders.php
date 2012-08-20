<?php 
global $current_user;

//DELETING THE ORDERS
if ($_GET) {
	include 'wpdzshop_admin_menu_myorders_actions.php';
}
?>
<div class="wrap">
<h2>My Orders</h2>

<table width="100%" style="border: 1px solid #CCC"  cellpadding="0" cellspacing="0">
  <caption align="left">
    Order List
  </caption>
  <tr>
    <th scope="col">N°</th>
    <th scope="col">Products</th>
    <th scope="col">Amount</th>
    <th scope="col">Currency</th>
    <th scope="col">User</th>
    <th scope="col">Email</th>
    <th scope="col">Date</th>
    <th scope="col">Payment Method</th>
    <th scope="col">State</th>
    <th scope="col">Action</th>
  </tr>
<?php 
// Numero de page (1 par défaut)
if( isset($_GET['pg']) && is_numeric($_GET['pg']) )
	$page = $_GET['pg'];
else
	$page = 1;
// Nombre d'infos par page
$pagination = 20;
// Numéro du 1er enregistrement à lire
$limit_start = ($page - 1) * $pagination;
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

echo (strftime("%A %d %B %Y")); 

$myorder = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."wpdzshop_purchase LIMIT $limit_start, $pagination");
if ($myorder != null) {
	foreach ($myorder as $order){
		//Get User name
		$thisuser = $order->id_user;
		$myuser = $wpdb->get_row("SELECT first_name, last_name FROM ".$wpdb->prefix."wpdzshop_customer WHERE id_user =".$order->id_user);
		$my_user = $myuser->first_name." ".$myuser->last_name;
?>
  <tr>
    <td align="center"><?php echo $order->id_purchase;?></td>
    <td align="center"><a href="#" onclick="window.open('../wp-content/plugins/wpdzshop/productlist.php?orderid=<?php echo $order->id_purchase;?>','nom','toolbar=0,menubar=0,location=0,scrollbars=auto,width=700,height=500')"><?php echo $order->subject;?></a></td>
    <td align="center"><?php echo $order->amount;?></td>
    <td align="center"><?php echo $order->currency;?></td>
    <td align="center"><?php echo $my_user;?></td>
    <td align="center"><?php echo $order->payer_email;?></td>
    <td align="center"><?php echo $order->date_purchase;?></td>
    <td align="center"><?php echo $order->payment_method;?></td>
    <td align="center"><?php echo $order->state_purchase;?></td>
    <td align="center">
		<a href="<?php echo CurrentPageURL(); ?>&id=<?php echo $order->id_purchase;?>&validate=ok"><img src="../wp-content/plugins/wpdzshop/images/validate.png" width="16" height="17" alt="Validate the order"></a>
		
		<a href="<?php echo CurrentPageURL(); ?>&id=<?php echo $order->id_purchase;?>&waiting=ok"><img src="../wp-content/plugins/wpdzshop/images/waiting.png" width="16" height="16" alt="Put the order on Waiting"></a>
		
		<a href="<?php echo CurrentPageURL(); ?>&id=<?php echo $order->id_purchase;?>&cancel=ok"><img src="../wp-content/plugins/wpdzshop/images/cancel.png" width="16" height="17" alt="Cancel the order"></a>
		
		<a href="<?php echo CurrentPageURL(); ?>&id=<?php echo $order->id_purchase;?>&del=ok"><img src="../wp-content/plugins/wpdzshop/images/trash.png" width="16" height="17" alt="Delete the order"></a>
	</td>
  </tr>
<?php
	}
} else {
?>
<br/>
<span class="message"> There is no order</span>
<?php }
?>

</table>
<?php 
// Nb d'enregistrement total
$nb_total = mysql_query("SELECT COUNT(*) AS nb_total FROM ".$wpdb->prefix."wpdzshop_purchase");
$nb_total = mysql_fetch_array($nb_total);
$nb_total = $nb_total['nb_total'];

// Pagination
$nb_pages = ceil($nb_total / $pagination);
$myurl=CurrentPageURL();
 // $myurl=explode('&pg')
echo '<p>[ Page :';
// Boucle sur les pages
for ($i = 1 ; $i <= $nb_pages ; $i++) {
    if ($i == $page )
        echo " $i";
    else
        echo " <a href=\"$myurl&pg=$i\">$i</a> ";
}
echo ' ]</p>';

?>

</div>
<!--
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/blitzer/jquery-ui.css" type="text/css" />
<script>
$(function() {
	$( "#dialog-confirm" ).dialog({
		resizable: false,

		modal: true,
		buttons: {
			"Yes! Delete.": function() {
				$( this ).dialog( "close" );
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
});
</script>
<div id="dialog-confirm" title="Delete the order?">
	<p>Are you sure?</p>
</div>-->
