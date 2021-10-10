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
  <div class="container pt-32 pb-8 z-10">
    <div class="flex">
      <div class="w-1/2 pb-20 text-white">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
          <h1 class="woocommerce-products-header__title page-title text-6xl font-sans mb-5 text-white"><?php woocommerce_page_title(); ?></h1>
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
    <div class="container h-12 flex items-center">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>
</section>

<section class="bg-secondary-light">
  <div class="container">
    <div class="flex pt-14 pb-20 gap-12 items-center">
      <div class="w-1/2">
        <div class="px-14">
          <div class="mb-8 max-w-md ml-auto"><img src="<?php echo get_home_url() ?>/wp-content/themes/suzanneclothier/assets/images/learning-path/learningpath-intro.jpg" class="rounded-full mx-auto" /></div>
        </div>
      </div>
      <div class="w-1/2">
        <div class="font-medium">
          <p class="text-xl mb-4">Suzanne Clothier is an internationally respected dog trainer, and the author of many publications, including Bones Would Rain from the Sky: Deepening Our Relationships with Dogs. She teaches seminars throughout the US & internationally on a wide range of topics.</p>

          <p class="mb-4">Suzanne’s approach to dog training, Relationship Centered Training™ (RCT), blends science and heart in a satisfying blend that has helped countless people and dogs create healthy, happy relationships.</p>
        </div>
      </div>
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
          'taxonomy' => 'learning_paths',
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
      echo '<li class="px-8 py-3 bg-secondary text-primary font-bold font-sans">' . $queried_object->name . '</li>';
      foreach ($categories as $key => $category) {
        echo '<li>';
        echo '<a href="#' . $category->slug . '" class="block text-white font-bold font-sans px-8 py-3 whitespace-nowrap">';
        echo $category->name;
        echo '</a>';
        echo '</li>';
      }
      echo '</ul>';
    }

    ?>
  </div>

</div>

<?php

$term_id = $queried_object->term_id;
$term_slug = $queried_object->slug;

$product_cat_args = array(
  'orderby'    => 'menu_order',
  'order'      => 'asc',
  'hide_empty' => true,
  'exclude'    => 16
);

$product_categories = get_terms('product_cat', $product_cat_args);

if (!empty($product_categories)) {

  $count = 0;
  foreach ($product_categories as $key => $category) {

    $params = array(
      'posts_per_page' => 8,
      'post_type' => 'product',
      'orderby' => 'menu_order',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $category->slug,
        ),
      ),
    );

    $wc_query = new WP_Query($params);

    // echo '<pre>';
    // print_r($wc_query);
    // echo '</pre>';

    if ($wc_query->have_posts()) {

      echo '<div id="' . $category->slug . '" class="section-anchor ' . (++$count % 2 ? "" : " bg-secondary-light") . '">';
      echo '<div class="container">';

      echo '<div class="text-center mb-10">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-sans">' . $category->name . '</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>';

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

      // echo '<div class="flex justify-center mt-12">';
      // echo '<a href="' . get_term_link($category) . '" class="w-44 inline-flex items-center justify-between leading-none py-2 pl-6 pr-2 rounded-full bg-secondary text-primary font-semibold shadow-md hover:shadow-lg transition-all">
      // <span class="inline-block whitespace-nowrap font-sans mr-4">Load More</span>
      // <ion-icon name="add-circle" class="text-4xl text-white leading-none md hydrated" role="img" aria-label="add-circle"></ion-icon>
      // </a>';
      // echo '</div>';

      echo '<div class="text-center mt-16">
        <div class="h-12 w-px bg-primary bg-opacity-50 mx-auto"></div>
      </div>';

      echo '</div>';
      echo '</div>';
    }
  }
}

?>

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
