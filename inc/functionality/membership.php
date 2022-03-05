<?php

//add_action('wp_head', 'output_all_postmeta');
function output_all_postmeta()
{

  $postmetas = get_post_meta(get_the_ID());

  foreach ($postmetas as $meta_key => $meta_value) {
    echo $meta_key . ' : ' . $meta_value[0] . '<br/>';
  }

  $key_1_value = get_post_meta(get_the_ID(), 'rcp_subscription_level', true);
  print_r($key_1_value);

  $test = unserialize($key_1_value);

  echo $test;
}
