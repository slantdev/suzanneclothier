<?php

/**
 * Shop breadcrumb
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!empty($breadcrumb)) {

  echo $wrap_before;

  foreach ($breadcrumb as $key => $crumb) {

    echo $before;

    if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
      echo '<span class="inline-block px-1"><a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a></span>';
    } else {
      echo '<span class="font-semibold inline-block px-1">' . esc_html($crumb[0]) . '</span>';
    }

    echo $after;

    if (sizeof($breadcrumb) !== $key + 1) {
      //echo $delimiter;
      echo '<span class="inline-block px-1"> / </span>';
    }
  }

  echo $wrap_after;
}
