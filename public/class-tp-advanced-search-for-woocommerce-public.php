<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.tplugins.com/shop
 * @since      1.0.0
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tp_Advanced_Search_For_Woocommerce
 * @subpackage Tp_Advanced_Search_For_Woocommerce/public
 * @author     TP Plugins <pluginstp@gmail.com>
 */
class Tp_Advanced_Search_For_Woocommerce_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('tpasfw', array($this, 'render_tpasfw_shortcode'));
		add_shortcode('tpasfwopen', array($this, 'render_tpasfwopen_shortcode'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( 'aos', plugin_dir_url( __FILE__ ) . 'css/aos.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'pagination.min', plugin_dir_url( __FILE__ ) . 'css/pagination.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tp-advanced-search-for-woocommerce-loading', plugin_dir_url( __FILE__ ) . 'css/tp-advanced-search-for-woocommerce-loading.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'owl.carousel.min', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'owl.theme.default.min', plugin_dir_url( __FILE__ ) . 'css/owl.theme.default.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tpasfw-fontello', plugin_dir_url( __FILE__ ) . 'icons/css/fontello.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-advanced-search-for-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-ui-autocomplete' );
		//wp_enqueue_script( 'aos', plugin_dir_url( __FILE__ ) . 'js/aos.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'owl.carousel.min', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-advanced-search-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'tpasfwAjax', array('ajaxurl' => admin_url('admin-ajax.php')) );
		$tpasfw = array(
			'no_result' => get_option('tpasfw_no_result'),
			'minlength' => get_option('tpasfw_autocomplete_minlength',3),
			'owlloop' => get_option('tpasfw_owl_loop'),
			'owlnav' => get_option('tpasfw_owl_nav'),
			'owldots' => get_option('tpasfw_owl_dots'),
			'owlrtl' => get_option('tpasfw_owl_rtl'),
			'owlautoplay' => get_option('tpasfw_owl_autoplay'),
			'owlautoplayTimeout' => get_option('tpasfw_owl_autoplayTimeout',5000),
			'owlarrow_left'  => get_option('tpasfw_owl_arrow_left','tpasfw-left-open-big'),
			'owlarrow_right' => str_replace("left","right",get_option('tpasfw_owl_arrow_left','tpasfw-left-open-big')),
			'image_type' => get_option('tpasfw_image_type'),
			'display_order_by' => get_option('tpasfw_display_order_by'),
			'pagination_active' => get_option('tpasfw_pagination_active'),
			'pagination_items' => get_option('tpasfw_pagination_items',15),
		);
		//tpasfw_owl_arrow_left
		wp_localize_script( $this->plugin_name, 'tpasfw', $tpasfw );
	
	}

	// Function to render the shortcode
    public function render_tpasfw_shortcode() {
		$search_input_placeholder = get_option('tpasfw_search_input_placeholder');
		// The base class that should always be present
		$base_class = 'tpasfw-search-results-ajax';
		// Apply filters to allow additional classes to be added
		$additional_classes = apply_filters('tpasfw_search_results_additional_class', '');
		// Combine the base class with any additional classes
		$final_classes = trim($base_class . ' ' . $additional_classes);

        // Start output buffering to capture the HTML output
        ob_start();
        ?>
        <div class="tpasfw-search-box">
			<i class="demo-icon tpasfw-search"></i>
			<div class="tpasfw-search-results">
				<?php do_action('tpasfw_before_search_form'); ?>
				<div class="tpasfw-search-form">

					<div class="tpasfw-search-abs-left"><?php do_action('tpasfw_form_abs_left'); ?></div>
					<div class="tpasfw_before_search_input">
						<?php do_action('tpasfw_before_search_input'); ?>
						<!-- <div class="tpasfw-search-abs-midd"> -->
						<input type="text" class="tpasfw-search-input" placeholder="<?php echo esc_attr($search_input_placeholder); ?>">
						<?php // do_action('tpasfw_nextto_search_input'); ?>
						<!-- </div> -->

						<?php do_action('tpasfw_after_search_input'); ?>
					</div>

					<div class="tpasfw-search-abs-right"><?php do_action('tpasfw_form_abs_right'); ?></div>
				</div>
				<?php do_action('tpasfw_after_search_form'); ?>
				<?php echo $this->loading(); ?>
				<div class="<?php echo esc_attr($final_classes); ?>"></div>
			</div>
		</div>
		<div class="tpasfw-overlay"></div> <!-- Overlay for the background -->
        <?php
        // Get the buffered content and clean the buffer
        return ob_get_clean();
    }

	public function render_tpasfwopen_shortcode() {
		$search_input_placeholder = get_option('tpasfw_search_input_placeholder');
		// The base class that should always be present
		$base_class = 'tpasfw-search-results-ajax';
		// Apply filters to allow additional classes to be added
		$additional_classes = apply_filters('tpasfw_search_results_additional_class', '');
		// Combine the base class with any additional classes
		$final_classes = trim($base_class . ' ' . $additional_classes);

        // Start output buffering to capture the HTML output
        ob_start();
        ?>
        <div class="tpasfwopen-search-box">
			<!-- <i class="demo-icon tpasfw-search"></i> -->
			<div class="tpasfwopen-search-results">
				<?php do_action('tpasfw_before_search_form'); ?>
				<div class="tpasfwopen-search-form">

					<?php do_action('tpasfw_before_search_input'); ?>
					<div class="tpasfwopen-search-ins">
						<input type="text" class="tpasfw-search-input" placeholder="<?php echo esc_attr($search_input_placeholder); ?>">
						<?php do_action('tpasfw_nextto_search_input'); ?>
						<span class="tpasfwopen-search-ins-close">X</span>
					</div>
					<?php do_action('tpasfw_after_search_input'); ?>

				</div>
				<?php do_action('tpasfw_after_search_form'); ?>
				<?php echo $this->loading(); ?>
				<div class="<?php echo esc_attr($final_classes); ?>"></div>
			</div>
		</div>
		<!-- <div class="tpasfw-overlay"></div> -->
        <?php
        // Get the buffered content and clean the buffer
        return ob_get_clean();
    }

	public function search_products() {

		$searchTerm = sanitize_text_field($_POST['searchTerm']);

		// Sanitize and validate the 'orderby' parameter
		$orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'default';

		// Validation example
		$valid_orderby_options = ['date', 'price', 'default'];
		if (!in_array($orderby, $valid_orderby_options)) {
			$orderby = 'default';
		}

		// Perform WooCommerce product query
		$args = array(
			'post_type' => 'product',
			's' => $searchTerm,
			// Add other query parameters as needed
			'posts_per_page' => -1, // Fetch all matching products
		);

		//----------------------------------------
		// Modify the query based on the orderby value
		switch ($orderby) {
			case 'date':
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
				break;
			case 'price':
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_price';
				$args['order'] = 'ASC';
				break;
			case 'price-desc':
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_price';
				$args['order'] = 'DESC';
				break;
			case 'popularity':
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = 'total_sales';
				$args['order'] = 'DESC';
				break;
			case 'rating':
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_wc_average_rating';
				$args['order'] = 'DESC';
				break;
			case 'featured':
				$args['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key'     => '_featured',
						'value'   => 'yes',
						'compare' => '='
					),
					array(
						'key'     => '_featured',
						'compare' => 'NOT EXISTS'
					)
				);
				$args['orderby'] = array(
					'meta_value' => 'DESC', // Prioritize featured products
					'date' => 'DESC'       // Secondary order
				);
				break;				
			case 'sale':
				$args['meta_query'] = array(
					'relation' => 'OR',
					array( // Check if product is on sale
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'NUMERIC'
					),
					array( // Products not on sale will be at the end
						'key'     => '_sale_price',
						'compare' => 'NOT EXISTS'
					)
				);
				$args['orderby'] = array(
					'meta_value_num' => 'DESC',
					'date' => 'DESC' // Or any other secondary order
				);
				break;
			default:
				// Default order
				break;
		}
		//----------------------------------------
		// print_r($args);
		$query = new WP_Query($args);

		$output = '';
		$output_cat = '';
	
		if ($query->have_posts()) {
			$label_sale = get_option('tpasfw_label_sale');
			$image_type = get_option('tpasfw_image_type');

			// Action to add custom fields or additional content
			ob_start();
			do_action('tpasfw_before_products_grid', $args);
			$output .= ob_get_clean();

			$output .= '<div class="tpasfw-products-grid">'; // Start grid container
	
				while ($query->have_posts()) {
					$query->the_post();
					global $product;
		
					// Get the permalink of the product
					$product_link = esc_url(get_permalink($product->get_id()));

					$image = get_the_post_thumbnail_url($product->get_id(), 'woocommerce_thumbnail');
					$title = esc_html(get_the_title());
					$price = $product->get_price_html();

					$gallery_ids = $product->get_gallery_image_ids();
					array_unshift($gallery_ids, $product->get_image_id()); // Add main image ID to the beginning

					//---------------------------------------------------
					// Determine if the product is on sale
					$is_on_sale = $product->is_on_sale() ? '1' : '0';

					// Determine if the product is featured
					$is_featured = $product->is_featured() ? '1' : '0';

					// Additional data attributes
					$price_value = $product->get_price(); // Raw price value for sorting
					// $ccategories = wp_get_post_terms($product->get_id(), 'product_cat');
					// $main_category = !empty($ccategories) ? $ccategories[0]->name : '';
					$average_rating = $product->get_average_rating();
					$is_in_stock = $this->is_product_in_stock($product);
					//---------------------------------------------------
					// data-category="' . esc_attr($main_category) . '" 

					$product_output = '<div class="tpasfw-product" data-sale="' . esc_attr($is_on_sale) . '" data-featured="' . esc_attr($is_featured) . '" data-price="' . esc_attr($price_value) . '" data-rating="' . esc_attr($average_rating) . '" data-instock="' . esc_attr($is_in_stock) . '">';

						// Action to add custom fields or additional content
						ob_start();
						do_action('tpasfw_before_product_image', $product);
						$product_output .= ob_get_clean();

						// Apply filter for the sale badge
						if ($product->is_on_sale()) {
							$sale_badge = '<span class="onsale">' . esc_html($label_sale) . '</span>';
							$sale_badge = apply_filters('tpasfw_product_sale_badge', $sale_badge, $product);
							$product_output .= $sale_badge;
						}

						if ($image_type == 'flipper' && count($gallery_ids) >= 2) {
							// Get URLs of the first two images
							$first_image_url = wp_get_attachment_url($gallery_ids[0]);
							$second_image_url = wp_get_attachment_url($gallery_ids[1]);
						
							$product_output .= '<div class="tpasfw-flipper">';
								$product_output .= '<img class="tpasfw-flipper-image tpasfw-flipper-front" src="' . esc_url($first_image_url) . '" alt="' . esc_attr($title) . '">';
								$product_output .= '<img class="tpasfw-flipper-image tpasfw-flipper-back" src="' . esc_url($second_image_url) . '" alt="' . esc_attr($title) . '">';
							$product_output .= '</div>';
						}						
						else {
							$product_output .= '<div class="owl-carousel owl-theme tpasfw-carousel">';
								foreach ($gallery_ids as $image_id) {
									$image_url = wp_get_attachment_url($image_id);
									$product_output .= '<div class="item"><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" title="' . esc_attr(get_the_title()) . '"></div>';
								}
							$product_output .= '</div>';
						}
						
						$product_output .= '<div class="tpasfw-content">';

							// Action to add custom fields or additional content
							ob_start();
							do_action('tpasfw_before_product_title', $product);
							$product_output .= ob_get_clean();

							// Apply filter for the product title with link
							$title = '<h3 class="tpasfw-product-title"><a href="' . esc_url($product_link) . '">' . get_the_title() . '</a></h3>';
							$title = apply_filters('tpasfw_product_title', $title, $product);
							$product_output .= $title;

							ob_start();
							do_action('tpasfw_after_product_title', $product);
							$product_output .= ob_get_clean();
				
							if(!get_option('tpasfw_hide_product_price')) {
								// Apply filter for the product price
								$price = '<span class="tpasfw-product-price">' . $product->get_price_html() . '</span>';
								$price = apply_filters('tpasfw_product_price', $price, $product);
								$product_output .= $price;
							
								// Action after the product price
								ob_start();
								do_action('tpasfw_after_product_price', $product);
								$product_output .= ob_get_clean();
							}

						$product_output .= '</div>';

						// $output .= '<h3 class="tpasfw-product-title">' . esc_html($title) . '</h3>';
						// $output .= '<span class="tpasfw-product-price">' . wp_kses_post($price) . '</span>';
					// End of the single product output
					$product_output .= '</div>';

					// Add the single product output to the main output
					$output .= $product_output;
				}
	
			$output .= '</div>'; // End grid container

			ob_start();
			do_action('tpasfw_after_products_grid', $args);
			$output .= ob_get_clean();

		} else {
			$output = '<div class="tpasfw-no-result">'.esc_html( get_option('tpasfw_no_result') ).'</div>';
		}
	
		wp_reset_postdata();

		echo $output . $output_cat;

		wp_die();
	}	

	public function loading() {
		// $loading_type = get_option('tpasfw_loading_type',6);
		// $loading = $this->get_loading($loading_type);
		// return '<div class="lds-grid-mask">'.$loading.'</div>';
		
		$loading_type = get_option('tpasfw_loading_type', 6);
		$loading = $this->get_loading($loading_type);

		// Apply filter to the loading HTML
		$loading_html = '<div class="lds-grid-mask">' . $loading . '</div>';
		$loading_html = apply_filters('tpasfw_loading_html', $loading_html, $loading_type);

		return $loading_html;
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

	public function get_site_logo_url($size = 'full') {
		$custom_logo_id = get_theme_mod('custom_logo');
		$logo_src = ''; // Initialize with an empty string

		if ($custom_logo_id) {
			$image = wp_get_attachment_image_src($custom_logo_id, $size);
			if ($image) {
				$logo_src = $image[0];
			}
		}
		return $logo_src;
	}

	public function display_close_button() {
		echo '<div class="tpasfw-ic tpasfw-close-button"><i class="demo-icon tpasfw-cancel-1"></i></div>';
	}

	public function display_shopping_cart() {
		if(get_option('tpasfw_display_cart_icon')) {
			$cart_url = wc_get_cart_url();
			$cart_icon = get_option('tpasfw_cart_icon','tpasfw-basket-3');
			echo '<div class="tpasfw-ic tpasfw-shopping-cart"><a href="'.esc_url($cart_url).'"><i class="demo-icon '.esc_attr($cart_icon).'"></i></a></div>';
		}
	}

	public function display_my_account() {
		if(get_option('tpasfw_display_my_account_icon')) {
			$my_account_url = wc_get_page_permalink('myaccount');
			$my_account_icon = get_option('tpasfw_my_account_icon','tpasfw-user-o');
			echo '<div class="tpasfw-ic tpasfw-my-account"><a href="'.esc_url($my_account_url).'"><i class="demo-icon '.esc_attr($my_account_icon).'"></i></a></div>';
		}
	}

	public function display_shop_categories() {
		// Get the selected categories from the options table
		$selected_categories = get_option('tpasfw_display_shop_categories');
	
		// Check if the field is not empty
		if (!empty($selected_categories)) {
			// Iterate over each category ID
			echo '<div class="tpasfw-categories">';
			foreach ($selected_categories as $category_id) {
				// Get the category object using the category ID
				$category = get_term_by('id', $category_id, 'product_cat');
	
				// Check if the category exists
				if ($category) {
					// Get the category link
					$category_link = get_term_link($category);
	
					// Display the category with its name and link
					echo '<a class="tpasfw-cat" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a> ';
				}
			}
			echo '</div>';
		}
	}	

	public function is_product_in_stock($product) {
		// Default to out of stock
		$is_in_stock = '0';
	
		if ($product->is_type('variable')) {
			// For variable products, check if any variation is in stock
			foreach ($product->get_available_variations() as $variation) {
				$variation_obj = wc_get_product($variation['variation_id']);
				if ($variation_obj && $variation_obj->is_in_stock()) {
					$is_in_stock = '1';
					break; // Stop the loop if at least one variation is in stock
				}
			}
		} else {
			// For simple products, just check the product's stock status
			$is_in_stock = $product->is_in_stock() ? '1' : '0';
		}
	
		return $is_in_stock;
	}
	
	public function init_custom_css() {
		$border_style = $this->get_search_input_border_css();
		$logo_max_height = get_option('tpasfw_logo_max_height',45);
		$search_input_max_width = get_option('tpasfw_search_input_max_width',500);
		$style_color = get_option('tpasfw_style_color','#000000');
		$style_size = get_option('tpasfw_style_size','12px');
		$results_font_size = get_option('tpasfw_results_font_size','1rem');
		$results_pt_color = get_option('tpasfw_results_pt_color','#000');
		$results_pt_price_color = get_option('tpasfw_results_pt_price_color','#000');
		$results_pt_sale_color = get_option('tpasfw_results_pt_sale_color','#ccc');
		$search_input_border_radius = get_option('tpasfw_search_input_border_radius',0);
		$loading_background = get_option('tpasfw_loading_background','#000000');
		$cat_border_radius = get_option('tpasfw_cat_border_radius','0px');
		$search_input_focus_background = get_option('tpasfw_search_input_focus_background','none');

		$logo_positions = $this->get_logo_position_values();
		$abs_left  = $logo_positions['abs_left'];
		$abs_midd  = $logo_positions['abs_midd'];
		$abs_right = $logo_positions['abs_right'];

		$items_widths  = $this->get_responsive_item_widths();
		$items_mobile  = $items_widths['mobile'];
		$items_tablet  = $items_widths['tablet'];
		$items_desktop = $items_widths['desktop'];

		echo '<style>';
			echo '.tpasfw-search-abs-left {
				order: '.esc_attr($abs_left).';
			}';

			echo '.tpasfw-product-price {
				color: '.esc_attr($results_pt_price_color).';
			}';

			// echo '.tpasfw-search-abs-midd {
			// 	order: '.$abs_midd.';
			// 	max-width: '.$search_input_max_width.'px !important;
			// }';
			echo '.tpasfw_before_search_input {
				order: '.esc_attr($abs_midd).';
				max-width: '.esc_attr($search_input_max_width).'px !important;
				width: 100%;
				border-radius: '.esc_attr($search_input_border_radius).'px !important;
				' . esc_attr($border_style) . '
			}';
			
			echo '.tpasfw_before_search_input input{
				border-radius: '.esc_attr($search_input_border_radius).'px !important;
			}';
			
			echo '.tpasfw-search-abs-right {
				order: '.esc_attr($abs_right).';
			}';
		
			echo '.tpasfw-product{
					width: calc('.esc_attr($items_mobile).'% - 15px);
				}
				@media screen and (min-width: 768px) {
					.tpasfw-product{
						width: calc('.esc_attr($items_tablet).'% - 15px);
					}
				}
				@media screen and (min-width: 1240px) {
					.tpasfw-product{
						width: calc('.esc_attr($items_desktop).'% - 15px);
					}
				}';

			echo '.tpasfw-site-logo img {
				max-height: '.esc_attr($logo_max_height).'px !important;
			}';

			echo '.tpasfw-search-abs-right i {
				color: ' . esc_attr($style_color) . ';
				font-size: '.esc_attr($style_size).'px;
			}';

			echo '.tpasfw-content , .tpasfw-content a {
				font-size: '.esc_attr($results_font_size).';
			}';

			echo '.tpasfw-product-title , .tpasfw-product-title a {
				color: '.esc_attr($results_pt_color).';
				font-size: '.esc_attr($results_font_size).';
			}';

			echo '.tpasfw-content ins {
				color: '.esc_attr($results_pt_price_color).';
				text-decoration: none;
			}';

			echo '.tpasfw-content del {
				color: '.esc_attr($results_pt_sale_color).';
			}';

			//---------------------------------------
			echo '.lds-grid div, .lds-facebook div, .lds-circle > div, .lds-roller div:after, .lds-heart div, .lds-ellipsis div, .lds-default div {
				background: '.esc_attr($loading_background).';
			}';

			echo '.lds-dual-ring:after {
				border: 6px solid '.esc_attr($loading_background).';
    			border-color: '.esc_attr($loading_background).' transparent '.esc_attr($loading_background).' transparent;
			}';

			echo '.lds-ring div {
				border: 8px solid '.esc_attr($loading_background).';
				border-color: '.esc_attr($loading_background).' transparent transparent transparent;
			}';

			echo '.lds-heart div:after,	.lds-heart div:before {
				background: '.esc_attr($loading_background).';
			}';

			echo '.lds-ripple div {
				border: 4px solid '.esc_attr($loading_background).';
			}';
			//---------------------------------------

			echo '.tpasfw-category img , .tpasfw-category:not(:has(img)) a::before {
				border-radius: '.esc_attr($cat_border_radius).' !important;
			}';

			echo '.tpasfw-category img {
				border-radius: '.esc_attr($cat_border_radius).' !important;
			}';

		echo '</style>';
	}
	
	//---------------------------------------------------------
	public function get_responsive_item_widths() {
		// Fetch the settings from the WordPress database
		$items_desktop = get_option('tpasfw_screen_items_desktop');
		$items_tablet  = get_option('tpasfw_screen_items_tablet');
		$items_mobile  = get_option('tpasfw_screen_items_mobile');
	
		// Calculate the width percentages
		$items_desktop = $this->calculate_width_percentage($items_desktop);
		$items_tablet  = $this->calculate_width_percentage($items_tablet);
		$items_mobile  = $this->calculate_width_percentage($items_mobile);
	
		// Prepare the array to return
		$widths = [
			'desktop' => $items_desktop,
			'tablet'  => $items_tablet,
			'mobile'  => $items_mobile
		];
	
		// Apply a filter for external modification
		return apply_filters('tpasfw_responsive_item_widths', $widths);
	}
	
	public function calculate_width_percentage($items) {
		switch ($items) {
			case 1:
				return '100';
			case 2:
				return '50';
			case 3:
				return '33.33';
			case 4:
				return '25';
			case 5:
				return '20';
			default:
				return '100'; // Default to 100% if the value is unexpected
		}
	}
	
	//---------------------------------------------------------
	public function get_logo_position_values() {
		$logo_position = get_option('tpasfw_logo_position', 'left');
	
		if ($logo_position == 'right') {
			$values = [
				'abs_left'  => 3,
				'abs_midd'  => 2,
				'abs_right' => 1
			];
		} else {
			$values = [
				'abs_left'  => 1,
				'abs_midd'  => 2,
				'abs_right' => 3
			];
		}
	
		// Apply a filter for external modification
		return apply_filters('tpasfw_logo_position_values', $values);
	}
	
	//---------------------------------------------------------
	// $border_style = get_search_input_border_css();
	// echo '<input type="text" style="' . esc_attr($border_style) . '" />';

	public function get_search_input_border_css() {
		$styles = [];

		$style = get_option("tpasfw_search_input_border_style");
		$color = get_option("tpasfw_search_input_border_color");
	
		foreach (['top', 'right', 'bottom', 'left'] as $side) {
			$width = get_option("tpasfw_search_input_border_{$side}");
	
			if ($width && $style && $color) {
				$styles[] = "border-{$side}: {$width} {$style} {$color} !important";
			}
		}
	
		return implode('; ', $styles);
	}

	//---------------------------------------------------------
	public function add_order_by() {
		$html = '';
		
		echo esc_html($html);
	}
	//---------------------------------------------------------

}

