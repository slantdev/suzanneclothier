<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

add_filter('body_class', 'my_body_classes');
function my_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

$shop_page_id = get_option('woocommerce_shop_page_id');

$hero_title = get_field('hero_title', $shop_page_id);
$hero_description = get_field('hero_description', $shop_page_id);
$hero_background = get_field('hero_background', $shop_page_id);
$background_image_desktop = $hero_background['background_image_desktop'];
$background_image_mobile = $hero_background['background_image_mobile'];
$background_overlay = $hero_background['background_overlay'];
$text_color = $hero_background['text_color'];
if ($text_color == 'dark') {
  $text_color = 'text-primary';
} else {
  $text_color = 'text-white';
};
$hero_image = '';
if ($background_image_desktop) {
  $hero_image = $background_image_desktop;
}

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>

<section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
  <?php if ($background_overlay) {
    echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
  } ?>
  <div class="container pt-32 pb-8 z-10 mx-auto">
    <div class="block lg:flex">
      <div class="w-full lg:w-2/5 pb-20">
        <h2 class="text-5xl lg:text-6xl font-quincy mb-5 <?php echo $text_color ?>"><?php echo ($hero_title) ? $hero_title : woocommerce_page_title() ?></h2>
        <?php if ($hero_description) {
          echo '<div class="' . $text_color . '">';
          echo $hero_description;
          echo '</div>';
        } ?>
      </div>
    </div>
  </div>
  <div class="w-full bg-white bg-opacity-50 z-10">
    <div class="container h-12 flex items-center mx-auto">
      <div class="breadcrumb -mx-1 <?php echo $text_color ?>">
        <span class="inline-block px-1"><a class="hover:text-white" href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Shop</span>
      </div>
    </div>
  </div>
</section>

<div class="pt-20 pb-24 bg-secondary-light">
  <div class="container">

    <?php
    if (woocommerce_product_loop()) {

      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      //do_action('woocommerce_before_shop_loop');
      echo woocommerce_output_all_notices();
      echo '<div class="flex justify-between mb-4">';
      echo woocommerce_result_count();
      echo woocommerce_catalog_ordering();
      echo '</div>';

      woocommerce_product_loop_start();

      if (wc_get_loop_prop('total')) {
        while (have_posts()) {
          the_post();

          /**
           * Hook: woocommerce_shop_loop.
           */
          do_action('woocommerce_shop_loop');

          wc_get_template_part('content', 'product');
        }
      }

      woocommerce_product_loop_end();

      /**
       * Hook: woocommerce_after_shop_loop.
       *
       * @hooked woocommerce_pagination - 10
       */
      do_action('woocommerce_after_shop_loop');
    } else {
      /**
       * Hook: woocommerce_no_products_found.
       *
       * @hooked wc_no_products_found - 10
       */
      do_action('woocommerce_no_products_found');
    } ?>

  </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action( 'woocommerce_sidebar' );

get_footer('shop');
