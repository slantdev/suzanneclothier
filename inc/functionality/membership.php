<?php

//add_action('woocommerce_account_dashboard', 'member_exclusive_article');
function member_exclusive_article()
{
  if (rcp_user_has_active_membership()) {
    echo '<h2 class="text-xl font-bold mb-4">MEMBER EXCLUSIVE ARTICLES</h2>';
    //$post_ids = rcp_get_restricted_post_ids();
    //$post_ids = rcp_get_paid_posts();

    // $args = array(
    //   'meta_key'       => '_is_paid',
    //   'meta_value'     => 1,
    //   'post_status'    => 'publish',
    //   'posts_per_page' => -1,
    //   'post_type'      => 'post',
    //   'fields'         => 'ids'
    // );

    // $post_ids = get_posts($args);
    // echo '<pre>';
    // print_r($post_ids);
    // echo '</pre>';

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'paged' => $paged,
      'meta_key'       => '_is_paid',
      'meta_value'     => 1,
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'post_type'      => 'post',
      'fields'         => 'ids'
    );
    $posts_query = new WP_Query($args);

    if ($posts_query->have_posts()) {
      echo '<div class="blog-grid grid grid-cols-4 pb-12 gap-8">';
      while ($posts_query->have_posts()) {
        $posts_query->the_post();
        get_template_part('template-parts/blog-list-item');
      }
      echo '</div>';
    }
    wp_reset_postdata();
  }
}
