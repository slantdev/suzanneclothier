<?php


add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-border-bottom';
  return $classes;
}

get_header();

?>


<main>

  <section class="bg-white">
    <div class="container mx-auto pt-8 pb-10 max-w-2xl lg:py-20">

      <?php
      $s = get_search_query();
      $args = array(
        's' => $s
      );
      // The Query
      $the_query = new WP_Query($args);

      if ($the_query->have_posts()) :
      ?>
        <header class="page-header">
          <h1 class="font-bold mb-4 text-lg lg:text-xl lg:mb-6"><?php printf(__('Search Results for: %s', 'shape'), '<span>' . get_search_query() . '</span>'); ?></h1>
        </header><!-- .page-header -->
        <!-- the loop -->

        <ul class="search-results">
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <li class="mb-4 lg:mb-8">
              <a href="<?php the_permalink(); ?>" class="block bg-white shadow border border-gray-100 rounded-lg transition duration-300 hover:shadow-xl">
                <div class="flex flex-wrap md:flex-nowrap">
                  <div class="w-full rounded-t-lg aspect-w-16 aspect-h-9 md:hidden">
                    <?php if (has_post_thumbnail()) { ?>
                      <?php the_post_thumbnail('medium', array('class' => 'object-cover h-full w-full rounded-t-lg md:hidden')); ?>
                    <?php } ?>
                  </div>
                  <div class="hidden md:block w-1/4 rounded-l-lg">
                    <?php if (has_post_thumbnail()) { ?>
                      <?php the_post_thumbnail('medium', array('class' => 'object-cover h-full w-full rounded-l-lg')); ?>
                    <?php } ?>
                  </div>
                  <div class="w-full md:w-3/4 p-4 lg:p-8">
                    <h3 class="font-bold mb-2 text-xl lg:text-2xl"><?php the_title(); ?></h3>
                    <div class="text-sm"><?php the_excerpt() ?></div>
                  </div>
                </div>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
        <!-- end of the loop -->

        <?php wp_reset_postdata(); ?>

      <?php else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
      <?php endif; ?>

    </div>
  </section>


</main>


<?php
get_footer();
