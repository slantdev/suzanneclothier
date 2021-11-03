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

<div class="sticky top-0 z-30 bg-primary text-white">
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

    $filters = array();

    foreach ($query->posts as $post_id) {
      $learning_paths = get_the_terms($post_id, 'learning_paths');
      if (!is_wp_error($learning_paths) && $learning_paths) {
        foreach ($learning_paths as $learning_path) {
          if (!isset($categories[$product_cat->term_id])) {
            $filters[$learning_path->term_id] = $learning_path;
          }
        }
      }
    }

    // echo '<pre>';
    // print_r($filters);
    // echo '</pre>';

    if (!empty($filters)) {
      echo '<ul class="flex bg-primary overflow-x-auto items-center justify-center">';
      echo '<li><a href="#" data-term="' . $term_slug . '" data-slug="" class="filter-button block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">All</a></li>';
      foreach ($filters as $key => $filter) {
        echo '<li>';
        echo '<a href="#" data-term="' . $term_slug . '" data-slug="' . $filter->slug . '" class="filter-button block text-white font-bold font-quincy text-xl px-8 py-3 whitespace-nowrap">';
        echo $filter->name;
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
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'paged' => $paged,
      'orderby' => 'menu_order',
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );
    $posts_query = new WP_Query($args);

    if ($posts_query->have_posts()) {
      echo '<div class="product-grid grid grid-cols-4 pb-12 gap-8">';
      while ($posts_query->have_posts()) {
        $posts_query->the_post();
        wc_get_template_part('content', 'product');
      }
      echo '</div>';

      // echo '<div class="pb-24">';
      // echo pagination($posts_query->max_num_pages);
      // echo '</div>';
    } else {
    ?>
      <div class="text-center text-3xl">Sorry, there's no product in this category.</div>
    <?php
    }
    wp_reset_postdata();
    ?>

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
