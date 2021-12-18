<?php

/**
 * Template Name: Homepage
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-transparent';
  return $classes;
}

get_header();

function learning_path_item($background, $title, $text, $url)
{
  $output = '';
  $output .= '<div class="learning-path--item">';
  $output .= '<a href="' . $url . '" class="learning-path--link flex flex-row items-center relative w-full h-full text-center text-white bg-cover bg-no-repeat bg-center rounded-2xl overflow-hidden" style="background-image: url(' . $background . ')">';
  $output .= '<div class="bg-overlay z-10"></div>';
  if ($text) {
    $output .= '<div class="relative px-6 py-20 z-20 xl:px-10 xl:py-32">';
    $output .= '<h4 class="text-4xl font-quincy mb-8">' . $title . '</h4>';
    $output .= '<div class="w-10 h-0.5 bg-white mx-auto mb-8"></div>';
    $output .= '<p class="text-sm leading-snug">' . $text . '</p>';
    $output .= '</div>';
  } else {
    $output .= '<div class="relative px-6 py-12 z-20 self-end">';
    $output .= '<h4 class="text-3xl font-quincy mb-0 mt-auto text-left">' . $title . '</h4>';
    $output .= '</div>';
  }
  $output .= '<div class="absolute bottom-0 right-0 p-1 z-20 leading-none"><ion-icon name="add" class="text-4xl leading-none"></ion-icon></div>';
  $output .= '</a>';
  $output .= '</div>';

  return $output;
}
?>

<main class="page-homepage">

  <?php
  $home_hero_background_image = get_field('home_hero_background_image');
  if (!$home_hero_background_image) {
    $home_hero_background_image = get_stylesheet_directory_uri() . '/assets/images/hero/hero-homepage.jpg';
  }
  $home_hero_title = get_field('home_hero_title');
  $home_hero_description = get_field('home_hero_description');
  $home_hero_button_text = get_field('home_hero_button_text');
  $home_hero_button_url = get_field('home_hero_button_url');
  ?>

  <section class="hero min-h-screen lg:min-h-screen-85 flex items-center" style="background-image: url(<?php echo $home_hero_background_image ?>)">
    <div class="container max-w-7xl mx-auto">
      <div class="flex">
        <div class="w-full lg:w-1/2 pb-24 lg:pb-20">
          <?php if ($home_hero_title) { ?>
            <h2 class="text-4_25xl lg:text-5xl xl:text-6xl text-primary font-quincy mb-5"><?php echo $home_hero_title ?></h2>
          <?php } ?>
          <?php if ($home_hero_description) { ?>
            <p class="mb-5"><?php echo $home_hero_description ?></p>
          <?php } ?>
          <?php if ($home_hero_button_text) { ?>
            <a href="<?php echo $home_hero_button_url ?>" class="inline-flex items-center leading-none py-2 pl-6 pr-2 rounded-full bg-secondary text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-4"><?php echo $home_hero_button_text ?></span>
              <ion-icon name="arrow-forward-circle" class="text-4xl lg:text-5xl leading-none"></ion-icon>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <section id="about-suzanne" class="bg-secondary-light">
    <div class="container max-w-7xl mx-auto">
      <?php
      $cta_title = get_field('cta_title');
      $cta_description = get_field('cta_description');
      $cta_button_text = get_field('cta_button_text');
      $cta_button_url = get_field('cta_button_url');
      ?>
      <div class="cta-box -mt-24 relative z-20">
        <div class="block lg:flex items-center bg-primary text-white rounded-2xl shadow-md px-5 py-5 lg:px-16 lg:py-16">
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
      <div class="container px-0 lg:px-4 max-w-7xl mx-auto">
        <?php
        $about_title = get_field('about_title');
        $about_image = get_field('about_image');
        $about_intro_text = get_field('about_intro_text');
        $about_body_text = get_field('about_body_text');
        $phone_number = get_field('phone_number');
        $email = get_field('email');
        $linkedin_url = get_field('linkedin_url');
        $learn_more_url = get_field('learn_more_url');
        ?>
        <div class="text-center">
          <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
          <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
          <h3 class="text-4xl my-6 text-primary font-quincy"><?php echo $about_title ?></h3>
          <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
        </div>
        <div class="block lg:flex items-center pt-8 lg:pt-14 pb-12 lg:pb-20 gap-12">
          <div class="w-full lg:w-1/2">
            <div class="mb-8"><img src="<?php echo $about_image ?>" class="rounded-full mx-auto" /></div>
            <div class="mb-8 lg:mb-0">
              <ul class="list-none flex justify-center gap-4 leading-none">
                <li><a href="tel:<?php echo $phone_number ?>" target="_blank">
                    <ion-icon class="text-3xl" name="call"></ion-icon>
                  </a></li>
                <li><a href="mailto:<?php echo $email ?>" target="_blank">
                    <ion-icon class="text-3xl" name="mail"></ion-icon>
                  </a></li>
                <li><a href="<?php echo $linkedin_url ?>" target="_blank">
                    <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="w-full lg:w-1/2">
            <div class="text-area">
              <?php echo $about_body_text ?>
            </div>
            <div class="mt-8">
              <a href="<?php echo $learn_more_url ?>" class="inline-flex items-center justify-between leading-none py-1 pl-6 pr-2 rounded-full bg-white text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-8">Learn more</span>
                <ion-icon name="arrow-forward-circle" class="text-4xl lg:text-5xl leading-none"></ion-icon>
              </a>
            </div>
          </div>
        </div>
      </div>
  </section>

  <section id="learning-path" class="bg-secondary-light">
    <div class="container pb-20">
      <div class="text-center mb-10 lg:mb-20">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">Choose your Learning Path</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <?php
      if (have_rows('learning_path_item')) :

        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">';

        while (have_rows('learning_path_item')) : the_row();

          $lp_title = get_sub_field('lp_title');
          $lp_description = get_sub_field('lp_description');
          $lp_image = get_sub_field('lp_image');
          $learning_path_url = get_sub_field('learning_path_url');

          $background = get_sub_field('lp_image');
          $title = get_sub_field('lp_title');
          $text = get_sub_field('lp_description');
          $url = get_sub_field('lp_url');
          echo learning_path_item($background, $title, $text, $url);

        endwhile;

        echo '</div>';

      endif;
      ?>

    </div>
  </section>


  <section>
    <?php if (have_rows('slides', 'option')) : ?>
      <div id="featured-courses" class="swiper">

        <div class="swiper-wrapper">
          <?php while (have_rows('slides', 'option')) : the_row(); ?>
            <?php
            $slide_title = get_sub_field('slide_title');
            $slide_description = get_sub_field('slide_description');
            $slide_background = get_sub_field('slide_background');
            $slide_button = get_sub_field('slide_button');
            ?>
            <div class="swiper-slide relative bg-black py-20 lg:py-28 bg-cover bg-no-repeat bg-center" style="background-image: url(<?php echo $slide_background['background_image']['url'] ?>)">
              <?php if ($slide_background['background_overlay']) {
                echo '<div class="absolute z-0 w-full h-full inset-0" style="background-color: ' . $slide_background['background_overlay'] . '"></div>';
              } ?>
              <div class="container relative z-10 max-w-7xl mx-auto">
                <div class="block lg:flex">
                  <div class="w-full lg:w-1/2">
                    <div class="text-white">
                      <h2 class="text-4xl font-quincy">Featured Course</h2>
                      <div class="w-14 h-1 my-6 bg-secondary"></div>
                      <?php if ($slide_title) {
                        echo '<h3 class="text-4xl font-bold mb-4">' . $slide_title . '</h3>';
                      } ?>
                      <?php if ($slide_description) {
                        echo '<p class="mb-8">' . $slide_description . '</p>';
                      } ?>
                      <?php if ($slide_button['button_url']) {
                        echo '<a href="' . $slide_button['button_url'] . '" class="inline-flex items-center leading-none py-2 pl-6 pr-2 rounded-full bg-secondary text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-4 uppercase">' . $slide_button['button_text'] . '</span>
                        <ion-icon name="arrow-forward-circle" class="text-4xl lg:text-5xl leading-none"></ion-icon>
                      </a >';
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="swiper-button-prev hidden lg:block"></div>
        <div class="swiper-button-next hidden lg:block"></div>

      </div>
    <?php endif; ?>

    <script>
      const coursesSwiper = new Swiper('#featured-courses', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
    </script>
  </section>

  <section id="latest-posts" class="py-16 lg:py-28">
    <div class="container max-w-7xl mx-auto">
      <div class="block lg:flex lg:gap-12 lg:divide-x lg:divide-black lg:divide-opacity-10">
        <div class="w-full lg:w-3/5">
          <div class="mb-8">
            <div class="flex justify-between items-center">
              <h4 class="text-3xl text-primary font-quincy">Latest Post</h4>
              <div><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-12 h-auto mx-auto"></div>
            </div>
            <div class="border-b border-black border-opacity-10 relative mt-4 pt-1">
              <div class="w-12 h-1 bg-secondary -mb-px"></div>
            </div>
          </div>
          <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'category__not_in' => array(get_category_by_slug('videos')->term_id)
          );
          $posts_query = new WP_Query($args);

          if ($posts_query->have_posts()) {
            echo '<div class="flex flex-col gap-8 mb-5 lg:mb-8">';
            while ($posts_query->have_posts()) {
              $posts_query->the_post();
          ?>
              <div class="block md:flex md:gap-8">
                <div class="w-full flex-none md:w-1/3">
                  <a href="<?php echo get_the_permalink(); ?>" class="block">
                    <div class="aspect-w-5 aspect-h-4 bg-primary-light bg-opacity-10 shadow-md rounded-xl overflow-hidden">
                      <?php
                      $thumbnail_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                      if (!$thumbnail_medium) {
                        $thumbnail_medium = get_stylesheet_directory_uri() . '/assets/images/sc-featured-image.png';
                      }
                      echo '<img src="' . $thumbnail_medium . '" class="w-full h-full object-cover object-center transform transition-transform scale-100 duration-500 hover:scale-110">';
                      ?>
                    </div>
                  </a>
                </div>
                <div class="w-full md:w-2/3">
                  <h4 class="text-xl md:text-2xl font-semibold text-primary mb-2 md:mb-4 mt-4">
                    <a href="<?php echo get_the_permalink(); ?>" class="text-primary transition hover:text-primary-light">
                      <?php echo get_the_title(); ?>
                    </a>
                  </h4>
                  <div class="text-sm break-words">
                    <?php echo get_the_excerpt(); ?>
                  </div>
                </div>
              </div>
            <?php
            }
            echo '</div>';
          } else {
            ?>
            <div class="text-center text-2xl lg:text-3xl">Sorry, there's no post in this category.</div>
          <?php
          }
          wp_reset_postdata();
          ?>
          <div class="bg-secondary-light py-1 px-4 text-right mt-4 lg:mt-8 mb-12 lg:mb-0"><a href="/resources" class="font-semibold text-primary text-sm">VIEW ALL &raquo;</a></div>
        </div>

        <div class="w-full lg:w-2/5 flex flex-col lg:pl-12">
          <div class="mb-8">
            <div class="flex justify-between items-center">
              <h4 class="text-3xl text-primary font-quincy">Upcoming Events</h4>
              <div><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-12 h-auto mx-auto"></div>
            </div>
            <div class="border-b border-black border-opacity-10 relative mt-4 pt-1">
              <div class="w-12 h-1 bg-secondary -mb-px"></div>
            </div>
          </div>

          <?php
          $args = array(
            'post_type' => 'mec-events',
            'posts_per_page' => 4,
          );
          $posts_query = new WP_Query($args);

          if ($posts_query->have_posts()) {
            echo '<div class="flex flex-col gap-8 mb-5 lg:mb-8">';
            while ($posts_query->have_posts()) {
              $posts_query->the_post();
          ?>
              <div class="block md:flex md:gap-6">

                <div class="w-full flex-none md:w-1/3">
                  <a href="<?php echo get_the_permalink(); ?>" class="block">
                    <div class="aspect-w-11 aspect-h-10 shadow-md rounded-xl overflow-hidden">
                      <?php
                      $thumbnail_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                      if (!$thumbnail_medium) {
                        $thumbnail_medium = get_stylesheet_directory_uri() . '/assets/images/sc-featured-image.png';
                      }
                      echo '<img src="' . $thumbnail_medium . '" class="w-full h-full object-cover object-center transform transition-transform scale-100 duration-500 hover:scale-110">';
                      ?>
                    </div>
                  </a>
                </div>
                <div class="w-full md:w-2/3">
                  <h4 class="text-xl md:text-base leading-tight font-semibold text-primary mb-2 md:mb-3 mt-4 md:mt-1"><a href="<?php echo get_the_permalink(); ?>" class="text-primary transition hover:text-primary-light">
                      <?php echo get_the_title(); ?>
                    </a></h4>
                  <div class="text-xs break-words">
                    <?php echo get_the_excerpt(); ?>
                  </div>
                </div>
              </div>
            <?php
            }
            echo '</div>';
          } else {
            ?>
            <div class="text-2xl lg:text-3xl">Sorry, there's no post in this category.</div>
          <?php
          }
          wp_reset_postdata();
          ?>

          <div class="bg-secondary-light py-1 px-4 text-right mt-4 lg:mt-auto"><a href="/events" class="font-semibold text-primary text-sm">VIEW ALL &raquo;</a></div>
        </div>
      </div>
    </div>
  </section>

  <?php
  get_template_part('template-parts/section-testimonial-slider');
  ?>

</main>

<?php get_footer(); ?>