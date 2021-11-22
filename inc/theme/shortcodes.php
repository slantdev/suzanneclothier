<?php

add_shortcode('pathmenu', 'sc_pathmenu_func');
function sc_pathmenu_func($atts)
{
  $atts = shortcode_atts(array(
    'term' => '',
  ), $atts, 'pathmenu');

  $term = $atts['term'];

  $term_slug = $term;

  $params = array(
    'posts_per_page' => -1,
    'post_type' => 'product',
    'orderby' => 'menu_order',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );

  $query = new WP_Query($params);

  $categories = array();

  foreach ($query->posts as $post_id) {
    $product_categories = get_the_terms($post_id, 'product_cat');
    if (!is_wp_error($product_categories) && $product_categories) {
      foreach ($product_categories as $product_cat) {
        if ($product_cat->term_id != 16) { // Exclude Uncategorized
          if (!isset($categories[$product_cat->term_id])) {
            $categories[$product_cat->term_id] = $product_cat;
          }
        }
      }
    }
  }

  wp_reset_postdata();

  $slug = array_column($categories, 'slug');

  array_multisort($slug, SORT_ASC, $categories);

  $output = '';

  $output .= '<pre><small>';
  $output .= print_r($categories, true);
  $output .= '</small></pre>';

  // $output .= '<pre>';
  // $output .= print_r($categories['name']);
  // $output .= '</pre>';

  if (!empty($categories)) {
    $output .=  '<div class="grid grid-cols-4 gap-4 w-full">';
    foreach ($categories as $key => $category) {

      $output .= '<div class="">';
      $output .= '<h5 class="border-b border-gray-300 px-1 pt-2 pb-3 font-bold">' . $category->name . '</h5>';

      //$output .= '<pre>';
      //$output .= print_r($category, true);
      //$output .= '</pre>';

      $params2 = array(
        'posts_per_page' => 5,
        'post_type' => 'product',
        'orderby' => 'name',
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'learning_paths',
            'field'    => 'slug',
            'terms'    => $term_slug,
          ),
          array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category->slug,
          ),
        ),
      );

      $wc_query = new WP_Query($params2);

      if ($wc_query->have_posts()) {

        $output .= '<ul class="py-2">';

        while ($wc_query->have_posts()) {
          $wc_query->the_post();
          $output .= '<li>';
          $output .= '<a href="' . get_the_permalink() . '" class="block text-sm text-gray-600 py-2 px-1  hover:bg-secondary">';
          $output .= get_the_title();
          $output .= '</a>';
          $output .= '</li>';
        }

        $output .= '</ul>';

        $output .= '<a class="text-xs px-1 mt-1 text-secondary-dark hover:text-secondary flex gap-1" href="' . get_term_link($category->slug, 'product_cat') . '"><ion-icon name="arrow-forward-circle-outline" class="text-base"></ion-icon> <span class="inline-block">VIEW ALL</span></a>';

        wp_reset_postdata();
      }

      $output .= '</div>';
    }
    $output .=  '</div>';
  }

  wp_reset_postdata();

  return $output;
}
