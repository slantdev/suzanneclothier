<?php

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function sc_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'sc_excerpt_length', 999);

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function sc_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'sc_excerpt_more');


function filter_blog()
{
  $catSlug = $_POST['category'];

  $ajaxposts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => -1,
    'category_name' => $catSlug,
    'orderby' => 'menu_order',
    'order' => 'desc',
  ]);
  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= get_template_part('template-parts/blog-list-item');
    endwhile;
  } else {
    $response = 'empty';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_blog', 'filter_blog');
add_action('wp_ajax_nopriv_filter_blog', 'filter_blog');

function filter_article()
{
  $catSlug = $_POST['category'];
  $postType = $_POST['post_type'];

  $ajaxposts = new WP_Query([
    'post_type' => $postType,
    'posts_per_page' => -1,
    'category_name' => $catSlug,
    'orderby' => 'menu_order',
    'order' => 'desc',
  ]);
  $response = '';

  if ($ajaxposts->have_posts()) {
    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= get_template_part('template-parts/blog-list-item');
    endwhile;
  } else {
    $response = 'empty';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_filter_article', 'filter_article');
add_action('wp_ajax_nopriv_filter_article', 'filter_article');
