<?php

/**
 * Template Name: About
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

<main class="page-about">

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
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
    <div class="w-full bg-white bg-opacity-50">
      <div class="container h-12 flex items-center mx-auto max-w-7xl">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">About Us</span>
        </div>
      </div>
    </div>
  </section>

  <section id="about-suzanne" class="bg-secondary-light">
    <?php
    $about_title = get_field('about_title');
    $about_image = get_field('about_image');
    $about_intro_text = get_field('about_intro_text');
    $about_body_text = get_field('about_body_text');
    $phone_number = get_field('phone_number');
    $email = get_field('email');
    $linkedin_url = get_field('linkedin_url');
    ?>
    <div class="container mx-auto max-w-7xl">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy"><?php echo $about_title ?></h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="flex pt-14 pb-20 gap-12">
        <div class="w-1/2">
          <div class="px-14">
            <div class="mb-8"><img src="<?php echo $about_image ?>" class="rounded-full mx-auto" /></div>
            <div>
              <ul class="list-none flex flex-col gap-4 leading-none">
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="mail"></ion-icon>
                  <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  <a href="<?php echo $linkedin_url ?>" target="_blank"><?php echo $linkedin_url ?></a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="call"></ion-icon>
                  <a href="tel:<?php echo $phone_number ?>"><?php echo $phone_number ?></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="text-area">
            <?php echo $about_body_text ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="testimonial" class="pb-28 bg-primary-light bg-opacity-10">
    <div class="container">
      <div class="h-10 w-px bg-black bg-opacity-20 mx-auto"></div>
      <div class="text-center mb-8">
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">What our customers say about us</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <?php
      $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => 3
      );
      $the_query = new WP_Query($args);

      // The Loop
      if ($the_query->have_posts()) {
        echo '<div id="testimonials" class="swiper"><div class="swiper-wrapper">';
        while ($the_query->have_posts()) {
          $the_query->the_post();
      ?>
          <div class="swiper-slide">
            <div class="max-w-3xl mx-auto text-sm bg-white rounded-2xl shadow-md mb-4">
              <div class="w-full flex py-10 px-10 gap-10">
                <div class="w-1/5">
                  <div class="rounded-full overflow-hidden mb-4 w-32 h-32 mx-auto">
                    <img src="<?php the_post_thumbnail_url() ?>" class="object-cover object-center w-full h-full">
                  </div>
                  <h4 class="text-2xl text-primary font-semibold text-center"><?php the_title() ?></h4>
                </div>
                <div class="w-4/5">
                  <?php the_content() ?>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
        echo '</div>';
        echo '<div class="swiper-button-prev"></div>';
        echo '<div class="swiper-button-next"></div>';

        echo '</div></div>';
      }
      wp_reset_postdata();

      ?>

    </div>
    <script>
      const testimonialSwiper = new Swiper('#testimonials', {
        direction: 'horizontal',
        loop: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    </script>
  </section>

</main>


<?php get_footer(); ?>