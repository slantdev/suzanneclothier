<?php
// numbered pagination
function pagination($pages = '', $range = 3)
{
  $showitems = ($range * 2) + 1;

  global $paged;
  if (empty($paged)) $paged = 1;

  // echo '<pre>';
  // print_r($showitems);
  // echo '</pre>';

  if ($pages == '') {
    global $posts_query;
    $pages = $posts_query->max_num_pages;
    if (!$pages) {
      $pages = 1;
    }
  }

  if (1 != $pages) {
    echo '<div class="archive-pagination pagination font-sans">';
    echo '<ul class="flex justify-center items-center text-sm">';
    if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
      echo '<li class="border border-gray-300 -ml-1">
        <a class="block w-8 h-8 py-2 leading-4 text-center bg-gray-50 text-gray-600 hover:text-gray-800 hover:bg-gray-200" href="' . get_pagenum_link(1) . '">
         <span>&#171;</span>
        </a></li>';
    }
    if ($paged > 1 && $showitems < $pages) {
      echo '<li class="border border-gray-300 -ml-1">
        <a class="block w-8 h-8 py-2 leading-4 text-center bg-gray-50 text-gray-600 hover:text-gray-800 hover:bg-gray-200" href="' . get_pagenum_link($paged - 1) . '">
          <span>&#8249;</span>
        </a></li>';
    }
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        echo ($paged == $i) ? '<li class="border border-gray-300 -ml-1"><span class="block w-8 h-8 py-2 leading-4 text-center bg-primary text-white hover:text-gray-800">' . $i . '</span></li>' : '<li class="border border-gray-300 -ml-1"><a class="block w-8 h-8 py-2 leading-4 text-center bg-gray-50 text-gray-600 hover:text-gray-800 hover:bg-gray-200" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
      }
    }

    if ($paged < $pages && $showitems < $pages) {
      echo '<li class="border border-gray-300 -ml-1">
      <a class="block w-8 h-8 py-2 leading-4 text-center bg-gray-50 text-gray-600 hover:text-gray-800 hover:bg-gray-200" href="' . get_pagenum_link($paged + 1) . '">
        <span>&#8250;</span>
      </a></li>';
    }
    if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) {
      echo '<li class="border border-gray-300 -ml-1">
      <a class="block w-8 h-8 py-2 leading-4 text-center bg-gray-50 text-gray-600 hover:text-gray-800 hover:bg-gray-200"  href="' . get_pagenum_link($pages) . '">
        <span>&#187;</span>
      </a></li>';
    }
    echo '</ul>';
    echo '</div>';
  }
}
