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

//* Add Member Coupon Code
add_action('woocommerce_single_product_summary', 'sc_add_rcp_member_coupon_code', 25);
function sc_add_rcp_member_coupon_code()
{
  global $product;
  $product_type = $product->get_type();

  if ($product_type == 'external') {
    $included_for_member = get_field('included_for_member');
    $rcp_customer_membership = rcp_get_customer_membership_level_ids();
    $silver_code = get_field('silver_member_coupon_code', 'option');
    $gold_code = get_field('gold_member_coupon_code', 'option');

    if (in_array(1, $rcp_customer_membership)) {
      if (in_array(1, $included_for_member)) {
        echo '<div class="p-4 bg-primary-lighter my-4 text-sm rounded-md">This product is included in your <a href="/my-account">Silver Member Library</a>. </div>';
      } else {
        echo '<div class="p-4 bg-primary-lighter my-4 text-sm rounded-md">As a Silver Member, please use <strong>' . $silver_code . '</strong> coupon code to get 5% discount upon checkout</div>';
      }
    } else if (in_array(2, $rcp_customer_membership)) {
      if (in_array(2, $included_for_member)) {
        echo '<div class="p-4 bg-primary-lighter my-4 text-sm rounded-md">This product is included in your <a href="/my-account">Gold Member Library</a>. </div>';
      } else {
        echo '<div class="p-4 bg-primary-lighter my-4 text-sm rounded-md">As a Gold Member, please use <strong>' . $gold_code . '</strong> coupon code to get 5% discount upon checkout</div>';
      }
    }
  }
}

//* Add Discounted Price Info for Member
//* Shown to non member only
add_action('woocommerce_single_product_summary', 'sc_add_discounted_price', 35);
function sc_add_discounted_price()
{
  if (!rcp_user_has_active_membership()) {
    $this_product = wc_get_product(get_the_ID());
    $this_price = $this_product->get_price();
    $silver_disc_percent = 5 / 100;
    $silver_disc_amount = $this_price * $silver_disc_percent;
    $silver_disc_price = $this_price - $silver_disc_amount;
    $gold_disc_percent = 10 / 100;
    $gold_disc_amount = $this_price * $gold_disc_percent;
    $gold_disc_price = $this_price - $gold_disc_amount;

    echo '<div class="pt-12 mt-12 border-t border-solid border-gray-300">
    <div class="member-price-compare flex gap-4">
      <div class="inline-flex bg-gray-100 border border-solid border-gray-200 rounded-lg shadow-md">
        <div class="py-6 px-6 text-left">
          <div class="font-quincy text-primary font-bold text-2xl">Silver</div>
          <div class="mt-2 mb-4 bg-secondary w-8 h-1"></div>
          <div class="text-3xl font-semibold">$' . number_format((float)$silver_disc_price, 2, '.', '') . '</div>
        </div>
        <div>
          <a href="/membership/silver-membership/" class="flex py-4 px-8 h-full w-full rounded-lg font-quincy bg-primary-lighter text-primary no-underline items-center text-2xl hover:no-underline"><span class="text-primary">Signup <br>& Save</span>
          </a>
        </div>
      </div>
      <div class="inline-flex bg-gray-100 border border-solid border-gray-200 rounded-lg shadow-md">
        <div class="py-6 px-6 text-left">
          <div class="font-quincy text-primary font-bold text-2xl">Gold</div>
          <div class="mt-2 mb-4 bg-secondary w-8 h-1"></div>
          <div class="text-3xl font-semibold">$' . number_format((float)$gold_disc_price, 2, '.', '') . '</div>
        </div>
        <div>
          <a href="/membership/gold-membership/" class="flex py-4 px-8 h-full w-full rounded-lg font-quincy bg-secondary text-primary items-center text-2xl"><span class="text-primary">Signup <br>& Save</span>
          </a>
        </div>
      </div>
    </div>
    </div>';
  }
  $rcp_customer_membership = rcp_get_customer_membership_level_ids();
  if (in_array(1, $rcp_customer_membership)) {
    $this_product = wc_get_product(get_the_ID());
    $this_price = $this_product->get_price();
    $gold_disc_percent = 10 / 100;
    $gold_disc_amount = $this_price * $gold_disc_percent;
    $gold_disc_price = $this_price - $gold_disc_amount;

    echo '<div class="pt-12 mt-12 border-t border-solid border-gray-300">
    <div class="member-price-compare flex gap-4">
      <a href="/membership/gold-membership/" class="inline-flex bg-gray-100 border border-solid border-gray-200 rounded-lg shadow-md">
        <div class="py-6 px-6 text-left">
          <div class="font-quincy text-primary font-bold text-2xl">Gold Member Price</div>
          <div class="mt-2 mb-4 bg-secondary w-8 h-1"></div>
          <div class="text-3xl font-semibold text-black">$' . number_format((float)$gold_disc_price, 2, '.', '') . '</div>
        </div>
      </a>
    </div>
    </div>';
  }
}

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
  add_rewrite_endpoint('#courses', EP_ROOT | EP_PAGES, false);
  add_rewrite_endpoint('#video-library', EP_ROOT | EP_PAGES, false);
  add_rewrite_endpoint('#articles', EP_ROOT | EP_PAGES, false);
  add_rewrite_endpoint('community', EP_ROOT | EP_PAGES, false);
  add_rewrite_endpoint('my-membership', EP_ROOT | EP_PAGES);
  add_rewrite_endpoint('coupon', EP_ROOT | EP_PAGES);
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

add_filter('woocommerce_account_menu_items', 'sc_add_my_account_link');
function sc_add_my_account_link($items)
{
  $new_items = array();

  $new_items['#courses'] = 'Courses';
  $new_items['#video-library'] = 'Video Library';
  $new_items['#articles'] = 'Articles';
  $new_items['community'] = 'Community';
  $new_items['my-membership'] = 'My Membership';
  $new_items['coupon'] = 'Coupon';


  return sc_insert_after_helper($items, $new_items, 'dashboard');
}

add_filter('woocommerce_get_endpoint_url', 'sc_hook_endpoint', 10, 4);
function sc_hook_endpoint($url, $endpoint, $value, $permalink)
{
  if ($endpoint === '#courses') {
    $url = site_url() . '/my-account/#courses';
  }
  if ($endpoint === '#on-demand') {
    $url = site_url() . '/my-account/#video-library';
  }
  if ($endpoint === '#articles') {
    $url = site_url() . '/my-account/#articles';
  }
  if ($endpoint === 'community') {
    $url = site_url() . '/community';
  }
  return $url;
}

add_action('woocommerce_account_my-membership_endpoint', 'sc_my_membership_endpoint_content');
function sc_my_membership_endpoint_content()
{
  echo do_shortcode('[subscription_details]');
}

add_action('woocommerce_account_coupon_endpoint', 'sc_my_coupon_endpoint_content');
function sc_my_coupon_endpoint_content()
{
  $rcp_customer_membership = rcp_get_customer_membership_level_ids();
  $coupon_code = '';
  $member_level = '';

  if (in_array(1, $rcp_customer_membership)) {
    $member_level = 'Silver Member';
    $coupon_code = get_field('silver_member_coupon_code', 'option');
  } else if (in_array(2, $rcp_customer_membership)) {
    $member_level = 'Gold Member';
    $coupon_code = get_field('gold_member_coupon_code', 'option');
  }
  echo '<h3 class="text-2xl font-bold mt-4 mb-8">' . $member_level . ' Coupon Code</h3>';
  echo '<div>';
  echo '<input type="text" value="' . $coupon_code . '" id="copyText" readonly>';
  echo '<div class="copyTooltip">';
  echo '<button onclick="copyFunction()" onmouseout="outFunc()"><span class="copyTooltipText" id="copyTooltip">Copy to clipboard</span><ion-icon name="clipboard-outline"></ion-icon></button>';
  echo '</div>';
  echo '</div>';
  echo '<script>';
  echo 'function copyFunction() {
    var copyText = document.getElementById("copyText");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    var copyTooltip = document.getElementById("copyTooltip");
    copyTooltip.innerHTML = "Copied: " + copyText.value;
  }

  function outFunc() {
    var copyTooltip = document.getElementById("copyTooltip");
    copyTooltip.innerHTML = "Copy to clipboard";
  }';
  echo '</script>';
}
