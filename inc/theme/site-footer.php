<?php

add_action('twp_footer', 'site_footer');
function site_footer()
{
?>
  <footer>
    <div class="bg-primary py-16 lg:py-24">
      <div class="container px-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:divide-x divide-white divide-opacity-10 text-white">
          <div class="px-4 lg:px-8 mb-10 lg:mb-0">
            <div class="mb-5 lg:mb-8 mr-auto md:mx-0">
              <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-footer.svg" class="max-h-40 xl:max-h-48">
            </div>
            <div>
              <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
          <div class="px-4 lg:px-10 mb-10 lg:mb-0">
            <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">FIND US</h4>
            <div class="text-sm mb-5 lg:mb-8">
              <h5 class="font-semibold mb-4">Mailing Address</h5>
              <p>Carpe Canem Inc.<br>
                PO Box 105, St. Johnsville, <br>
                NY 13452</p>
            </div>
            <div class="text-sm">
              <h5 class="font-semibold mb-4">Phone</h5>
              <p>1-800-7-FLY-DOG or<br>
                518-568-3325</p>
            </div>
          </div>
          <div class="px-4 lg:px-10 mb-10 lg:mb-0">
            <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">SITEMAP</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Learning Paths</a></li>
              <li><a href="#">Shop</a></li>
              <li><a href="#">Resources</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <div class="px-4 lg:px-10">
            <div class="mb-14">
              <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">NEWSLETTER SIGN UP</h4>
              <div>
                <form class="flex bg-white shadow-md rounded-full inline-form-pill">
                  <input type="text" class="text-gray-700 w-full px-4 bg-transparent rounded-full focus:outline-none" placeholder="Email">
                  <button class="py-3 px-4 text-sm rounded-full bg-secondary font-semibold text-primary uppercase hover:bg-opacity-80 whitespace-nowrap">Sign Up</button>
                </form>
              </div>
            </div>
            <div class="">
              <h4 class="text-xl font-semibold uppercase mb-5 lg:mb-8">QUICK SEARCH</h4>
              <div>
                <form class="flex bg-white shadow-md rounded-full inline-form-pill">
                  <input type="text" class="text-gray-700 w-full px-4 bg-transparent rounded-full focus:outline-none" placeholder="Email">
                  <button class="py-3 px-4 text-sm rounded-full bg-secondary font-semibold text-primary uppercase hover:bg-opacity-80 whitespace-nowrap">Search</button>
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
            <a href="#" class="inline-block uppercase font-semibold hover:underline">Privacy Policy</a>
            <span class="inline-block">|</span>
            <a href="#" class="inline-block uppercase font-semibold hover:underline">Terms of Service</a>
          </div>
          <div class="w-full lg:w-1/2 text-center lg:text-right font-semibold">
            Copyright © 2018-2021 Suzanne Clothier & Carpe Canem Inc.
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php
}
