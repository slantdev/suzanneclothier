<?php

/**
 * Template Name: Dashboard
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-border-bottom';
  return $classes;
}

get_header();

?>

<main>

  <?php if (have_posts()) : ?>
    <?php
    while (have_posts()) :
      the_post();
    ?>

      <?php the_content(); ?>

    <?php endwhile; ?>

  <?php endif; ?>


</main>


<?php get_footer(); ?>