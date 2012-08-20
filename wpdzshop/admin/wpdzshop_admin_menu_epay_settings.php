<div class="wrap">
<h2>ePay Configuration Page</h2>
<form action="options.php" method="post">
	 <?php settings_fields( 'wpdz_shop_epay' ); ?>
	<table width="510">
		<tr valign="top">
			<th width="178" scope="row">Id Client</th>
			<td width="320">
				<input name="merchant" type="text" id="merchant" value="<?php echo get_option('merchant'); ?>" />
			</td>
		</tr>
		<!--<tr>
			<th width="178" scope="row">Devise</th>
			<td width="320">
				<select name="currency">
				  <option value="DZD" <?php if (get_option('currency')=='DZD') { echo 'selected'; } ?>>DZD (Algerian Dinar)</option>
				  <option value="USD" <?php if (get_option('currency')=='USD') { echo 'selected'; } ?>>USD (American Dollar)</option>
				  <option value="EUR" <?php if (get_option('currency')=='EUR') { echo 'selected'; } ?>>EUR (Euro)</option>
				</select>
			</td>
		</tr>-->
		<tr>
			<th width="178" scope="row">Langue</th>
			<td width="320">
				<select name="language">
				  <option value="fr" <?php if (get_option('currency')=='fr') { echo 'selected'; } ?>>Français</option>
				  <option value="ar" <?php if (get_option('currency')=='ar') { echo 'selected'; } ?>>Arabe</option>
				  <option value="en" <?php if (get_option('currency')=='en') { echo 'selected'; } ?>>Anglais</option>
				</select>
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Lien de validation</th>
			<td width="320">
				<input name="returnurl" type="text" id="returnurl" value="<?php echo get_option('returnurl'); ?>" size="50"/>
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Lien d'echec</th>
			<td width="320">
				<input name="cancelurl" type="text" id="cancelurl" value="<?php echo get_option('cancelurl'); ?>" size="50"/>
			</td>
		</tr>
		<!--<tr>
			<th width="178" scope="row">Lien de notification</th>
			<td width="320">
				<input name="statusurl" type="text" id="statusurl" value="<?php //echo get_option('statusurl'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°1</th>
			<td width="320">
				<input name="ref1" type="text" id="ref1" value="<?php echo get_option('ref1'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°2</th>
			<td width="320">
				<input name="ref2" type="text" id="ref2" value="<?php echo get_option('ref2'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°3</th>
			<td width="320">
				<input name="ref3" type="text" id="ref3" value="<?php echo get_option('ref3'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°4</th>
			<td width="320">
				<input name="ref4" type="text" id="ref4" value="<?php echo get_option('ref4'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°5</th>
			<td width="320">
				<input name="ref5" type="text" id="ref5" value="<?php echo get_option('ref5'); ?>" />
			</td>
		</tr>
		<tr>
			<th width="178" scope="row">Données optionnel n°6</th>
			<td width="320">
				<input name="ref6" type="text" id="ref6" value="<?php echo get_option('ref6'); ?>" />
			</td>
		</tr>-->
	</table>
	<p>
	<input type="submit" value="<?php _e('Enregistrer') ?>" />
	</p>
</form>
</div>