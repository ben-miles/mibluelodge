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
// console.log(efbl_skin_id);
  /*
  * Show or hide header in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_header]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper .efbl_header').slideDown('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl_header').slideUp('slow');
      }

    });
  });

  /*
  * Show or hide next prev icon in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_next_prev_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>html body .efbl_feed_wraper .efbl_feeds_carousel .owl-nav{display:flex!important}</style>').
                appendTo('head');

          }
          else {
            $('<style>html body .efbl_feed_wraper .efbl_feeds_carousel .owl-nav{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  * Show or hide header in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_nav]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('<style>.efbl_feed_wraper .owl-dots{display:block!important}</style>').
            appendTo('head');
      }
      else {
        $('<style>.efbl_feed_wraper .owl-dots{display:none!important}</style>').
            appendTo('head');
      }

    });
  });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[wraper_background_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_feeds_carousel').
              css('background-color', newval);
        });
      });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[nav_color]', function(value) {
    value.bind(function(newval) {
      $('.efbl_feed_wraper .efbl_feeds_carousel .owl-dots .owl-dot span').
          css('background', newval);
    });
  });

  /*
* Updates background color of loadmore in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[nav_active_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_feeds_carousel .owl-dots .owl-dot.active span').
              css('background', newval);
        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[nav_active_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .owl-theme .owl-dots .owl-dot:hover span{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[load_more_background_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_load_more_holder a span').
              css('background-color', newval);
        });
      });

  /*
  * Updates background color of loadmore in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[load_more_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_load_more_holder a span').
              css('color', newval);
        });
      });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[load_more_hover_background_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .efbl_load_more_holder a:hover span{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[load_more_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .efbl_load_more_holder a:hover span{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated background color of header in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_background_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_header').css('background-color', newval);
        });
      });

  /*
  * Updated color of header in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_text_color]',
      function(value) {
        value.bind(function(newval) {
          $('.efbl_feed_wraper .efbl_header, .efbl_feed_wraper .efbl_header .efbl_cat, .efbl_feed_wraper .efbl_header .efbl_followers, .efbl_feed_wraper .efbl_header .efbl_bio, .efbl_feed_wraper .efbl_header .efbl_header_title, .efbl_feed_wraper .efbl_header_time .efbl_header_title').
              css('color', newval);
        });
      });

  /*
  * Updated the title size of header.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[title_size]', function(value) {

    value.bind(function(newval) {

      $('.efbl_feed_wraper .efbl_header .efbl_header_title').
          css('font-size', newval + 'px');

    });

  });

  /*
  * Show or hide display picture in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_dp]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper .efbl_header .efbl_header_img').fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl_header .efbl_header_img').fadeOut('slow');
      }

    });
  });

  /*
  * Show rounded or boxed dp.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_round_dp]',
      function(value) {

        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper .efbl_header_img img').
                css('border-radius', '50%');
          }
          else {

            $('.efbl_feed_wraper .efbl_header_img img').
                css('border-radius', '0px');
          }

        });

      });

  /*
  * Show or hide total number of feeds in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_page_category]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper .efbl_header .efbl_cat').
                fadeIn('slow').
                css('display', 'inline-block');
          }
          else {
            $('.efbl_feed_wraper .efbl_header .efbl_cat').fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of feeds in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shadow]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper .efbl-story-wrapper').css({
          '-moz-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          '-webkit-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
          'box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
        });
      }
      else {
        $('.efbl_feed_wraper .efbl-story-wrapper').css('box-shadow', 'none');
      }

    });
  });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shadow_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper').
              css('box-shadow', '0 0 10px 0 ' + newval + '');

        });

      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[header_shadow]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper .efbl_header').css({
              '-moz-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
              '-webkit-box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
              'box-shadow': '0 0 10px 0 rgba(0,0,0,0.15)',
            });
          }
          else {
            $('.efbl_feed_wraper .efbl_header').css('box-shadow', 'none');
          }

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[header_shadow_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('box-shadow', '0 0 10px 0 ' + newval + '');

        });

      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_no_of_followers]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper .efbl_header .efbl_followers').
                fadeIn('slow').
                css('display', 'inline-block');
          }
          else {
            $('.efbl_feed_wraper .efbl_header .efbl_followers').fadeOut('slow');
          }

        });
      });

  /*
  * Updated the title size of total posts and followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[metadata_size]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header .efbl_cat, .efbl_feed_wraper .efbl_header .efbl_followers').
              css('font-size', newval + 'px');

        });

      });

  /*
  * Show or hide bio in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_bio]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper .efbl_header .efbl_bio').fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl_header .efbl_bio').fadeOut('slow');
      }

    });
  });

  /*
  * Updated the title size of bio in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[bio_size]', function(value) {

    value.bind(function(newval) {

      $('.efbl_feed_wraper .efbl_header .efbl_bio').
          css('font-size', newval + 'px');

    });

  });

  /*
  * Updated the Header Border Color in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[bio_size]', function(value) {

    value.bind(function(newval) {

      $('.efbl_feed_wraper .efbl_header').css('border-color', newval);

    });

  });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').css('border-color', newval);

        });

      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_style]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').css('border-style', newval);

        });

      });

  /*
  * Updated the Header Border top size in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_top]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('border-top-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border bottom size in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('border-bottom-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border left size in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('border-left-width', newval + 'px');

        });

      });

  /*
  * Updated the Header Border left size in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_border_right]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('border-right-width', newval + 'px');

        });

      });

  /*
  * Updated the Header top padding in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_content_padding]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper.grid .efbl_post_content, .efbl_feed_wraper .efbl-story-wrapper.grid .efbl_story_meta').
              css('padding', newval + 'px');

        });

      });

  /*
  * Updated the Header top padding in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_padding_top]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').css('padding-top', newval + 'px');

        });

      });

  /*
  * Updated the Header bottom padding in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_padding_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('padding-bottom', newval + 'px');

        });

      });

  /*
  * Updated the Header left padding in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_padding_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('padding-left', newval + 'px');

        });

      });

  /*
  * Updated the Header right padding in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_padding_right]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_header').
              css('padding-right', newval + 'px');

        });

      });

  /*
  * Updated the Header Alignment in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_align]', function(value) {

    value.bind(function(newval) {

      $('.efbl_feed_wraper .efbl_header .efbl_header_inner_wrap').
          css('float', newval);

    });

  });

  /*
  * Updated the Header shadow color of dp.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_dp_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper  .efbl_header a:hover .efbl_overlay{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Updated the Header shadow icon color of dp.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[header_dp_hover_icon_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper  .efbl_header .efbl_head_img_holder .efbl_overlay .icon{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_follow_btn]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_follow_btn').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper .efbl_follow_btn').fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_load_more_btn]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_load_more_btn ').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper .efbl_load_more_btn ').fadeOut('slow');
          }

        });
      });

  //======================================================================
  // Feeds Live Preview
  //======================================================================
  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_background_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper, .efbl_feed_wraper .efbl_feeds_carousel .efbl-story-wrapper .efbl-grid-wrapper').
              css({'background-color': newval});

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_borders_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper, .efbl_feed_wraper .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col a img, .efbl_feed_wraper .efbl-story-wrapper .efbl-thumbnail-wrapper .efbl-thumbnail-col, .efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer').
              css({'border-color': newval, 'outline-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shared_link_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shared_link_heading_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story .efbl_title_link a').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shared_link_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story .efbl_link_description').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shared_link_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story').
              css({'border-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_text_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper, .efbl_feed_wraper  .efbl-story-wrapper .efbl-feed-content > .efbl-d-flex .efbl-profile-title span, .efbl_feed_wraper  .efbl-story-wrapper .efbl-feed-content .description, .efbl_feed_wraper  .efbl-story-wrapper .efbl-feed-content .description a, .efbl_feed_wraper  .efbl-story-wrapper .efbl-feed-content .efbl_link_text, .efbl_feed_wraper  .efbl-story-wrapper .efbl-feed-content .efbl_link_text .efbl_title_link a').
              css({'color': newval});

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_spacing]', function(value) {

    value.bind(function(newval) {

      $('.efbl_feed_wraper .efbl-story-wrapper').
          css({'margin-bottom': newval + 'px'});

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_type_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper .efbl-overlay .efbl_multimedia, .efbl_feed_wraper .efbl-story-wrapper .efbl-overlay .icon-esf-video-camera').
              css({'color': newval});

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_meta_buttons_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb, .efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share').
              css({'color': newval});

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_meta_buttons_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb, .efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share').
              css({'background': newval});

        });
      });

  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[feed_meta_buttons_hover_bg_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb:hover, .efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share:hover{background:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_meta_buttons_hover_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .efbl-view-on-fb:hover, .efbl_feed_wraper .efbl-story-wrapper .efbl-post-footer .esf-share-wrapper .esf-share:hover{color:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_hover_shadow_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper .efbl-overlay').
              css({'background': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_header]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_author_info ').
            fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl-story-wrapper .efbl_author_info ').
            fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_shared_link]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story').
                fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_shared_story').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide header in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_header_logo]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_author_info .efbl_auth_logo').
                fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper  .efbl-story-wrapper .efbl_author_info .efbl_auth_logo').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_likes]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper  .efbl_likes, .efbl_feed_wraper  .efbl_all_likes_wrap').
            fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl_likes, .efbl_feed_wraper  .efbl_all_likes_wrap').
            fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_shares]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper  .efbl_shares').fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper .efbl_shares').fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_comments]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_comments').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
            $('.efbl_feed_wraper .efbl_comments_wraper').remove();
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[number_of_cols]',
      function(value) {
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

          $('.efbl_feed_wraper .efbl-grid-skin .efbl-row.e-outer').
              css({
                'grid-template-columns': 'repeat(auto-fill, minmax(' +
                    no_of_columns + '%, 1fr))',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_padding_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'padding-bottom': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_padding_top]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'padding-top': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_padding_right]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'padding-right': newval + 'px'});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_padding_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'padding-left': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_margin_top]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'margin-top': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_margin_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'margin-bottom': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_margin_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'margin-left': newval + 'px'});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_margin_right]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css({'margin-right': newval + 'px'});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_likes]', function(value) {
    value.bind(function(newval) {

      if (newval) {
        $('.efbl_feed_wraper  .efbl_lnc_holder  .efbl_likes').fadeIn('slow');
      }
      else {
        $('.efbl_feed_wraper  .efbl_lnc_holder  .efbl_likes').fadeOut('slow');
      }

    });
  });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_meta_data_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_likes, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_comments, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_shares, .efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_all_likes_wrap').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_meta_data_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-post-footer .efbl-reacted-item, .efbl_feed_wraper .efbl-post-footer .efbl-reacted-item .efbl_all_comments_wrap').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_likes_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_lnc_holder .efbl_likes').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_likes_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_lnc_holder .efbl_likes').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_comments]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper .efbl_story_meta .efbl_info .efbl_comments').
                fadeIn('slow');
            $('.efbl_feed_wraper .efbl_comments_wraper').
                css('display', 'block !important');
          }
          else {
            $('.efbl_feed_wraper .efbl_story_meta .efbl_info  .efbl_comments').
                fadeOut('slow');
            $('.efbl_feed_wraper .efbl_comments_wraper').
                css('display', 'none !important');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_comments_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
          $('.efbl_feed_wraper .efbl_lnc_holder .efbl_comments').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_comments_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
          $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
          $('.efbl_feed_wraper  .efbl_comments p, .efbl_feed_wraper .efbl_comments .icon').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[feed_comments_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
          $('.efbl_feed_wraper .efbl_lnc_holder .efbl_comments').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[feed_comments_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_comments').fadeOut('slow');
          $('.efbl_feed_wraper .efbl_lnc_holder .efbl_comments').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_feed_caption]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_story_text').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper  .efbl_story_text').fadeOut('slow');
          }

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_caption_background_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_text ').
              css({'background-color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[caption_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_text, .efbl_feed_wraper .efbl_story_text p, .efbl_feed_wraper .efbl_story_text a').
              css({'color': newval});

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[feed_caption_padding_top_bottom]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_text').
              css({
                'padding-top': newval + 'px',
                'padding-bottom': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[feed_caption_padding_right_left]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_text').
              css({
                'padding-left': newval + 'px',
                'padding-right': newval + 'px',
              });

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_feed_open_popup_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_hover .icon ').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper  .efbl_hover .icon  ').fadeOut('slow');
          }

        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-overlay').css({'color': newval});

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[show_feed_cta]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_wraper  .efbl_read_more_link ').fadeIn('slow');
          }
          else {
            $('.efbl_feed_wraper  .efbl_read_more_link ').fadeOut('slow');
          }

        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_cta_text_color]',
      function(value) {
        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_read_more_link a').css({'color': newval});
        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_cta_text_hover_color]',
      function(value) {
        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper .efbl-story-wrapper .efbl_read_more_link a:hover{color:' +
              newval + '!important}</style>').appendTo('head');
        });
      });

  /*
* Show or hide total number of followers in real time.
*/
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_time_text_color]',
      function(value) {
        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl_story_time').css({'color': newval});
        });
      });

  /*
  * Show or hide total number of followers in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_seprator_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper .efbl-story-wrapper').
              css({'border-color': newval});

        });
      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_border_style]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css('border-style', newval);

        });

      });

  /*
  * Updated the Header Border style in real time.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_border_size]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_wraper  .efbl-story-wrapper').
              css('border-width', newval + 'px');

        });

      });

  /*
  * Change hover shadow color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[feed_hover_bg_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.efbl_feed_wraper  .efbl_story_photo .efbl_hover{background:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  //======================================================================
  // PoUp Live Preview
  //======================================================================
  /*
  * Background color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_sidebar_bg]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper').
              css({'background': newval});

          $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-caption::after{background:' +
              newval + '}</style>').appendTo('head');
        });
      });

  /*
  * content color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_sidebar_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper, .efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-caption .efbl-feed-description, .efbl_feed_popup_container .efbl-post-detail a, .efbl_feed_popup_container .efbl-post-detail span').
              css({'color': newval});

        });
      });

  /*
  * Show header
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_header]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header{display:none!important}</style>').
                appendTo('head');

          }

        });
      });

  /*
  * Show header logo
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_header_logo]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header .efbl-profile-image').
                fadeIn('slow');
          }
          else {
            $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header .efbl-profile-image').
                fadeOut('slow');
          }

        });
      });

  /*
  * Header title color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_header_title_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header h2').
              css({'color': newval});

        });
      });

  /*
  * Header title color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_post_time_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-post-header span').
              css({'color': newval});

        });
      });

  /*
  * Show caption
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_caption]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_popup_container .efbl-feed-description, .efbl_feed_popup_container .efbl_link_text').
                fadeIn('slow');
          }
          else {
            $('.efbl_feed_popup_container .efbl-feed-description, .efbl_feed_popup_container .efbl_link_text').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show meta
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_meta]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  *  meta color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_meta_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions span').
              css({'color': newval});

        });
      });

  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_meta_border_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box').
              css({'border-color': newval});

        });
      });

  /*
  * Show reactions counter
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_reactions_counter]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl_popup_likes_main{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl_popup_likes_main{display:none!important}</style>').
                appendTo('head');

          }

        });
      });

  /*
  * Show comments counter
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_comments_counter]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl-popup-comments-icon-wrapper{display:flex!important}</style>').
                appendTo('head');
          }
          else {
            $('<style>.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-reactions-box .efbl-reactions .efbl-popup-comments-icon-wrapper{display:none!important}</style>').
                appendTo('head');
          }

        });
      });

  /*
  * Show comments
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_comments]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_popup_container .efbl-commnets, .efbl_feed_popup_container .efbl-comments-list').
                fadeIn('slow');
          }
          else {
            $('.efbl_feed_popup_container .efbl-commnets, .efbl_feed_popup_container .efbl-comments-list').
                fadeOut('slow');
          }

        });
      });

  /*
  * Show view on fb link
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_view_fb_link]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.efbl_feed_popup_container .efbl-action-btn').fadeIn('slow');
          }
          else {
            $('.efbl_feed_popup_container .efbl-action-btn').fadeOut('slow');
          }

        });
      });

  /*
  *  Comments bg
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_comments_color]',
      function(value) {

        value.bind(function(newval) {

          $('.efbl_feed_popup_container .efbl-post-detail .efbl-d-columns-wrapper .efbl-comments-list .efbl-comment-wrap').
              css({'color': newval});

        });
      });

  /*
  * Show close Icon
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_show_close_icon]',
      function(value) {
        value.bind(function(newval) {

          if (newval) {
            $('.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small').
                fadeIn('slow');
          }
          else {
            $('.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small').
                fadeOut('slow');
          }

        });
      });

  /*
  *  Close Icon bg color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_close_icon_bg_color]',
      function(value) {

        value.bind(function(newval) {

          $('.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small').
              css({'background-color': newval});

        });
      });

  /*
  *  Close Icon bg color
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_close_icon_color]',
      function(value) {

        value.bind(function(newval) {

          $('.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small').
              css({'color': newval});

        });
      });

  /*
  * Close hover bg.
  */
  wp.customize(
      'efbl_skin_' + efbl_skin_id + '[popup_close_icon_bg_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small:hover{background-color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

  /*
  * Close hover color.
  */
  wp.customize('efbl_skin_' + efbl_skin_id + '[popup_close_icon_hover_color]',
      function(value) {

        value.bind(function(newval) {
          $('<style>.fancybox-container .efbl_feed_popup_container.fancybox-content .fancybox-close-small:hover{color:' +
              newval + '!important}</style>').appendTo('head');

        });

      });

})(jQuery);