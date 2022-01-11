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
  <div class="container pt-12 lg:pt-32 pb-8 z-10 mx-auto">
    <div class="flex">
      <div class="w-full lg:w-2/5 pb-4 lg:pb-20">
        <h2 class="text-5xl lg:text-6xl font-quincy text-primary mb-0 lg:mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
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


          <?php if (!rcp_user_has_active_membership()) { ?>
            <?php
            $cta_title = get_field('cta_title', 2);
            $cta_description = get_field('cta_description', 2);
            $cta_button_text = get_field('cta_button_text', 2);
            $cta_button_url = get_field('cta_button_url', 2);
            ?>

            <?php if ($cta_title) { ?>
              <div class="cta-box relative lg:-mt-32 z-10 mb-6 lg:mb-8">
                <div class="block lg:flex items-center bg-primary text-white rounded-2xl shadow-md px-5 py-5 lg:px-14 lg:py-10">
                  <div class="block lg:inline-flex lg:pr-8 mb-4 lg:mb-0">
                    <h3 class="text-3xl lg:text-4_25xl font-quincy whitespace-nowrap"><?php echo $cta_title ?></h3>
                  </div>
                  <div class="block lg:inline-flex lg:px-8 lg:border-l border-white border-opacity-10">
                    <div class="text-sm lg:text-base mb-4 lg:mb-0"><?php echo $cta_description ?></div>
                  </div>
                  <div class="block lg:inline-flex ml-auto">
                    <a href="<?php echo $cta_button_url ?>" class="inline-flex min-w-full items-center justify-between leading-none py-2 pl-6 pr-2 rounded-full bg-white text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-4"><?php echo $cta_button_text ?></span>
                      <ion-icon name="arrow-forward-circle" class="text-4xl lg:text-5xl leading-none"></ion-icon>
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>

          <?php the_content(); ?>

        </div>

      <?php endwhile; ?>

    <?php endif; ?>

  </div>
</section>

<?php
get_footer();
