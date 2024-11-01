<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.tplugins.com/shop
 * @since      1.0.0
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/admin
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Advanced_Search_For_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		wp_enqueue_style( 'datatables.min', plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tp-advanced-search-for-woocommerce-loading', plugin_dir_url( __FILE__ ) . 'css/tp-advanced-search-for-woocommerce-loading.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tpasfw-fontello', plugin_dir_url( __FILE__ ) . 'icons/css/fontello.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( 'select2.min', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-advanced-search-for-woocommerce-admin.css', array(), $this->version, 'all' );
		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_media();
		wp_enqueue_script( 'select2.min', plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( 'datatables.min', plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-advanced-search-for-woocommerce-admin.js', array('jquery', 'jquery-ui-tabs'), $this->version, false );
		wp_localize_script( $this->plugin_name, 'tpasfwParam', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}

	// Add this method to your class
	public function add_plugin_admin_menu() {
		add_menu_page(
			'TP Advanced Search Settings', // Page title
			'Advanced Search', // Menu title
			'manage_options', // Capability
			'tp_advanced_search_settings', // Menu slug
			array($this, 'display_plugin_setup_page'), // Callback function
			'dashicons-search', // Icon
			99 // Position
		);
	}

	public function display_plugin_setup_page() {
		include_once('partials/tp-advanced-search-for-woocommerce-admin-display.php');
	}

	public function register_mysettings() { // whitelist options

		//General Settings
		register_setting('tp_advanced_search_options_group', 'tpasfw_site_logo');
		register_setting('tp_advanced_search_options_group', 'tpasfw_screen_items_desktop');
		register_setting('tp_advanced_search_options_group', 'tpasfw_screen_items_tablet');
		register_setting('tp_advanced_search_options_group', 'tpasfw_screen_items_mobile');

		register_setting('tp_advanced_search_options_group', 'tpasfw_logo_max_height');
		register_setting('tp_advanced_search_options_group', 'tpasfw_logo_position');
		register_setting('tp_advanced_search_options_group', 'tpasfw_no_result');
		register_setting('tp_advanced_search_options_group', 'tpasfw_autocomplete_minlength');
    	register_setting('tp_advanced_search_options_group', 'tpasfw_display_cart_icon');
		register_setting('tp_advanced_search_options_group', 'tpasfw_cart_icon');
    	register_setting('tp_advanced_search_options_group', 'tpasfw_display_my_account_icon');
		register_setting('tp_advanced_search_options_group', 'tpasfw_my_account_icon');
		register_setting('tp_advanced_search_options_group', 'tpasfw_loading_type');
		register_setting('tp_advanced_search_options_group', 'tpasfw_display_shop_categories', array(
            'sanitize_callback' => array($this, 'tpasfw_sanitize_shop_categories'),
        ));

		//Style Settings
		register_setting('tp_advanced_search_options_group', 'tpasfw_style_color'); // New setting for color
		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_max_width');
		register_setting('tp_advanced_search_options_group', 'tpasfw_label_sale');
		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_placeholder');
		register_setting('tp_advanced_search_options_group', 'tpasfw_categories_title');
		register_setting('tp_advanced_search_options_group', 'tpasfw_style_size'); // New setting for size
		register_setting('tp_advanced_search_options_group', 'tpasfw_results_font_size');
		register_setting('tp_advanced_search_options_group', 'tpasfw_results_pt_color');
		register_setting('tp_advanced_search_options_group', 'tpasfw_results_pt_price_color');
		register_setting('tp_advanced_search_options_group', 'tpasfw_results_pt_sale_color');
		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_border_radius');
		register_setting('tp_advanced_search_options_group', 'tpasfw_loading_background');
		register_setting('tp_advanced_search_options_group', 'tpasfw_image_type');
		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_focus_background');
		register_setting('tp_advanced_search_options_group', 'tpasfw_cat_border_radius');
		register_setting('tp_advanced_search_options_group', 'tpasfw_pagination_items');

		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_border_style', 'sanitize_text_field');
		register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_border_color', 'sanitize_hex_color');
		// Repeat for each border side
		foreach (['top', 'right', 'bottom', 'left'] as $side) {
			register_setting('tp_advanced_search_options_group', 'tpasfw_search_input_border_' . $side . '', 'sanitize_text_field');
		}

		//Carousel Settings
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_loop');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_nav');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_dots');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_rtl');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_autoplay');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_autoplayTimeout');
		register_setting('tp_advanced_search_options_group', 'tpasfw_owl_arrow_left');
		register_setting('tp_advanced_search_options_group', 'tpasfw_custom_css');

	}

	// Sanitize function for the shop categories field
	public function tpasfw_sanitize_shop_categories($input) {
		// Ensure input is an array
		if (!is_array($input)) {
			$input = [];
		}

		// Sanitize each value in the array
		return array_map('sanitize_text_field', $input);
	}

	public function triangle_pro() {
		$link_pro = TPASFW_PLUGIN_HOME.'product/'.TPASFW_PLUGIN_SLUG_PRO.'/';
		return '<div class="tpasfw_triangle_topright_box"><div class="tpasfw_triangle_topright"><span><a class="tpasfw_pro_a" href="'.esc_url( $link_pro ).'" target="_blank">PRO</a></span></div></div>';
	}

	public function regular_pro() {
		$link_pro = TPASFW_PLUGIN_HOME.'product/'.TPASFW_PLUGIN_SLUG_PRO.'/';
		return '<span class="tpasfw_regular_pro"><a class="tpasfw_pro_a" href="'.esc_url( $link_pro ).'" target="_blank">PRO</a></span>';
	}

	public function select_cart_icon($cart_icon) {
		$html = '';
		$icons = array(
			'tpasfw-basket' => '<i class="demo-icon tpasfw-basket"></i>',
			'tpasfw-basket-3' => '<i class="demo-icon tpasfw-basket-3"></i>',
			'tpasfw-basket-circled' => '<i class="demo-icon tpasfw-basket-circled"></i>',
			'tpasfw-cart-arrow-down' => '<i class="demo-icon tpasfw-cart-arrow-down"></i>',
			'tpasfw-basket-1' => '<i class="demo-icon tpasfw-basket-1"></i>',
			'tpasfw-basket-alt' => '<i class="demo-icon tpasfw-basket-alt"></i>',
			'tpasfw-opencart' => '<i class="demo-icon tpasfw-opencart"></i>',
			'tpasfw-bag' => '<i class="demo-icon tpasfw-bag"></i>',
			'tpasfw-cart' => '<i class="demo-icon tpasfw-cart"></i>',
			'tpasfw-basket-2' => '<i class="demo-icon tpasfw-basket-2"></i>',
			'tpasfw-basket-4' => '<i class="demo-icon tpasfw-basket-4"></i>',
			'tpasfw-cart-plus' => '<i class="demo-icon tpasfw-cart-plus"></i>'
		);
		// wp_dbug($cart_icon);

		// Ensure that the key is a valid option to prevent manipulation
		if (!array_key_exists($cart_icon, $icons)) {
			$cart_icon = 'default_icon_key'; // Replace with your default icon key
		}

		foreach ($icons as $key => $value) {
			$checked = ($cart_icon === $key) ? 'checked' : '';
			$html .= '<label class="tpasfw-icon-radio">';
			$html .= '<input type="radio" name="tpasfw_cart_icon" value="' . esc_attr($key) . '" ' . $checked . ' style="display: none;">'; // Hide the default radio button
			$html .= wp_kses_post($value); // Ensure that the HTML for the icon is safe
			$html .= '</label>';
		}

		return $html;
	}

	public function select_my_account_icon($my_account_icon) {
		$html = '';
		$icons = array(
			'tpasfw-user-o' => '<i class="demo-icon tpasfw-user-o"></i>',
			'tpasfw-user' => '<i class="demo-icon tpasfw-user"></i>',
			'tpasfw-login' => '<i class="demo-icon tpasfw-login"></i>',
			'tpasfw-user-circle' => '<i class="demo-icon tpasfw-user-circle"></i>',
			'tpasfw-user-circle-o' => '<i class="demo-icon tpasfw-user-circle-o"></i>'
		);
		// wp_dbug($cart_icon);

		// Validate the $my_account_icon
		if (!array_key_exists($my_account_icon, $icons)) {
			$my_account_icon = 'default_icon_key'; // Replace with your default icon key
		}
		
		foreach ($icons as $key => $value) {
			$checked = ($my_account_icon === $key) ? 'checked' : '';
			$html .= '<label class="tpasfw-icon-radio">';
			$html .= '<input type="radio" name="tpasfw_my_account_icon" value="' . esc_attr($key) . '" ' . $checked . ' style="display: none;">'; // Hide the default radio button
			$html .= wp_kses_post($value); // Ensure that the HTML for the icon is safe
			$html .= '</label>';
		}

		return $html;
	}

	public function select_owl_arrows($arrow_left) {
		$html = '';
		$icons = array(
			'tpasfw-left-open-big' => '<i class="demo-icon tpasfw-left-open-big"></i><i class="demo-icon tpasfw-right-open-big"></i>',
			'tpasfw-left-open' => '<i class="demo-icon tpasfw-left-open"></i><i class="demo-icon tpasfw-right-open"></i>',
			'tpasfw-left-small' => '<i class="demo-icon tpasfw-left-small"></i><i class="demo-icon tpasfw-right-small"></i>',
			'tpasfw-left-dir' => '<i class="demo-icon tpasfw-left-dir"></i><i class="demo-icon tpasfw-right-dir"></i>',
			'tpasfw-left-open-mini' => '<i class="demo-icon tpasfw-left-open-mini"></i><i class="demo-icon tpasfw-right-open-mini"></i>',
			'tpasfw-left-bold' => '<i class="demo-icon tpasfw-left-bold"></i><i class="demo-icon tpasfw-right-bold"></i>',
			'tpasfw-left-circle' => '<i class="demo-icon tpasfw-left-circle"></i><i class="demo-icon tpasfw-right-circle"></i>',
			'tpasfw-left-circle-1' => '<i class="demo-icon tpasfw-left-circle-1"></i><i class="demo-icon tpasfw-right-circle-1"></i>',
			// 'tpasfw-left-bold' => '<i class="demo-icon tpasfw-left-bold"></i><i class="demo-icon tpasfw-right-bold"></i>',
			// 'tpasfw-left-bold' => '<i class="demo-icon tpasfw-left-bold"></i><i class="demo-icon tpasfw-right-bold"></i>',

		);

		// Validate the $arrow_left
		if (!array_key_exists($arrow_left, $icons)) {
			$arrow_left = 'default_icon_key'; // Replace with your default icon key
		}

		// wp_dbug($cart_icon);
		foreach ($icons as $key => $value) {
			$checked = ($arrow_left === $key) ? 'checked' : '';
			$html .= '<label class="tpasfw-icon-radio">';
			$html .= '<input type="radio" name="tpasfw_owl_arrow_left" value="' . esc_attr($key) . '" ' . $checked . ' style="display: none;">'; // Hide the default radio button
			$html .= wp_kses_post($value); // Ensure that the HTML for the icon is safe
			$html .= '</label>';
		}

		return $html;
	}

	public function get_loading($loading) {
		switch ($loading) {
			case 1:
			  	return '<div class="lds-facebook"><div></div><div></div><div></div></div>';
			  	break;
			case 2:
				return '<div class="lds-dual-ring"></div>';
			  	break;
			case 3:
				return '<div class="lds-circle"><div></div></div>';
			  	break;
			case 4:
				return '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
				break;
			case 5:
				return '<div class="lds-heart"><div></div></div>';
				break;
			case 6:
				return '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
				break;
			case 7:
				return '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';
				break;
			case 8:
				return '<div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
				break;
			case 9:
				return '<div class="lds-ripple"><div></div><div></div></div>';
				break;
			case 10:
				return '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
				break;
			// case 3:
			// 	return '<div class="lds-circle"><div></div></div>';
			// 	break;
			// case 3:
			// 	return '<div class="lds-circle"><div></div></div>';
			// 	break;
			default:
				return '<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
		}
	}

	public function select_loading($loading) {
		$html = '';
		$default = $this->get_loading(esc_attr($loading));
		$options = array(1 => 'Type 1', 2 => 'Type 2', 3 => 'Type 3', 4 => 'Type 4', 5 => 'Type 5', 6 => 'Type 6', 7 => 'Type 7', 8 => 'Type 8', 9 => 'Type 9');
		$html .= '<select class="tpasfw_loading_type" name="tpasfw_loading_type">';
	
		foreach($options as $key => $value) {
			$selected = ($loading == $key) ? 'selected' : '';
			$html .= '<option value="'. esc_attr($key) .'" '. $selected .'>'. esc_html($value) .'</option>';
		}
	
		$html .= '</select>';
		$html .= '<div class="tpasfw_loading_preview" id="tpasfw_loading_preview">'. wp_kses_post($default) .'</div>';
	
		return $html;
	}	

	//-------------------------------------------------------

	public function settings_link( $links ) {
		$settings_link  = '<a class="tpasfw_settings_link" href="' . esc_url( get_admin_url(null, 'admin.php?page=tp_advanced_search_settings') ) . '">Settings</a> | ';
		$settings_link .= '<a class="tpasfw_gopro_link" target="_blank" href="' . esc_url( TPASFW_PLUGIN_HOME.'product/'.TPASFW_PLUGIN_SLUG_PRO ) . '">GO PRO</a>';
    	array_unshift($links, $settings_link);
    	return $links;
	}

	//-------------------------------------------------------
	public function get_top_search_terms($offset = 0, $limit = 20) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tpasfw_searches';

        $query = $wpdb->prepare("SELECT search_term, search_count FROM $table_name ORDER BY search_count DESC LIMIT %d, %d", $offset, $limit);
        $results = $wpdb->get_results($query, ARRAY_A);

        return $results;
    }

	public function ajax_get_search_terms() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'tpasfw_searches';
	
		$offset = isset($_POST['start']) ? intval($_POST['start']) : 0;
		$limit = isset($_POST['length']) ? intval($_POST['length']) : 20;
	
		$query = $wpdb->prepare("SELECT search_term, search_count, last_searched, has_results FROM $table_name ORDER BY search_count DESC LIMIT %d, %d", $offset, $limit);
		$search_terms = $wpdb->get_results($query, ARRAY_A);
	
		// Assuming you want the total number of rows for pagination
		$total_rows = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
	
		wp_send_json(array(
			"data" => $search_terms,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows
		));
	}	

	// function register_ajax_handlers() {
	// 	add_action('wp_ajax_get_search_terms', 'ajax_get_search_terms');
	// 	add_action('wp_ajax_nopriv_get_search_terms', 'ajax_get_search_terms'); // if you want it accessible for non-logged-in users
	// }

	public function ajax_delete_all_search_terms() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'tpasfw_searches';
	
		$wpdb->query("TRUNCATE TABLE $table_name");
	
		wp_send_json_success(); // Send a success response
	}
	
	public function ajax_delete_no_results_search_terms() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'tpasfw_searches';
	
		$wpdb->query("DELETE FROM $table_name WHERE has_results = 0");
	
		wp_send_json_success(); // Send a success response
	}
	
	//-------------- Add the Dashboard Widget ---------------
	
	public function add_dashboard_widgets() {
		wp_add_dashboard_widget(
			'tpasfw_popular_searches_widget',               // Widget slug.
			'Popular Searches',                             // Title.
			array($this,'display_popular_searches_widget')  // Display function.
		);
	}
	// add_action('wp_dashboard_setup', 'add_dashboard_widgets');

	public function display_popular_searches_widget() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'tpasfw_searches';
	
		// Fetch top 10 popular searches
		$popular_searches = $wpdb->get_results("SELECT search_term, search_count, has_results FROM $table_name ORDER BY search_count DESC LIMIT 10", ARRAY_A);
	
		// Check if there are any results
		if (empty($popular_searches)) {
			echo "<p>No search data available.</p>";
			return;
		}
	
		// Start the table
		echo "<table class='widefat fixed' cellspacing='0'>\n";
		echo "<thead>\n<tr>\n";
		echo "<th class='manage-column column-columnname' scope='col'>Search Term</th>\n";
		echo "<th class='manage-column column-columnname' scope='col'>Count</th>\n";
		echo "<th class='manage-column column-columnname' scope='col'>Has Results</th>\n";
		echo "</tr>\n</thead>\n";
		echo "<tbody>\n";
	
		// Display each row
		foreach ($popular_searches as $search) {

			$has_results = ($search['has_results'] == '1') ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>';
			//return data == '1' ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>';

			echo "<tr>\n";
			echo "<td class='column-columnname'>" . esc_html($search['search_term']) . "</td>\n";
			echo "<td class='column-columnname'>" . esc_html($search['search_count']) . "</td>\n";
			echo "<td class='column-columnname'>" . esc_html($has_results) . "</td>\n";
			echo "</tr>\n";
		}
	
		// End the table
		echo "</tbody>\n</table>\n";

		// Dynamic URL for the 'See All' link
		$see_all_link = admin_url('admin.php?page=tp_advanced_search_settings#tab7');
		echo '<a href="' . esc_url($see_all_link) . '" class="tpasfw_widget_see_all">See All</a>';
	}
	
	//-------------------------------------------------------

	public function clear_search_cache() {
		global $wpdb;
		$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_search_results_%'");
	}

	public function clear_all_cache() {
		global $wpdb;
		$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
		echo '<span class="tpa_success_desc">Cache cleared successfully.</span>';
		wp_die();
	}

	//-------------------------------------------------------

}
