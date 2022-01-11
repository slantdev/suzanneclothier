jQuery(document).ready(function ($) {

  $('#header-search-button').on('click', function () {
    $('#header-search').toggleClass('show');
  });
  $(window).click(function () {
    if ($("#header-search").hasClass("show")) {
      $('#header-search').removeClass('show');
    }
  });
  $('#header-search, #header-search-button').click(function (event) {
    event.stopPropagation();
  });
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

  $('.article-cat-list').on('change', function () {
    $category = this.value;
    $postType = $(this).data("post");
    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filter_article',
        category: $category,
        postType: $postType,
      },
      success: function (res) {
        $('.blog-grid').html(res);
      }
    })
  });

  $('.filter-button').on('click', function (e) {
    e.preventDefault();
    $term = $(this).data('term');
    $slug = $(this).data('slug');

    //console.log($(this).data('term'));
    //console.log($(this).data('slug'));

    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filter_product_cat',
        term: $term,
        slug: $slug,
      },
      success: function (res) {
        $('.product-grid').html(res);
      }
    })


  });

  $('.pricing-switch-buttons > li:first-child > a').addClass('active');
  $('.pricing-tab-container > .pricing-tab-content:first-child').addClass('active');
  $('.pricing-switch-button').on('click', function (e) {
    e.preventDefault();
    $target = $(this).data('target');
    //console.log($target);
    $('#pricing-tabs .pricing-switch-button').removeClass('active');
    $(this).addClass('active');

    $('#pricing-tabs .pricing-tab-content').removeClass('active');
    $('#' + $target).addClass('active');
  });

});

