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
