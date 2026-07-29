(function ($) {
  'use strict';

  $(function () {
    var $heroFeatures = $('.js-hero-features-slider');
    if ($heroFeatures.length) {
      $heroFeatures.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 5000,
        cssEase: 'linear',
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        waitForAnimate: false,
        responsive: [
          { breakpoint: 900, settings: { slidesToShow: 2, speed: 4500 } },
          { breakpoint: 640, settings: { slidesToShow: 1, speed: 3500 } }
        ]
      });
    }

    var $trusted = $('.js-trusted-slider');
    if ($trusted.length) {
      $trusted.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 12000,
        cssEase: 'linear',
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        waitForAnimate: false
      });
    }

    var $categories = $('.js-category-slider');
    if ($categories.length && window.matchMedia('(max-width: 1100px)').matches) {
      $categories.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        infinite: false,
        adaptiveHeight: true
      });
    }

    var $reviews = $('.js-reviews-slider');
    if ($reviews.length) {
      $reviews.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 6000,
        cssEase: 'linear',
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        waitForAnimate: false,
        responsive: [
          { breakpoint: 1100, settings: { slidesToShow: 2, speed: 5000 } },
          { breakpoint: 700, settings: { slidesToShow: 1, speed: 4000 } }
        ]
      });
    }

    $('.hn-faq__question').on('click', function () {
      var $item = $(this).closest('.hn-faq__item');
      var isOpen = $item.hasClass('is-open');

      $('.hn-faq__item').removeClass('is-open').find('.hn-faq__question').attr('aria-expanded', 'false');

      if (!isOpen) {
        $item.addClass('is-open');
        $(this).attr('aria-expanded', 'true');
      }
    });

    $('.hn-tabs__item').on('click', function (event) {
      var id = $(this).attr('data-tab');
      var $target = $('#' + id);
      if (!$target.length) {
        return;
      }

      event.preventDefault();
      $('.hn-tabs__item').removeClass('hn-tabs__item--active');
      $(this).addClass('hn-tabs__item--active');
      $('html, body').animate({ scrollTop: $target.offset().top - 100 }, 400);
    });
  });
})(jQuery);
