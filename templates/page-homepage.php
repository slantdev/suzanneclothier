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

  <section class="hero min-h-screen flex items-center" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/hero/hero-homepage.jpg)">
    <div class="container max-w-7xl mx-auto">
      <div class="flex">
        <div class="w-1/2 pb-20">
          <h2 class="text-6xl text-primary font-quincy mb-5">Relationship Centered Training</h2>
          <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
          <a href="#" class="inline-flex items-center leading-none py-2 pl-6 pr-2 rounded-full bg-secondary text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-4">Learn more about RCT</span>
            <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="about-suzanne" class="bg-secondary-light">
    <div class="container max-w-7xl mx-auto">
      <div class="cta-box -mt-24 relative z-20">
        <div class="flex items-center bg-primary text-white rounded-2xl shadow-md px-16 py-16">
          <div class="w-2/4 pr-8">
            <h3 class="text-4_25xl font-quincy">Become a member<br><span class="text-secondary">& enjoy the benefits</span></h3>
          </div>
          <div class="w-3/4 pl-12 border-l border-white border-opacity-10">
            <div class="flex items-center gap-12">
              <div class="w-3/5">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
              </div>
              <div class="w-2/5">
                <a href="#" class="inline-flex min-w-full items-center justify-between leading-none py-2 pl-6 pr-2 rounded-full bg-white text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-4">Learn more</span>
                  <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container max-w-7xl mx-auto">
        <div class="text-center">
          <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
          <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
          <h3 class="text-4xl my-6 text-primary font-quincy">About Suzanne</h3>
          <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
        </div>
        <div class="flex items-center pt-14 pb-20 gap-12">
          <div class="w-1/2">
            <div class="mb-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/about-suzanne.jpg" class="rounded-full mx-auto" /></div>
            <div>
              <ul class="list-none flex justify-center gap-4 leading-none">
                <li><a href="#">
                    <ion-icon class="text-3xl" name="call"></ion-icon>
                  </a></li>
                <li><a href="#">
                    <ion-icon class="text-3xl" name="mail"></ion-icon>
                  </a></li>
                <li><a href="#">
                    <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  </a></li>
              </ul>
            </div>
          </div>
          <div class="w-1/2">
            <div class="font-medium">
              <p class="text-xl mb-4">Suzanne Clothier is an internationally respected dog trainer, and the author of many publications, including Bones Would Rain from the Sky: Deepening Our Relationships with Dogs. She teaches seminars throughout the US & internationally on a wide range of topics.</p>

              <p class="mb-4">Suzanne’s approach to dog training, Relationship Centered Training™ (RCT), blends science and heart in a satisfying blend that has helped countless people and dogs create healthy, happy relationships.</p>

              <p class="mb-4">RCT™ techniques are innovative, practical, effective and humane - and fun! Whether you want to understand your dog better, solve a behavior problem, improve your dog training & handling skills, or add some new tools to your training toolbox, Relationship Centered Training™ provides a wealth of information.</p>
            </div>
            <div class="mt-8">
              <a href="#" class="inline-flex items-center justify-between leading-none py-1 pl-6 pr-2 rounded-full bg-white text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-8">Learn more</span>
                <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
              </a>
            </div>
          </div>
        </div>
      </div>
  </section>

  <section id="learning-path" class="bg-secondary-light">
    <div class="container pb-20">
      <div class="text-center mb-20">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">Choose your Learning Path</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-01.jpg';
        $title = 'Behavior';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/behavior';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-02.jpg';
        $title = 'Training';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/training';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-03.jpg';
        $title = 'Relationship';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/relationship';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-04.jpg';
        $title = 'Performance';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/performance';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-05.jpg';
        $title = 'Professional';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/professional';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-06.jpg';
        $title = 'Rescue';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/rescue';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-07.jpg';
        $title = 'Breeding';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.';
        $url = '/learning_paths/breeding';
        echo learning_path_item($background, $title, $text, $url);
        ?>
        <?php
        $background = get_stylesheet_directory_uri() . '/assets/images/learning-path/learningpath-bg-08.jpg';
        $title = 'Need Help In Choosing Your Learning Path?';
        $text = '';
        $url = '/contact-us';
        echo learning_path_item($background, $title, $text, $url);
        ?>
      </div>
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
            <div class="swiper-slide relative bg-black py-28 bg-cover bg-no-repeat bg-center" style="background-image: url(<?php echo $slide_background['background_image']['url'] ?>)">
              <?php if ($slide_background['background_overlay']) {
                echo '<div class="absolute z-0 w-full h-full inset-0" style="background-color: ' . $slide_background['background_overlay'] . '"></div>';
              } ?>
              <div class="container relative z-10 max-w-7xl mx-auto">
                <div class="flex">
                  <div class="w-1/2">
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
                        <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
                      </a >';
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

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



  <section id="featured-videos" class="bg-secondary-light">
    <div class="container max-w-7xl mx-auto">
      <div class="h-10 w-px bg-black bg-opacity-20 mx-auto"></div>
      <div class="text-center mb-8">
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy">Featured Videos</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
        <div class="max-w-2xl mx-auto text-sm">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
        </div>
      </div>


      <?php
      $args = array(
        'category_name' => 'videos',
        'posts_per_page' => 3
      );
      $the_query = new WP_Query($args);

      // The Loop
      if ($the_query->have_posts()) {
        echo '<div class="grid grid-cols-3 gap-6">';
        while ($the_query->have_posts()) {
          $the_query->the_post();
      ?>
          <div>
            <div class="mb-4">
              <a href="<?php the_permalink() ?>" class="block relative aspect-w-16 aspect-h-9 rounded-xl shadow-md overflow-hidden">
                <div class="absolute z-10 inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-30 hover:bg-opacity-20 transition-all">
                  <div class="py-2 px-4 rounded-lg bg-red-500 leading-none">
                    <ion-icon name="play" class="text-4xl text-white leading-none"></ion-icon>
                  </div>
                </div>
                <img src="<?php the_post_thumbnail_url('post-thumbnail') ?>" class="w-full h-full object-center object-cover" />
              </a>
            </div>
            <h4 class="font-semibold text-xl"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
          </div>

      <?php
        }
        echo '</div>';
      }
      wp_reset_postdata();

      ?>
      <div class="mt-16 flex justify-center">
        <a href="/category/videos/" class="inline-flex items-center justify-between leading-none py-1 pl-6 pr-2 rounded-full bg-white text-primary font-semibold shadow-md hover:shadow-lg transition-all"><span class="inline-block whitespace-nowrap font-sans mr-8 uppercase">View all</span>
          <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
        </a>
      </div>
      <div class="h-10 w-px bg-black bg-opacity-20 mx-auto mt-14"></div>
    </div>
  </section>

  <section id="latest-posts" class="py-28">
    <div class="container max-w-7xl mx-auto">
      <div class="flex gap-12 divide-x divide-black divide-opacity-10">
        <div class="w-3/5">
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
            echo '<div class="flex flex-col gap-8 mb-8">';
            while ($posts_query->have_posts()) {
              $posts_query->the_post();
          ?>
              <div class="flex gap-8">
                <div class="w-1/3">
                  <a href="<?php echo get_the_permalink(); ?>" class="block">
                    <div class="aspect-w-5 aspect-h-4 bg-primary-light bg-opacity-10 shadow-md rounded-xl overflow-hidden">
                      <?php
                      $thumbnail_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                      if ($thumbnail_medium) {
                        echo '<img src="' . $thumbnail_medium . '" class="w-full h-full object-cover object-center transform transition-transform scale-100 duration-500 hover:scale-110">';
                      } else {
                        echo '<div class="flex items-center justify-center"><ion-icon name="image-outline" class="text-5xl text-primary-light text-opacity-50"></ion-icon></div>';
                      }
                      ?>
                    </div>
                  </a>
                </div>
                <div class="w-2/3">
                  <h4 class="text-2xl font-semibold text-primary mb-4 mt-4">
                    <a href="<?php echo get_the_permalink(); ?>" class="text-primary transition hover:text-primary-light">
                      <?php echo get_the_title(); ?>
                    </a>
                  </h4>
                  <div class="text-sm">
                    <?php echo get_the_excerpt(); ?>
                  </div>
                </div>
              </div>

            <?php
            }
            echo '</div>';
          } else {
            ?>
            <div class="text-center text-3xl">Sorry, there's no post in this category.</div>
          <?php
          }
          wp_reset_postdata();
          ?>
          <div class="bg-secondary-light py-1 px-4 text-right mt-8"><a href="/resources" class="font-semibold text-primary text-sm">VIEW ALL &raquo;</a></div>
        </div>

        <div class="flex flex-col w-2/5 pl-12">
          <div class="mb-8">
            <div class="flex justify-between items-center">
              <h4 class="text-3xl text-primary font-quincy">Upcoming Events</h4>
              <div><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-12 h-auto mx-auto"></div>
            </div>
            <div class="border-b border-black border-opacity-10 relative mt-4 pt-1">
              <div class="w-12 h-1 bg-secondary -mb-px"></div>
            </div>
          </div>
          <div class="flex flex-col gap-8 mb-8">
            <div class="flex gap-6">
              <div class="w-1/3">
                <a href="#" class="block">
                  <div class="aspect-w-11 aspect-h-10 shadow-md rounded-xl overflow-hidden">
                    <img src="https://source.unsplash.com/random/360x360" alt="" class="w-full h-full object-center object-cover">
                  </div>
                </a>
              </div>
              <div class="w-2/3">
                <h4 class="text-base leading-tight font-semibold text-primary mb-3 mt-1"><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                <div class="text-xs">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </div>
            <div class="flex gap-6">
              <div class="w-1/3">
                <a href="#" class="block">
                  <div class="aspect-w-11 aspect-h-10 shadow-md rounded-xl overflow-hidden">
                    <img src="https://source.unsplash.com/random/360x360" alt="" class="w-full h-full object-center object-cover">
                  </div>
                </a>
              </div>
              <div class="w-2/3">
                <h4 class="text-base leading-tight font-semibold text-primary mb-3 mt-1"><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                <div class="text-xs">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </div>
            <div class="flex gap-6">
              <div class="w-1/3">
                <a href="#" class="block">
                  <div class="aspect-w-11 aspect-h-10 shadow-md rounded-xl overflow-hidden">
                    <img src="https://source.unsplash.com/random/360x360" alt="" class="w-full h-full object-center object-cover">
                  </div>
                </a>
              </div>
              <div class="w-2/3">
                <h4 class="text-base leading-tight font-semibold text-primary mb-3 mt-1"><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                <div class="text-xs">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </div>
            <div class="flex gap-6">
              <div class="w-1/3">
                <a href="#" class="block">
                  <div class="aspect-w-11 aspect-h-10 shadow-md rounded-xl overflow-hidden">
                    <img src="https://source.unsplash.com/random/360x360" alt="" class="w-full h-full object-center object-cover">
                  </div>
                </a>
              </div>
              <div class="w-2/3">
                <h4 class="text-base leading-tight font-semibold text-primary mb-3 mt-1"><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                <div class="text-xs">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-secondary-light py-1 px-4 text-right mt-auto"><a href="" class="font-semibold text-primary text-sm">VIEW ALL &raquo;</a></div>
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