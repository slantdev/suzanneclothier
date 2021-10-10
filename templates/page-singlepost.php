<?php

/**
 * Template Name: Single
 */

add_filter('body_class', 'sc_body_classes');
function sc_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

get_header();

?>

<main class="page-single">

  <section class="hero flex flex-col items-center bg-primary bg-opacity-30">
    <div class="container pt-32 pb-8 z-10">
      <div class="flex">
        <div class="w-2/3 pb-20">
          <h2 class="text-6xl font-sans mb-5 text-primary">When Is a Refrigerator Like a Morgue?</h2>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container h-12 flex items-center">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span>
          <span class="inline-block px-1"> / </span>
          <span class="inline-block px-1"><a href="/">Blog</a></span>
          <span class="inline-block px-1"> / </span>
          <span class="font-semibold inline-block px-1">When is a refrigerator like a morgue</span>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white entry-content">
    <div class="container pt-20 pb-28">
      <div class="flex gap-20">
        <div class="w-2/3">
          <p class="text-xl font-semibold">At a farm show many years ago, I came across Nok Out, an odor eliminator which is better than anything I’ve ever seen (and believe me, with this many animals, we’ve tried plenty!).</p>
          <p>Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
          <p>Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit.</p>
          <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada.</p>
          <p>Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
          <p>Donec sollicitudin molestie malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus.</p>
          <p>Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
          <p>Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Curabitur aliquet quam id dui posuere blandit.</p>
          <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vivamus suscipit tortor eget felis porttitor volutpat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada.</p>
          <p>Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
          <p>Donec sollicitudin molestie malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus.</p>

        </div>
        <div class="w-1/3">
          <div class="px-8">
            <div class="mb-12">
              <img src="https://source.unsplash.com/collection/9718726/320x320" class="rounded-full mx-auto">
            </div>
            <div class="mb-12">
              <h4 class="text-primary mb-4 text-3xl font-sans">Search the site</h4>
              <form class="flex bg-gray-50 shadow-md rounded-full">
                <input type="text" class="w-full px-6 bg-transparent rounded-full mr-4 focus:outline-none">
                <button class="py-3 px-5 text-sm rounded-full bg-primary font-semibold text-white uppercase">Search</button>
              </form>
            </div>
            <div>
              <h4 class="text-primary mb-4 text-3xl font-sans">Latest Posts</h4>
              <ul class="flex flex-col divide-y divide-black divide-opacity-10">
                <li class="py-3"><a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consecte adipiscing elit</a></li>
                <li class="py-3"><a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consecte adipiscing elit</a></li>
                <li class="py-3"><a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consecte adipiscing elit</a></li>
                <li class="py-3"><a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consecte adipiscing elit</a></li>
                <li class="py-3"><a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consecte adipiscing elit</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</main>


<?php get_footer(); ?>