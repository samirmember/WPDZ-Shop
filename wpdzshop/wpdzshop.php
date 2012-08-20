<?php
/*
Plugin Name: WP DZ SHOP
Plugin URI: http://www.epay.dz/wordpress/
Description: Extension eCommerce de WordPress Algérie
Author: Samir IZZA
Version: 1.0b
Author URI: www.viadeo.com/profile/samir.izza1
*/
include('admin/wpdzshop_admin_menu.php');
include('admin/functions.php');
//Register new post type (Product)
add_action('init', 'wpdzshop_product_register');
function wpdzshop_product_register() {
	$args = array(
				'public' =>   true,
				'query_var' =>  'prodcut',
				'rewrite' =>  array(
					'slug' =>  'shop/product',
					'with_front' =>  false,
				),
				'supports' =>  array(
					'title',
					'editor',
					'excerpt',
					'custom_fields',
					'thumbnail'
				),
				'menu_icon' => plugins_url( 'admin/images/e-logo.png' , __FILE__ ),
	'labels' =>   array(
		'name' =>__('Products'),
		'singular_name' =>__('Product'),
		'add_new' =>  'Add New Product',
		'add_new_item' =>  'Add New product',
		'edit_item' =>  'Edit Product',
		'new_item' =>  'New Product',
		'view_item' =>  'View Product',
		'search_items' =>  'Search Products',
		'not_found' =>  'No Products Found',
	));

	register_post_type( 'product' , $args );
}


//ADD Meta Options for Product
add_action("admin_init", "wpdzshop_admin_init");
function wpdzshop_admin_init(){
	add_meta_box("prodInfo-meta", "Product Options", "wpdzshop_meta_options", "product", "normal", "high");
}

function wpdzshop_meta_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$product_brand = $custom["product_brand"][0];
	$product_price = $custom["product_price"][0];
	$original_price = $custom["original_price"][0];
	$shipping_price = $custom["shipping_price"][0];
	$additional_shipping_price = $custom["additional_shipping_price"][0];
	$product_tax = $custom["product_tax"][0];
?>
<div id="product-options">
 <label>Brand:</label><input name="product_brand" value="<?php echo $product_brand; ?>" /><br>
 <label>Price:</label><input name="product_price" value="<?php echo $product_price; ?>" />DZD<br>
 <label>Original Price</label><input name="original_price" value="<?php echo $original_price; ?>" />DZD<br>
 <label>Shipping Price of the first piece (quantity of 1)</label><input name="shipping_price" value="<?php echo $shipping_price; ?>" /><br>
 <label>Shipping Price of each additional piece (quantity 2 or more)</label><input name="additional_shipping_price" value="<?php echo $additional_shipping_price; ?>" />
 <br/>
 <label>Tax</label>
	<select name="product_tax">
	  <option value="0.07" <?php if ($product_tax=="0.07") echo "selected"; ?>>07%</option>
	  <option value="0.17" <?php if ($product_tax=="0.17") echo "selected"; ?>>17%</option>
	</select>
 </div><!--end product-options-->
<?php
}


//Product Save Meta Options
add_action('save_post', 'wpdzshop_save_meta_options');
function wpdzshop_save_meta_options(){
	global $post;
	update_post_meta($post->ID, "product_brand", $_POST["product_brand"]);
	update_post_meta($post->ID, "product_price", $_POST["product_price"]);
	update_post_meta($post->ID, "original_price", $_POST["original_price"]);
	update_post_meta($post->ID, "shipping_price", $_POST["shipping_price"]);
	update_post_meta($post->ID, "additional_shipping_price", $_POST["additional_shipping_price"]);
	update_post_meta($post->ID, "product_tax", $_POST["product_tax"]);
}


//register product taxonomies
//Categories & Product Tags
add_action('init','wpdzshop_taxonomies');
function wpdzshop_taxonomies(){
	$product_categories_args = array(
		'hierarchical' => true, 
		'query_vars'=>'product_catalog',
		'rewrite' => array(
			'slug'=>'product/catalog',
			'with_front'=>'false',
		), 
		'labels'=>array(
			'name' =>__('Products Catalogs'),
			'singular_name' =>__('Product Catalog'),
			'edit_item' =>__('Edit Products Catalog'),
			'update_item' =>__('Update Products Catalog'),
			'add_new_item' =>__('Add New Products Catalog'),
			'new_item_name' =>__('New Product Catalog name'),
			'all_items' =>__('All Products Catalog'),
			'search_items' =>__('Search Catalog'),
			'parent_item' =>__('Parent Catalog'),
			'parent_item_colon' =>__('Parent Catalog: '),
		), 
	);

	$product_tags_args = array(
		'hierarchical' => false, 
		'query_vars'=>'product_tag',
		'show_tagcloud'=>true,
		'rewrite' => array(
			'slug'=>'product/tags',
			'with_front'=>'false',
		),
		'labels'=>array(
			'name' =>__('Products Tags'),
			'singular_name' =>__('Products Tag'),
			'edit_item' =>__('Edit Products Tag'),
			'update_item' =>__('Update Products Tag'),
			'add_new_item' =>__('Add New Products Tag'),
			'new_item_name' =>__('New Product Tag Name'),
			'all_items' =>__('All Products Tags'),
			'search_items' =>__('Search Tags'),
			'popular_items' =>__('Popular Tags'),
			'separate_items_with_commas' =>__('Separate tags with commas'),
			'add_or_remove_items' =>__('Add or remove tags'),
			'choose_from_most_used' =>__('Choose from the most popular tags'),
		), 
	);
										
	register_taxonomy('product_tag',array('product'),$product_tags_args);
	register_taxonomy('product_catalog',array('product'),$product_categories_args);
}


//Show Products in GRID
add_filter("manage_edit-product_columns", "prod_edit_columns");
add_action("manage_posts_custom_column",  "prod_custom_columns");

function prod_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Product title",
		"thumbnail" => "Thumbnail",
		"description" => "Description",
		"product_price" => "Price",
		"product_catalog" => "Product Catalog",
	);

	return $columns;
}

function prod_custom_columns($column){
	global $post;
	switch ($column)
	{
        case 'thumbnail' :
            if (has_post_thumbnail($post->ID))
                echo get_the_post_thumbnail($post->ID, array(50, 50));
            else
                echo '<em>no thumbnail</em>';
        break;
				
		case "description":
			the_excerpt();
			break;
		case "product_price":
			$custom = get_post_custom();
			echo $custom["product_price"][0];
			break;
		case 'product_catalog':
				echo get_the_term_list($post->ID, 'product_catalog', '', '', '');
		break;
	}
}


/*** Add some Shortcode ***/
include('wpdzshop_shortcode.php');




/**********Actions To Do When Activating the Plugin**********/

function wpdz_shop_install()
{
//Création de deux (02) fichiers
$singleproduct=get_template_directory()."\single-product.php";
$fp = fopen($singleproduct, 'w');
fwrite($fp, '<?php ');
fwrite($fp, ' wp_enqueue_style("hpt_ini", WP_PLUGIN_URL."/wpdzshop/css/style.css");');
fwrite($fp, ' wp_enqueue_script("hpt_ini", WP_PLUGIN_URL."/wpdzshop/js/wpdzshop.js");');
fwrite($fp, ' get_header();');
fwrite($fp, ' the_post();');
fwrite($fp, ' $custom = get_post_custom($post->ID);');
fwrite($fp, ' $product_price = $custom["product_price"][0]." DZD";');
fwrite($fp, ' $product_brand = $custom["product_brand"][0];');
fwrite($fp, ' include "wpdzshop-productshow.php";');
fwrite($fp, ' get_footer(); ?> ');
fclose($fp);

$productshow=get_template_directory()."\wpdzshop-productshow.php";
$fp = fopen($productshow, 'w');
fwrite($fp, '<?php ');
fwrite($fp, '$whereismycart = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE post_content = \"[wpdzshop_showcart]\" AND post_status=\"publish\""); ');
fwrite($fp, '$message=""; $color=""; ');
fwrite($fp, 'if ($whereismycart == null) { $message="Vous n`avez pas encore de panier. Vous pouvez en ajouter en créant une page avec le contenu [wpdzshop_showcart]"; ');
fwrite($fp, '?> ');
fwrite($fp, '<span class="message"><?php echo $message;?></span> ');
fwrite($fp, '<?php ');
fwrite($fp, '} else if (count($whereismycart) > 1) { $message="Vous avez plus d`un panier, vous devez en avoir qu`un seul"; } ');
fwrite($fp, 'else if ($_GET["do"]=="added") { $message="Ce produit à bien été ajouté au panier"; $color="color:green;"; } ');
fwrite($fp, 'else if ($_GET["do"]=="exist") { $message="Ce produit existe déjà dans votre panier!"; } ');
fwrite($fp, 'foreach ($whereismycart as $cart){ ?> ');
fwrite($fp, '<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> ');
fwrite($fp, '<h1 class="entry-title"><?php the_title(); ?> - <?php echo $product_brand; ?></h1> ');
fwrite($fp, '<span class="message" style="<?php echo $color;?>"><?php echo $message;?></span> ');
fwrite($fp, '<div class="entry-meta"> ');
fwrite($fp, '<div class="thumb_product"><?php the_post_thumbnail(); ?></div> ');
fwrite($fp, '<?php the_content(); ?> ');
fwrite($fp, '<?php echo $product_price; ?> ');
fwrite($fp, '<br/> ');
fwrite($fp, '<form method="post" name="buy_form" action="<?php echo get_permalink( $cart->ID ); ?>"> ');
fwrite($fp, '<input type="hidden" name="productid" value="<?php the_ID(); ?>" /> ');
fwrite($fp, '<input type="submit" name="buy" value="Acheter" class="button-primary"/> ');
fwrite($fp, '<input type="submit" name="add" value="Ajouter au panier" class="button-primary"/> ');
fwrite($fp, '</form> ');
fwrite($fp, '</div> ');
fwrite($fp, '<?php } ?> ');
fclose($fp);

//Création des tables
global $wpdb;
$table_cart = $wpdb->prefix."wpdzshop_cart";
$structure = "CREATE TABLE $table_cart (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `added_date` varchar(25) NOT NULL,
  PRIMARY KEY (`id_cart`));";
$wpdb->query($structure);

$table_customer = $wpdb->prefix."wpdzshop_customer";
$structure = "CREATE TABLE $table_customer (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `adress` varchar(250) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `first_name_shipping` varchar(250) NOT NULL,
  `last_name_shipping` varchar(250) NOT NULL,
  `adress_shipping` varchar(255) NOT NULL,
  `city_shipping` varchar(100) NOT NULL,
  `state_shipping` varchar(100) NOT NULL,
  `country_shipping` varchar(100) NOT NULL,
  `postal_code_shipping` varchar(10) NOT NULL,
  PRIMARY KEY (`id_customer`));";
$wpdb->query($structure);

$table_purchase = $wpdb->prefix."wpdzshop_purchase";
$structure = "CREATE TABLE $table_purchase (
  `id_purchase` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `currency` enum('DZD','EUR','USD') NOT NULL,
  `id_user` int(11) NOT NULL,
  `payer_email` varchar(150) NOT NULL,
  `date_purchase` varchar(25) DEFAULT NULL,
  `paiementid` int(11) DEFAULT NULL,
  `authcode` int(6) DEFAULT NULL,
  `payment_method` enum('ePay','Paypal','Bank Transfer','CCP') NOT NULL,
  `state_purchase` enum('Canceled','Validated','Waiting') NOT NULL,
  PRIMARY KEY (`id_purchase`));";
$wpdb->query($structure);

$table_product_purchase = $wpdb->prefix."wpdzshop_product_purchase";
$structure = "CREATE TABLE $table_product_purchase (
  `id_purchase` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_purchase`,`id_product`));";
$wpdb->query($structure);

//INSERT DATAS IN TABLES
$table = $wpdb->prefix."posts";
$option_table = $wpdb->prefix."options";
$wpdb->query("INSERT INTO $table (post_author, post_content, post_title, post_status, comment_status, ping_status, post_name, post_parent, menu_order, post_type, comment_count) VALUES (1, '[wpdzshop_showcart]', 'My cart', 'publish', 'closed', 'open', 'my-cart', 0, 0, 'page', 0)");

$wpdb->query("INSERT INTO $table (post_author, post_content, post_title, post_status, comment_status, ping_status, post_name, post_parent, menu_order, post_type, comment_count) VALUES (1, '[wpdzshop_paypal_notify_successfull]', 'Successfull Payment Notify – Paypal', 'publish', 'closed', 'open', 'successfull-payment-notify-paypal', 0, 0, 'page', 0)");

$wpdb->query("INSERT INTO $table (post_author, post_content, post_title, post_status, comment_status, ping_status, post_name, post_parent, menu_order, post_type, comment_count) VALUES (1, '[wpdzshop_epay_notify_successfull]', 'Successfull Payment Notify – ePay', 'publish', 'closed', 'open', 'successfull-payment-notify-epay', 0, 0, 'page', 0)");


$wpdb->query("INSERT INTO $table (post_author, post_content, post_title, post_status, comment_status, ping_status, post_name, post_parent, menu_order, post_type, comment_count) VALUES (1, '[wpdzshop_paypal_successfull]', 'Successfull Payment – PayPal', 'publish', 'closed', 'open', 'successfull-payment-paypal', 0, 0, 'page', 0)");
$paypalID = mysql_insert_id();
$return_url = get_permalink($paypalID);
if (get_option('return_url') == null) {
	$wpdb->query("INSERT INTO $option_table (blog_id, option_name, option_value, autoload) VALUES (0, 'return_url', '$return_url', 'yes')");
} else {
	$wpdb->query("UPDATE  $option_table SET option_value = '$return_url' WHERE option_name = 'return_url'");
}

$wpdb->query("INSERT INTO $table (post_author, post_content, post_title, post_status, comment_status, ping_status, post_name, post_parent, menu_order, post_type, comment_count) VALUES (1, '[wpdzshop_epay_successfull]', 'Successfull Payment – ePay', 'publish', 'closed', 'open', 'successfull-payment-ePay', 0, 0, 'page', 0)");
$epayID = mysql_insert_id();
$returnurl = get_permalink($epayID);
if (get_option('returnurl') == null) {
	$wpdb->query("INSERT INTO $option_table (blog_id, option_name, option_value, autoload) VALUES (0, 'returnurl', '$returnurl', 'yes')");
} else {
	$wpdb->query("UPDATE  $option_table SET option_value = '$returnurl' WHERE option_name = 'returnurl'");
}

if (get_option('exchange_usd') == null) {
	$wpdb->query("INSERT INTO $option_table (blog_id, option_name, option_value, autoload) VALUES (0, 'exchange_usd', '74.14', 'yes')");
}
if (get_option('exchange_eur') == null) {
	$wpdb->query("INSERT INTO $option_table (blog_id, option_name, option_value, autoload) VALUES (0, 'exchange_eur', '98.38', 'yes')");
}
if (get_option('shipping_shop') == null) {
	$wpdb->query("INSERT INTO $option_table (blog_id, option_name, option_value, autoload) VALUES (0, 'shipping_shop', 'desactive', 'yes')");
}

}

add_action('activate_wpdzshop/wpdzshop.php', 'wpdz_shop_install');


/**********Actions To Do When Desactivating the plugin**********/
function remove_extension()
{
global $wpdb;
$singleproduct=get_template_directory()."\single-product.php";
unlink($singleproduct);
$productshow=get_template_directory()."\wpdzshop-productshow.php";
unlink($productshow);

$table = $wpdb->prefix."wpdzshop_cart";
$wpdb->query("DROP TABLE  $table");

$table = $wpdb->prefix."wpdzshop_customer";
$wpdb->query("DROP TABLE  $table");

$table = $wpdb->prefix."wpdzshop_purchase";
$wpdb->query("DROP TABLE  $table");

$table = $wpdb->prefix."wpdzshop_product_purchase";
$wpdb->query("DROP TABLE  $table");

$table = $wpdb->prefix."posts";
$delete = $wpdb->query("DELETE FROM $table WHERE post_name IN ('my-cart', 'successfull-payment-notify-paypal', 'successfull-payment-notify-epay', 'successfull-payment-epay', 'successfull-payment-paypal')");
}
register_deactivation_hook( __FILE__, 'remove_extension' );