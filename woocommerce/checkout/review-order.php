<?php

/**
 * Review order table
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table mb-8 border border-gray-200 rounded-xl p-6 shadow-md">

  <?php
  do_action('woocommerce_review_order_before_cart_contents');
  ?>
  <div class="cart-contents flex flex-col gap-y-4 pb-4">
    <?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
      $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

      if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
    ?>
        <div class="flex w-full gap-3 <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

          <div class="product-thumbnail w-12 flex-grow-0 flex-shrink-0">
            <?php
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

            echo $thumbnail; // PHPCS: XSS ok.
            ?>
          </div>
          <div class="product-name flex-1">
            <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
            <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', '<br><span class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
          </div>
          <div class="product-total w-1/4 flex-shrink-0 flex-grow-0 text-right">
            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
          </div>
        </div>

    <?php
      }
    }
    ?>
  </div>
  <?php do_action('woocommerce_review_order_after_cart_contents'); ?>

  <div class="cart-subtotal-wrapper pt-4 pb-3 border-t border-gray-300">

    <div class="cart-subtotal flex gap-x-3 mb-1">
      <div class="w-1/2"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
      <div class="w-1/2 text-right"><?php wc_cart_totals_subtotal_html(); ?></div>
    </div>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
      <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> flex gap-x-3 mb-1">
        <div class="w-1/2"><?php wc_cart_totals_coupon_label($coupon); ?></div>
        <div class="w-1/2 text-right"><?php wc_cart_totals_coupon_html($coupon); ?></div>
      </div>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
      <div class="cart-shipping mb-1">
        <?php do_action('woocommerce_review_order_before_shipping'); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action('woocommerce_review_order_after_shipping'); ?>
      </div>

    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
      <div class="fee flex gap-x-3 mb-1">
        <div class="w-1/2"><?php echo esc_html($fee->name); ?></div>
        <div class="w-1/2 text-right"><?php wc_cart_totals_fee_html($fee); ?></div>
      </div>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
      <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
        <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        ?>
          <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> flex gap-x-3 mb-1">
            <div class="w-1/2"><?php echo esc_html($tax->label); ?></div>
            <div class="w-1/2 text-right"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="tax-total flex gap-x-3 mb-1">
          <div class="w-1/2"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
          <div class="w-1/2 text-right"><?php wc_cart_totals_taxes_total_html(); ?></div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <div class="order-total-wrapper pt-4 border-t border-gray-300">

    <?php do_action('woocommerce_review_order_before_order_total'); ?>

    <div class="order-total flex items-center gap-x-3">
      <div class="w-1/2"><?php esc_html_e('Total', 'woocommerce'); ?></div>
      <div class="w-1/2 text-right text-xl"><?php wc_cart_totals_order_total_html(); ?></div>
    </div>

    <?php do_action('woocommerce_review_order_after_order_total'); ?>

  </div>
</div>