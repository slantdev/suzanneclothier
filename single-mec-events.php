<?php

/** no direct access **/
defined('MECEXEC') or die();

/**
 * The Template for displaying all single events
 *
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

get_header('mec'); ?>
<main class="page-single">

  <section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
    <div class="container pt-32 pb-8 z-10 max-w-7xl mx-auto">
      <div class="block lg:flex">
        <div class="w-full lg:w-3/5 pb-14">
          <h1 class="text-5xl lg:text-6xl font-quincy mb-5 text-primary"><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container py-2 flex items-center max-w-7xl mx-auto">
        <div class="breadcrumb -mx-1 text-sm lg:text-base">
          <span class="inline-block px-1"><a href="/">Home</a></span>
          <span class="inline-block px-1"> / </span>
          <span class="inline-block px-1"><a href="/events">Events</a></span>
          <span class="inline-block px-1"> / </span>
          <span class="font-semibold inline-block px-1"><?php the_title(); ?></span>
        </div>
      </div>
    </div>
  </section>

  <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="bg-white mec-single-event">

    <?php do_action('mec_before_main_content'); ?>

    <?php while (have_posts()) : the_post(); ?>

      <?php
      //$MEC = MEC::instance();
      //echo $MEC->single();
      $single = new MEC_skin_single();
      $single_event_main = $single->get_event_mec(get_the_ID());
      $single_event_obj = $single_event_main[0];

      // $post_id = get_the_ID();
      // $thumbnail_full = get_the_post_thumbnail_url($post_id, 'full');
      // $thumbnail_medium = get_the_post_thumbnail_url($post_id, 'medium');

      // if (!$thumbnail_medium) {
      //   $thumbnail_medium = get_stylesheet_directory_uri() . '/assets/images/sc-featured-image.png';
      // }
      ?>

      <div class="container pt-10 lg:pt-20 pb-14 lg:pb-28 max-w-7xl mx-auto">
        <div class="flex flex-wrap gap-0 lg:gap-16 lg:flex-nowrap">
          <div class="w-full order-2 lg:order-1 lg:w-2/3">
            <div class="entry-content">
              <article id="post-<?php the_ID(); ?>" <?php post_class('prose xl:prose-lg font-sans'); ?>>

                <?php the_content(); ?>

              </article>
            </div>
          </div>
          <div class="w-full order-1 lg:order-2 lg:w-1/3">
            <div class="mec-event-info-desktop mec-event-meta mec-color-before mec-frontbox">
              <?php
              $single->display_date_widget($single_event_obj);
              $single->display_time_widget($single_event_obj);
              $single->display_cost_widget($single_event_obj);
              $single->display_register_button_widget($single_event_obj);
              ?>
            </div>
          </div>
        </div>
      </div>

    <?php endwhile; // end of the loop.
    ?>

  </section>

  <?php do_action('mec_after_main_content'); ?>
</main>
<?php get_footer('mec');
