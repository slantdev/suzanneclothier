<?php
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'   => 'Slider',
    'menu_title'  => 'Slider',
    'menu_slug'   => 'slider-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));

  // acf_add_options_page(array(
  //   'page_title'   => 'Member Coupon',
  //   'menu_title'  => 'Member Coupon',
  //   'menu_slug'   => 'member-coupon-settings',
  //   'capability'  => 'edit_posts',
  //   'redirect'    => false
  // ));

  acf_add_options_page(array(
    'page_title'   => 'Site Settings',
    'menu_title'  => 'Site Settings',
    'menu_slug'   => 'site-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}
