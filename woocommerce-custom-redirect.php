<?php
/*
 * Plugin Name: Woocommerce Add-to-Cart Custom Redirect
 * Plugin URI: http://www.engagewp.com/
 * Description: Redirect customers to a defined URL after a WooCommerce product is added to the cart.
 * Author: Ren Ventura
 * Author URI: http://www.engagewp.com
 * Version: 1.2
 * License: GPL 2.0
 * Text Domain: woocommerce
*/

 /*

	Copyright 2015  Ren Ventura

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	Permission is hereby granted, free of charge, to any person obtaining a copy of this
	software and associated documentation files (the "Software"), to deal in the Software
	without restriction, including without limitation the rights to use, copy, modify, merge,
	publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons
	to whom the Software is furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or
	substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.

*/

//* Add/Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'rv_woo_add_custom_general_fields' );
function rv_woo_add_custom_general_fields() {

	global $post_id, $woocommerce, $post;

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
add_filter( 'woocommerce_add_to_cart_redirect', 'rv_redirect_to_url' );
function rv_redirect_to_url() {

	global $woocommerce, $post;

	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );

	$rv_woo_redirect_url = get_post_meta( $product_id, '_rv_woo_product_custom_redirect_url', true );

	if ( ! empty( $rv_woo_redirect_url ) ) {

		wp_redirect( esc_url( $rv_woo_redirect_url ) ); exit;

	}

}
