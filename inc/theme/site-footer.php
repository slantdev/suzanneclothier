<?php

add_action('twp_footer', 'site_footer');
function site_footer()
{

  $logo_description = get_field('logo_description', 'option');
  $mailing_address = get_field('mailing_address', 'option');
  $phone = get_field('phone', 'option');
?>
  <footer>
    <div class="bg-primary py-16 lg:py-24">
      <div class="container px-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:divide-x divide-white divide-opacity-10 text-white">
          <div class="px-4 lg:px-8 mb-10 lg:mb-0">
            <div class="mb-5 lg:mb-8 mr-auto md:mx-0">
              <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-footer.svg" class="max-h-40 xl:max-h-48">
            </div>
            <?php
            if ($logo_description) {
              echo '<div>
                <p class="text-sm">' . $logo_description . '</p>
                </div>';
            }
            ?>
          </div>
          <div class="px-4 lg:px-10 mb-10 lg:mb-0">
            <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">FIND US</h4>

            <?php
            if ($mailing_address) {
              echo '<div class="text-sm mb-5 lg:mb-8">';
              echo '<h5 class="font-semibold mb-4">Mailing Address</h5>';
              echo '<p>' . $mailing_address . '</p>';
              echo '</div>';
            }
            ?>

            <?php
            if ($phone) {
              echo '<div class="text-sm">';
              echo '<h5 class="font-semibold mb-4">Phone</h5>';
              echo '<p>' . $phone . '</p>';
              echo '</div>';
            }
            ?>

          </div>
          <div class="px-4 lg:px-10 mb-10 lg:mb-0">
            <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">SITEMAP</h4>
            <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'footer',
                'container_class' => 'footer-menu',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              )
            );
            ?>
          </div>
          <div class="px-4 lg:px-10">
            <div class="mb-14">
              <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">NEWSLETTER SIGN UP</h4>
              <div>
                <form class="flex bg-white shadow-md rounded-full inline-form-pill">
                  <input type="text" class="text-gray-700 w-full px-4 bg-transparent rounded-full focus:outline-none" placeholder="Email">
                  <button class="py-3 px-4 text-sm rounded-full bg-secondary font-semibold text-primary uppercase hover:bg-opacity-80 whitespace-nowrap cursor-pointer">Sign Up</button>
                </form>
              </div>
            </div>
            <div class="">
              <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">QUICK SEARCH</h4>
              <div>
                <form id="searchform" class="flex bg-white shadow-md rounded-full inline-form-pill" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                  <input type="text" class="text-gray-700 w-full px-4 bg-transparent rounded-full focus:outline-none" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>">
                  <input class="py-3 px-4 text-sm rounded-full bg-secondary font-semibold text-primary uppercase hover:bg-opacity-80 whitespace-nowrap cursor-pointer" type="submit" value="Search">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-black text-white text-xs py-5 lg:py-8">
      <div class="container">
        <div class="block lg:flex">
          <div class="w-full lg:w-1/2 text-center lg:text-left flex gap-4 justify-center lg:justify-start mb-4 lg:mb-0">
            <a href="/privacy-policy" class="inline-block uppercase font-semibold hover:underline">Privacy Policy</a>
            <span class="inline-block">|</span>
            <a href="/terms-of-service" class="inline-block uppercase font-semibold hover:underline">Terms of Service</a>
          </div>
          <div class="w-full lg:w-1/2 text-center lg:text-right font-semibold">
            Copyright © 2018-<?php echo date("Y"); ?> Suzanne Clothier & Carpe Canem Inc.
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php
}
