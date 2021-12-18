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
  <div class="site-header-top hidden lg:block bg-white py-3">
    <div class="container">
      <div class="flex justify-between">
        <div class="text-sm text-primary font-sans">Welcome to Suzanne Clothier | RCT</div>
        <?php echo top_navigation(); ?>
      </div>
    </div>
  </div>
<?php
}

function site_header_bottom()
{
?>
  <div class="site-header-bottom">
    <div class="relative container py-2 lg:py-4 px-0 lg:px-4">
      <div class="flex justify-between items-center">
        <div class="pl-4 lg:pl-0 pr-5">
          <a href="/"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-suzanneclothier.svg" class="site-logo max-h-12 lg:max-h-16" /></a>
        </div>
        <div class="flex items-center pr-1 lg:pr-0">
          <div class="flex flex-none order-last lg:order-1">
            <?php echo site_navigation(); ?>
          </div>
          <div class="flex items-center lg:order-2">
            <?php echo site_header_buttons(); ?>
            <?php echo site_header_icon_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}

function top_navigation()
{
  wp_nav_menu(
    array(
      'theme_location'  => 'header',
      'container_class' => 'header-menu text-sm text-primary uppercase font-semibold',
      'items_wrap'      => '<ul id="%1$s" class="%2$s flex list-none m-0 p-0">%3$s</ul>',
    )
  );
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
  <ul class="hidden xl:flex lg:border-r lg:border-primary-light lg:pr-2 lg:mr-2">
    <?php if (!is_user_logged_in()) { ?>
      <li class="px-1"><a href="/membership" class="block"><span class="text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 inline-block bg-primary text-white">Become a Member</span></a></li>
      <li class="px-1">
        <a href="/my-account" class="block">
          <span class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-secondary text-primary">Member Login</span>
        </a>
      </li>

    <?php } else { ?>
      <?php if (function_exists('rcp_user_has_active_membership')) {
        if (!rcp_user_has_active_membership()) {
          echo '<li class="px-1"><a href="/membership" class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-primary text-white">Become a Member</a></li>';
        }
      } ?>
      <li class="px-1 leading-none">
        <a href="/my-account" class="block">
          <span class="inline-block text-sm font-semibold whitespace-nowrap rounded-full px-4 py-3 bg-secondary text-primary">My Account</span>
        </a>
      </li>
    <?php } ?>
  </ul>
<?php
}

function site_header_icon_links()
{
  $items_count = WC()->cart->get_cart_contents_count();
  //echo '< id="mini-cart-count"><?php echo $items_count ? $items_count : '&nbsp;';
?>
  <ul class="flex leading-none">
    <li class="xl:hidden">
      <a href="/my-account" class="inline-flex p-1">
        <ion-icon name="person-circle-outline" class="text-2xl leading-none"></ion-icon>
      </a>
    </li>
    <li><button class="hidden lg:inline-flex p-1" type="button">
        <ion-icon name="search" class="text-2xl leading-none"></ion-icon>
      </button></li>
    <li><a href="/cart" class="inline-flex p-1">
        <ion-icon name="cart" class="text-2xl leading-none"></ion-icon>
        <div id="mini-cart" class="-mt-1 w-5 h-5 leading-5 font-semibold text-xs font-sans text-center rounded-full bg-secondary"><?php echo $items_count ? $items_count : '0'; ?></div>
      </a></li>
  </ul>
<?php
}
