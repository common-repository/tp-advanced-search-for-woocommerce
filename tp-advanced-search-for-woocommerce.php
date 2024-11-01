<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.tplugins.com/shop
 * @since             1.0.0
 * @package           Tp_Advanced_Search_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       TP Advanced Search For WooCommerce
 * Plugin URI:        https://www.tplugins.com
 * Description:       Transforms your Sope site with an advanced, customizable WooCommerce search feature, offering dynamic, responsive product and category results with rich visual and interactive elements.
 * Version:           1.0.0
 * Author:            TP Plugins
 * Author URI:        https://www.tplugins.com/shop/
 * Text Domain:       tpasfw
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * WC requires at least: 3.5
 * WC tested up to: 8.4.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TPASFW_PLUGIN_VERSION', '1.0.0');
define('TPASFW_PLUGIN_NAME', 'TP Advanced Search For WooCommerce');
define('TPASFW_PLUGIN_MENU_NAME', 'Advanced Search');
define('TPASFW_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('TPASFW_PLUGIN_HOME', 'https://www.tplugins.com/');
define('TPASFW_PLUGIN_API', 'https://www.tplugins.com/tp-services');
define('TPASFW_PLUGIN_SLUG', 'tp-advanced-search-for-woocommerce');
define('TPASFW_PLUGIN_SLUG_PRO', 'tp-advanced-search-for-woocommerce-pro');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tp-advanced-search-for-woocommerce-activator.php
 */
function activate_tpasfw_advanced_search_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-advanced-search-for-woocommerce-activator.php';
	Tp_Advanced_Search_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tp-advanced-search-for-woocommerce-deactivator.php
 */
function deactivate_tpasfw_advanced_search_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-advanced-search-for-woocommerce-deactivator.php';
	TPASFW_Advanced_Search_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tpasfw_advanced_search_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_tpasfw_advanced_search_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tp-advanced-search-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tpasfw_advanced_search_for_woocommerce() {

	$plugin = new TPASFW_Advanced_Search_For_Woocommerce();
	$plugin->run();

}
run_tpasfw_advanced_search_for_woocommerce();