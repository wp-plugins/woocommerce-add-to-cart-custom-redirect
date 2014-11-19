<?php
/*
 * Plugin Name: Woocommerce Add-to-Cart Custom Redirect
 * Plugin URI: http://engagewp.com/woocommerce-add-to-cart-custom-redirect
 * Description: Redirect customers to a defined URL after a WooCommerce product is added to the cart.
 * Author: Ren Ventura
 * Author URI: http://engagewp.com
 * Version: 1.1
 * License: GPL 2.0
 * Text Domain: woocommerce
*/

//* Add/Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'rv_woo_add_custom_general_fields' );
function rv_woo_add_custom_general_fields() {

	global $post_id;
	global $woocommerce, $post;

	echo '<div class="options_group">';

	woocommerce_wp_text_input(

		array(
			'id'          => '_rv_woo_product_custom_redirect_url',
			'label'       => __( 'Redirect on Add to Cart', 'woocommerce' ),
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter a URL to redirect the user to after this product is added to the cart.', 'woocommerce' ) ,
			'value' => get_post_meta( $post_id, '_rv_woo_product_custom_redirect_url', true )
		)

	);

	echo '</div>';

}

//* Save Fields
add_action( 'woocommerce_process_product_meta',  'rv_woo_add_custom_general_fields_save' );
function rv_woo_add_custom_general_fields_save( $post_id ){

	$rv_woo_redirect_url = $_POST['_rv_woo_product_custom_redirect_url'];

	if ( ! empty( $rv_woo_redirect_url ) ) {

		update_post_meta( $post_id, '_rv_woo_product_custom_redirect_url', esc_url( $rv_woo_redirect_url ) );

	}

}

//* Redirect to URL
add_filter( 'add_to_cart_redirect', 'rv_redirect_to_url' );
function rv_redirect_to_url() {

	global $woocommerce, $post;

	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );

	$rv_woo_redirect_url = get_post_meta( $product_id, '_rv_woo_product_custom_redirect_url', true );

	if ( ! empty( $rv_woo_redirect_url ) ) {

		wp_redirect( $rv_woo_redirect_url ); exit;

	}

}
