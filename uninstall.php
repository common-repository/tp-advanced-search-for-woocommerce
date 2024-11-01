<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://www.tplugins.com/shop
 * @since      1.0.0
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;
$table_name = $wpdb->prefix . 'tpasfw_searches';
$sql = "DROP TABLE IF EXISTS $table_name;";
$wpdb->query($sql);

delete_option( 'tpasfw_display_site_logo' );
delete_option( 'tpasfw_display_cart_icon' );
delete_option( 'tpasfw_display_my_account_icon' );
delete_option( 'tpasfw_style_color' );
delete_option( 'tpasfw_display_shop_categories' );
delete_option( 'tpasfw_style_size' );
delete_option( 'tpasfw_owl_loop' );
delete_option( 'tpasfw_owl_nav' );
delete_option( 'tpasfw_owl_dots' );
delete_option( 'tpasfw_owl_rtl' );
delete_option( 'tpasfw_owl_autoplay' );
delete_option( 'tpasfw_owl_autoplayTimeout' );
delete_option( 'tpasfw_results_font_size' );
delete_option( 'tpasfw_results_pt_color' );
delete_option( 'tpasfw_categories_title' );
delete_option( 'tpasfw_search_input_border_radius' );
delete_option( 'tpasfw_custom_css' );
delete_option( 'tpasfw_loading_background' );
delete_option( 'tpasfw_autocomplete_minlength' );
delete_option( 'tpasfw_no_result' );
delete_option( 'tpasfw_logo_max_height' );
delete_option( 'tpasfw_site_logo' );
delete_option( 'tpasfw_search_input_border_style' );
delete_option( 'tpasfw_search_input_border_color' );
delete_option( 'tpasfw_search_input_border_top' );
delete_option( 'tpasfw_search_input_border_right' );
delete_option( 'tpasfw_search_input_border_bottom' );
delete_option( 'tpasfw_search_input_border_left' );
delete_option( 'tpasfw_hide_product_price' );
delete_option( 'tpasfw_display_categories_in_results' );
delete_option( 'tpasfw_cart_icon' );
delete_option( 'tpasfw_my_account_icon' );
delete_option( 'tpasfw_loading_type' );
delete_option( 'tpasfw_screen_items_desktop' );
delete_option( 'tpasfw_screen_items_tablet' );
delete_option( 'tpasfw_screen_items_mobile' );
delete_option( 'tpasfw_owl_arrow_left' );
delete_option( 'tpasfw_cat_border_radius' );
delete_option( 'tpasfw_search_input_max_width' );
delete_option( 'tpasfw_label_sale' );
delete_option( 'tpasfw_save_searches' );
delete_option( 'tpasfw_image_type' );
delete_option( 'tpasfw_search_input_focus_background' );
delete_option( 'tpasfw_search_input_placeholder' );
delete_option( 'tpasfw_logo_position' );
delete_option( 'tpasfw_display_order_by' );
delete_option( 'tpasfw_pagination_active' );
delete_option( 'tpasfw_pagination_items' );
delete_option( 'tpasfw_activate_cache' );
// delete_option( 'xxx' );
// delete_option( 'xxx' );
// delete_option( 'xxx' );
// delete_option( 'xxx' );
// delete_option( 'xxx' );
// delete_option( 'xxx' );