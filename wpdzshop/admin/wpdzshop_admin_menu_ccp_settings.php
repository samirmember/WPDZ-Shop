<div class="wrap">
<?php screen_icon(); ?>
<h2>WPDZ Shop - CCP Settings (Algérie Poste)</h2>
<br/>
<form action="options.php" method="post">
    <?php settings_fields( 'wpdz_shop_ccp' ); ?>
<table width="100%" border="0">
  <tr>
    <td width="10%"><label for="fax_ccp">Fax</label></td>
    <td><input name="fax_ccp" type="text" id="fax_ccp" value="<?php echo get_option('fax_ccp'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="email_ccp">E-Mail</label></td>
    <td><input name="email_ccp" type="text" id="email_ccp" value="<?php echo get_option('email_ccp'); ?>" /></td>
  </tr>
   <tr>
    <td width="10%"><label for="tel_ccp">Téléphone</label></td>
    <td><input name="tel_ccp" type="text" id="tel_ccp" value="<?php echo get_option('tel_ccp'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="ccp_name">Account Name</label></td>
    <td><input name="ccp_name" type="text" id="ccp_name" value="<?php echo get_option('ccp_name'); ?>" /></td>
  </tr>
  <tr>
    <td width="10%"><label for="ccp_number">Account Number</label></td>
    <td><input name="ccp_number" type="text" id="ccp_number" value="<?php echo get_option('ccp_number'); ?>" /></td>
  </tr>
</table>
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</form>
</div>