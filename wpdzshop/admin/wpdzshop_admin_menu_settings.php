<div class="wrap">
<h2>WPDZ Shop - Setting of the Store</h2>
<br/>
<form action="options.php" method="post">
	<?php settings_fields( 'wpdz_shop_settings' ); ?>
	<table width="100%" border="0">
	  <tr>
		<td width="15%"><label for="shop_email">Shop E-mail</label></td>
		<td>
			<input name="shop_email" type="text" id="shop_email" value="<?php echo get_option('shop_email'); ?>" />
		</td>
	  </tr>
	  <tr>
		<td width="15%"><label for="shop_tel">Shop Telephone</label></td>
		<td>
			<input name="shop_tel" type="text" id="shop_tel" value="<?php echo get_option('shop_tel'); ?>" />
		</td>
	  </tr>
	  <tr>
		<td width="15%"><label for="shipping_shop">Shipping</label></td>
		<td>
			<input type="radio" name="shipping_shop" id="shipping_shop" value="active" <?php if (get_option('shipping_shop')=="active") { echo 'checked="checked"';} ?>/>
			<label for="shipping_shop">Activate</label>
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="shipping_shop" id="shipping_shop2" value="desactive" <?php if (get_option('shipping_shop')=="desactive") { echo 'checked="checked"';} ?>/>
			<label for="shipping_shop2">Desactivate</label>
		</td>
	  </tr>
	  <tr>
		<td width="15%"><br/><h3>Exchange Rate</h3></td>
		<td>
		</td>
	  </tr>
	  
	  <tr>
		<td width="15%"><label for="exchange_usd">01 USD&nbsp;&nbsp;&nbsp;= </label></td>
		<td>
			<input name="exchange_usd" type="text" id="exchange_usd" value="<?php echo get_option('exchange_usd'); ?>" /> DZD
		</td>
	  </tr>
	  <tr>
		<td width="15%"><label for="exchange_eur">01 EUR&nbsp;&nbsp;&nbsp;= </label></td>
		<td>
			<input name="exchange_eur" type="text" id="exchange_eur" value="<?php echo get_option('exchange_eur'); ?>" /> DZD
		</td>
	  </tr>
	  <tr>
		<td width="15%"><br/><h3>Activate/Desactivate Payment Method</h3></td>
		<td>
		</td>
	  </tr>
	  <?php $my_method=get_option('payment_method_active'); if (isset($my_method)) $my_method[]='0'; ?>
	  <tr>
		<td width="15%"><label for="payment_method">Payment Method</label></td>
		<td>
		  <input name="payment_method_active[]" disabled="disabled" type="checkbox" readonly id="payment_method_active" value="Paypal" checked="checked" />
		  <label for="payment_method_active">Paypal</label>
		  <input name="payment_method_active[]" type="checkbox" id="payment_method_active" value="ePay" <?php if (in_array("ePay", $my_method)) echo 'checked="checked"'; ?> />
		  <label for="payment_method_active">ePay</label>
		  <input name="payment_method_active[]" type="checkbox" id="payment_method_active" value="Bank Transfer" <?php if (in_array("Bank Transfer", $my_method)) echo 'checked="checked"'; ?> />
		  <label for="payment_method_active">Bank Transfer</label>
		  <input name="payment_method_active[]" type="checkbox" id="payment_method_active" value="Mandat CCP" <?php if (in_array("Mandat CCP", $my_method)) echo 'checked="checked"'; ?> />
		  <label for="payment_method_active">Mandat CCP</label>
		</td>
	  </tr>
	</table>
	<br/>
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>
</div>