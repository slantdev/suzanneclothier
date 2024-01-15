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

  //$slug = array_column($categories, 'slug');
  //array_multisort($slug, SORT_ASC, $categories);

  $product_cat = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'orderby' => 'menu_order',
    'exclude' => 16
  ));


  $order = array();
  foreach ($product_cat as $cat) {
    $order[] = $cat->term_id;
  }

  //var_dump($order);

  uksort($categories, function ($a, $b) use ($order) {
    foreach ($order as $value) {
      if ($a == $value) {
        return 0;
        break;
      }
      if ($b == $value) {
        return 1;
        break;
      }
    }
  });

  //var_dump($categories);

  $output = '';

  // $output .= '<pre><small>';
  // $output .= print_r($categories, true);
  // $output .= '</small></pre>';

  if (!empty($categories)) {
    $output .=  '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-4 w-full">';
  }

  if (!empty($categories)) {
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

    wp_reset_postdata();
  }



  // Articles Args
  $defaults = array(
    'fields'                 => 'ids',
    'update_post_term_cache' => false,
    'update_post_meta_cache' => false,
    'cache_results'          => false
  );
  $article = array(
    'posts_per_page' => -1,
    'post_type' => 'article',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );
  $articles_french = array(
    'posts_per_page' => -1,
    'post_type' => 'articles_french',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );
  $article_norway = array(
    'posts_per_page' => -1,
    'post_type' => 'article_norway',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );
  $article_dutch = array(
    'posts_per_page' => -1,
    'post_type' => 'article_dutch',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );
  $article_it = array(
    'posts_per_page' => -1,
    'post_type' => 'article_it',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );
  $article_spanish = array(
    'posts_per_page' => -1,
    'post_type' => 'article_spanish',
    'orderby' => 'date',
    'tax_query' => array(
      array(
        'taxonomy' => 'learning_paths',
        'field'    => 'slug',
        'terms'    => $term_slug,
      ),
    ),
  );

  $article_query = get_posts(array_merge($defaults, $article));
  $article_french_query = get_posts(array_merge($defaults, $articles_french));
  $article_norway_query = get_posts(array_merge($defaults, $article_norway));
  $article_dutch_query = get_posts(array_merge($defaults, $article_dutch));
  $article_it_query = get_posts(array_merge($defaults, $article_it));
  $article_spanish_query = get_posts(array_merge($defaults, $article_spanish));

  $articles = array_merge($article_query, $article_french_query, $article_norway_query, $article_dutch_query, $article_it_query, $article_spanish_query);

  if (!empty($articles)) {

    $final_args = array(
      'post_type' => ['article', 'articles_french', 'article_norway', 'article_dutch', 'article_it', 'article_spanish'],
      'post__in'  => $articles,
      'posts_per_page' => 5,
      'orderby' => 'date',
    );

    $the_query = new WP_Query($final_args);

    $output .= '<div class="">';
    $output .= '<h5 class="border-b border-gray-300 px-1 pt-2 pb-3 font-bold">Articles</h5>';

    if ($the_query->have_posts()) {

      $output .= '<ul class="py-2">';
      while ($the_query->have_posts()) {
        $the_query->the_post();
        $output .= '<li>';
        $output .= '<a href="' . get_the_permalink() . '" class="block text-sm text-gray-600 py-2 px-1  hover:bg-secondary">';
        $output .= get_the_title();
        $output .= '</a>';
        $output .= '</li>';
      }
      $output .= '</ul>';

      $output .= '<a class="text-xs px-1 mt-1 text-secondary-dark hover:text-secondary flex gap-1" href="/articles-in-english"><ion-icon name="arrow-forward-circle-outline" class="text-base"></ion-icon> <span class="inline-block">VIEW ALL</span></a>';
    }

    $output .= '</div>';

    wp_reset_postdata();
  }



  if (!empty($categories)) {
    $output .=  '</div>';
  }

  return $output;
}

add_shortcode('membership_buttons', 'mobile_membership_buttons');
function mobile_membership_buttons()
{
  $output = '';
  $output .= '<ul class="flex justify-center py-4 border-b border-gray-300 border-solid">';

  if (!is_user_logged_in()) {
    $output .= '<li class="px-1"><a href="/membership" class="block"><span class="text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 inline-block bg-primary text-white">Become a Member</span></a></li>';
    $output .= '<li class="px-1">
      <a href="/my-account" class="block">
        <span class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-secondary text-primary">Member Login</span>
      </a>
    </li>';
  } else {
    if (function_exists('rcp_user_has_active_membership')) {
      if (!rcp_user_has_active_membership()) {
        $output .= '<li class="px-1"><a href="/membership" class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-primary text-white">Become a Member</a></li>';
      }
    }
    $output .= '<li class="px-1 leading-none">
      <a href="/my-account" class="block">
        <span class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-secondary text-primary">My Account</span>
      </a>
    </li>';
  }
  $output .= '</ul>';

  return $output;
}

//add_shortcode('mobile_header_menu', 'mobile_header_menu_function');
function mobile_header_menu_function()
{
  return wp_nav_menu(
    array(
      'theme_location' => 'header',
      'container_class' => 'mobile_header_menu'
    )
  );
}
