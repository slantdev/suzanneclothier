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

$show_intro = get_field('show_intro', $queried_object);
$intro_image = get_field('intro_image', $queried_object);
$intro_text = get_field('intro_text', $queried_object);

?>

<section class="woocommerce-products-header hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>)">
  <?php if ($hero_overlay) {
    echo '<div class="absolute inset-0" style="background-color: ' . $hero_overlay . '"></div>';
  } ?>
  <div class="container pt-24 lg:pt-36 pb-14 lg:pb-20 z-10 mx-auto max-w-7xl">
    <div class="flex">
      <div class="w-full lg:w-2/5">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
          <h1 class="woocommerce-products-header__title page-title text-5xl lg:text-6xl font-quincy mb-5 text-primary"><?php woocommerce_page_title(); ?></h1>
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
    <div class="container py-3 text-sm lg:text-base flex items-center mx-auto max-w-7xl">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>
</section>

<?php if ($show_intro) { ?>
  <section class="bg-secondary-light learning-path-intro">
    <div class="container">
      <div class="flex pt-14 pb-20 gap-12 items-center">
        <div class="w-1/2">
          <div class="px-14">
            <div class="mb-8 max-w-md ml-auto"><img src="<?php echo $intro_image ?>" class="rounded-full mx-auto" /></div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="intro-text">
            <?php echo $intro_text ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>

<div class="sticky top-0 z-10 bg-primary">
  <div class="container px-0 lg:px-4">
    <?php

    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    $term_slug = $queried_object->slug;

    // Product Categories Args
    $params = array(
      'posts_per_page' => 1000,
      'post_type' => 'product',
      //'orderby' => 'name',
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

    //$slug = array_column($categories, 'slug');

    //array_multisort($slug, SORT_ASC, $categories);

    $product_cat = get_terms(array(
      'taxonomy' => 'product_cat',
      'hide_empty' => true,
      'orderby' => 'menu_order',
      'exclude' => 16
    ));


    $order = array();
    foreach ($product_cat as $cat) {
      $order[] = $cat->term_id;
    }
    //var_dump($order);

    uksort($categories, function ($a, $b) use ($order) {
      foreach ($order as $value) {
        if ($a == $value) {
          return 0;
          break;
        }
        if ($b == $value) {
          return 1;
          break;
        }
      }
    });

    // echo '<pre>';
    // print_r($categories);
    // echo '</pre>';

    // Articles Args
    $defaults = array(
      'fields'                 => 'ids',
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'cache_results'          => false
    );
    $article = array(
      'posts_per_page' => -1,
      'post_type' => 'article',
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );
    $articles_french = array(
      'posts_per_page' => -1,
      'post_type' => 'articles_french',
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );
    $article_norway = array(
      'posts_per_page' => -1,
      'post_type' => 'article_norway',
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );
    $article_dutch = array(
      'posts_per_page' => -1,
      'post_type' => 'article_dutch',
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );
    $article_it = array(
      'posts_per_page' => -1,
      'post_type' => 'article_it',
      'orderby' => 'date',
      'tax_query' => array(
        array(
          'taxonomy' => 'learning_paths',
          'field'    => 'slug',
          'terms'    => $term_slug,
        ),
      ),
    );

    $article_query = get_posts(array_merge($defaults, $article));
    $article_french_query = get_posts(array_merge($defaults, $articles_french));
    $article_norway_query = get_posts(array_merge($defaults, $article_norway));
    $article_dutch_query = get_posts(array_merge($defaults, $article_dutch));
    $article_it_query = get_posts(array_merge($defaults, $article_it));

    $articles = array_merge($article_query, $article_french_query, $article_norway_query, $article_dutch_query, $article_it_query);

    echo '<ul class="flex bg-primary overflow-x-auto items-center justify-start lg:justify-center">';
    if (!empty($categories)) {
      foreach ($categories as $key => $category) {
        echo '<li>';
        echo '<a href="#' . $category->slug . '" class="block text-white font-bold font-quincy text-xl px-6 py-3 whitespace-nowrap">';
        echo $category->name;
        echo '</a>';
        echo '</li>';
      }
    }
    if (!empty($articles)) {
      echo '<li>';
      echo '<a href="#articles" class="block text-white font-bold font-quincy text-xl px-6 py-3 whitespace-nowrap">';
      echo 'Articles';
      echo '</a>';
      echo '</li>';
      echo '</ul>';
    }
    ?>
  </div>

</div>

<?php

$term_id = $queried_object->term_id;
$term_slug = $queried_object->slug;

// Product Categories
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
      'posts_per_page' => -1,
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

      echo '<div class="text-center mb-10 lg:mb-20">
        <div class="h-10 lg:h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4_25xl my-6 text-primary font-quincy">' . $category->name . '</h3>
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

      echo '<div class="text-center mt-16">
        <div class="h-10 lg:h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
      </div>';

      echo '</div>';
      echo '</div>';
    }
  }
}

// Articles
if (!empty($articles)) {
  $final_args = array(
    'post_type' => ['article', 'articles_french', 'article_norway', 'article_dutch', 'article_it'],
    'post__in'  => $articles,
    'orderby' => 'date',
  );

  $the_query = new WP_Query($final_args);

  if ($the_query->have_posts()) {

    echo '<div id="articles" class="section-anchor ' . (++$count % 2 ? "" : " bg-secondary-light") . '">';
    echo '<div class="container">';

    echo '<div class="text-center mb-10 lg:mb-20">
    <div class="h-10 lg:h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
    <div class="my-8"><img src="' . get_stylesheet_directory_uri() . '/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
    <h3 class="text-4_25xl my-6 text-primary font-quincy">Articles</h3>
    <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
  </div>';

    echo '<div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pb-12 gap-8">';
    while ($the_query->have_posts()) {
      $the_query->the_post();
      get_template_part('template-parts/blog-list-item');
    }
    echo '</div>';

    echo '<div class="text-center mt-16">
    <div class="h-10 lg:h-16 w-px bg-primary bg-opacity-50 mx-auto"></div>
  </div>';

    echo '</div>';
    echo '</div>';
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
