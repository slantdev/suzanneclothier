<?php

/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
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

$queried_object = get_queried_object();

$hero_image = get_field('hero_image', $queried_object);
$hero_overlay = get_field('hero_overlay', $queried_object);

?>

<section class="woocommerce-products-header hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>)">
  <?php if ($hero_overlay) {
    echo '<div class="absolute inset-0" style="background-color: ' . $hero_overlay . '"></div>';
  } ?>
  <div class="container pt-36 pb-20 z-10 mx-auto max-w-7xl">
    <div class="flex">
      <div class="w-2/5">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
          <h1 class="woocommerce-products-header__title page-title text-6xl font-quincy mb-5 text-primary"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>
        <?php
        /**
         * Hook: woocommerce_archive_description.
         *
         * @hooked woocommerce_taxonomy_archive_description - 10
         * @hooked woocommerce_product_archive_description - 10
         */
        do_action('woocommerce_archive_description');
        ?>
      </div>
    </div>
  </div>
  <div class="w-full bg-white bg-opacity-90 z-10">
    <div class="container h-12 flex items-center mx-auto max-w-7xl">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="container pb-10">
    <div class="text-center">
      <div class="mt-16 mb-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
      <h3 class="text-4xl my-6 text-primary font-quincy"><?php echo $queried_object->name ?></h3>
      <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
    </div>
  </div>
</section>

<div class="sticky top-0 z-30 bg-primary">
  <div class="container">
    <?php

    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $term_slug = $queried_object->slug;

    $params = array(
      'posts_per_page' => 1000,
      'post_type' => 'product',
      'orderby' => 'menu_order',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );

    $query = new WP_Query($params);

    $categories = array();

    foreach ($query->posts as $post_id) {
      $product_categories = get_the_terms($post_id, 'product_cat');
      if (!is_wp_error($product_categories) && $product_categories) {
        foreach ($product_categories as $product_cat) {
          if ($product_cat->term_id != 16) { // Exclude Uncategorized
            if (!isset($categories[$product_cat->term_id])) {
              $categories[$product_cat->term_id] = $product_cat;
            }
          }
        }
      }
    }

    if (!empty($categories)) {
      echo '<ul class="flex bg-primary overflow-x-auto items-center">';
      echo '<li class="px-8 py-3 bg-secondary text-primary font-bold font-quincy text-xl">' . $queried_object->name . '</li>';
      foreach ($categories as $key => $category) {
        echo '<li>';
        echo '<a href="#' . $category->slug . '" class="block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">';
        echo $category->name;
        echo '</a>';
        echo '</li>';
      }
      echo '</ul>';
    }

    ?>
  </div>

</div>

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
      //echo '<div class="flex justify-between mb-4">';
      //echo woocommerce_result_count();
      //echo woocommerce_catalog_ordering();
      //echo '</div>';

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
