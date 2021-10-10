<?php

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

get_header();
?>

<main class="page-single">

  <?php if (have_posts()) : ?>

    <?php
    while (have_posts()) :
      the_post();
    ?>

      <?php get_template_part('template-parts/content', 'single'); ?>

    <?php endwhile; ?>

  <?php endif; ?>

</main>

<?php
get_footer();
