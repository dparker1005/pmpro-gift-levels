<?php
/*
Plugin Name: Paid Memberships Pro - Gift Levels Add On
Plugin URI: https://www.paidmembershipspro.com/add-ons/pmpro-gift-levels/
Description: Sell a gift certificate that generates a unique gift code for membership to your site.
Version: 1.1.1
Author: Paid Memberships Pro
Author URI: https://www.paidmembershipspro.com
Text Domain: pmpro-gift-levels
Domain Path: /languages
*/

define( 'PMPROGL_VERSION', '1.1.1' );
define( 'PMPROGL_BASE_FILE', __FILE__ );
define( 'PMPROGL_DIR', dirname( __FILE__ ) );

require_once( PMPROGL_DIR . '/includes/functions.php' );

require_once( PMPROGL_DIR . '/includes/admin.php' );    // Set up settings pages.
require_once( PMPROGL_DIR . '/includes/checkout.php' ); // Add functionality to checkout.
require_once( PMPROGL_DIR . '/includes/email.php' );    // Modify emails that are sent.
require_once( PMPROGL_DIR . '/includes/frontend.php' ); // Show content on frontend.

/**
 * Load text domain
 * pmprogl_load_plugin_text_domain
 */
function pmprogl_load_plugin_text_domain() {
	load_plugin_textdomain( 'pmpro-gift-levels', false, basename( PMPROGL_DIR ) . '/languages' ); 
}
add_action( 'init', 'pmprogl_load_plugin_text_domain' ); 

function pmprogl_admin_enqueue_scripts() {
	wp_enqueue_script( 'pmprogl_admin', plugins_url( 'js/pmprogl-admin.js', PMPROGL_BASE_FILE ), array( 'jquery' ), PMPROGL_VERSION  );
}
add_action( 'admin_enqueue_scripts', 'pmprogl_admin_enqueue_scripts' );

/*
Function to add links to the plugin row meta
*/
function pmprogl_plugin_row_meta($links, $file) {
	if(strpos($file, 'pmpro-gift-levels.php') !== false)
	{
		$new_links = array(
			'<a href="' . esc_url( 'https://www.paidmembershipspro.com/add-ons/pmpro-gift-levels/' )  . '" title="' . esc_attr( __( 'View Documentation', 'pmpro-gift-levels' ) ) . '">' . __( 'Docs', 'pmpro-gift-levels' ) . '</a>',
			'<a href="' . esc_url('https://www.paidmembershipspro.com/support/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'pmpro-gift-levels' ) ) . '">' . __( 'Support', 'pmpro-gift-levels' ) . '</a>',
		);
		$links = array_merge($links, $new_links);
	}
	return $links;
}
add_filter('plugin_row_meta', 'pmprogl_plugin_row_meta', 10, 2);
