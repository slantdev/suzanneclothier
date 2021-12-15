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
      <div class="block lg:flex">
        <div class="w-full lg:w-2/5 pb-20">
          <h2 class="text-5xl lg:text-6xl font-quincy text-primary mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
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
      <div class="block lg:flex pt-14 pb-20 gap-12">
        <div class="w-full lg:w-1/2 mb-8 lg:mb-0">
          <div class="px-0 lg:px-14">
            <div class="mb-5 lg:mb-8"><img src="<?php echo $about_image ?>" class="rounded-full mx-auto" /></div>
            <div>
              <ul class="list-none flex flex-col gap-4 leading-none">
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="mail"></ion-icon>
                  <a href="mailto:<?php echo $email ?>" target="_blank"><?php echo $email ?></a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  <a href="<?php echo $linkedin_url ?>" target="_blank"><?php echo $linkedin_url ?></a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="call"></ion-icon>
                  <a href="tel:<?php echo $phone_number ?>" target="_blank"><?php echo $phone_number ?></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-full lg:w-1/2">
          <div class="text-area">
            <?php echo $about_body_text ?>
          </div>

          <?php if (have_rows('faqs')) : ?>

            <div class="my-8">
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
      </div>
    </div>
  </section>

  <?php
  get_template_part('template-parts/section-testimonial-slider');
  ?>

</main>


<?php get_footer(); ?>