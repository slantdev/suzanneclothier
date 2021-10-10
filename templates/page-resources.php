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
?>

<main>

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>)">
    <?php if ($background_overlay) {
      echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
    } ?>
    <div class="container pt-32 pb-8 z-10">
      <div class="flex">
        <div class="w-1/2 pb-20 text-white">
          <h2 class="text-6xl font-sans mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
          <?php if ($hero_description) {
            echo '<div>';
            echo $hero_description;
            echo '</div>';
          } ?>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container h-12 flex items-center">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Blog</span>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white">
    <div class="container">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-sans">Suzanne Clothier’s Blog</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="max-w-lg mx-auto my-12">
        <form class="flex bg-gray-50 shadow-md rounded-full">
          <select class="w-full px-6 bg-transparent rounded-full border-0 focus:outline-none focus:ring-0">
            <option>ALL</option>
            <option>Cat 1</option>
            <option>Cat 2</option>
          </select>
          <button class="py-3 px-10 rounded-full bg-primary font-semibold text-white uppercase">Filter</button>
        </form>
      </div>

      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 8
      );
      $posts_query = new WP_Query($args);

      if ($posts_query->have_posts()) {
        echo '<div class="grid grid-cols-3 pb-24 gap-8">';
        while ($posts_query->have_posts()) {
          $posts_query->the_post();
      ?>
          <div class="shadow-md rounded-2xl bg-gray-100 overflow-hidden flex flex-col">
            <div class="rounded-t-2xl overflow-hidden">
              <a href="<?php echo get_the_permalink(); ?>" class="block">
                <div class="aspect-w-16 aspect-h-9 bg-primary-light bg-opacity-10">
                  <?php
                  $thumbnail_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                  if ($thumbnail_medium) {
                    echo '<img src="' . $thumbnail_medium . '" class="w-full h-full object-cover object-center transform transition-transform scale-100 duration-500 hover:scale-110">';
                  } else {
                    echo '<div class="flex items-center justify-center"><ion-icon name="image-outline" class="text-5xl text-primary-light text-opacity-50"></ion-icon></div>';
                  }
                  ?>
                </div>
              </a>
            </div>
            <div class="pt-5 pb-4 px-6 flex flex-col flex-grow">
              <h3 class="mb-4 text-lg font-semibold">
                <a href="<?php echo get_the_permalink(); ?>" class="text-primary transition hover:text-primary-light"><?php echo get_the_title(); ?></a>
              </h3>
              <div class="text-sm mb-2"><?php echo get_the_excerpt(); ?></div>
              <div class="text-right leading-none mt-auto -mr-2">
                <a href="<?php echo get_the_permalink(); ?>" class="inline-block leading-none text-primary transition hover:text-primary-light">
                  <ion-icon name="add-circle" class="text-right text-4xl leading-none"></ion-icon>
                </a>
              </div>
            </div>
          </div>
        <?php
        }
        echo '</div>';
      } else {
        ?>
        <div class="text-center text-3xl">Sorry, there's no post in this category.</div>
      <?php
      }
      wp_reset_postdata();
      ?>

      <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>

    </div>
  </section>


</main>


<?php get_footer(); ?>