<?php

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-border-bottom';
  return $classes;
}

get_header();
?>

<main class="page-forum">


  <?php if (have_posts()) : ?>

    <?php
    while (have_posts()) :
      the_post();
    ?>

      <section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
        <div class="container pt-32 pb-8 z-10 max-w-7xl mx-auto">
          <div class="flex">
            <div class="w-2/3 pb-14">
              <h1 class="text-6xl font-quincy mb-5 text-primary"><?php the_title(); ?></h1>
            </div>
          </div>
        </div>
        <div class="w-full bg-white bg-opacity-90 z-10">
          <div class="container h-12 flex items-center max-w-7xl mx-auto">
            <div class="breadcrumb -mx-1">
              <span class="inline-block px-1"><a href="/">Home</a></span>
              <span class="inline-block px-1"> / </span>
              <span class="inline-block px-1"><a href="/my-account">Dashboard</a></span>
              <span class="inline-block px-1"> / </span>
              <span class="font-semibold inline-block px-1"><?php the_title(); ?></span>
            </div>
          </div>
        </div>
      </section>

      <section class="max-w-7xl mx-auto">
        <div class="container py-8">

          <article id="post-<?php the_ID(); ?>" <?php post_class('font-sans'); ?>>
            <?php the_content(); ?>
          </article>

        </div>
      </section>

    <?php endwhile; ?>

  <?php endif; ?>


</main>

<?php
get_footer();
