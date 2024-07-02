jQuery(function( $ ) {
  // Lazy load inline images
  $('img.esf-lazyload').each(function() {
    $(this).attr('imgsrc', $(this).data('imgsrc'));
    $(this).removeClass('esf-lazyload');
  });

  // Lazy load background images
  var lazyloadBackgrounds = $('.esf-lazyload');
  lazyloadBackgrounds.each(function() {
    var dataSrc = $(this).data('imgsrc');
    $(this).css('background-image', 'url(' + dataSrc + ')');
    $(this).removeClass('esf-lazyload');
  });

  // Lazy load new elements added to the page
  var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      var newElements = $(mutation.addedNodes).find('.esf-lazyload');
      newElements.each(function() {
        var dataSrc = $(this).data('imgsrc');
        $(this).css('background-image', 'url(' + dataSrc + ')');
        $(this).removeClass('esf-lazyload');
      });
    });
  });
  var config = { childList: true, subtree: true };
  observer.observe(document.body, config);
});



/**
 * Init Grid layout
 */
function esf_insta_init_grid(){
  jQuery('.esf_insta_load_more_btns_wrap').hide();
  jQuery('.esf-insta-grid-wrapper .esf_insta_feed_fancy_popup').imagesLoaded(function() {
        jQuery('.esf_insta_feeds_holder .esf-insta-load-opacity').fadeIn('slow');
        jQuery('.esf_insta_load_more_btns_wrap').slideDown();
        jQuery('.esf_insta_feeds_holder .esf-insta-load-opacity').removeClass('esf-insta-load-opacity');
  });
}




jQuery(document).ready(function($) {
  if (jQuery('.esf_insta_feeds_grid').length) {
    esf_insta_init_grid();
  }

  

});

function esf_insta_init_layouts(){
  esf_insta_init_grid();
  
}

jQuery( window ).on( 'elementor/frontend/init', function() {
  elementorFrontend.hooks.addAction( 'frontend/element_ready/shortcode.default', function(){
    esf_insta_init_layouts();
  });
  elementorFrontend.hooks.addAction( 'frontend/element_ready/esf_instagram_feed.default', function(){
    esf_insta_init_layouts();
  });
} );
