<?php
/**
 * Plugin Name: QR Code For WooCommerce
 * Description: Add qr code functionality to the products
 * Version: 1.0
 * Author: Jethro Landa
 * Author URI: https://jethrolanda.com/
 * Text Domain: qr-code-for-woocommerce
 * Domain Path: /languages/
 * Requires at least: 5.8
 * Requires PHP: 7.2
 */

defined('ABSPATH') || exit;

if (!defined('QCFW_PLUGIN_FILE')) {
    define('QCFW_PLUGIN_FILE', __FILE__);
}

// Include the main Keyword Censor class.
if (!class_exists('QCFW_Bootstrap', false)) {
    include_once dirname(QCFW_PLUGIN_FILE) . '/includes/class-qcfw-bootstrap.php';
}

function qr_code_for_woocommerce()
{
    return QCFW_Bootstrap::instance();
}

// Global for backwards compatibility.
$GLOBALS['qr_code_for_woocommerce'] = qr_code_for_woocommerce();
