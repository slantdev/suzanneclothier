<?php

/**
 * Template Name: Cart
 */

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent page-cart';
  return $classes;
}

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

get_header();

?>
<section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
  <?php if ($background_overlay) {
    echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
  } ?>
  <div class="container pt-32 pb-8 z-10 mx-auto">
    <div class="flex">
      <div class="w-2/5 pb-20">
        <h2 class="text-6xl font-quincy text-primary mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
        <?php if ($hero_description) {
          echo '<div>';
          echo $hero_description;
          echo '</div>';
        } ?>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container mx-auto my-12">

    <?php if (have_posts()) : ?>
      <?php
      while (have_posts()) :
        the_post();
      ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('mb-12'); ?>>

          <?php the_content(); ?>

        </div>

      <?php endwhile; ?>

    <?php endif; ?>

  </div>
</section>

<?php
get_footer();
