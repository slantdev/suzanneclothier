<?php
$post_id = get_the_ID();
$thumbnail_full = get_the_post_thumbnail_url($post_id, 'full');
$thumbnail_medium = get_the_post_thumbnail_url($post_id, 'medium');

if (!$thumbnail_medium) {
  $thumbnail_medium = get_stylesheet_directory_uri() . '/assets/images/sc-featured-image.png';
}
?>
<section class="hero flex flex-col items-center bg-cover bg-center bg-primary bg-opacity-30">
  <div class="container pt-32 pb-8 z-10 max-w-7xl mx-auto">
    <div class="flex">
      <div class="w-2/3 pb-14">
        <h1 class="text-6xl font-quincy mb-5 text-primary"><?php the_title(); ?></h1>
        <?php
        $article_in_other_language = get_field('article_in_other_language');
        if ($article_in_other_language) {
          echo '<p>This article is also available in ';
          foreach ($article_in_other_language as $article) :
            $permalink = get_permalink($article->ID);
            $post_type = get_post_type_object(get_post_type($article->ID));
            $separator = ($article != end($article_in_other_language)) ? ", " : '';
            echo '<a class="font-semibold hover:underline" href="' . esc_url($permalink) . '">' . esc_html($post_type->labels->singular_name) . '</a>' . $separator;
          endforeach;
          echo '.</p>';
        }
        ?>
      </div>
    </div>
  </div>
  <div class="w-full bg-white bg-opacity-90 z-10">
    <div class="container h-12 flex items-center max-w-7xl mx-auto">
      <div class="breadcrumb -mx-1">
        <span class="inline-block px-1"><a href="/">Home</a></span>
        <span class="inline-block px-1"> / </span>
        <span class="inline-block px-1"><a href="/">Blog</a></span>
        <span class="inline-block px-1"> / </span>
        <span class="font-semibold inline-block px-1"><?php the_title(); ?></span>
      </div>
    </div>
  </div>
</section>

<section class="bg-white">
  <div class="container pt-20 pb-28 max-w-7xl mx-auto">
    <div class="flex gap-16">
      <div class="w-2/3">
        <div class="entry-content">
          <article id="post-<?php the_ID(); ?>" <?php post_class('prose xl:prose-lg font-sans'); ?>>
            <?php the_content(); ?>
          </article>
        </div>
      </div>
      <div class="w-1/3">
        <div class="px-8">
          <?php
          if ($thumbnail_medium) {
          ?>
            <div class="mb-12">
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
          <div>
            <h4 class="text-primary mb-4 text-3xl font-sans">Latest Posts</h4>
            <?php
            $args = array(
              'post_type' => 'post',
              'posts_per_page' => 8
            );
            $posts_query = new WP_Query($args);

            if ($posts_query->have_posts()) {
              echo '<ul class="flex flex-col divide-y divide-black divide-opacity-10">';
              while ($posts_query->have_posts()) {
                $posts_query->the_post();
            ?>
                <li class="py-3"><a href="<?php echo get_the_permalink(); ?>" class="font-semibold"><?php echo get_the_title(); ?></a></li>
              <?php
              }
              echo '</ul>';
            } else {
              ?>
              <div class="text-center text-xl">Sorry, there's no post in this category.</div>
            <?php
            }
            wp_reset_postdata();
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>