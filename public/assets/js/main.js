/**
* Template Name: EstateAgency - v2.1.0
* Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function($) {
  "use strict";

  // Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });
  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  var nav = $('nav');
  var navHeight = nav.outerHeight();

  /*--/ ScrollReveal /Easy scroll animations for web and mobile browsers /--*/
  window.sr = ScrollReveal();
  sr.reveal('.foo', {
    duration: 1000,
    delay: 15
  });

  /*--/ Carousel owl /--*/
  $('#carousel').owlCarousel({
    loop: true,
    margin: -1,
    items: 1,
    nav: true,
    navText: ['<i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i>'],
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true
  });

  /*--/ Animate Carousel /--*/
  $('.intro-carousel').on('translate.owl.carousel', function() {
    $('.intro-content .intro-title').removeClass('animate__zoomIn animate__animated').hide();
    $('.intro-content .intro-price').removeClass('animate__fadeInUp animate__animated').hide();
    $('.intro-content .intro-title-top, .intro-content .spacial').removeClass('animate__fadeIn animate__animated').hide();
  });

  $('.intro-carousel').on('translated.owl.carousel', function() {
    $('.intro-content .intro-title').addClass('animate__zoomIn animate__animated').show();
    $('.intro-content .intro-price').addClass('animate__fadeInUp animate__animated').show();
    $('.intro-content .intro-title-top, .intro-content .spacial').addClass('animate__fadeIn animate__animated').show();
  });

  /*--/ Navbar Collapse /--*/
  $('.navbar-toggle-box-collapse').on('click', function() {
    $('body').removeClass('box-collapse-closed').addClass('box-collapse-open');
  });
  $('.close-box-collapse, .click-closed').on('click', function() {
    $('body').removeClass('box-collapse-open').addClass('box-collapse-closed');
    $('.menu-list ul').slideUp(700);
  });

  /*--/ Navbar Menu Reduce /--*/
  $(window).trigger('scroll');
  $(window).bind('scroll', function() {
    var pixels = 50;
    var top = 1200;
    if ($(window).scrollTop() > pixels) {
      $('.navbar-default').addClass('navbar-reduce');
      $('.navbar-default').removeClass('navbar-trans');
    } else {
      $('.navbar-default').addClass('navbar-trans');
      $('.navbar-default').removeClass('navbar-reduce');
    }
    if ($(window).scrollTop() > top) {
      $('.scrolltop-mf').fadeIn(1000, "easeInOutExpo");
    } else {
      $('.scrolltop-mf').fadeOut(1000, "easeInOutExpo");
    }
  });

  /*--/ Property owl /--*/
  $('#property-carousel').owlCarousel({
    loop: true,
    margin: 30,
    responsive: {
      0: {
        items: 1,
      },
      769: {
        items: 1,
      },
      992: {
        items: 3,
      }
    }
  });

  /*--/ Property owl owl /--*/
  $('#property-single-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    navText: ['<i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1,
      }
    }
  });

  /*--/ News owl /--*/
  $('#new-carousel').owlCarousel({
    loop: true,
    margin: 30,
    responsive: {
      0: {
        items: 1,
      },
      769: {
        items: 1,
      },
      992: {
        items: 3,
      }
    }
  });

  /*--/ Testimonials owl /--*/
  $('#bex-bussiness-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-section"><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 8000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1
      },
  
      1024: {
        items: 3
      },
  
      1366: {
        items: 3
      }
    }
  });

  $('#bex-featured-business-for-sale-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-section"><div><a</div><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1
      },
  
      1024: {
        items: 4
      },
  
      1366: {
        items: 4
      }
    }
  });
  $('#bex-Featured-Start-Ups-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-sectionm"><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1
      },
  
      1024: {
        items: 4
      },
  
      1366: {
        items: 4
      }
    }
  });
  //bex-upcoming-past-events-carousel
  $('#bex-upcoming-past-events-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-sectionm"><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1
      },
  
      1024: {
        items: 2
      },
  
      1366: {
        items: 2
      }
    }
  });
  //bex-Featured-mentors-carousel
  $('#bex-Featured-mentors-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-sectionm"><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1
      },
  
      1024: {
        items: 3
      },
  
      1366: {
        items: 3
      }
    }
  });
  // bex-featured-investors-carousel
  $('#bex-featured-investors-carousel').owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeInUp',
    navText: ['<div class="bex-arrow-sectionm"><i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i></div>'],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2
      },
  
      1024: {
        items: 3
      },
  
      1366: {
        items: 3
      }
    }
  });

  //bx insight
//   $(window).on('load', function() {
//     var bxinsight = $('.bx-insight-container').isotope({
//       itemSelector: '.bx-insight-item'
//     });
//     $('#bx-insight-flters li').on('click', function() {
//       $("#bx-insight-flters li").removeClass('filter-active');
//       $(this).addClass('filter-active');

//       bxinsight.isotope({
//         filter: $(this).data('filter')
//       });
//       aos_init();
//     });
//   });
})(jQuery);