<?php

/**
 * Template Name: Checkout
 */

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'page-cart';
  return $classes;
}

get_header();

?>

<div class="container mx-auto my-8">

  <?php if (have_posts()) : ?>
    <?php
    while (have_posts()) :
      the_post();
    ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class('mb-12'); ?>>

        <header class="entry-header mb-4">
          <?php the_title(sprintf('<h2 class="entry-title text-2xl md:text-3xl font-extrabold leading-tight mb-1"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        </header>

        <?php the_content(); ?>

      </div>

    <?php endwhile; ?>

  <?php endif; ?>

</div>

<?php
get_footer();
