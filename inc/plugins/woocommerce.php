<?php

/*
 * SINGLE
 */

/**
 * Hook: woocommerce_before_single_product_summary.
 *
 * @hooked woocommerce_show_product_sale_flash - 10
 * @hooked woocommerce_show_product_images - 20
 */
//* Remove woocommerce_show_product_sale_flash
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);


/**
 * Hook: woocommerce_single_product_summary.
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 * @hooked WC_Structured_Data::generate_product_data() - 60
 */

//* Move woocommerce_template_single_price
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);

//* Move woocommerce_template_single_meta
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_meta', 25);

//* Make External Product Buy Now button open in new tab
// This will take care of the Buy Product button below the external product on the Shop page.
add_filter('woocommerce_loop_add_to_cart_link', 'sc_external_add_product_link', 10, 2);
function sc_external_add_product_link($link)
{
  global $product;

  if ($product->is_type('external')) {

    $link = sprintf(
      '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" target="_blank">%s</a>',
      esc_url($product->add_to_cart_url()),
      esc_attr(isset($quantity) ? $quantity : 1),
      esc_attr($product->id),
      esc_attr($product->get_sku()),
      esc_attr(isset($class) ? $class : 'button product_type_external'),
      esc_html($product->add_to_cart_text())
    );
  }

  return $link;
}

// Remove the default WooCommerce external product Buy Product button on the individual Product page.
remove_action('woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30);

// Add the open in a new browser tab WooCommerce external product Buy Product button.
add_action('woocommerce_external_add_to_cart', 'sc_external_add_to_cart', 30);
function sc_external_add_to_cart()
{
  global $product;

  if (!$product->add_to_cart_url()) {
    return;
  }

  $product_url = $product->add_to_cart_url();
  $button_text = $product->single_add_to_cart_text();

  /**
   * The code below outputs the edited button with target="_blank" added to the html markup.
   */
  do_action('woocommerce_before_add_to_cart_button');

  echo '<p class="cart">
    <a href="' . esc_url($product_url) . '" rel="nofollow" class="single_add_to_cart_button button alt" target="_blank">' . esc_html($button_text) . '</a></p>';

  do_action('woocommerce_after_add_to_cart_button');
}


/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */

//* Remove product page tabs
add_filter('woocommerce_product_tabs', 'sc_remove_all_product_tabs', 98);
function sc_remove_all_product_tabs($tabs)
{
  unset($tabs['description']);
  unset($tabs['reviews']);
  unset($tabs['additional_information']);
  return $tabs;
}

//* Move comments_template
add_action('woocommerce_after_single_product_summary', 'comments_template', 50);

//* Move woocommerce_upsell_display
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15);

//* Move woocommerce_output_related_products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);

/*
 * ARCHIVES
 */

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//* Move woocommerce_breadcrumb
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//* Filter Product Category Against Learning Paths
function filter_product_cat()
{
  $term = $_POST['term'];
  $slug = $_POST['slug'];

  if ($slug) {
    $ajaxposts = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'desc',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $term,
        ),
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $slug,
        ),
      ),
    ]);
  } else {
    $ajaxposts = new WP_Query([
      'post_type' => 'product',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'desc',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $term,
        ),
      ),
    ]);
  }

  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= wc_get_template_part('content', 'product');
    endwhile;
  } else {
    $response = 'empty';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_product_cat', 'filter_product_cat');
add_action('wp_ajax_nopriv_filter_product_cat', 'filter_product_cat');

/*
 * CART
 */
//* Modify number of woocommerce_cross_sells_total in cart
add_filter('woocommerce_cross_sells_total', 'sc_cross_sells_total');
function sc_cross_sells_total($total)
{
  $total = '4';
  return $total;
}

add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments)
{
  ob_start();
  $items_count = WC()->cart->get_cart_contents_count();
?>
  <div id="mini-cart" class="-mt-1 w-5 h-5 leading-5 font-semibold text-xs font-sans text-center rounded-full bg-secondary"><?php echo $items_count ? $items_count : '0'; ?></div>
<?php
  $fragments['#mini-cart'] = ob_get_clean();
  return $fragments;
}

/*
 * CHECKOUT
 */

//remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
//add_action('woocommerce_checkout_before_order_review_heading', 'woocommerce_checkout_coupon_form');

//* Move email field to top
add_filter('woocommerce_billing_fields', 'sc_move_checkout_email_field');
function sc_move_checkout_email_field($address_fields)
{
  $address_fields['billing_email']['priority'] = 1;
  return $address_fields;
}

//add_filter('wcopc_templates', 'sc_add_opc_template');
function sc_add_opc_template($templates)
{

  $templates['sc-membership-pricing'] = array(
    'label'       => __('SC Pricing Table', 'sc'),
    'description' => __("Display a sophisticated and colourful pricing table with each product's attributes, but not weight or dimensions.", 'sc'),
  );

  return $templates;
}

/*
 * MY ACCOUNT
 */
add_filter('woocommerce_account_menu_items', 'sc_remove_my_account_links');
function sc_remove_my_account_links($menu_links)
{

  //unset( $menu_links['edit-address'] ); // Addresses
  //unset( $menu_links['dashboard'] ); // Remove Dashboard
  unset($menu_links['payment-methods']); // Remove Payment Methods
  //unset( $menu_links['orders'] ); // Remove Orders
  unset($menu_links['downloads']); // Disable Downloads
  //unset( $menu_links['edit-account'] ); // Remove Account details tab
  //unset( $menu_links['customer-logout'] ); // Remove Logout link

  return $menu_links;
}

// Add custom endpoint for My Account menu
add_action('init', 'sc_add_my_account_endpoint');
function sc_add_my_account_endpoint()
{
  // add_rewrite_endpoint('#courses', EP_ROOT | EP_PAGES, false);
  // add_rewrite_endpoint('#video-library', EP_ROOT | EP_PAGES, false);
  // add_rewrite_endpoint('#articles', EP_ROOT | EP_PAGES, false);
  add_rewrite_endpoint('community', EP_ROOT | EP_PAGES, false);
  //add_rewrite_endpoint('my-membership', EP_ROOT | EP_PAGES);
  //add_rewrite_endpoint('coupon', EP_ROOT | EP_PAGES);
}

function sc_insert_after_helper($items, $new_items, $after)
{
  // Search for the item position and +1 since is after the selected item key.
  $position = array_search($after, array_keys($items)) + 1;

  // Insert the new item.
  $array = array_slice($items, 0, $position, true);
  $array += $new_items;
  $array += array_slice($items, $position, count($items) - $position, true);

  return $array;
}

add_filter('woocommerce_get_endpoint_url', 'sc_hook_endpoint', 10, 4);
function sc_hook_endpoint($url, $endpoint, $value, $permalink)
{
  // if ($endpoint === '#courses') {
  //   $url = site_url() . '/my-account/#courses';
  // }
  // if ($endpoint === '#video-library') {
  //   $url = site_url() . '/my-account/#video-library';
  // }
  // if ($endpoint === '#articles') {
  //   $url = site_url() . '/my-account/#articles';
  // }
  if ($endpoint === 'community') {
    $url = site_url() . '/community';
  }
  return $url;
}
