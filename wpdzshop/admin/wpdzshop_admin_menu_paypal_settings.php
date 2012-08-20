<div class="wrap">
<?php screen_icon(); ?>
<h2>WPDZ Shop - Paypal Settings</h2>
<br/>
<form action="options.php" method="post">
    <?php settings_fields( 'wpdz_shop_paypal' ); ?>
    <?php //do_settings( 'wpdz_shop_options' ); ?>
<table width="100%" border="0">
  <tr>
    <td width="10%"><label for="account_type">Account Type</label></td>
    <td><select name="account_type" id="account_type">
	  <option value="0" <?php if (get_option('account_type')=='0') { echo 'selected'; } ?>>Paypal Test</option>
	  <option value="1" <?php if (get_option('account_type')=='1') { echo 'selected'; } ?>>Paypal Live</option>
	</select></td>
  </tr>
  <tr>
    <td width="10%"><label for="login_account">Login</label></td>
    <td><input name="login_account" type="text" id="login_account" value="<?php echo get_option('login_account'); ?>" size="50" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="return_url">Return URL</label></td>
    <td><input name="return_url" type="text" id="return_url" value="<?php echo get_option('return_url'); ?>" size="50"/></td>
  </tr>
  <tr>
    <td width="10%"><label for="currency_code">Devise</label></td>
    <td><select name="currency_code" id="currency_code">
		<!--<option value="AUD" <?php if (get_option('currency_code')=='AUD') { echo 'selected'; } ?>>Australian Dollar</option>
		<option value="BRL" <?php if (get_option('currency_code')=='BRL') { echo 'selected'; } ?>>Brazilian Real</option>
		<option value="CAD" <?php if (get_option('currency_code')=='CAD') { echo 'selected'; } ?>>Canadian Dollar</option>
		<option value="CZK" <?php if (get_option('currency_code')=='CZK') { echo 'selected'; } ?>>Czech Koruna</option>
		<option value="DKK" <?php if (get_option('currency_code')=='DKK') { echo 'selected'; } ?>>Danish Krone</option>-->
		<option value="EUR" <?php if (get_option('currency_code')=='EUR') { echo 'selected'; } ?>>Euro</option>
		<!--<option value="HKD" <?php if (get_option('currency_code')=='HKD') { echo 'selected'; } ?>>Hong Kong Dollar</option>
		<option value="HUF" <?php if (get_option('currency_code')=='HUF') { echo 'selected'; } ?>>Hungarian Forint</option>
		<option value="ILS" <?php if (get_option('currency_code')=='ILS') { echo 'selected'; } ?>>Israeli New Sheqel</option>
		<option value="JPY" <?php if (get_option('currency_code')=='JPY') { echo 'selected'; } ?>>Japanese Yen</option>
		<option value="MYR" <?php if (get_option('currency_code')=='MYR') { echo 'selected'; } ?>>Malaysian Ringgit</option>
		<option value="MXN" <?php if (get_option('currency_code')=='MXN') { echo 'selected'; } ?>>Mexican Peso</option>
		<option value="NOK" <?php if (get_option('currency_code')=='NOK') { echo 'selected'; } ?>>Norwegian Krone</option>
		<option value="NZD" <?php if (get_option('currency_code')=='NZD') { echo 'selected'; } ?>>New Zealand Dollar</option>
		<option value="PHP" <?php if (get_option('currency_code')=='PHP') { echo 'selected'; } ?>>Philippine Peso</option>
		<option value="PLN" <?php if (get_option('currency_code')=='PLN') { echo 'selected'; } ?>>Polish Zloty</option>
		<option value="GBP" <?php if (get_option('currency_code')=='GBP') { echo 'selected'; } ?>>Pound Sterling</option>
		<option value="SGD" <?php if (get_option('currency_code')=='SGD') { echo 'selected'; } ?>>Singapore Dollar</option>
		<option value="SEK" <?php if (get_option('currency_code')=='SEK') { echo 'selected'; } ?>>Swedish Krona</option>
		<option value="CHF" <?php if (get_option('currency_code')=='CHF') { echo 'selected'; } ?>>Swiss Franc</option>
		<option value="TWD" <?php if (get_option('currency_code')=='TWD') { echo 'selected'; } ?>>Taiwan New Dollar</option>
		<option value="THB" <?php if (get_option('currency_code')=='THB') { echo 'selected'; } ?>>Thai Baht</option>
		<option value="TRY" <?php if (get_option('currency_code')=='TRY') { echo 'selected'; } ?>>Turkish Lira</option>-->
		<option value="USD" <?php if (get_option('currency_code')=='USD') { echo 'selected'; } ?>>U.S. Dollar</option>
	</select></td>
  </tr>
</table>
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>
</div>