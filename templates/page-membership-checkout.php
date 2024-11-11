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

$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
$hero_background = get_field('hero_background');
$background_image_desktop = $hero_background['background_image_desktop'] ?? '';
$background_image_mobile = $hero_background['background_image_mobile'] ?? '';
$background_overlay = $hero_background['background_overlay'] ?? '';

global $post;

$parentId = $post->post_parent;
$linkToParent = get_permalink($parentId);
?>

<main class="page-membership-checkout">

  <?php if ($hero_image) { ?>
    <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
    <?php } else { ?>
      <section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
      <?php } ?>
      <?php if ($background_overlay) {
        echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
      } ?>
      <div class="container pt-32 pb-8 z-10 mx-auto max-w-7xl">
        <div class="block lg:flex">
          <div class="w-full lg:w-2/5 pb-20">
            <h2 class="text-5xl lg:text-6xl font-quincy text-primary mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
            <?php if ($hero_description) {
              echo '<div>';
              echo $hero_description;
              echo '</div>';
            } ?>
          </div>
        </div>
      </div>
      <div class="w-full bg-white bg-opacity-90 z-10">
        <div class="container flex items-center max-w-7xl mx-auto">
          <div class="breadcrumb py-2 -mx-1 text-sm lg:text-base">
            <span class="inline-block px-1"><a href="/">Home</a></span>
            <?php if ($parentId) { ?>
              <span class="inline-block px-1"> / </span>
              <span class="inline-block px-1"><a href="<?php echo $linkToParent ?>"><?php echo get_the_title($parentId) ?></a></span>
            <?php } ?>
            <span class="inline-block px-1"> / </span>
            <span class="font-semibold inline-block px-1"><?php the_title(); ?></span>
          </div>
        </div>
      </div>
      </section>

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