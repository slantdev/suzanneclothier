<?php

/**
 * Template Name: Membership
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
$background_image_desktop = $hero_background['background_image_desktop'];
$background_image_mobile = $hero_background['background_image_mobile'];
$background_overlay = $hero_background['background_overlay'];

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
    <div class="container pt-24 lg:pt-32 pb-8 z-10 mx-auto max-w-7xl">
      <div class="flex">
        <div class="w-full lg:w-2/5 pb-12 lg:pb-20">
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
      <div class="container py-3 flex items-center mx-auto max-w-7xl">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Membership</span>
        </div>
      </div>
    </div>
  </section>

  <?php
  $intro_title = get_field('intro_title');
  $intro_description = get_field('intro_description');
  ?>
  <?php if ($intro_title) { ?>
    <section class="bg-white pb-8">
      <div class="container mx-auto max-w-7xl">
        <div class="text-center">
          <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
          <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
          <h3 class="text-4xl my-6 text-primary font-quincy"><?php echo $intro_title ?></h3>
          <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
        </div>
      </div>
    </section>
  <?php } ?>

  <section class="bg-secondary-light">
    <div class="container mx-auto py-12 lg:py-20 max-w-7xl">

      <?php if ($intro_description) { ?>
        <div class="max-w-lg text-center mb-8 mx-auto">
          <?php echo $intro_description ?>
        </div>
      <?php } ?>

      <?php
      if (have_rows('membership_pricing')) {
      ?>
        <div id="pricing-tabs" class="pricing-tabs">
          <div class="pricing-switch">
            <ul class="pricing-switch-buttons">

              <?php
              while (have_rows('membership_pricing')) : the_row();
                $billing_duration = get_sub_field('billing_duration');
                $target = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $billing_duration)));
                echo '<li><a href="#" class="pricing-switch-button" data-target="pricing-' . $target . '">' . $billing_duration . '</a></li>';
              endwhile;
              ?>

            </ul>
          </div>

          <div class="pricing-tab-container">
            <?php
            while (have_rows('membership_pricing')) : the_row();
              $billing_duration = get_sub_field('billing_duration');
              $pricing_table_shortcode = get_sub_field('pricing_table_shortcode');
              $target = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $billing_duration)));
              echo '<div id="pricing-' . $target . '" class="pricing-tab-content">';
              echo do_shortcode($pricing_table_shortcode);
              echo '</div>';
            endwhile;
            ?>
          </div>
        </div>
      <?php
      }
      ?>

      <?php
      $below_title = get_field('below_title');
      $below_description = get_field('below_description');
      $below_button = get_field('below_button');
      ?>
      <?php if ($below_description) { ?>
        <div class="max-w-lg text-center mt-8 mb-8 md:mb-12 mx-auto">
          <h3 class="text-2xl font-bold mb-4"><?php echo $below_title ?></h3>
          <div>
            <?php echo $below_description ?>
          </div>
          <?php if ($below_button) { ?>
            <div class="my-4"><a href="<?php echo $below_button['button_url'] ?>" class="font-bold whitespace-nowrap rounded-full px-8 py-4 inline-block bg-primary text-white transition duration-200 hover:bg-primary-light"><?php echo $below_button['button_text'] ?></a></div>
          <?php } ?>
        </div>
      <?php } ?>

      <?php if (have_rows('faqs')) : ?>
        <div class="max-w-3xl mx-auto my-8 xl:my-12">
          <?php while (have_rows('faqs')) : the_row();
            $faq_title = get_sub_field('faq_title');
            $faq_content = get_sub_field('faq_content');
          ?>

            <div class="faq group outline-none accordion-section rounded-3xl border border-gray-200 shadow-lg bg-gray-100 mb-6" tabindex="<?php echo get_row_index(); ?>">
              <div class="group bg-white border border-gray-200 -my-px -mx-px rounded-3xl flex justify-between px-6 py-4 items-center text-gray-800 transition ease duration-500 cursor-pointer pr-10 relative">
                <div class="font-bold uppercase">
                  <?php echo $faq_title ?>
                </div>
                <div class="h-8 w-8 text-primary-light text-lg rounded-full items-center inline-flex justify-center transform transition ease duration-500 group-focus:rotate-180 absolute top-0 right-0 mb-auto ml-auto mt-3 mr-3">
                  <ion-icon name="chevron-down-outline"></ion-icon>
                </div>
              </div>
              <div class="group-focus:max-h-screen max-h-0 bg-gray-100 px-6 overflow-hidden ease duration-500 text-gray-800 text-justify rounded-b-3xl rounded-l-3xl">
                <div class="py-6 text-gray-800 faq-content">
                  <?php echo $faq_content ?>
                </div>
              </div>
            </div>

          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>


</main>


<?php get_footer(); ?>