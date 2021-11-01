<?php

/**
 * Template Name: Simple
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-border-bottom';
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

  <section class="bg-white">
    <div class="container mx-auto py-20 max-w-7xl">

      <?php if (have_posts()) : ?>
        <?php
        while (have_posts()) :
          the_post();
        ?>

          <?php the_content(); ?>

        <?php endwhile; ?>

      <?php endif; ?>

    </div>
  </section>


</main>


<?php get_footer(); ?>