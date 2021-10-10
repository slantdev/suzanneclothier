<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
//do_action('woocommerce_before_single_product');

if (post_password_required()) {
  echo get_the_password_form(); // WPCS: XSS ok.
  return;
}
?>
<section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
  <div class="container pt-20 pb-12 z-10">
    <div class="flex">
      <div class="w-2/3">
        <h1 class="text-6xl font-sans mb-5 text-primary"><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
  <div class="w-full bg-white bg-opacity-90 z-10">
    <div class="container h-12 flex items-center">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="container pt-20 pb-28">
    <?php woocommerce_output_all_notices(); ?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

      <div class="flex gap-12">
        <div class="w-1/2">

          <?php
          /**
           * Hook: woocommerce_before_single_product_summary.
           *
           * @hooked woocommerce_show_product_sale_flash - 10
           * @hooked woocommerce_show_product_images - 20
           */
          do_action('woocommerce_before_single_product_summary');
          ?>
        </div>
        <div class="w-1/2">

          <div class="entry-content prose">

            <div class="summary entry-summary">
              <?php
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
              do_action('woocommerce_single_product_summary');
              ?>
            </div>

            <?php
            $heading = apply_filters('woocommerce_product_description_heading', __('Description', 'woocommerce'));
            $description = get_the_content();

            if ($description) {
            ?>
              <div class="product-description border-t border-gray-300 pt-12">
                <?php if ($heading) : ?>
                  <h2 class="mt-0" style="margin-top:0"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>

                <?php the_content(); ?>
              </div>
            <?php } ?>

            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php do_action('woocommerce_after_single_product'); ?>