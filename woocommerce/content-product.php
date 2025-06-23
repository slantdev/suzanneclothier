<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
  return;
}
?>
<div <?php wc_product_class('', $product); ?>>
  <div class="product-card flex flex-col w-full h-full bg-white rounded-xl shadow-md p-4">
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    //do_action('woocommerce_before_shop_loop_item');
    echo '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link block">';

    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    //do_action('woocommerce_before_shop_loop_item_title');

    echo '<div class="product-thumbnail aspect-w-1 aspect-h-1 bg-primary-light bg-opacity-10 rounded-xl overflow-hidden mb-4">';
    echo woocommerce_get_product_thumbnail('medium');
    echo '</div>';


    /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    //do_action('woocommerce_shop_loop_item_title');

    echo '<h3 class="woocommerce-loop-product__title product-title text-sm font-semibold mb-4">' . get_the_title() . '</h3>';

    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    //do_action('woocommerce_after_shop_loop_item_title');


    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    //do_action('woocommerce_after_shop_loop_item');
    echo '</a>';

    echo '<div class="flex justify-between pt-4 mt-auto border-t border-gray-200">';
    echo '<div class="mr-auto">';
    echo woocommerce_template_loop_price();
    echo woocommerce_template_loop_rating();
    echo '</div>';
    echo '<div class="ml-4">';
    echo woocommerce_template_loop_add_to_cart();
    echo '</div>';
    echo '</div>';
    ?>
  </div>
</div>