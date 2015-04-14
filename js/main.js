/* jshint browser: true, devel: true, indent: 2 */
/* global $, jQuery, document */

// DEV FUNCTION REMOVE FOR PROD

function l(data) {
  'use strict';
  console.log(data);
}

// VARIABLES

var scrollAnimationDuration = 400;

// CACHED

var $masonry = $('.js-masonry'),
  $window = $('.js-window'),

  $splash = $('#splash'),
  $home = $('#home'),
  $mainContent = $('#main-content');
  $news = $('#news'),
  $backArrow = $('.back-arrow');
  $newsLink = $('.js-news-link');

// ROUTER
function router( hash ) {

    hash = hash.replace("#!/",'');

    if ( hash === 'news' ) {

      $splash.remove();
      $mainContent.show();
      $news.show();
      $masonry.masonry();
      $news.ScrollTo();
      $backArrow.removeClass('u-hidden');
      $newsLink.addClass('u-hidden');
      $('meta[property="og:title"]').attr('content','ARPA - News');
      $('title').html('ARPA - News');

    } else if ( hash === 'home' ) {

      $splash.remove();
      $home.ScrollTo();
      $backArrow.addClass('u-hidden');
      $newsLink.removeClass('u-hidden');
      $('meta[property="og:title"]').attr('content','ARPA');
      $('title').html('ARPA');

      timeout = setTimeout(function() {
        $mainContent.hide();
        $news.hide();
      }, scrollAnimationDuration);

    }

}

// LAYOUT FIXES
function setWindowSized() {
  $window.css({
    'min-height': $(window).height()
  });
}

jQuery(document).ready(function () {
  'use strict';

  // LAYOUT
  setWindowSized();
  $(window).resize(function() {
    setWindowSized();
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
  $(window).scroll(function(e) {

    // when you scroll back to top of the page set hash as home
    if ($(window).scrollTop() === 0) {
      $mainContent.hide();
      window.location.hash = '!/home';
    }
  });

  // CLICK EVENTS
  $('#splash-arpa').on('click', function() {
  	$splash.remove();
  });

  $masonry.imagesLoaded( function() {
	  $masonry.masonry({
	    columnWidth: 1,
	    gutter: 0,
	    itemSelector: '.item',
      transitionDuration: 0
	  });
  });

});