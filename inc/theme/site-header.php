<?php
function site_header()
{
  echo '<div class="site-header relative z-20">';
  echo site_header_top();
  echo site_header_bottom();
  echo '</div>';
}
add_action('twp_header', 'site_header');

function site_header_top()
{ ?>
  <div class="site-header-top bg-white py-3">
    <div class="container">
      <div class="flex justify-between">
        <div class="text-sm text-primary font-sans">Welcome to Suzanne Clothier | RCT</div>
        <div class="text-sm text-primary uppercase font-semibold">
          <ul class="flex list-none m-0 p-0">
            <li><a href="#" class="text-primary inline-block px-3 leading-none border-r-2 border-primary hover:text-primary-light">The Enriched Puppy Protocol</a></li>
            <li><a href="#" class="text-primary inline-block px-3 leading-none border-r-2 border-primary hover:text-primary-light">FAT</a></li>
            <li><a href="#" class="text-primary inline-block px-3 leading-none border-r-2 border-primary hover:text-primary-light">CARAT</a></li>
            <li><a href="#" class="text-primary inline-block pl-3 leading-none hover:text-primary-light">CCC Training</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php
}

function site_header_bottom()
{
?>
  <div class="site-header-bottom">
    <div class="relative container py-4">
      <div class="flex justify-between items-center">
        <div class="max-w-1/5 pr-5">
          <a href="/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-suzanneclothier.svg" class="site-logo" /></a>
        </div>
        <div class="flex items-center">
          <?php echo site_navigation(); ?>
          <?php echo site_header_buttons(); ?>
          <?php echo site_header_icon_links(); ?>
        </div>
      </div>
    </div>
  </div>
<?php
}

function site_navigation()
{
  wp_nav_menu(
    array(
      'theme_location'  => 'primary',
      'container_class' => 'primary-menu',
      'items_wrap'      => '<ul id="%1$s" class="%2$s flex text-sm font-semibold">%3$s</ul>',
    )
  );
}

function primary_menu_li_classes($classes, $item, $args)
{
  if ($args->theme_location == 'primary') {
    $classes[] = 'px-3';
  }
  return $classes;
}
//add_filter('nav_menu_css_class', 'primary_menu_li_classes', 1, 3);

function primary_menu_a_atts($atts)
{
  $atts['class'] = "whitespace-nowrap py-2 border-b-2 border-secondary border-opacity-0 transition hover:text-secondary-dark";
  return $atts;
}
//add_filter('nav_menu_link_attributes', 'primary_menu_a_atts');

function site_header_buttons()
{ ?>
  <ul class="flex text-sm font-semibold border-r border-primary-light pr-2 mr-2">
    <li class="px-1"><a href="/membership" class="whitespace-nowrap rounded-full px-4 py-3 inline-block bg-primary text-white">Become a Member</a></li>
    <li class="px-1"><a href="/my-account" class="whitespace-nowrap rounded-full px-4 py-3 inline-block bg-secondary text-primary">Member Login</a></li>
  </ul>
<?php
}

function site_header_icon_links()
{ ?>
  <ul class="flex leading-none">
    <li><button class="inline-flex p-1" type="button">
        <ion-icon name="search" class="text-2xl leading-none"></ion-icon>
      </button></li>
    <li><a href="/cart" class="inline-flex p-1">
        <ion-icon name="cart" class="text-2xl leading-none"></ion-icon>
      </a></li>
  </ul>
<?php
}
