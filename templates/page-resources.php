<?php

/**
 * Template Name: Blog
 */

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

get_header();

$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
$hero_background = get_field('hero_background');
$background_image_desktop = $hero_background['background_image_desktop'];
$background_image_mobile = $hero_background['background_image_mobile'];
$background_overlay = $hero_background['background_overlay'];

$hero_image = '';
if ($background_image_desktop) {
  $hero_image = $background_image_desktop;
}

$post_type = get_field('post_type');
if (!$post_type) {
  $post_type = 'post';
}


// Gets Categories by Post Type
// returns categories that aren't empty
function get_categories_for_post_type($post_type = 'post', $taxonomy = '')
{
  $exclude = array(get_category_by_slug('videos')->term_id, get_category_by_slug('uncategorized')->term_id);
  $args = array(
    "taxonomy" => $taxonomy,
  );
  $categories = get_categories($args);

  // Check ALL categories for posts of given post type
  foreach ($categories as $category) {
    $posts = get_posts(array(
      'post_type' => $post_type,
      'tax_query' => array(
        array(
          'taxonomy' => $taxonomy,
          'field' => 'term_id',
          'terms' => $category->term_id
        )
      )
    ));

    // If no posts in category, add to exclude list
    if (empty($posts)) {
      $exclude[] = $category->term_id;
    }
  }

  // If exclude list, add to args
  //if (!empty($exclude)) {
  $args['exclude'] = implode(',', $exclude);
  //}

  // List categories
  return get_categories($args);
}

?>

<main>

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>)">
    <?php if ($background_overlay) {
      echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
    } ?>
    <div class="container pt-32 pb-8 z-10 mx-auto max-w-7xl">
      <div class="block lg:flex">
        <div class="w-full lg:w-2/5 pb-20 text-white">
          <h2 class="text-5xl lg:text-6xl font-quincy mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
          <?php if ($hero_description) {
            echo '<div>';
            echo $hero_description;
            echo '</div>';
          } ?>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container py-3 flex items-center mx-auto max-w-7xl">
        <?php if ($post_type == 'post') { ?>
          <div class="breadcrumb -mx-1">
            <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Blog</span>
          </div>
        <?php } ?>
        <?php if ($post_type != 'post') { ?>
          <?php if ($post_type == 'testimonial') { ?>
            <div class="breadcrumb -mx-1">
              <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Testimonials</span>
            </div>
          <?php } else { ?>
            <div class="breadcrumb -mx-1">
              <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Articles</span>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="bg-white">
    <div class="container mx-auto max-w-7xl">

      <?php if ($post_type == 'post') { ?>
        <div class="text-center">
          <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
          <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
          <h3 class="text-4xl my-6 text-primary font-quincy">Suzanne Clothier’s Blog</h3>
          <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
        </div>
        <div class="max-w-sm mx-auto my-12">
          <?php
          $args = array(
            'exclude' => array(get_category_by_slug('videos')->term_id, get_category_by_slug('uncategorized')->term_id)
          );
          $categories = get_categories($args);
          ?>
          <form class="flex bg-gray-50 shadow-md rounded-full">
            <select class="cat-list w-full py-3 px-6 bg-transparent rounded-full border-0 focus:outline-none focus:ring-0">
              <option value="">All</option>
              <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category->slug; ?>">
                  <?php echo $category->name; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <!-- <button class="filter-btn py-3 px-10 rounded-full bg-primary font-semibold text-white uppercase">Filter</button> -->
          </form>
        </div>
      <?php } ?>
      <?php if ($post_type != 'post') { ?>
        <?php if ($post_type == 'testimonial') { ?>
          <div class="text-center">
            <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
            <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
            <h3 class="text-4xl my-6 text-primary font-quincy">Suzanne Clothier Testimonials</h3>
            <div class="w-14 h-1 mt-6 mb-16 bg-secondary mx-auto"></div>
          </div>
        <?php } else { ?>
          <div class="text-center">
            <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
            <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
            <h3 class="text-4xl my-6 text-primary font-quincy">Suzanne Clothier’s Articles</h3>
            <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
          </div>
          <div class="text-center my-12">
            <?php
            $link_class_english = 'text-link hover:text-link-hover';
            $link_class_french = 'text-link hover:text-link-hover';
            $link_class_norway = 'text-link hover:text-link-hover';
            $link_class_dutch = 'text-link hover:text-link-hover';
            $link_class_italian = 'text-link hover:text-link-hover';

            if ($post_type == 'article') {
              $link_class_english = 'font-bold';
            }
            if ($post_type == 'articles_french') {
              $link_class_french = 'font-bold';
            }
            if ($post_type == 'article_norway') {
              $link_class_norway = 'font-bold';
            }
            if ($post_type == 'article_dutch') {
              $link_class_dutch = 'font-bold';
            }
            if ($post_type == 'article_it') {
              $link_class_italian = 'font-bold';
            }
            ?>
            <ul class="flex justify-start lg:justify-center gap-y-4 gap-x-8 text-sm lg:text-base lg:gap-x-12 xl:gap-x-16 border-t border-b py-6 border-solid border-gray-200 overflow-x-auto">
              <li><a class="<?php echo $link_class_english ?> whitespace-nowrap" href="/articles-in-english">Articles in English</a></li>
              <li><a class="<?php echo $link_class_dutch ?> whitespace-nowrap" href="/articles-in-dutch">Articles in Dutch</a></li>
              <li><a class="<?php echo $link_class_italian ?> whitespace-nowrap" href="/articles-in-italian">Articles in Italian</a></li>
              <li><a class="<?php echo $link_class_norway ?> whitespace-nowrap" href="/articles-in-norwegian">Articles in Norwegian</a></li>
              <li><a class="<?php echo $link_class_french ?> whitespace-nowrap" href="/articles-in-french">Articles in French</a></li>
            </ul>
          </div>

          <div class="max-w-sm mx-auto my-12">
            <?php
            // $args = array(
            //   'exclude' => array(get_category_by_slug('videos')->term_id, get_category_by_slug('uncategorized')->term_id)
            // );
            $categories = get_categories_for_post_type($post_type, 'category');

            ?>
            <form class="flex bg-gray-50 shadow-md rounded-full">
              <select class="article-cat-list w-full py-3 px-6 bg-transparent rounded-full border-0 focus:outline-none focus:ring-0">
                <option value="">All</option>
                <?php foreach ($categories as $category) : ?>
                  <option data-post="<?php echo $post_type ?>" value="<?php echo $category->slug; ?>">
                    <?php echo $category->name; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </form>
          </div>
        <?php } ?>
      <?php } ?>

      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'paged' => $paged,
      );
      $posts_query = new WP_Query($args);

      if ($posts_query->have_posts()) {
        echo '<div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 pb-12 gap-8">';
        while ($posts_query->have_posts()) {
          $posts_query->the_post();
          get_template_part('template-parts/blog-list-item');
        }
        echo '</div>';

        // echo '<div class="pb-24">';
        // echo pagination($posts_query->max_num_pages);
        // echo '</div>';
      } else {
      ?>
        <div class="text-center text-3xl">Sorry, there's no post in this category.</div>
      <?php
      }
      wp_reset_postdata();
      ?>



      <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto mt-20"></div>

    </div>
  </section>


</main>


<?php get_footer(); ?>