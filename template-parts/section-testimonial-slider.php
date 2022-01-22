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

    if (have_rows('testimonials', 'option')) :

      echo '<div id="testimonials" class="swiper"><div class="swiper-wrapper">';

      while (have_rows('testimonials', 'option')) : the_row();

        $testimonial_title = get_sub_field('testimonial_title');
        $testimonial_content = get_sub_field('testimonial_content');
    ?>

        <div class="swiper-slide">
          <div class="prose prose-sm mx-auto text-sm bg-white rounded-2xl shadow-md mb-4">
            <div class="block w-full pt-1 pb-2 px-5 md:pt-2 md:pb-4 md:px-10">
              <h3 class="mt-0"><?php echo $testimonial_title ?></h3>
              <?php echo $testimonial_content ?>
            </div>
          </div>
        </div>

    <?php

      endwhile;

      echo '</div>';
      echo '<div class="swiper-button-prev hidden lg:block"></div>';
      echo '<div class="swiper-button-next hidden lg:block"></div>';
      echo '</div></div>';
      echo "<script>
  const testimonialSwiper = new Swiper('#testimonials', {
    direction: 'horizontal',
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>";

    endif;
    ?>
</section>