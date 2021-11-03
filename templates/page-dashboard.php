<?php

/**
 * Template Name: Dashboard
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
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

<main>

  <?php if (is_user_logged_in()) { ?>
    <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
      <?php if ($background_overlay) {
        echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
      } ?>
      <div class="container pt-24 pb-8 z-10 mx-auto max-w-7xl">
        <div class="flex">
          <div class="w-full pb-16">
            <h2 class="text-5xl text-white text-left font-quincy text-primary mb-5">Hi <?php echo esc_html($current_user->display_name) ?></h2>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

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