<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.tplugins.com/shop
 * @since      1.0.0
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/includes
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Advanced_Search_For_Woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		self::create_searches_table();

		$custom_logo_id = get_theme_mod('custom_logo');
		$logo_src = ''; // Initialize with an empty string

		if ($custom_logo_id) {
			$image = wp_get_attachment_image_src($custom_logo_id, 'full');
			if ($image) {
				$logo_src = $image[0];
			}
		}

		add_option( 'tpasfw_autocomplete_minlength', 3 );
		add_option( 'tpasfw_display_site_logo', 0 );
		add_option( 'tpasfw_display_cart_icon', 1 );
		add_option( 'tpasfw_display_my_account_icon', 0 );
		add_option( 'tpasfw_style_color', '#000000' );
		add_option( 'tpasfw_display_shop_categories', '' );
		add_option( 'tpasfw_style_size', 15 );
		add_option( 'tpasfw_owl_loop', 1 );
		add_option( 'tpasfw_owl_nav', 1 );
		add_option( 'tpasfw_owl_dots', '' );
		add_option( 'tpasfw_owl_rtl', '' );
		add_option( 'tpasfw_owl_autoplay', '' );
		add_option( 'tpasfw_owl_autoplayTimeout', 5000 );
		add_option( 'tpasfw_results_font_size', '1rem' );
		add_option( 'tpasfw_results_pt_color', '#000000' );
		add_option( 'tpasfw_search_input_border_radius', 30 );
		add_option( 'tpasfw_custom_css', '' );
		add_option( 'tpasfw_loading_background', '#000000' );
		add_option( 'tpasfw_no_result', 'No products found' );
		add_option( 'tpasfw_categories_title', 'Categories' );
		add_option( 'tpasfw_site_logo', $logo_src );
		add_option( 'tpasfw_logo_max_height', 45 );
		add_option( 'tpasfw_search_input_border_style', 'solid' );
		add_option( 'tpasfw_search_input_border_color', '#000000' );
		add_option( 'tpasfw_search_input_border_top', '1px' );
		add_option( 'tpasfw_search_input_border_right', '1px' );
		add_option( 'tpasfw_search_input_border_bottom', '1px' );
		add_option( 'tpasfw_search_input_border_left', '1px' );
		add_option( 'tpasfw_hide_product_price', '' );
		add_option( 'tpasfw_display_categories_in_results', '' );
		add_option( 'tpasfw_cart_icon', 'tpasfw-basket-3' );
		add_option( 'tpasfw_my_account_icon', 'tpasfw-user-o' );
		add_option( 'tpasfw_loading_type', 6 );
		add_option( 'tpasfw_screen_items_desktop', 5 );
		add_option( 'tpasfw_screen_items_tablet', 4 );
		add_option( 'tpasfw_screen_items_mobile', 2 );
		add_option( 'tpasfw_owl_arrow_left', 'tpasfw-left-open-big' );
		add_option( 'tpasfw_cat_border_radius', '50%' );
		add_option( 'tpasfw_search_input_max_width', 500 );
		add_option( 'tpasfw_search_input_focus_background', '#fff' );
		add_option( 'tpasfw_label_sale', 'Sale!' );
		add_option( 'tpasfw_save_searches', 0 );
		add_option( 'tpasfw_image_type', 'gallery' );
		add_option( 'tpasfw_search_input_placeholder', 'Search...' );
		add_option( 'tpasfw_logo_position', 'left' );
		add_option( 'tpasfw_display_order_by', 0 );
		add_option( 'tpasfw_pagination_active', 0 );
		add_option( 'tpasfw_pagination_items', 15 );
		add_option( 'tpasfw_activate_cache', 0 );
		// add_option( 'XXX', 0 );
		// add_option( 'XXX', 0 );
		// add_option( 'XXX', 0 );
		// add_option( 'XXX', 0 );
	}

	/**
     * Create table to store search queries.
     */
    private static function create_searches_table() {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		$table_name = $wpdb->prefix . 'tpasfw_searches';
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			search_term varchar(255) NOT NULL,
			search_count bigint(20) NOT NULL DEFAULT 1,
			last_searched datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			has_results tinyint(1) NOT NULL DEFAULT 0,
			PRIMARY KEY  (id),
			UNIQUE KEY search_term (search_term)
		) $charset_collate;";
	
		dbDelta($sql);
	}		

}
