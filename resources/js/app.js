// Navigation toggle
jQuery(document).ready(function ($) {

  $('.cat-list').on('change', function () {
    $category = this.value;
    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filter_blog',
        category: $category,
      },
      success: function (res) {
        $('.blog-grid').html(res);
      }
    })
  });

});

