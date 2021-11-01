<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

$allowed_html = array(
  'a' => array(
    'href' => array(),
  ),
);
?>

<!-- <div class="container">
  <p>
    <?php
    printf(
      /* translators: 1: user display name 2: logout url */
      wp_kses(__('Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce'), $allowed_html),
      '<strong>' . esc_html($current_user->display_name) . '</strong>',
      esc_url(wc_logout_url())
    );
    ?>
  </p>

  <p>
    <?php
    /* translators: 1: Orders URL 2: Address URL 3: Account URL. */
    $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
    if (wc_shipping_enabled()) {
      /* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
      $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
    }
    printf(
      wp_kses($dashboard_desc, $allowed_html),
      esc_url(wc_get_endpoint_url('orders')),
      esc_url(wc_get_endpoint_url('edit-address')),
      esc_url(wc_get_endpoint_url('edit-account'))
    );
    ?>
  </p>
</div> -->

<div class="sticky top-0 z-10 bg-primary">
  <div class="container">
    <ul class="flex bg-primary overflow-x-auto items-center justify-center">
      <li><a href="#courses" class="block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">Courses</a></li>
      <li><a href="#videos" class="block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">Streaming Videos</a></li>
      <li><a href="#articles" class="block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">Articles</a></li>
    </ul>
  </div>
</div>

<?php
if (rcp_user_has_active_membership()) {

  // Courses
  echo '<div id="courses" class="section-anchor">';
  echo '<div class="container">';

  echo '<div class="text-center mb-14">
    <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
    <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
    <h3 class="text-4_25xl my-6 text-primary font-quincy">Courses</h3>
    <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
  </div>';

  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'product',
    'orderby' => 'menu_order',
    'tax_query' => array(
      array(
        'taxonomy' => 'product_cat',
        'field'    => 'id',
        'terms'    => '178',
      ),
    ),
    'meta_query'  => array(
      'relation'    => 'OR',
      array(
        'key'    => 'included_for_member',
        'value'    => '1',
        'compare'  => 'LIKE'
      ),
      array(
        'key'    => 'included_for_member',
        'value'    => '2',
        'compare'  => 'LIKE'
      )
    )
  );
  $wc_query = new WP_Query($args);

  if ($wc_query->have_posts()) {

    echo '<div class="text-center text-sm max-w-prose mx-auto mb-14">' . term_description('178', 'product_cat') . '</div>';

    woocommerce_product_loop_start();

    while ($wc_query->have_posts()) {
      $wc_query->the_post();

      /**
       * Hook: woocommerce_shop_loop.
       */
      do_action('woocommerce_shop_loop');

      wc_get_template_part('content', 'product');
    }

    woocommerce_product_loop_end();
  }
  wp_reset_postdata();

  echo '<div class="text-center mt-16">
  <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
  </div>';

  echo '</div>';
  echo '</div>';

  // Videos
  echo '<div id="videos" class="section-anchor bg-secondary-light">';
  echo '<div class="container">';

  echo '<div class="text-center mb-14">
    <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
    <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
    <h3 class="text-4_25xl my-6 text-primary font-quincy">Streaming Videos</h3>
    <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
  </div>';

  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'product',
    'orderby' => 'menu_order',
    'tax_query' => array(
      array(
        'taxonomy' => 'product_cat',
        'field'    => 'id',
        'terms'    => '269',
      ),
    ),
    'meta_query'  => array(
      'relation'    => 'OR',
      array(
        'key'    => 'included_for_member',
        'value'    => '1',
        'compare'  => 'LIKE'
      ),
      array(
        'key'    => 'included_for_member',
        'value'    => '2',
        'compare'  => 'LIKE'
      )
    )
  );
  $wc_query = new WP_Query($args);

  if ($wc_query->have_posts()) {

    echo '<div class="text-center text-sm max-w-prose mx-auto mb-14">' . term_description('269', 'product_cat') . '</div>';

    woocommerce_product_loop_start();

    while ($wc_query->have_posts()) {
      $wc_query->the_post();

      /**
       * Hook: woocommerce_shop_loop.
       */
      do_action('woocommerce_shop_loop');

      wc_get_template_part('content', 'product');
    }

    woocommerce_product_loop_end();
  }
  wp_reset_postdata();

  echo '<div class="text-center mt-16">
  <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
  </div>';

  echo '</div>';
  echo '</div>';

  // Articles
  echo '<div id="articles" class="section-anchor">';
  echo '<div class="container">';

  echo '<div class="text-center mb-20">
    <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
    <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
    <h3 class="text-4_25xl my-6 text-primary font-quincy">Articles</h3>
    <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
  </div>';

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'paged' => $paged,
    'meta_key'       => '_is_paid',
    'meta_value'     => 1,
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids'
  );
  $posts_query = new WP_Query($args);

  if ($posts_query->have_posts()) {
    echo '<div class="blog-grid grid grid-cols-4 pb-12 gap-8">';
    while ($posts_query->have_posts()) {
      $posts_query->the_post();
      get_template_part('template-parts/blog-list-item');
    }
    echo '</div>';
  }
  wp_reset_postdata();

  echo '<div class="text-center mt-16">
  <div class="h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
  </div>';

  echo '</div>';
  echo '</div>';
}
?>
<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
