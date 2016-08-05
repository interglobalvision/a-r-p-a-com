/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, WP */

// VARIABLES

var scrollAnimationDuration = 400;

// CACHED

var $masonry = $('.js-masonry'),
  $window = $('.js-window'),

  $splash = $('#splash'),
  $home = $('#home'),
  $mainContent = $('#main-content'),

  $news = $('#news'),
  $backArrow = $('.back-arrow'),
  $newsLink = $('.js-news-link'),

  $noonVideo = $('#noon-video'),

  timeout;

// ROUTER
function router( hash ) {

    hash = hash.replace("#!/",'');

    if ( hash === 'news' ) {

      $splash.hide();

      $home.show();
      $mainContent.show();
      $news.show();

      $masonry.masonry();

      $news.ScrollTo();

      $backArrow.removeClass('u-hidden').attr('href', WP.home);
      $newsLink.addClass('u-hidden');

      $('meta[property="og:title"]').attr('content','ARPA - News');
      $('title').html('ARPA - News');

    } else if ( hash === 'home' ) {

      $splash.hide();
      $home.show().ScrollTo();

      $backArrow.removeClass('u-hidden').attr('href', WP.splash);
      $newsLink.removeClass('u-hidden');

      $('meta[property="og:title"]').attr('content','ARPA');
      $('title').html('ARPA');

      timeout = setTimeout(function() {
        $mainContent.hide();
        $news.hide();
      }, scrollAnimationDuration);

    } else if ( hash === 'splash' ) {

      $splash.show();
      $home.hide();

      $backArrow.addClass('u-hidden');
      $newsLink.addClass('u-hidden');

      $('meta[property="og:title"]').attr('content','ARPA');
      $('title').html('ARPA');

    }

}

// VIDEO

function centerVideo() {
  var videoWidth = $noonVideo.width();
  var halfWindowWidth = ($(window).width() / 2);
  var marginLeft = ((videoWidth - halfWindowWidth) / 2);
  $noonVideo.css({
    'margin-left': '-' + marginLeft + 'px'
  });
}

function initVideo() {
  var videoElement = document.getElementById('noon-video');

  videoElement.addEventListener('play', function() {
    $(videoElement).css({
      'opacity': 1,
      'display': 'block'
    });
    centerVideo();
  });

  videoElement.load();
}

// LAYOUT FIXES
function setWindowSized() {
  $window.each(function() {
    var $this = $(this);
    var windowHeight = $(window).height();
    if ($this.height() > windowHeight) {
      $this.css({
        'height': 'auto'
      });
    } else {
      $this.css({
        'height': $(window).height()
      });
    }
  });
}

jQuery(document).ready(function () {
  'use strict';

  // VIDEO
  initVideo();

  // LAYOUT
  setWindowSized();
  centerVideo();
  $(window).resize(function() {
    setWindowSized();
    centerVideo();
  });

  // ROUTER: on load
  if ( window.location.hash ) {
    router( window.location.hash );
  }

  // ROUTER: on change
  window.onhashchange = function () {
    router( window.location.hash );
  };

  // SCROLL EVENTS
  $(window).scroll(function() {
    // when you scroll back to top of the page set hash as home
    if ($(window).scrollTop() === 0 && window.location.hash !== '#!/splash') {
      $mainContent.hide();
      window.location.hash = '!/home';
    }
  });

  // CLICK EVENTS
  $('#splash-arpa').on('click', function() {
  	window.location.hash = '!/home';
  });

  $masonry.imagesLoaded( function() {
	  $masonry.masonry({
	    itemSelector: '.js-masonry-item',
      transitionDuration: 0,
      percentPosition: true
	  });
  });

});