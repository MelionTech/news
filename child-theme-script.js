jQuery(document).ready(function() {
  var owl = jQuery('.news-category .owl-carousel');
    owl.owlCarousel({
      margin: 30,
      nav: false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      loop: true,
      dots:true,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1024: {
          items: 1
      }
    }
  })
})