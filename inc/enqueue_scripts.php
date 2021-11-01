<?php

/**
 * Enqueue scripts.
 */
function twp_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_script('jquery');

  wp_enqueue_style('swiper', 'https://unpkg.com/swiper@7/swiper-bundle.min.css', array(), $theme->get('Version'));
  wp_enqueue_script('swiper', 'https://unpkg.com/swiper@7/swiper-bundle.min.js', array(), $theme->get('Version'));
  wp_enqueue_style('twp', twp_get_mix_compiled_asset_url('assets/css/app.css'), array(), $theme->get('Version'));
  wp_enqueue_script('twp', twp_get_mix_compiled_asset_url('assets/js/app.js'), array('jquery'), $theme->get('Version'));
}
add_action('wp_enqueue_scripts', 'twp_enqueue_scripts', 9999);

function twp_google_fonts()
{
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;
  echo '<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">' . PHP_EOL;
  echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">' . PHP_EOL;
}
add_action('wp_head', 'twp_google_fonts', 5);

function twp_footer_scripts()
{
  echo '<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>' . PHP_EOL;
  echo '<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>' . PHP_EOL;
}
add_action('wp_footer', 'twp_footer_scripts');

/**
 * Get mix compiled asset.
 *
 * @param string $path The path to the asset.
 *
 * @return string
 */
function twp_get_mix_compiled_asset_url($path)
{
  $path                = '/' . $path;
  $stylesheet_dir_uri  = get_stylesheet_directory_uri();
  $stylesheet_dir_path = get_stylesheet_directory();

  if (!file_exists($stylesheet_dir_path . '/mix-manifest.json')) {
    return $stylesheet_dir_uri . $path;
  }

  $mix_file_path = file_get_contents($stylesheet_dir_path . '/mix-manifest.json');
  $manifest      = json_decode($mix_file_path, true);
  $asset_path    = !empty($manifest[$path]) ? $manifest[$path] : $path;

  return $stylesheet_dir_uri . $asset_path;
}
