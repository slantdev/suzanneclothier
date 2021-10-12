<?php
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'   => 'Slider',
    'menu_title'  => 'Slider',
    'menu_slug'   => 'slider-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}
