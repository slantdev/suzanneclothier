<?php

/**
 * Generate custom search form
 */
function sc_search_form($form)
{
  $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
  <div class="flex bg-white shadow-md rounded-full inline-form-pill"><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
  <input type="text" class="text-gray-700 w-full px-4 bg-transparent rounded-full focus:outline-none" value="' . get_search_query() . '" name="s" id="s" />
  <button type="submit"><ion-icon name="search" class="text-xl text-gray-400 leading-none"></ion-icon></button>
  <input type="submit" id="searchsubmit" class="py-3 px-4 text-xs rounded-full bg-secondary font-semibold text-primary uppercase hover:bg-opacity-80 whitespace-nowrap cursor-pointer" value="' . esc_attr__('Search') . '" />
  </div>
  </form>';

  return $form;
}
add_filter('get_search_form', 'sc_search_form');
