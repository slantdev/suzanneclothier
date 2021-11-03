<?php

/**
 * Template Name: Contact
 */

add_filter('body_class', 'my_body_classes');
function my_body_classes($classes)
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

<main class="page-contact">

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
    <?php if ($background_overlay) {
      echo '<div class="absolute inset-0" style="background-color: ' . $background_overlay . '"></div>';
    } ?>
    <div class="container pt-32 pb-8 z-10 mx-auto max-w-7xl">
      <div class="flex">
        <div class="w-2/5 pb-20">
          <h2 class="text-6xl font-quincy text-white mb-5"><?php echo ($hero_title) ? $hero_title : get_the_title() ?></h2>
          <?php if ($hero_description) {
            echo '<div class="text-white">';
            echo $hero_description;
            echo '</div>';
          } ?>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-50 z-10">
      <div class="container h-12 flex items-center mx-auto max-w-7xl">
        <div class="breadcrumb -mx-1 text-white">
          <span class="inline-block px-1"><a class="hover:text-white" href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Contact Us</span>
        </div>
      </div>
    </div>
  </section>

  <section id="customer-service" class="bg-white">
    <?php
    $contact_title = get_field('contact_title');
    $contact_image = get_field('contact_image');
    $contact_body_text = get_field('contact_body_text');
    $phone_number = get_field('phone_number');
    $email = get_field('email');
    $linkedin_url = get_field('linkedin_url');
    $form_shortcode = get_field('form_shortcode');
    ?>
    <div class="container max-w-7xl mx-auto">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-quincy"><?php echo $contact_title ?></h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="flex pt-14 pb-20 gap-12">
        <div class="w-1/2">
          <div class="px-14">
            <div class="mb-8"><img src="<?php echo $contact_image ?>" class="rounded-full mx-auto" /></div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="text-area">
            <?php echo $contact_body_text ?>
          </div>
        </div>
      </div>
      <div class="flex pb-28">
        <div class="w-1/2">
          <div class="px-14">
            <h3 class="mb-8 text-4xl text-primary font-quincy">Our Details</h3>
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
        <div class="w-1/2">
          <h3 class="mb-8 text-4xl text-primary font-quincy">Drop us a line</h3>
          <div>
            <?php
            if ($form_shortcode) {
              echo do_shortcode($form_shortcode);
            }
            ?>
            <!-- <form>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <input type="text" placeholder="First Name" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Last Name" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Phone Number" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Email" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div class="col-span-2">
                  <textarea placeholder="Message" class="h-32 bg-white rounded-3xl w-full shadow py-5 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"></textarea>
                </div>
                <div class="col-span-2">
                  <button type="submit" class="w-44 inline-flex items-center justify-between leading-none py-2 pl-6 pr-2 rounded-full bg-primary text-white font-semibold shadow-md hover:shadow-lg transition-all">
                    <span class="inline-block whitespace-nowrap font-sans mr-4">Submit</span>
                    <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
                  </button>
                </div>
              </div>
            </form> -->
          </div>
        </div>
      </div>
    </div>
  </section>


</main>


<?php get_footer(); ?>