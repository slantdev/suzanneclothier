<?php

/**
 * Template to display a pricing table in a list
 *
 * @package WooCommerce-One-Page-Checkout/Templates
 * @version 1.0
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="opc-pricing-table-wrapper grid grid-cols-2 gap-28 px-12">
  <?php foreach ($products as $product) : ?>
    <div class="opc-pricing-table-product product-item cart w-full border-0 bg-primary-light bg-opacity-10 rounded-xl shadow-md p-6 text-left <?php if (wcopc_get_products_prop($product, 'in_cart')) echo 'selected'; ?>">
      <div class="opc-pricing-table-bg p-6">
        <div class="opc-pricing-table-product-header p-0">
          <h3 class="opc-pricing-table-product-title font-quincy text-primary text-4xl mb-4"><?php echo wp_kses_post($product->get_title()); ?></h3>
          <div class="h-1 w-10 bg-white"></div>
          <div class="opc-pricing-table-product-price">
            <p class="text-5xl font-bold py-8"><?php echo $product->get_price_html(); ?></p>
          </div>
          <div class="mb-8">
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
            <ul class="list-disc pl-6">
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ul>
          </div>
        </div>

        <?php if ($product->has_attributes() || $product->is_type('variation')) : ?>
          <!-- Product Attributes -->
          <div class="opc-pricing-table-product-attributes">

            <?php if ($product->is_type('variation')) : ?>
              <?php foreach ($product->get_variation_attributes() as $attribute_title => $attribute_value) : ?>
                <h4 class="attribute_title"><?php echo wc_attribute_label(str_replace('attribute_', '', $attribute_title)); ?></h4>
                <?php $parent = is_callable(array($product, 'get_parent_id')) ? wc_get_product($product->get_parent_id()) : $product->parent; ?>
                <p><?php echo PP_One_Page_Checkout::get_formatted_attribute_value($attribute_title, $attribute_value, $parent->get_attributes()); ?></p>
              <?php endforeach; ?>
            <?php else : ?>
              <?php foreach ($product->get_attributes() as $attribute) :
                if (empty($attribute['is_visible']) || ($attribute['is_taxonomy'] && !taxonomy_exists($attribute['name']))) {
                  continue;
                } ?>
                <h4 class="attribute_title"><?php echo wc_attribute_label($attribute['name']); ?></h4>
                <p><?php
                    if ($attribute['is_taxonomy']) {
                      $values = wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'names'));
                      foreach ($values as $attribute_value) {
                        echo apply_filters('woocommerce_attribute', wpautop(wptexturize($attribute_value)), $attribute, $values);
                      }
                    } else {
                      // Convert pipes to commas and display values
                      $values = array_map('trim', explode(WC_DELIMITER, $attribute['value']));
                      foreach ($values as $attribute_value) {
                        echo apply_filters('woocommerce_attribute', wpautop(wptexturize($attribute_value)), $attribute, $values);
                      }
                    }
                    ?>
                </p>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        <?php endif; //$product->has_attributes()
        ?>

        <?php if ($product->has_weight() || $product->has_dimensions()) : ?>
          <div class="opc-pricing-table-product-dimensions">
            <?php if ($product->has_weight()) : ?>
              <!-- Product Weight -->
              <h4><?php esc_html_e('Weight', 'wcopc') ?></h4>
              <p class="product_weight"><?php echo wc_format_weight($product->get_weight()); ?></p>
            <?php endif; ?>
            <?php if ($product->has_dimensions()) : ?>
              <!-- Product Dimension -->
              <h4><?php esc_html_e('Dimensions', 'wcopc') ?></h4>
              <p class="product_dimensions"><?php echo wc_format_dimensions($product->get_dimensions(false)); ?></p>
            <?php endif; ?>
          </div>
        <?php endif; // $product->enable_dimensions_display()
        ?>

        <div class="product-quantity pt-8 border-t border-gray-400">
          <?php wc_get_template('checkout/add-to-cart/opc.php', array('product' => $product), '', PP_One_Page_Checkout::$template_path); ?>
        </div>
      </div>
    </div>
  <?php endforeach; // product in product_post
  ?>
</div>
<div class="clear"></div>