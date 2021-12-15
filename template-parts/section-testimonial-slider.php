<?php
?>
<section id="testimonial" class="pb-16 lg:pb-28 bg-primary-light bg-opacity-10">
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
            <div class="block md:flex w-full p-5 md:p-10 gap-10">
              <div class="flex items-center md:block w-full md:w-1/5">
                <div class="flex-none mr-5 md:mr-auto rounded-full overflow-hidden mb-4 w-24 h-24 md:w-32 md:h-32 md:mx-auto">
                  <img src="<?php the_post_thumbnail_url() ?>" class="object-cover object-center w-full h-full">
                </div>
                <h4 class="text-2xl text-primary font-semibold text-left md:text-center mb-5 md:mb-0"><?php the_title() ?></h4>
              </div>
              <div class="w-full md:w-4/5">
                <?php the_content() ?>
              </div>
            </div>
          </div>
        </div>
    <?php
      }
      echo '</div>';
      echo '<div class="swiper-button-prev hidden lg:block"></div>';
      echo '<div class="swiper-button-next hidden lg:block"></div>';

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