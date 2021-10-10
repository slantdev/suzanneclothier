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
