<?php

/**
 * Load Required functions
 */
require get_template_directory() . '/inc/enqueue_scripts.php';
require get_template_directory() . '/inc/theme_setup.php';
require get_template_directory() . '/inc/nav_menu.php';

require get_template_directory() . '/inc/theme/site-header.php';
require get_template_directory() . '/inc/theme/site-footer.php';
require get_template_directory() . '/inc/theme/pagination.php';
require get_template_directory() . '/inc/theme/posts.php';
require get_template_directory() . '/inc/theme/search.php';
require get_template_directory() . '/inc/theme/shortcodes.php';

require get_template_directory() . '/inc/plugins/acf.php';
require get_template_directory() . '/inc/plugins/woocommerce.php';
require get_template_directory() . '/inc/plugins/restrict-content-pro.php';

require get_template_directory() . '/inc/functionality/membership.php';
