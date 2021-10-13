<?php
?>
<div class="shadow-md rounded-2xl bg-gray-100 overflow-hidden flex flex-col">
  <div class="rounded-t-2xl overflow-hidden">
    <a href="<?php echo get_the_permalink(); ?>" class="block">
      <div class="aspect-w-16 aspect-h-9 bg-primary-light bg-opacity-10">
        <?php
        $thumbnail_medium = get_the_post_thumbnail_url(get_the_ID(), 'medium');
        if ($thumbnail_medium) {
          echo '<img src="' . $thumbnail_medium . '" class="w-full h-full object-cover object-center transform transition-transform scale-100 duration-500 hover:scale-110">';
        } else {
          echo '<div class="flex items-center justify-center"><ion-icon name="image-outline" class="text-5xl text-primary-light text-opacity-50"></ion-icon></div>';
        }
        ?>
      </div>
    </a>
  </div>
  <div class="pt-5 pb-4 px-6 flex flex-col flex-grow">
    <h3 class="mb-4 text-lg font-semibold">
      <a href="<?php echo get_the_permalink(); ?>" class="text-primary transition hover:text-primary-light"><?php echo get_the_title(); ?></a>
    </h3>
    <div class="text-sm mb-2"><?php echo get_the_excerpt(); ?></div>
    <div class="text-right leading-none mt-auto -mr-2">
      <a href="<?php echo get_the_permalink(); ?>" class="inline-block leading-none text-primary transition hover:text-primary-light">
        <ion-icon name="add-circle" class="text-right text-4xl leading-none"></ion-icon>
      </a>
    </div>
  </div>
</div>