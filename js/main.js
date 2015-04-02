/* jshint browser: true, devel: true, indent: 2 */
/* global $, jQuery, document */

function l(data) {
  'use strict';
  console.log(data);
}

jQuery(document).ready(function () {
  'use strict';

  $('#splash-arpa').on('click', function() {
  	$('#splash').remove();
  });

  var $masonry = $('.js-masonry');
  $masonry.imagesLoaded( function() {
	  $masonry.masonry({
	    columnWidth: '.grid-sizer',
	    gutterWidth: '.gutter-sizer',
	    itemSelector: '.item'
	  });
  });

});