jQuery(function ($) {
  $(document).on('click', 'body:not(.elementor-editor-active) .link-column', function (e) {
    var column = $(this),
      link = column.data('link-column-options-url');

    if (link) {
      // skip clicks by links and elements marked as no-link 
      if ($(e.target).filter('a, a *, .no-link, .no-link *').length) {
        return true;
      }

      // maybe elementor actions
      if (link.match("^#elementor-action")) {

        var elementorActionHash = link;
        var elementorActionHash = decodeURIComponent(elementorActionHash);

        // if is Elementor Popup
        if (elementorActionHash.includes("elementor-action:action=popup:open") || elementorActionHash.includes("elementor-action:action=lightbox")) {

          if( 0 < $('body').find('#make-link-column-open-elementor-content').length ) {
            $('body').find('#make-link-column-open-elementor-content').remove();
          }
          if (0 === $('body').find('#make-link-column-open-elementor-content').length) {
            $('body').append('<a id="make-link-column-open-elementor-content" style="display: none !important;" href="' + link + '">Open elementor popup</a>');
          }
          if(0 < $('body').find('#make-link-column-open').length) {
            $('body').find('#make-link-column-open-elementor-content')[0].click();
          }

          return true;
        }

        return true;
      }

      // scroll by hash
      if (link.match("^#")) {
        var linkHash = link;
        if ($(linkHash).length) {
          $('html, body').animate({
            scrollTop: $(linkHash).offset().top
          }, 800, function () {
            window.location.hash = linkHash;
          });
        }
        return true;
      }

      // open link
      if( 0 < $('body').find('#make-link-column-open').length ) {
        $('body').find('#make-link-column-open').remove();
      }
      if (0 === $('body').find('#make-link-column-open').length) {
        $('body').append('<a id="make-link-column-open" style="display: none !important;" href="' + link + '" target="' + column.data('link-column-options-blank') + '">' + link + '</a>');
      }
      if(0 < $('body').find('#make-link-column-open').length) {
        $('body').find('#make-link-column-open')[0].click();
      }
      return false;
    }
  });
});
