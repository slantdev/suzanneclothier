<?php

/**
 * Cart totals
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="cart_totals ml-auto <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

  <?php do_action('woocommerce_before_cart_totals'); ?>

  <h3 class="text-xl font-semibold mb-4"><?php esc_html_e('Cart totals', 'woocommerce'); ?></h3>

  <div class="shop_table shop_table_responsive mb-8 border border-gray-200 rounded-xl p-6 shadow-md font-sans">

    <div class="cart-subtotal flex gap-x-3 mb-1">
      <div class="w-1/2"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
      <div class="w-1/2 text-right" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
    </div>

    <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
      <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> flex gap-x-3 mb-1">
        <div class="w-1/2"><?php wc_cart_totals_coupon_label($coupon); ?></div>
        <div class="w-1/2 text-right" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></div>
      </div>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

      <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

      <?php wc_cart_totals_shipping_html(); ?>

      <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

    <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

      <div class="shipping flex gap-x-3 mb-1">
        <div class="w-1/2"><?php esc_html_e('Shipping', 'woocommerce'); ?></div>
        <div class="w-1/2 text-right" data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></div>
      </div>

    <?php endif; ?>

    <?php foreach (WC()->cart->get_fees() as $fee) : ?>
      <div class="fee flex gap-x-3 mb-1">
        <div class="w-1/2"><?php echo esc_html($fee->name); ?></div>
        <div class="w-1/2 text-right" data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></div>
      </div>
    <?php endforeach; ?>

    <?php
    if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
      $taxable_address = WC()->customer->get_taxable_address();
      $estimated_text  = '';

      if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
        /* translators: %s location. */
        $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
      }

      if ('itemized' === get_option('woocommerce_tax_total_display')) {
        foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    ?>
          <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> flex gap-x-3 mb-1">
            <div class="w-1/2"><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                ?></div>
            <div class="w-1/2 text-right" data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
          </div>
        <?php
        }
      } else {
        ?>
        <div class="tax-total flex gap-x-3 mb-1">
          <div class="w-1/2"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                              ?></div>
          <div class="w-1/2 text-right" data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
        </div>
    <?php
      }
    }
    ?>

    <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

    <div class="order-total flex gap-x-3 mb-1 pt-4 mt-4 border-t border-gray-200 items-center">
      <div class="w-1/2"><?php esc_html_e('Total', 'woocommerce'); ?></div>
      <div class="w-1/2 text-right text-xl" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
    </div>

    <?php do_action('woocommerce_cart_totals_after_order_total'); ?>

    <div class="wc-proceed-to-checkout">
      <?php do_action('woocommerce_proceed_to_checkout'); ?>
    </div>

  </div>

  <?php do_action('woocommerce_after_cart_totals'); ?>

</div>