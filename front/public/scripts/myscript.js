var topoffset = 50; // variable for menu height
var carouselQuanity = 0;

$(function(){

    "use strict";

    // Carousel Items
    var carouselElement = 'carousel-featured';
    carouselQuanity = $('#' + carouselElement + ' .item').length;

    // Activate ScrollSpy
    $('body').scrollspy({
        target: 'header .navbar',
        offset: topoffset
    });

    // Add an inbody class to nav when scrollspy event fires
    $('.navbar-fixed-top').on('activate.bs.scrollspy', function() {
        checkNavigation(carouselElement);
    });


    // Initialize Menu
    checkNavigation(carouselElement);
    initCarousel(carouselElement);


    //Use smooth scrolling when clicking on navigation
    $('.navbar a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') ===
      this.pathname.replace(/^\//,'') &&
      location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top-topoffset+2
        }, 500);
        return false;
      } //target.length
    } //click function
    }); //smooth scrolling
});

function checkNavigation(firstElement) {
    var hash = $('header').find('li.active a').attr('href'); // look for the menu list item that is active

    if(hash !== '#' + firstElement) {
        $('header nav').addClass('inbody');
    } else {
        $('header nav').removeClass('inbody');
    }
}

function initCarousel(carouselElement) {
    // Initialize Carousel
    $('#' + carouselElement).carousel({
        pause: false
    });

    // carousel height
    var carouselHeight = $(window).height(); // get the height of the window

    $('.fullheight').css('height', carouselHeight); // set the height of inner to the full window

    // set the active to a random slide
    var randSlide = Math.floor(Math.random() * carouselQuanity);
    $('#' + carouselElement + ' .item').eq(randSlide).addClass('active');

    // setup navigation
    for(var i = 0; i < carouselQuanity; i++)
    {
        var insertText = '<li data-target="#' + carouselElement + '" data-slide-to="' + i + '"';
        if(i === randSlide)
        {
            insertText += ' class="active"';
        }

        insertText += '></li>';

        $('#' + carouselElement + ' ol').append(insertText);
    }

    // replace images to background images inside item
    $('#' + carouselElement + ' .item img').each(function(){
        var imgSrc = $(this).attr('src');
        $(this).parent().css({'background-image': 'url(' + imgSrc + ')'});
        $(this).remove();
    });

    // adjust height of .fullheight elements on window resize
    $(window).resize(function(){
        var carouselHeight = $(window).height(); // get the height of the window

        $('.fullheight').css('height', carouselHeight); // set the height of inner to the full window
    });
}