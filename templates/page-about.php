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

get_header();
?>

<main class="page-about">

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/hero/hero-about.jpg)">
    <div class="container pt-32 pb-8 mx-auto max-w-7xl">
      <div class="flex">
        <div class="w-2/5 pb-20">
          <h2 class="text-6xl text-primary font-quincy mb-5">About Us</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
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
    <div class="container mx-auto max-w-7xl">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">About Suzanne</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="flex pt-14 pb-20 gap-12">
        <div class="w-1/2">
          <div class="px-14">
            <div class="mb-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/about-suzanne.jpg" class="rounded-full mx-auto" /></div>
            <div>
              <ul class="list-none flex flex-col gap-4 leading-none">
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="mail"></ion-icon>
                  <a href="#">info@suzanneclothier.com</a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  <a href="#">https://au.linkedin.com/in/suzanne-clothier</a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="call"></ion-icon>
                  <a href="#">1-800-7-FLY-DOG</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="font-medium">
            <p class="text-xl mb-4">Suzanne Clothier is an internationally respected dog trainer, and the author of many publications, including Bones Would Rain from the Sky: Deepening Our Relationships with Dogs. She teaches seminars throughout the US & internationally on a wide range of topics.</p>

            <p class="mb-4">Suzanne’s approach to dog training, Relationship Centered Training™ (RCT), blends science and heart in a satisfying blend that has helped countless people and dogs create healthy, happy relationships.</p>

            <p class="mb-4">RCT™ techniques are innovative, practical, effective and humane - and fun! Whether you want to understand your dog better, solve a behavior problem, improve your dog training & handling skills, or add some new tools to your training toolbox, Relationship Centered Training™ provides a wealth of information.</p>

            <p class="mb-4">Suzanne’s approach to dog training, Relationship Centered Training™ (RCT), blends science and heart in a satisfying blend that has helped countless people and dogs create healthy, happy relationships.</p>

            <p class="mb-4">RCT™ techniques are innovative, practical, effective and humane - and fun! Whether you want to understand your dog better, solve a behavior problem, improve your dog training & handling skills, or add some new tools to your training toolbox, Relationship Centered Training™ provides a wealth of information.</p>

            <p class="mb-4">Suzanne’s approach to dog training, Relationship Centered Training™ (RCT), blends science and heart in a satisfying blend that has helped countless people and dogs create healthy, happy relationships.</p>

            <p class="mb-4">RCT™ techniques are innovative, practical, effective and humane - and fun! Whether you want to understand your dog better, solve a behavior problem, improve your dog training & handling skills, or add some new tools to your training toolbox, Relationship Centered Training™ provides a wealth of information.</p>
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