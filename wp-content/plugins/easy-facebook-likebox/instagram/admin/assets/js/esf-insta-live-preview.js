/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage

 * this, set your custom settings to 'postMessage' and then add your handling

 * here. Your javascript should grab settings from customizer controls, and

 * then make any necessary changes to the page using jQuery.

 */

//======================================================================
// Header Live Preview
//======================================================================

(function($) {
// console.log(mif_skin_id);

  /*
  * Show or hide next prev icon in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_next_prev_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>html body .esf_insta_feed_wraper .esf_insta_feeds_carousel .owl-nav{display:flex!important}</style>').
                appendTo('head');

          }
          else {
            $('<style>html body .esf_insta_feed_wraper .esf_insta_feeds_carousel .owl-nav{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  * Show or hide header in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_nav]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('<style>.esf_insta_feed_wraper .owl-dots{display:block!important}</style>').
            appendTo('head');
      }
      else {
        $('<style>.esf_insta_feed_wraper .owl-dots{display:none!important}</style>').
            appendTo('head');
      }

    });
  });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[nav_color]', function(value) {
    value.bind(function(newval) {
      $('.esf_insta_feed_wraper .esf_insta_feeds_carousel .owl-dots .owl-dot span').
          css('background', newval);
    });
  });

  /*
* Updates background color of loadmore in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[nav_active_color]',
      function(value) {
        value.bind(function(newval) {
          $('.esf_insta_feed_wraper .esf_insta_feeds_carousel .owl-dots .owl-dot.active span').
              css('background', newval);
        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[nav_active_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .owl-theme .owl-dots .owl-dot:hover span{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[load_more_background_color]',
      function(value) {
        value.bind(function(newval) {
          $('.esf_insta_feed_wraper .esf_insta_load_more_holder a span').
              css('background-color', newval);
        });
      });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[load_more_color]',
      function(value) {
        value.bind(function(newval) {
          $('.esf_insta_feed_wraper .esf_insta_load_more_holder a span').
              css('color', newval);
        });
      });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[load_more_hover_background_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .esf_insta_load_more_holder a:hover span{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[load_more_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .esf_insta_load_more_holder a:hover span{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated background color of header in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_background_color]',
      function(value) {
        value.bind(function(newval) {
          $('.esf_insta_feed_wraper .esf_insta_header').
              css('background-color', newval);
        });
      });

  /*
  * Updated color of header in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_text_color]',
      function(value) {
        value.bind(function(newval) {
          $('.esf_insta_feed_wraper .esf_insta_header, .esf_insta_feed_wraper .esf_insta_header .esf_insta_followers, .esf_insta_feed_wraper .esf_insta_header .esf_insta_bio, .esf_insta_feed_wraper .esf_insta_header .esf_insta_header_title a').
              css('color', newval);
        });
      });

  /*
  * Updated the title size of header.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[title_size]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_header_title').
          css('font-size', newval + 'px');

    });

  });

  /*
  * Show or hide display picture in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_dp]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_header_img').
            fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_header_img').
            fadeOut('slow');
      }

    });
  });

  /*
  * Change Image Filters.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_image_filter]',
      function(value) {

        value.bind(function(newval) {

          $('.mif_wrap  .mif_single .mif_feed_image').
              attr('class', 'mif_feed_image');

          $('.mif_wrap  .mif_single .mif_feed_image').addClass(newval);
          $('.mif_wrap  .mif_single.mif_grid_layout').addClass(newval);

        });
      });

  /*
  * Change Amount OF Filters.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_image_filter_amount]',
      function(value) {

        value.bind(function(newval) {

          wp.customize('mif_skin_' + mif_skin_id + '[feed_image_filter]',
              function(setting) {

                var mif_filter = setting.get();

                $('<style>.mif_wrap  .mif_single .mif_feed_image.' +
                    mif_filter + ', .mif_wrap  .mif_single .mif_feed_image.' +
                    mif_filter + '{filter:' + mif_filter + '(' + newval +
                    ')}</style>').appendTo('head');
                $('<style>.mif_wrap  .mif_single.' + mif_filter +
                    ', .mif_wrap  .mif_single.' + mif_filter + '{filter:' +
                    mif_filter + '(' + newval + ')}</style>').appendTo('head');

              });
        });
      });

  /*
  * Show rounded or boxed dp.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_round_dp]',
      function(value) {

        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper .esf_insta_header_img img').
                css('border-radius', '50%');
          }
          else {

            $('.esf_insta_feed_wraper .esf_insta_header_img img').
                css('border-radius', '0px');
          }

        });

      });

  /*
  * Show or hide total number of feeds in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_page_category]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper .esf_insta_header .mif_cat').
                fadeIn('slow').
                css('display', 'inline-block');
          }
          else {
            $('.esf_insta_feed_wraper .esf_insta_header .mif_cat').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of feeds in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shadow]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper .esf-insta-story-wrapper').css({
          '-moz-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          '-webkit-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          'box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
        });
      }
      else {
        $('.esf_insta_feed_wraper .esf-insta-story-wrapper').
            css('box-shadow', 'none');
      }

    });
  });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_shadow_color]',
      function(value) {
        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper').
              css('box-shadow', '0 0 10px 0 ' + newval + '');

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[header_shadow]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper .esf_insta_header').css({
          '-moz-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          '-webkit-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          'box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
        });
      }
      else {
        $('.esf_insta_feed_wraper .esf_insta_header').css('box-shadow', 'none');
      }

    });
  });

  wp.customize('mif_skin_' + mif_skin_id + '[header_shadow_color]',
      function(value) {
        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('box-shadow', '0 0 10px 0 ' + newval + '');

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_no_of_followers]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper .esf_insta_header .mif_followers').
                fadeIn('slow').
                css('display', 'inline-block');
          }
          else {
            $('.esf_insta_feed_wraper .esf_insta_header .mif_followers').
                fadeOut('slow');
          }

        });
      });

  /*
  * Updated the title size of total posts and followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[metadata_size]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_followers').
          css('font-size', newval + 'px');

    });

  });

  /*
  * Updated the title size of bio in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[bio_size]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_bio').
          css('font-size', newval + 'px');

    });

  });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-color', newval);

        });

      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_style]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-style', newval);

        });

      });

  /*
  * Updated the Header Border top size in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_top]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-top-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border bottom size in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-bottom-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border left size in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-left-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border left size in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_border_right]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('border-right-width', newval + 'px');

        });

      });

  /*
  * Updated the Header top padding in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_content_padding]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper.grid .mif_post_content, .esf_insta_feed_wraper .esf-insta-story-wrapper.grid .mif_story_meta').
              css('padding', newval + 'px');

        });

      });

  /*
  * Updated the Header top padding in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_padding_top]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('padding-top', newval + 'px');

        });

      });

  /*
  * Updated the Header bottom padding in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_padding_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('padding-bottom', newval + 'px');

        });

      });

  /*
  * Updated the Header left padding in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_padding_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('padding-left', newval + 'px');

        });

      });

  /*
  * Updated the Header right padding in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_padding_right]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf_insta_header').
              css('padding-right', newval + 'px');

        });

      });

  /*
  * Updated the Header Alignment in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_align]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .esf_insta_header .esf_insta_header_inner_wrap').
          css('float', newval);

    });

  });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_dp_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper  .esf_insta_header a:hover .mif_overlay{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated the Header shadow icon color of dp.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[header_dp_hover_icon_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper  .esf_insta_header .mif_head_img_holder .mif_overlay .icon{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_follow_btn]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .mif_follow_btn').fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper .mif_follow_btn').fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_load_more_btn]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .mif_load_more_btn ').fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper .mif_load_more_btn ').fadeOut('slow');
          }

        });
      });

  //======================================================================
  // Feeds Live Preview
  //======================================================================
  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_background_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper, .esf_insta_feed_wraper .esf_insta_feeds_carousel .esf-insta-story-wrapper .esf-insta-grid-wrapper').
              css({'background-color': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_borders_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col a img, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-thumbnail-wrapper .esf-insta-thumbnail-col, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer').
              css({'border-color': newval, 'outline-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shared_link_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shared_link_heading_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story .mif_title_link a').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shared_link_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story .mif_link_description').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shared_link_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story').
              css({'border-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_text_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper, .esf_insta_feed_wraper  .esf-insta-story-wrapper .esf-insta-feed-content > .esf-insta-d-flex .esf-insta-profile-title span, .esf_insta_feed_wraper  .esf-insta-story-wrapper .esf-insta-feed-content .description, .esf_insta_feed_wraper  .esf-insta-story-wrapper .esf-insta-feed-content .description a, .esf_insta_feed_wraper  .esf-insta-story-wrapper .esf-insta-feed-content .mif_link_text, .esf_insta_feed_wraper  .esf-insta-story-wrapper .esf-insta-feed-content .mif_link_text .mif_title_link a').
              css({'color': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_spacing]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .esf-insta-story-wrapper').
          css({'margin-bottom': newval + 'px'});

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_type_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-overlay .esf-insta-multimedia, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-overlay .icon-esf-video-camera').
              css({'color': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_buttons_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share').
              css({'color': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_buttons_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share').
              css({'background': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_buttons_hover_bg_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb:hover, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share:hover{background:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_buttons_hover_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-insta-view-on-fb:hover, .esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-post-footer .esf-share-wrapper .esf-share:hover{color:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[feed_hover_shadow_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper .esf-insta-overlay').
              css({'background': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_header]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_author_info ').
            fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper .esf-insta-story-wrapper .mif_author_info ').
            fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_shared_link]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_shared_story').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide header in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_header_logo]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_author_info .mif_auth_logo').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper  .esf-insta-story-wrapper .mif_author_info .mif_auth_logo').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_likes]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .mif_likes, .esf_insta_feed_wraper  .mif_all_likes_wrap').
            fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper .mif_likes, .esf_insta_feed_wraper  .mif_all_likes_wrap').
            fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_shares]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .mif_shares').fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper .mif_shares').fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_comments]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .mif_comments').fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
        $('.esf_insta_feed_wraper .mif_comments_wraper').remove();
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[number_of_cols]', function(value) {
    var no_of_columns = null;
    value.bind(function(newval) {

      if (2 == newval) {

        no_of_columns = '50';
        height = '317';
      }
      else if (3 == newval) {

        no_of_columns = '33.33';
      }
      else if (4 == newval) {

        no_of_columns = '25';
      }

      $('.esf_insta_feed_wraper .esf-insta-grid-skin .esf-insta-row.e-outer').
          css({
            'grid-template-columns': 'repeat(auto-fill, minmax(' +
                no_of_columns + '%, 1fr))',
          });

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_padding_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'padding-bottom': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_padding_top]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'padding-top': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_padding_right]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'padding-right': newval + 'px'});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[feed_padding_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'padding-left': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_margin_top]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'margin-top': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_margin_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'margin-bottom': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_margin_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'margin-left': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_margin_right]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css({'margin-right': newval + 'px'});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[show_likes]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .mif_lnc_holder  .mif_likes').fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper  .mif_lnc_holder  .mif_likes').
            fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_data_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_story_meta .mif_info .mif_likes, .esf_insta_feed_wraper .mif_story_meta .mif_info .mif_comments, .esf_insta_feed_wraper .mif_story_meta .mif_info .mif_shares, .esf_insta_feed_wraper .mif_story_meta .mif_info .mif_all_likes_wrap').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_meta_data_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-post-footer .esf-insta-reacted-item, .esf_insta_feed_wraper .esf-insta-post-footer .esf-insta-reacted-item .mif_all_comments_wrap').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_likes_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_lnc_holder .mif_likes').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_likes_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_lnc_holder .mif_likes').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_comments]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper .mif_story_meta .mif_info .mif_comments').
            fadeIn('slow');
        $('.esf_insta_feed_wraper .mif_comments_wraper').
            css('display', 'block !important');
      }
      else {
        $('.esf_insta_feed_wraper .mif_story_meta .mif_info  .mif_comments').
            fadeOut('slow');
        $('.esf_insta_feed_wraper .mif_comments_wraper').
            css('display', 'none !important');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_comments_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
          $('.esf_insta_feed_wraper .mif_lnc_holder .mif_comments').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_comments_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
          $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
          $('.esf_insta_feed_wraper  .mif_comments p, .esf_insta_feed_wraper .mif_comments .icon').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_comments_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
          $('.esf_insta_feed_wraper .mif_lnc_holder .mif_comments').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_comments_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_comments').fadeOut('slow');
          $('.esf_insta_feed_wraper .mif_lnc_holder .mif_comments').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[show_feed_caption]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .mif_story_text').fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper  .mif_story_text').fadeOut('slow');
          }

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[feed_caption_background_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_story_text ').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[caption_color]', function(value) {

    value.bind(function(newval) {

      $('.esf_insta_feed_wraper .mif_story_text, .esf_insta_feed_wraper .mif_story_text p, .esf_insta_feed_wraper .mif_story_text a').
          css({'color': newval});

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_caption_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_story_text').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_caption_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_story_text').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[show_feed_open_popup_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_wraper  .mif_hover .icon ').fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_wraper  .mif_hover .icon  ').fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-overlay .esf-insta-plus').
              css({'color': newval});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[show_feed_cta]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.esf_insta_feed_wraper  .mif_read_more_link ').fadeIn('slow');
      }
      else {
        $('.esf_insta_feed_wraper  .mif_read_more_link ').fadeOut('slow');
      }

    });
  });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[feed_cta_text_color]',
      function(value) {
        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_read_more_link a').
              css({'color': newval});
        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[feed_cta_text_hover_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper .esf-insta-story-wrapper .mif_read_more_link a:hover{color:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('mif_skin_' + mif_skin_id + '[feed_time_text_color]',
      function(value) {
        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .mif_story_time').css({'color': newval});
        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_seprator_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper .esf-insta-story-wrapper').
              css({'border-color': newval});

        });
      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_border_style]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css('border-style', newval);

        });

      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_border_size]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_wraper  .esf-insta-story-wrapper').
              css('border-width', newval + 'px');

        });

      });

  /*
  * Change hover shadow color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[feed_hover_bg_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.esf_insta_feed_wraper  .mif_story_photo .mif_hover{background:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  //======================================================================
  // PoUp Live Preview
  //======================================================================
  /*
  * Background color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_sidebar_bg]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper').
              css({'background': newval});

          $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-caption::after{background:' +
              newval + '}</style>').appendTo('head');
        });
      });

  /*
  * content color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_sidebar_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper, .esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-caption .esf-insta-feed-description, .esf_insta_feed_popup_container .esf-insta-post-detail a, .esf_insta_feed_popup_container .esf-insta-post-detail span').
              css({'color': newval});

        });
      });

  /*
  * Show header
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_header]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header{display:none!important}</style>').
                appendTo('head');

          }

        });
      });

  /*
  * Show header logo
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_header_logo]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header .esf-insta-profile-image').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header .esf-insta-profile-image').
                fadeOut('slow');
          }

        });
      });

  /*
  * Header title color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_header_title_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header h2').
              css({'color': newval});

        });
      });

  /*
  * Header title color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_post_time_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-post-header span').
              css({'color': newval});

        });
      });

  /*
  * Show caption
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_caption]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_popup_container .esf-insta-feed-description').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_popup_container .esf-insta-feed-description').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show meta
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_meta]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  *  meta color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_meta_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions span').
              css({'color': newval});

        });
      });

  wp.customize('mif_skin_' + mif_skin_id + '[popup_meta_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box').
              css({'border-color': newval});

        });
      });

  /*
  * Show reactions counter
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_reactions_counter]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .mif_popup_likes_main{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .mif_popup_likes_main{display:none!important}</style>').
                appendTo('head');

          }

        });
      });

  /*
  * Show comments counter
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_comments_counter]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf-insta-popup-comments-icon-wrapper{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-reactions-box .esf-insta-reactions .esf-insta-popup-comments-icon-wrapper{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  * Show comments
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_comments]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_popup_container .esf-insta-commnets, .esf_insta_feed_popup_container .esf-insta-comments-list').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_popup_container .esf-insta-commnets, .esf_insta_feed_popup_container .esf-insta-comments-list').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show view on fb link
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_view_fb_link]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.esf_insta_feed_popup_container .esf-insta-action-btn').
                fadeIn('slow');
          }
          else {
            $('.esf_insta_feed_popup_container .esf-insta-action-btn').
                fadeOut('slow');
          }

        });
      });

  /*
  *  Comments bg
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_comments_color]',
      function(value) {

        value.bind(function(newval) {

          $('.esf_insta_feed_popup_container .esf-insta-post-detail .esf-insta-d-columns-wrapper .esf-insta-comments-list .esf-insta-comment-wrap').
              css({'color': newval});

        });
      });

  /*
  * Show close Icon
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_show_close_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small').
                fadeIn('slow');
          }
          else {
            $('.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small').
                fadeOut('slow');
          }

        });
      });

  /*
  *  Close Icon bg color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_close_icon_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small').
              css({'background-color': newval});

        });
      });

  /*
  *  Close Icon bg color
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_close_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small').
              css({'color': newval});

        });
      });

  /*
  * Close hover bg.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_close_icon_bg_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small:hover{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Close hover color.
  */
  wp.customize('mif_skin_' + mif_skin_id + '[popup_close_icon_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.fancybox-container .esf_insta_feed_popup_container.fancybox-content .fancybox-close-small:hover{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

})(jQuery);