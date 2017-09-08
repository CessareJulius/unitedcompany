(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 54
  });

  // Collapse the navbar when page is scrolled
  $(window).scroll(function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  });

})(jQuery); // End of use strict


// the list of our video elements
var videos = document.querySelectorAll('video');
// an array to store the top and bottom of each of our elements
var videoPos = [];
// a counter to check our elements position when videos are loaded
var loaded = 0;

// Here we get the position of every element and store it in an array
function checkPos() {
  // loop through all our videos
  for (var i = 0; i < videos.length; i++) {

    var element = videos[i];
    // get its bounding rect
    var rect = element.getBoundingClientRect();
    // we may already have scrolled in the page 
    // so add the current pageYOffset position too
    var top = rect.top + window.pageYOffset;
    var bottom = rect.bottom + window.pageYOffset;
    // it's not the first call, don't create useless objects
    if (videoPos[i]) {
      videoPos[i].el = element;
      videoPos[i].top = top;
      videoPos[i].bottom = bottom;
    } else {
      // first time, add an event listener to our element
      element.addEventListener('loadeddata', function() {
          if (++loaded === videos.length - 1) {
            // all our video have ben loaded, recheck the positions
            // using rAF here just to make sure elements are rendered on the page
            requestAnimationFrame(checkPos)
          }
        })
        // push the object in our array
      videoPos.push({
        el: element,
        top: top,
        bottom: bottom
      });
    }
  }
};
// an initial check
checkPos();


var scrollHandler = function() {
  // our current scroll position

  // the top of our page
  var min = window.pageYOffset;
  // the bottom of our page
  var max = min + window.innerHeight;

  videoPos.forEach(function(vidObj) {
    // the top of our video is visible
    if (vidObj.top >= min && vidObj.top < max) {
      // play the video
      vidObj.el.play();
    }

    // the bottom of the video is above the top of our page
    // or the top of the video is below the bottom of our page
    // ( === not visible anyhow )  
    if (vidObj.bottom <= min || vidObj.top >= max) {
      // stop the video
      vidObj.el.pause();
    }

  });
};
// add the scrollHandler
window.addEventListener('scroll', scrollHandler, true);
// don't forget to update the positions again if we do resize the page
window.addEventListener('resize', checkPos);