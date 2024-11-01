<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div id="tp-advanced-search-tabs">

    <div class="tpasfw-shortcode">
        <p>Copy and paste the following PHP code snippet into your WordPress theme's template file or a custom plugin file to display Advanced Search in your site.</p>
        <!-- <pre>&lt;?php echo do_shortcode('[tpasfw]'); ?&gt;</pre> -->
        <pre><code>&lt;?php echo do_shortcode('[tpasfw]'); ?&gt;</code></pre> For open mode use: <pre><code>&lt;?php echo do_shortcode('[tpasfwopen]'); ?&gt;</code></pre>

        <p>The <code>[tpasfw]</code> or <code>[tpasfwopen]</code> shortcode is designed to embed an advanced search feature into your site. <span class="tpasfw-see-more"><a href="<?php echo esc_url(TPASFW_PLUGIN_HOME); ?>" target="_blank">See more by TP Plugins</a></span></p>
    </div>

    <ul>
        
        <li><a href="#tab1">Settings</a></li>
        <li><a href="#tab2">Style</a></li>
        <li><a href="#tab3">Gallery Carousel</a></li>
        <li><a href="#tab6">Labels</a></li>
        <li><a href="#tab7">Users Searches</a></li>
        <li><a href="#tab4">Custom CSS</a></li>
    
        <li><a href="#tab5">License</a></li>
    </ul>

    <form method="post" action="options.php">
        <?php settings_fields('tp_advanced_search_options_group'); ?>
        
        <div id="tab1">
            <h3>General Settings</h3>
            
            <p>
                <label for="tpasfw_autocomplete_minlength">Minlength</label>
                <input type="number" id="tpasfw_autocomplete_minlength" name="tpasfw_autocomplete_minlength" value="<?php echo esc_attr( get_option('tpasfw_autocomplete_minlength',3) ); ?>" />
                <span class="tpasfw_desc">The minimum number of characters a user must type before a search is performed.</span>
            </p>

            <div class="tpasfw_screen_items">
                <h4>Items to show in a row (by screen resolution)</h4>

                <div class="tpasfw_screen_item">

                    <label for="tpasfw_screen_items_desktop">
                        <div class="tpasfw-tooltip"><i class="demo-icon tpasfw-desktop"></i>
                            <div class="tpasfw-right">
                                <p>min-width: 1240px</p>
                                <i></i>
                            </div>
                        </div>
                    </label>

                    <!-- <label for="tpasfw_screen_items_desktop"><i class="demo-icon tpasfw-desktop"></i></label> -->
                    <input type="number" id="tpasfw_screen_items_desktop" name="tpasfw_screen_items_desktop" value="<?php echo esc_attr( get_option('tpasfw_screen_items_desktop',5) ); ?>" />
                </div>

                <div class="tpasfw_screen_item">

                    <label for="tpasfw_screen_items_tablet">
                        <div class="tpasfw-tooltip"><i class="demo-icon tpasfw-tablet"></i>
                            <div class="tpasfw-right">
                                <p>min-width: 768px</p>
                                <i></i>
                            </div>
                        </div>
                    </label>

                    <!-- <label for="tpasfw_screen_items_tablet"><i class="demo-icon tpasfw-tablet"></i></label> -->
                    <input type="number" id="tpasfw_screen_items_tablet" name="tpasfw_screen_items_tablet" value="<?php echo esc_attr( get_option('tpasfw_screen_items_tablet',4) ); ?>" />
                </div>

                <div class="tpasfw_screen_item">

                    <label for="tpasfw_screen_items_mobile">
                        <div class="tpasfw-tooltip"><i class="demo-icon tpasfw-mobile"></i>
                            <div class="tpasfw-right">
                                <p>max-width: 767px</p>
                                <i></i>
                            </div>
                        </div>
                    </label>

                    <!-- <label for="tpasfw_screen_items_mobile"><i class="demo-icon tpasfw-mobile"></i></label> -->
                    <input type="number" id="tpasfw_screen_items_mobile" name="tpasfw_screen_items_mobile" value="<?php echo esc_attr( get_option('tpasfw_screen_items_mobile',2) ); ?>" />
                </div>
            </div>

            <p>
                <input type="checkbox" id="tpasfw_display_cart_icon" name="tpasfw_display_cart_icon" value="1" <?php checked(1, get_option('tpasfw_display_cart_icon'), true); ?> />
                <label for="tpasfw_display_cart_icon" class="tpasfw_width_160">Display Cart Icon</label>
                <?php echo $this->select_cart_icon(get_option('tpasfw_cart_icon')); ?>
            </p>
            <p>
                <input type="checkbox" id="tpasfw_display_my_account_icon" name="tpasfw_display_my_account_icon" value="1" <?php checked(1, get_option('tpasfw_display_my_account_icon'), true); ?> />
                <label for="tpasfw_display_my_account_icon" class="tpasfw_width_160">Display My Account Icon</label>
                <?php echo $this->select_my_account_icon(get_option('tpasfw_my_account_icon')); ?>
            </p>
            <p>
                <input type="checkbox" id="tpasfw_hide_product_price" name="tpasfw_hide_product_price" value="1" disabled />
                <label for="tpasfw_hide_product_price">Hide Product Price From Results</label>
                <?php echo $this->regular_pro(); ?>
            </p>
            <p>
                <input type="checkbox" id="tpasfw_display_order_by" name="tpasfw_display_order_by" value="1" disabled />
                <label for="tpasfw_display_order_by">Display Order By (Select)</label>
                <?php echo $this->regular_pro(); ?>
            </p>
            <div class="tpasfw_site_logo_group">
                <input type="checkbox" id="tpasfw_activate_cache" name="tpasfw_activate_cache" value="1" disabled />
                <label for="tpasfw_activate_cache">Activate Caching System</label>
                
                <?php echo $this->regular_pro(); ?>

            </div>
            <p>
                <input type="checkbox" id="tpasfw_save_searches" name="tpasfw_save_searches" value="1" disabled />
                <label for="tpasfw_save_searches" class="tpasfw_bold">Save Users Searches</label>
                <?php echo $this->regular_pro(); ?>
            </p>

            <div class="tpasfw_site_logo_group">
                <?php echo wp_kses_post($this->triangle_pro()); ?>
                <p>
                    <input type="checkbox" id="tpasfw_display_site_logo" name="tpasfw_display_site_logo" value="1" disabled />
                    <label for="tpasfw_display_site_logo">Display Site Logo</label>
                </p>
                <div class="tpasfw_site_logo">
                    <?php
                        $site_logo = get_option('tpasfw_site_logo');
                        $logo_max_height = get_option('tpasfw_logo_max_height',30);
                        if (!empty($site_logo)) {
                            echo '<img class="tpasfw_site_logo_view" src="' . esc_url($site_logo) . '" alt="Site Logo" style="max-height: '.esc_attr($logo_max_height).'px;">';
                        }
                    ?>
                    <input type="text" id="tpasfw_site_logo" name="tpasfw_site_logo" value="<?php echo esc_attr(get_option('tpasfw_site_logo')); ?>" />
                    <button type="button" class="button" id="tpasfw_site_logo_button">Select Image</button>
                </div>
                <div class="tpasfw_site_setting">
                <div>
                        <label for="tpasfw_logo_max_height">Logo Max Height (in px)</label><br>
                        <input type="number" id="tpasfw_logo_max_height" name="tpasfw_logo_max_height" value="<?php echo esc_attr( get_option('tpasfw_logo_max_height',45) ); ?>" />
                    </div>
                    <div>
                        <label for="tpasfw_logo_position">Position:</label><br>
                        <select id="tpasfw_logo_position" name="tpasfw_logo_position">
                            <option value="left" <?php selected(get_option('tpasfw_logo_position'), 'left'); ?>>Left</option>
                            <option value="right" <?php selected(get_option('tpasfw_logo_position'), 'right'); ?>>Right</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tpasfw_site_logo_group">
                <?php echo wp_kses_post($this->triangle_pro()); ?>
                <p>
                    <input type="checkbox" id="tpasfw_display_categories_in_results" name="tpasfw_display_categories_in_results" value="1" disabled />
                    <label for="tpasfw_display_categories_in_results">Display Categories in Results</label>
                    <span class="tpasfw_desc">Categories according to search.</span>
                </p>
                <p>
                    <?php
                    $selected_categories = get_option('tpasfw_display_shop_categories');
                    if (!is_array($selected_categories)) {
                        $selected_categories = [];
                    }
                    ?>
                    <p>
                        <label for="tpasfw_display_shop_categories">Categories Promotion:</label>
                        <span class="tpasfw_desc">will always be shown regardless of search results.</span>
                        <select id="tpasfw_display_shop_categories" name="tpasfw_display_shop_categories[]" multiple="multiple">
                            <option value="">Select Categories</option>
                            <?php
                            $categories = get_terms('product_cat', array('hide_empty' => false));
                            foreach ($categories as $category) {
                                $selected = in_array($category->term_id, $selected_categories) ? ' selected' : '';
                                echo '<option value="' . esc_attr($category->term_id) . '"' . esc_attr($selected) . '>' . esc_html($category->name) . '</option>';
                            }
                            ?>
                        </select>
                    </p>
                </p>
            </div>

            <div class="tpasfw_site_logo_group">
                <?php echo wp_kses_post($this->triangle_pro()); ?>
                <h4>Paging</h4>
                <p>
                    <input type="checkbox" id="tpasfw_pagination_active" name="tpasfw_pagination_active" value="1" disabled />
                    <label for="tpasfw_pagination_active">Display Paging</label>
                </p>
                <p>
                    <label for="tpasfw_pagination_items">Items to show</label><br>
                    <input type="number" id="tpasfw_pagination_items" name="tpasfw_pagination_items" value="<?php echo esc_attr(get_option('tpasfw_pagination_items')); ?>" /> 
                </p>
            </div>
            
            <div class="tpasfw_site_logo_group">
                <h4>Loading</h4>
                <div class="tpasfw_loading_box">
                    <?php echo $this->select_loading(get_option('tpasfw_loading_type')); ?>
                </div>
            </div>
            
        </div>

        <div id="tab2">

            <h3>Style Settings</h3>

            <div class="tpasfw-tab-group">
                <h4>Search Input</h4>
                <p>
                    <label for="tpasfw_display_cart_icon" class="tpasfw_label_200">Border Radius (in px)</label>
                    <input type="number" id="tpasfw_search_input_border_radius" name="tpasfw_search_input_border_radius" value="<?php echo esc_attr( get_option('tpasfw_search_input_border_radius',0) ); ?>" /> 
                </p>
                <p>
                    <label for="tpasfw_search_input_max_width" class="tpasfw_label_200">Max Width (in px)</label>
                    <input type="number" id="tpasfw_search_input_max_width" name="tpasfw_search_input_max_width" value="<?php echo esc_attr( get_option('tpasfw_search_input_max_width',500) ); ?>" /> 
                </p>
                <p>
                    <label for="tpasfw_search_input_focus_background" class="tpasfw_label_200">Focus Background</label>
                    <input type="color" id="tpasfw_search_input_focus_background" name="tpasfw_search_input_focus_background" value="<?php echo esc_attr( get_option('tpasfw_search_input_focus_background') ); ?>" /> 
                </p>
                
            </div>

            <div class="tpasfw-tab-group">
                <h4>Icons</h4>
                <p>
                    <label for="tpasfw_style_color" class="tpasfw_label_200">Icons Color:</label>
                    <input type="color" id="tpasfw_style_color" name="tpasfw_style_color" value="<?php echo esc_attr( get_option('tpasfw_style_color') ); ?>" />
                </p>
                <p>
                    <label for="tpasfw_style_size" class="tpasfw_label_200">Icons Size (in px):</label>
                    <input type="number" id="tpasfw_style_size" name="tpasfw_style_size" value="<?php echo esc_attr( get_option('tpasfw_style_size') ); ?>" />
                </p>
            </div>
            <!-- Additional style settings can be added here -->
            <div class="tpasfw-tab-group">
                <h4>Border Settings for Search Input</h4>
                <!-- Settings for each border side -->
                <?php foreach (['top', 'right', 'bottom', 'left'] as $side): ?>
                    <div class="border-settings-group">
                        <div class="border-setting">
                            <span>Border <?php echo esc_html(ucfirst($side)); ?></span><br>
                            <input type="text" class="tpasfw-small-input" id="tpasfw_search_input_border_<?php echo esc_attr($side); ?>" name="tpasfw_search_input_border_<?php echo esc_attr($side); ?>" value="<?php echo esc_attr(get_option('tpasfw_search_input_border_' . $side)); ?>" />
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="border-setting">
                    <span>Style:</span>
                    <select id="tpasfw_search_input_border_style" name="tpasfw_search_input_border_style">
                        <option value="none" <?php selected(get_option('tpasfw_search_input_border_style'), 'none'); ?>>None</option>
                        <option value="solid" <?php selected(get_option('tpasfw_search_input_border_style'), 'solid'); ?>>Solid</option>
                        <option value="dotted" <?php selected(get_option('tpasfw_search_input_border_style'), 'dotted'); ?>>Dotted</option>
                        <option value="dashed" <?php selected(get_option('tpasfw_search_input_border_style'), 'dashed'); ?>>Dashed</option>
                    </select>
                </div>
                <div class="border-setting">
                    <span>Color:</span>
                    <input type="color" id="tpasfw_search_input_border_color" name="tpasfw_search_input_border_color" value="<?php echo esc_attr(get_option('tpasfw_search_input_border_color')); ?>" />
                </div>
            </div>

            <div class="tpasfw-tab-group">
                <h4>Results</h4>
                <p>
                    <label for="tpasfw_results_font_size" class="tpasfw_label_200">Font Size:</label>
                    <input type="text" id="tpasfw_results_font_size" name="tpasfw_results_font_size" value="<?php echo esc_attr( get_option('tpasfw_results_font_size') ); ?>" />
                </p>
                <p>
                    <label for="tpasfw_results_font_size" class="tpasfw_label_200">Product Title Color:</label>
                    <input type="color" id="tpasfw_results_pt_color" name="tpasfw_results_pt_color" value="<?php echo esc_attr( get_option('tpasfw_results_pt_color','#000000') ); ?>" />
                </p>
                <p>
                    <label for="tpasfw_results_pt_price_color" class="tpasfw_label_200">Product Price Color:</label>
                    <input type="color" id="tpasfw_results_pt_price_color" name="tpasfw_results_pt_price_color" value="<?php echo esc_attr( get_option('tpasfw_results_pt_price_color','#000') ); ?>" />
                </p>
                <p>
                    <label for="tpasfw_results_pt_sale_color" class="tpasfw_label_200">Product Sale Price Color:</label>
                    <input type="color" id="tpasfw_results_pt_sale_color" name="tpasfw_results_pt_sale_color" value="<?php echo esc_attr( get_option('tpasfw_results_pt_sale_color','#ccc') ); ?>" />
                </p>
            </div>

            <div class="tpasfw-tab-group">
                <h4>Loading</h4>
                <p>
                    <label for="tpasfw_loading_background" class="tpasfw_label_200">Background:</label>
                    <input type="color" id="tpasfw_loading_background" name="tpasfw_loading_background" value="<?php echo esc_attr( get_option('tpasfw_loading_background','#000000') ); ?>" />
                </p>
            </div>

            <div class="tpasfw-tab-group">
                <h4>Categories</h4>
                <p>
                    <label for="tpasfw_cat_border_radius" class="tpasfw_label_200">Image Border Radius:</label>
                    <input type="text" id="tpasfw_cat_border_radius" name="tpasfw_cat_border_radius" value="<?php echo esc_attr( get_option('tpasfw_cat_border_radius') ); ?>" />
                </p>
            </div>
        </div>

        <div id="tab3">
            <h3>Carousel Settings</h3>

            <p>
                <label for="tpasfw_image_type">Show image as<label>
                <select id="tpasfw_image_type" name="tpasfw_image_type">
                    <option value="gallery" <?php echo get_option('tpasfw_image_type') == 'gallery' ? 'selected' : ''; ?>>Gallery</option>
                    <option value="flipper" <?php echo get_option('tpasfw_image_type') == 'flipper' ? 'selected' : ''; ?>>Flipper</option>
                </select>
                <span class="tpasfw_image_type_desc"></span>
            </p>

            <p>
                <input type="checkbox" id="tpasfw_owl_loop" name="tpasfw_owl_loop" value="1" <?php checked(1, get_option('tpasfw_owl_loop'), true); ?> />
                <label for="tpasfw_owl_loop">Loop</label>
                <span class="tpasfw_desc">Infinity loop. Duplicate last and first items to get loop illusion.</span>
            </p>

            <p>
                <input type="checkbox" id="tpasfw_owl_nav" name="tpasfw_owl_nav" value="1" <?php checked(1, get_option('tpasfw_owl_nav'), true); ?> />
                <label for="tpasfw_owl_nav">Nav</label>
                <span class="tpasfw_desc">Show next/prev buttons.</span>
            </p>

            <p>
                <input type="checkbox" id="tpasfw_owl_dots" name="tpasfw_owl_dots" value="1" <?php checked(1, get_option('tpasfw_owl_dots'), true); ?> />
                <label for="tpasfw_owl_dots">Dots</label>
                <span class="tpasfw_desc">Show dots navigation.</span>
            </p>

            <p>
                <input type="checkbox" id="tpasfw_owl_rtl" name="tpasfw_owl_rtl" value="1" <?php checked(1, get_option('tpasfw_owl_rtl'), true); ?> />
                <label for="tpasfw_owl_rtl">RTL</label>
                <!-- <span class="tpasfw_desc">Show dots navigation.</span> -->
            </p>

            <p>
                <input type="checkbox" id="tpasfw_owl_autoplay" name="tpasfw_owl_autoplay" value="1" <?php checked(1, get_option('tpasfw_owl_autoplay'), true); ?> />
                <label for="tpasfw_owl_autoplay">Autoplay</label>
                <!-- <span class="tpasfw_desc">Show dots navigation.</span> -->
            </p>

            <p>
                <input type="number" id="tpasfw_owl_autoplayTimeout" name="tpasfw_owl_autoplayTimeout" value="<?php echo esc_attr(get_option('tpasfw_owl_autoplayTimeout')); ?>" />
                <label for="tpasfw_owl_autoplayTimeout">Autoplay Timeout</label>
            </p>

            <p>
                <h3>Arrows <?php echo $this->regular_pro(); ?></h3>
                <?php echo $this->select_owl_arrows(get_option('tpasfw_owl_arrow_left')); ?>
            </p>

        </div>

        <div id="tab6">

            <p>
                <label for="tpasfw_no_result" class="tpasfw_label_200">No Result Label</label>
                <input type="text" id="tpasfw_no_result" name="tpasfw_no_result" value="<?php echo esc_attr( get_option('tpasfw_no_result') ); ?>" />
                <!-- <span class="tpasfw_desc">The minimum number of characters a user must type before a search is performed.</span> -->
            </p>
            <p>
                <label for="tpasfw_label_sale" class="tpasfw_label_200">Sale! Label</label>
                <input type="text" id="tpasfw_label_sale" name="tpasfw_label_sale" value="<?php echo esc_attr( get_option('tpasfw_label_sale','Sale!') ); ?>" />
                <!-- <span class="tpasfw_desc">The minimum number of characters a user must type before a search is performed.</span> -->
            </p>
            <p>
                <label for="tpasfw_search_input_placeholder" class="tpasfw_label_200">Search Input Placeholder</label>
                <input type="text" id="tpasfw_search_input_placeholder" name="tpasfw_search_input_placeholder" value="<?php echo esc_attr( get_option('tpasfw_search_input_placeholder') ); ?>" />
                <!-- <span class="tpasfw_desc">The minimum number of characters a user must type before a search is performed.</span> -->
            </p>
            <p>
                <label for="tpasfw_categories_title" class="tpasfw_label_200">Categories Title</label>
                <input type="text" id="tpasfw_categories_title" name="tpasfw_categories_title" value="<?php echo esc_attr( get_option('tpasfw_categories_title') ); ?>" />
                <!-- <span class="tpasfw_desc">The minimum number of characters a user must type before a search is performed.</span> -->
            </p>
            
        </div>

        <div id="tab4">
            <h4>This option is for developers only! If you do not know CSS it is not recommended to change it. <?php echo $this->regular_pro(); ?></h4>
            <textarea id="tpasfw_custom_css" class="tpasfw_custom_css" name="tpasfw_custom_css"></textarea>
        </div>

        <div id="tab7" class="tpasfw-tab7">

            <div class="tpasfw-pro-overlay">
                <span>PRO</span>
            </div>

            <div class="tpasfw_search_table_actions">
                <button id="deleteAll">Delete All</button>
                <button id="deleteNoResults">Delete Rows with No Results</button>
            </div>

            <table id="search_terms_table" class="display">
                <thead>
                    <tr>
                        <th>Search Term</th>
                        <th>Count</th>
                        <th>Last Searched</th>
                        <th>Has Results</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>

        <div id="tab5">
        
            <div class="tpasfw_admin_settings_left">

                <div class="tpasfw_buttons_container">
                    <a class="tp_get_pro" href="<?php echo esc_url(TPASFW_PLUGIN_HOME.'product/'.TPASFW_PLUGIN_SLUG_PRO); ?>" target="_blank">Get PRO</a>
                    <a class="tp_see_demo" href="<?php echo esc_url('https://tplugins.com/demos/ex2/shop/?tpasfw'); ?>" target="_blank">See Demo</a>
                </div>

                <div class="tpasfw_pro_features">
                    <h2 class="tpasfw_heading">Pro Version Features</h2>
                    <p class="tpasfw_description">All free features included, plus:</p>
                    <div class="tpasfw_feature_box">
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Hide Product Price From Results</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Display Order By (Select):
                            <div class="tpasfw_order_box">
                                <div class="tpasfw_order_item">Order by Latest</div>
                                <div class="tpasfw_order_item">Order by Price: Low to High</div>
                                <div class="tpasfw_order_item">Order by Price: High to Low</div>
                                <div class="tpasfw_order_item">Order by Popularity</div>
                                <div class="tpasfw_order_item">Order by Average Rating</div>
                                <div class="tpasfw_order_item">Order by Featured</div>
                                <div class="tpasfw_order_item">Order by Sale Items First</div>
                            </div>
                        </div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Activate Caching System - speeds up search result loading</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Save Users Searches - storage of search queries</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Display Site Logo or Upload new Logo</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Display Categories in Results Categories according to search</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Categories Promotion - always shown regardless of search results</div>
                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Paging - efficiently organize large numbers of results</div>

                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> Customize Everything:
                            <div class="tpasfw_order_box">
                                <div class="tpasfw_order_item">Colors</div>
                                <div class="tpasfw_order_item">Backgrounds</div>
                                <div class="tpasfw_order_item">Logo size</div>
                                <div class="tpasfw_order_item">Icons</div>
                                <div class="tpasfw_order_item">Custom CSS</div>
                                <div class="tpasfw_order_item">Font zise</div>
                                <div class="tpasfw_order_item">Results Data</div>
                                <div class="tpasfw_order_item">Hooks - actions and filters</div>
                                <div class="tpasfw_order_item">And more ...</div>
                            </div>
                        </div>

                        <div class="tpasfw_feature"><span class="dashicons dashicons-saved"></span> And much more...</div>
                    </div>
                </div>

            </div>
        
        </div>

        <?php submit_button(); ?>
    </form>
</div>
