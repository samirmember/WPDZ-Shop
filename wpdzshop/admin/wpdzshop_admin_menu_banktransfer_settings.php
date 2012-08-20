<div class="wrap">
<?php screen_icon(); ?>
<h2>WPDZ Shop - Bank Transfer Settings</h2>
<br/>
<form action="options.php" method="post">
    <?php settings_fields( 'wpdz_shop_banktransfer' ); ?>
<table width="100%" border="0">
  <tr>
    <td width="10%"><label for="fax_banktransfer">Fax</label></td>
    <td><input name="fax_banktransfer" type="text" id="fax_banktransfer" value="<?php echo get_option('fax_banktransfer'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="email_banktransfer">E-Mail</label></td>
    <td><input name="email_banktransfer" type="text" id="email_banktransfer" value="<?php echo get_option('email_banktransfer'); ?>" /></td>
  </tr>
   <tr>
    <td width="10%"><label for="tel_banktransfer">Téléphone</label></td>
    <td><input name="tel_banktransfer" type="text" id="tel_banktransfer" value="<?php echo get_option('tel_banktransfer'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="accountname_banktransfer">Account Name</label></td>
    <td><input name="accountname_banktransfer" type="text" id="accountname_banktransfer" value="<?php echo get_option('accountname_banktransfer'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="accountnumber_banktransfer">Account Number</label></td>
    <td><input name="accountnumber_banktransfer" type="text" id="accountnumber_banktransfer" value="<?php echo get_option('accountnumber_banktransfer'); ?>" /></td>
  </tr>
</table>
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>
</div>