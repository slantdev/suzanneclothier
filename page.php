<?php


add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

$post_id = get_the_ID();
$thumbnail_full = get_the_post_thumbnail_url($post_id, 'full');
$thumbnail_medium = get_the_post_thumbnail_url($post_id, 'medium');

if (!$thumbnail_medium) {
  $thumbnail_medium = get_stylesheet_directory_uri() . '/assets/images/sc-featured-image.png';
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

<?php if ($hero_image) { ?>
  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo $hero_image ?>">
  <?php } else { ?>
    <section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
    <?php } ?>
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
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container flex items-center max-w-7xl mx-auto">
        <div class="breadcrumb py-2 -mx-1 text-sm lg:text-base">
          <span class="inline-block px-1"><a href="/">Home</a></span>
          <span class="inline-block px-1"> / </span>
          <span class="font-semibold inline-block px-1"><?php the_title(); ?></span>
        </div>
      </div>
    </div>
    </section>


    <section class="bg-white">
      <div class="container pt-10 lg:pt-20 pb-14 lg:pb-28 max-w-7xl mx-auto">
        <div class="block lg:flex gap-16">
          <div class="w-full lg:w-2/3">
            <?php
            if ($thumbnail_medium) {
            ?>
              <div class="mb-8 lg:hidden">
                <div class="aspect-w-1 aspect-h-1">
                  <img src="<?php echo $thumbnail_medium ?>" class="w-full h-full object-cover object-center rounded-full">
                </div>
              </div>
            <?php
            }
            ?>
            <div class="entry-content">
              <article id="post-<?php the_ID(); ?>" <?php post_class('prose xl:prose-lg font-sans'); ?>>
                <?php the_content(); ?>
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
              </article>
            </div>
          </div>
          <div class="w-full pt-10 mt-10 border-t border-gray-200 border-solid lg:border-0 lg:pt-0 lg:mt-0 lg:w-1/3">
            <div class="px-0 lg:px-8">
              <?php
              if ($thumbnail_medium) {
              ?>
                <div class="hidden lg:block mb-12">
                  <div class="aspect-w-1 aspect-h-1">
                    <img src="<?php echo $thumbnail_medium ?>" class="w-full h-full object-cover object-center rounded-full">
                  </div>
                </div>
              <?php
              }
              ?>
              <div class="mb-12">
                <h4 class="text-primary mb-4 text-3xl font-sans">Search the site</h4>
                <form class="flex bg-gray-50 shadow-md rounded-full inline-form-pill">
                  <input type="text" class="w-full px-6 bg-transparent rounded-full focus:outline-none">
                  <button class="py-3 px-5 text-sm rounded-full bg-primary font-semibold text-white uppercase">Search</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php
    get_footer();
