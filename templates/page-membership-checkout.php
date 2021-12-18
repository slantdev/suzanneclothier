<?php

/**
 * Template Name: Membership Checkout
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-border-bottom';
  return $classes;
}

get_header();


?>

<main class="page-membership-checkout">

  <section class="bg-white">
    <div class="container mx-auto py-10 md:py-12 lg:py-20 max-w-2xl">

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