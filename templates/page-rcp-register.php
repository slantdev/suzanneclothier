<?php

/**
 * Template Name: RCP Register
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
$background_image_desktop = $hero_background['background_image_desktop'] ?? '';
$background_image_mobile = $hero_background['background_image_mobile'] ?? '';
$background_overlay = $hero_background['background_overlay'] ?? '';

$hero_image = '';
if ($background_image_desktop) {
  $hero_image = $background_image_desktop;
}

?>

<main class="page-membership">

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>)">
    <?php if ($background_overlay) {
      echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
    } ?>
    <div class="container pt-32 pb-8 z-10 mx-auto max-w-7xl">
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
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container h-12 flex items-center mx-auto max-w-7xl">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Membership</span>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white pb-8">
    <div class="container mx-auto max-w-7xl">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">Membership Packages</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
    </div>
  </section>

  <section class="bg-secondary-light">
    <div class="container mx-auto py-20 max-w-7xl">

      <div class="max-w-lg text-center mb-8 mx-auto">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
      </div>

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