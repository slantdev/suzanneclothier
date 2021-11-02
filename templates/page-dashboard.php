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

  <section class="bg-white">
    <div class="container mx-auto pt-10 pb-20">

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