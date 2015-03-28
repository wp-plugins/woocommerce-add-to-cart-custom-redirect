=== WooCommerce Add to Cart Custom Redirect ===
Contributors: EngageWP
Tags: WooCommerce
Tested up to: 4.2
Stable tag: 1.2
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Set your WooCommerce products to redirect to a custom URL when added to the cart.

== Description ==

This plugin adds a field to the Edit Product page (under the General product info) that accepts a URL from the administrator or shop manager. When this field is set, the front-end user (customer) will be redirected to the URL when that product is added to the cart. This can be useful if you want to automatically prompt your customers to purchase other products. 

== Installation ==

This section describes how to install the plugin and get it working.

<h2>Automatically</h2>

1. Search for WooCommerce Add to Cart Custom Redirect in the Add New Plugin section of the WordPress admin
2. Install & Activate

<h2>Manually</h2>

1. Download the zip file and upload `woocommerce-custom-redirect` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I use this plugin? =

Install, activate, and paste your URL into the Redirect on Add to Cart field under the General product data tab. If you want to utilize the redirect feature on product archive pages, make sure to uncheck the "Enable AJAX add to cart buttons on archives" checkbox under the WooCommerce settings Products tab.

= Do you offer support for this plugin? =

This plugin is very simple so it's unlikely you'll need support. If you do have any questions, feel free to <a href="http://www.engagewp.com/contact" target="_blank">email me</a>. 

== Screenshots ==

1. The WooCommerce Add to Cart Custom Redirect URL field.

== Changelog ==

= 1.2 =
* Replaced deprecated add_to_cart_redirect filter with woocommerce_add_to_cart_redirect

= 1.1 =
* Added support for redirects on product archive pages

= 1.0 =
* Initial version