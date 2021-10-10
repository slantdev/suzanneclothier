<?php

/**
 * Template Name: Contact
 */

add_filter('body_class', 'my_body_classes');
function my_body_classes($classes)
{
  $classes[] = 'header-semi-transparent';
  return $classes;
}

get_header();
//get_header('', array('bg_classes' => 'bg-opacity-50'));
?>

<main class="page-contact">

  <section class="hero flex flex-col items-center" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/hero/hero-contact.jpg)">
    <div class="absolute bg-black bg-opacity-30 inset-0"></div>
    <div class="container pt-32 pb-8 z-10">
      <div class="flex">
        <div class="w-1/2 pb-20 text-white">
          <h2 class="text-6xl font-sans mb-5">Contact Us</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Risus feugiat in ante metus dictum at tempor commodo.</p>
        </div>
      </div>
    </div>
    <div class="w-full bg-white bg-opacity-90 z-10">
      <div class="container h-12 flex items-center">
        <div class="breadcrumb -mx-1">
          <span class="inline-block px-1"><a href="/">Home</a></span><span class="inline-block px-1"> / </span><span class="font-semibold inline-block px-1">Contact Us</span>
        </div>
      </div>
    </div>
  </section>

  <section id="customer-service" class="bg-white">
    <div class="container">
      <div class="text-center">
        <div class="h-8 w-px bg-primary bg-opacity-50 mx-auto"></div>
        <div class="my-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-icon.svg" class="w-16 h-auto mx-auto"></div>
        <h3 class="text-4xl my-6 text-primary font-sans">Customer Service</h3>
        <div class="w-14 h-1 my-6 bg-secondary mx-auto"></div>
      </div>
      <div class="flex pt-14 pb-20 gap-12">
        <div class="w-1/2">
          <div class="px-14">
            <div class="mb-8"><img src="https://source.unsplash.com/collection/9718726/600x600" class="rounded-full mx-auto" /></div>
          </div>
        </div>
        <div class="w-1/2">
          <div class="font-medium">
            <p class="text-xl mb-4">Our brand new website is coming in fall 2021. Till then, we’re trying to cut down on spam bots sending us forms full of garbage.</p>
            <p class="mb-4">You can help us by doing what only a fellow human can do: think!</p>
            <p class="mb-4">To contact the right folks to help you, select the right email address from the list below. Then, remove the spaces before and after the @ symbol. Use that address to reach us.</p>
            <ul class="mb-4 list-disc pl-5">
              <li><strong>Question about an order?</strong> sales @ suzanneclothier.com</li>
              <li><strong>Interested in a consultation?</strong> Check out the Consultations page for information. https://suzanneclothier.com/shop/telephone-consultations/</li>
              <li><strong>Wondering about a webinar?</strong> webinars @ suzanneclothier.com</li>
              <li><strong>Looking for help with our online courses?</strong> courses @ suzanneclothier.com</li>
              <li><strong>Need Enriched Puppy help?</strong> Visit this page, then contact suzanne @ suzanneclothier.com</li>
              <li><strong>Seminars with Suzanne Clothier and/or John Rice?</strong> seminars @ suzanneclothier.com</li>
              <li><strong>Not sure?</strong> info @ suzanneclothier.com</li>
            </ul>
            <p>Thanks for doing your part to use this low-tech approach to avoid spammers. Our new website will handle it much better, promise!</p>
          </div>
        </div>
      </div>
      <div class="flex pb-28">
        <div class="w-1/2">
          <div class="px-14">
            <h3 class="mb-8 text-4xl text-primary font-sans">Our Details</h3>
            <div>
              <ul class="list-none flex flex-col gap-4 leading-none">
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="mail"></ion-icon>
                  <a href="#">info@suzanneclothier.com</a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="logo-linkedin"></ion-icon>
                  <a href="#">https://au.linkedin.com/in/suzanne-clothier</a>
                </li>
                <li class="flex items-center gap-4 border-b border-black border-opacity-10 pb-4">
                  <ion-icon class="text-3xl" name="call"></ion-icon>
                  <a href="#">1-800-7-FLY-DOG</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-1/2">
          <h3 class="mb-8 text-4xl text-primary font-sans">Drop us a line</h3>
          <div>
            <form>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <input type="text" placeholder="First Name" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Last Name" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Phone Number" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div>
                  <input type="text" placeholder="Email" class="bg-white rounded-full w-full shadow py-3 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                </div>
                <div class="col-span-2">
                  <textarea placeholder="Message" class="h-32 bg-white rounded-3xl w-full shadow py-5 px-5 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"></textarea>
                </div>
                <div class="col-span-2">
                  <button type="submit" class="w-44 inline-flex items-center justify-between leading-none py-2 pl-6 pr-2 rounded-full bg-primary text-white font-semibold shadow-md hover:shadow-lg transition-all">
                    <span class="inline-block whitespace-nowrap font-sans mr-4">Submit</span>
                    <ion-icon name="arrow-forward-circle" class="text-5xl leading-none"></ion-icon>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


</main>


<?php get_footer(); ?>