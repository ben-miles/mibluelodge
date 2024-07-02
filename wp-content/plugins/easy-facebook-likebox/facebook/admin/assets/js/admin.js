jQuery( document ).ready(
	function($) {
		/*
		* Getting the filter selected value from shortcode generator.
		*/
		jQuery( 'select#efbl_filter' ).on(
			'change',
			function() {
				if (this.value === 'events') {
					jQuery( '.efbl_filter_events_wrap_outer' ).slideDown( 'slow' );
				} else {
					jQuery( '.efbl_filter_events_wrap_outer' ).slideUp( 'slow' );
				}

				if (this.value === 'albums') {
					jQuery( '.efbl-albums-holder' ).slideDown( 'slow' );
				} else {
					jQuery( '.efbl-albums-holder' ).slideUp( 'slow' );
				}
			}
		);

		jQuery( 'input[type=radio][name=efbl_login_type]' ).change(
			function() {

				jQuery( '.efbl-authentication-modal .efbl-auth-modal-btn' ).attr( 'href', jQuery( this ).data( 'url' ) );

			}
		);

		/*
		* Get new albums list on page change
		*/
		jQuery( 'select#efbl_page_id' ).on(
			'change',
			function() {

				var data = {
					action: 'efbl_get_albums_list',
					page_id: this.value,
					nonce: efbl.nonce,
				};

				jQuery.ajax(
					{
						url: efbl.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								jQuery( "#efbl_albums_name" ).html( ' ' );
								jQuery( "#efbl_albums_name" ).html( response.data );
							} else {
								esfShowNotification( response.data, 4000 );
								jQuery( '#toast-container' ).addClass( 'esf-failed-notification' );
							}

						},
					}
				);

			}
		);

		/*
		* Display lists on moderate feed type change
		*/
		jQuery( 'select#efbl_moderate_feed_type' ).on(
			'change',
			function() {

				if ( this.value === 'group' ) {
					jQuery( '#efbl-moderate-wrap .efbl-moderate-page-id-wrap' ).slideUp( 'slow' );
					jQuery( '#efbl-moderate-wrap .efbl-group-id-wrap' ).slideDown( 'slow' );
				} else {
					jQuery( '#efbl-moderate-wrap .efbl-moderate-page-id-wrap' ).slideDown( 'slow' );
					jQuery( '#efbl-moderate-wrap .efbl-group-id-wrap' ).slideUp( 'slow' );
				}

			}
		);

		/*
		* Select from groups list
		*/
		jQuery( document ).on(
			'click',
			'#efbl-selected-groups-list li',
			function(event) {
				jQuery( this ).toggleClass( 'selected' );
			}
		);

		jQuery( 'select#efbl_free_filter_popup' ).on(
			'change',
			function() {
				if (this.value !== 'none') {
					jQuery( '.modal.open' ).removeClass( 'open' );
					jQuery( '#efbl-filter-upgrade' ).addClass( 'open' );
				}
			}
		);

		/**
		 * Show multifeed upgrade popup
		 *
		 * @since 6.2.0
		 */
		jQuery( "#efbl_page_id" ).change(
			function(){

				if ( this.value === 'multifeed-upgrade') {
					jQuery( '.modal.open' ).removeClass( 'open' );
					jQuery( '#efbl-addon-upgrade' ).addClass( 'open' );
				}
			}
		);

		jQuery( 'select#efbl_feed_type' ).on(
			'change',
			function() {
				jQuery( '.efbl_selected_type' ).val( this.value );
			}
		);

		/*
		* Getting the form submitted value from shortcode generator.
		*/
		jQuery( '.efbl_shortcode_submit' ).click(
			function(event) {

				/*
				* Prevnting to reload the page.
				*/
				event.preventDefault();

				var efbl_filter = null;

				/*
				* Getting mif_user_id
				*/
				var efbl_page_id = $( '.efbl-shortcode-fields-wrap #efbl_page_id' ).val();

				/*
				* Getting efbl_access_token
				*/
				var efbl_access_token = $( '.efbl-shortcode-fields-wrap #efbl_access_token' ).val();

				/*
				* Getting Feeds Per Page
				*/
				var efbl_filter = $( '.efbl-shortcode-fields-wrap #efbl_filter' ).val();

				/*
				* Getting Caption Words
				*/
				var efbl_skin_id = $( '.efbl-shortcode-fields-wrap #efbl_skin_id' ).val();

				if (efbl_skin_id == 'free-grid' || efbl_skin_id === 'free-masonry' ||
				efbl_skin_id === 'free-carousel') {
					jQuery( '#efbl-' + efbl_skin_id + '-upgrade' ).addClass( 'open' );

					efbl_skin_id = efbl.default_skin_id;
				}

				/*
				* Getting Wrap Class
				*/
				var efbl_post_limit = $( '.efbl-shortcode-fields-wrap #efbl_post_limit' ).val();

				/*
				* Getting cache unit
				*/
				var efbl_caption_words = $( '.efbl-shortcode-fields-wrap #efbl_caption_words' ).val();

				/*
				* Getting cache duration
				*/
				var efbl_cache_unit = $( '.efbl-shortcode-fields-wrap #efbl_cache_unit' ).val();

				/*
				* Getting events filter
				*/
				var efbl_filter_events = $( '.efbl-shortcode-fields-wrap #efbl_filter_events' ).val();

				/*
				* Getting Skin ID
				*/
				var efbl_cache_duration = $( '.efbl-shortcode-fields-wrap #efbl_cache_duration' ).val();

				if (efbl_skin_id) {
					efbl_skin_id = 'skin_id="' + efbl_skin_id + '" ';
				} else {
					efbl_skin_id = '';
				}

				if (efbl_access_token) {
					efbl_access_token = 'accesstoken="' + efbl_access_token + '" ';
				} else {
					efbl_access_token = '';
				}

				if (efbl_page_id) {
					efbl_page_id_attr = 'fanpage_id="' + efbl_page_id + '" ';
				} else {
					efbl_page_id_attr = '';
				}

				if (efbl_filter) {
					efbl_filter = 'filter="' + efbl_filter + '" ';
				} else {
					efbl_filter = '';
				}

				if ($( '.efbl-shortcode-fields-wrap #efbl_filter' ).val() === 'events') {

					efbl_filter_events = 'events_filter="' + efbl_filter_events + '" ';

				} else {
					efbl_filter_events = '';
				}

				var efbl_album_id = $( '.efbl-shortcode-fields-wrap #efbl_albums_name' ).val();

				if (efbl_album_id) {
					efbl_album_id = 'album_id="' + efbl_album_id + '" ';
				} else {
					efbl_album_id = '';
				}

				if ($( '.efbl-shortcode-fields-wrap #efbl_filter' ).val() !== 'albums') {

					efbl_album_id = '';

				}

				if (efbl_post_limit) {
					efbl_post_limit = 'post_limit="' + efbl_post_limit + '" ';
				} else {
					efbl_post_limit = '';
				}

				if (efbl_caption_words) {
					efbl_caption_words = 'words_limit="' + efbl_caption_words + '" ';
				} else {
					efbl_caption_words = '';
				}

				if (efbl_cache_unit) {
					efbl_cache_unit = 'cache_unit="' + efbl_cache_unit + '" ';
				} else {
					efbl_cache_unit = '';
				}

				if (efbl_cache_duration) {
					efbl_cache_duration = 'cache_duration="' + efbl_cache_duration + '" ';
				} else {
					efbl_cache_duration = '';
				}

				if (jQuery( '.efbl-shortcode-fields-wrap #efbl_link_new_tab' ).is( ':checked' )) {
					efbl_link_new_tab = 'links_new_tab="1" ';
				} else {
					efbl_link_new_tab = 'links_new_tab="0" ';
				}

				if (jQuery( '.efbl-shortcode-fields-wrap #efbl_load_more' ).is( ':checked' )) {
					efbl_load_more = 'load_more="1" ';
				} else {
					efbl_load_more = 'load_more="0" ';
				}

				if (jQuery( '.efbl-shortcode-fields-wrap #efbl_live_stream_only' ).is( ':checked' )) {
					efbl_live_stream_only = 'live_stream_only="1" ';
					efbl_filter           = '';
					efbl_album_id         = '';
					efbl_filter_events    = '';
					efbl_load_more        = 'load_more="0" ';
				} else {
					efbl_live_stream_only = 'live_stream_only="0" ';
				}

				if (jQuery( '.efbl-shortcode-fields-wrap #efbl_show_likebox' ).is( ':checked' )) {
					efbl_show_likebox = 'show_like_box="1"';
				} else {
					efbl_show_likebox = 'show_like_box="0"';
				}

				if ( efbl_page_id === 'multifeed-upgrade') {
					efbl_page_id      = jQuery( '.efbl-shortcode-fields-wrap #efbl_page_id' ).find( "option:first-child" ).val();
					efbl_page_id_attr = ' user_id="' + efbl_page_id + '"';
				}

				var shortcode_html = '[efb_feed ' + esf_strip_js_code(efbl_page_id_attr) + ' ' + esf_strip_js_code(efbl_access_token) +
					'' + esf_strip_js_code(efbl_filter) + '' + esf_strip_js_code(efbl_album_id) + '' + esf_strip_js_code(efbl_filter_events) + '' + esf_strip_js_code( efbl_caption_words ) +
					'' + esf_strip_js_code(efbl_post_limit) + '' + esf_strip_js_code(efbl_skin_id) + '' + esf_strip_js_code(efbl_cache_unit) + '' +
					esf_strip_js_code(efbl_cache_duration) + ' ' + esf_strip_js_code(efbl_live_stream_only) + ' ' + esf_strip_js_code(efbl_load_more) + ' ' + esf_strip_js_code(efbl_link_new_tab) + '' + esf_strip_js_code(efbl_show_likebox) +
				']';

				esfShowNotification(efbl.generating, 400000);

				const data = {
					action: 'efbl_preload_feed',
					shortcode: shortcode_html,
					nonce: efbl.nonce,
				};

				jQuery.ajax(
						{
							url: efbl.ajax_url,
							type: 'post',
							data: data,
							dataType: 'json',
							success: function() {
								esfRemoveNotification();
								jQuery( '.efbl_generated_shortcode blockquote' ).html( ' ' );

								jQuery( '.efbl_generated_shortcode blockquote' ).append( shortcode_html );

								jQuery( '.efbl_generated_shortcode .efbl_shortcode_generated_final' ).
										attr( 'data-clipboard-text', shortcode_html );

								jQuery( '.efbl_generated_shortcode' ).slideDown();
							}
						}
				);

			}
		);

		function efbl_get_moderate_feed(){
			var page_id   = $( '#efbl_moderate_page_id' ).val();
			esfShowNotification( efbl.moderate_wait, 400000 );

			var data = {
				action: 'efbl_get_moderate_feed',
				feed_type: feed_type,
				nonce: efbl.nonce,
			};

			jQuery.ajax(
				{
					url: efbl.ajax_url,
					type: 'post',
					data: data,
					dataType: 'json',
					success: function(response) {
						esfRemoveNotification();
						if (response.success) {
							jQuery( '#efbl-moderate-wrap .efbl-moderate-visual-wrap' ).html( ' ' ).append( response.data ).slideDown( 'slow' );
						} else {
							esfShowNotification( response.data, 4000 );
						}

					},

				}
			);
		}

		jQuery( document ).on(
			'click',
			'.efbl-get-moderate-feed',
			function(event) {
				event.preventDefault();
				efbl_get_moderate_feed();
			}
		);

		jQuery( document ).on(
			'click',
			'.efbl-connect-manually',
			function(event) {
				jQuery( ".efbl-connect-manually-wrap" ).slideToggle( 'slow' );
			}
		);

		

		jQuery( document ).on(
			'click',
			'.efbl_skin_redirect',
			function(event) {

				/*
				* Disabaling the deafult event.
				*/
				event.preventDefault();

				var skin_id     = $( this ).data( 'skin_id' );
				var select_id   = '.efbl_selected_account_' + skin_id;
				var selectedVal = $( select_id + ' option' ).filter( ':selected' ).val();
				var page_id     = $( this ).data( 'page_id' );

				/*
				* Collecting data for ajax call.
				*/
				var data = {
					action: 'efbl_create_skin_url',
					selectedVal: selectedVal,
					skin_id: skin_id,
					page_id: page_id,
					nonce: efbl.nonce,
				};
				/*
				* Making ajax request to save values.
				*/
				jQuery.ajax(
					{
						url: efbl.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						success: function(response) {

							if (response.success) {
								esfShowNotification( response.data['0'], 4000 );
								window.location.href = response.data['1'];
							} else {
								esfShowNotification( response.data, 4000 );
								jQuery( '#toast-container' ).addClass( 'esf-failed-notification' );
							}

						},

					}
				);/* Ajax func ends here. */

			}
		);

		/*
		* Getting the form submitted value from shortcode generator.
		*/
		jQuery( '.efbl_likebox_shortcode_submit' ).click(
			function(event) {

				/*
				* Prevnting to reload the page.
				*/
				event.preventDefault();

				var tabs = null;

				/*
				* Getting mif_user_id
				*/
				var efbl_like_box_url = $( '#efbl_like_box_url' ).val();

				/*
				* Getting Feeds Per Page
				*/
				var efbl_like_box_app_id = $( '#efbl_like_box_app_id' ).val();

				/*
				* Getting Caption Words
				*/
				var efbl_like_box_width = $( '#efbl_like_box_width' ).val();

				/*
				* Getting Wrap Class
				*/
				var efbl_like_box_height = $( '#efbl_like_box_height' ).val();

				/*
				* Getting cache unit
				*/
				var efbl_like_box_locale = $( '#efbl_like_box_locale' ).val();

				if (efbl_like_box_url) {
					efbl_like_box_url = 'fanpage_url="' + efbl_like_box_url + '" ';
				} else {
					efbl_like_box_url = '';
				}

				if (efbl_like_box_app_id) {
					efbl_like_box_app_id = 'fb_appid="' + efbl_like_box_app_id + '" ';
				} else {
					efbl_like_box_app_id = '';
				}

				if (efbl_like_box_width) {
					efbl_like_box_width = 'box_width="' + efbl_like_box_width + '" ';
				} else {
					efbl_like_box_width = '';
				}

				if (efbl_like_box_height) {
					efbl_like_box_height = 'box_height="' + efbl_like_box_height + '" ';
				} else {
					efbl_like_box_height = '';
				}

				if (efbl_like_box_locale) {
					efbl_like_box_locale = 'locale="' + efbl_like_box_locale + '" ';
				} else {
					efbl_like_box_locale = '';
				}

				if (jQuery( '#efbl_tabs_timeline' ).is( ':checked' )) {
					efbl_tabs_timeline = 'timeline,';
				} else {
					efbl_tabs_timeline = '';
				}

				if (jQuery( '#efbl_tabs_events' ).is( ':checked' )) {
					efbl_tabs_events = 'events,';
				} else {
					efbl_tabs_events = '';
				}
				if (jQuery( '#efbl_tabs_messages' ).is( ':checked' )) {
					efbl_tabs_messages = 'messages';
				} else {
					efbl_tabs_messages = '';
				}

				if ((efbl_tabs_timeline != '') || (efbl_tabs_events != '') ||
				(efbl_tabs_messages != '')) {
					tabs = 'tabs="' + efbl_tabs_timeline + efbl_tabs_events +
					  efbl_tabs_messages + '" ';
				} else {
					tabs = '';
				}

				// console.log(tabs); return;

				if (jQuery( '#efbl_like_box_responsive' ).is( ':checked' )) {
					efbl_like_box_responsive = 'responsive="1" ';
				} else {
					efbl_like_box_responsive = 'responsive="0" ';
				}

				if (jQuery( '#efbl_like_box_faces' ).is( ':checked' )) {
					efbl_like_box_faces = 'show_faces="1" ';
				} else {
					efbl_like_box_faces = 'show_faces="0" ';
				}

				if (jQuery( '#efbl_like_box_stream' ).is( ':checked' )) {
					efbl_like_box_stream = 'show_stream="1" ';
				} else {
					efbl_like_box_stream = 'show_stream="0" ';
				}

				if (jQuery( '#efbl_like_box_cover' ).is( ':checked' )) {
					efbl_like_box_cover = 'hide_cover="1" ';
				} else {
					efbl_like_box_cover = 'hide_cover="0" ';
				}

				if (jQuery( '#efbl_like_box_small_header' ).is( ':checked' )) {
					efbl_like_box_small_header = 'small_header="1" ';
				} else {
					efbl_like_box_small_header = 'small_header="0" ';
				}

				if (jQuery( '#efbl_like_box_hide_cta' ).is( ':checked' )) {
					efbl_like_box_hide_cta = 'hide_cta="1"';
				} else {
					efbl_like_box_hide_cta = 'hide_cta="0"';
				}

				var shortcode_html = '[efb_likebox ' + efbl_like_box_url + '' + tabs + '' +
				efbl_like_box_app_id + '' + efbl_like_box_width + '' +
				efbl_like_box_height + '' + efbl_like_box_locale + '' +
				efbl_like_box_responsive + '' + efbl_like_box_faces + '' +
				efbl_like_box_stream + '' + efbl_like_box_cover + '' +
				efbl_like_box_small_header + '' + efbl_like_box_hide_cta + ']';

				jQuery( '.efbl_likebox_generated_shortcode blockquote' ).html( ' ' );

				jQuery( '.efbl_likebox_generated_shortcode blockquote' ).
				append( shortcode_html );

				jQuery(
					'.efbl_likebox_generated_shortcode .efbl_likebox_shortcode_generated_final'
				).
				attr( 'data-clipboard-text', shortcode_html );

				jQuery( '.efbl_likebox_generated_shortcode' ).slideDown();

			}
		);/* Generated shortcode likeox func ends here. */

		/*
		* Hiding the create new button to make look and feel awesome.
		*/
		var mif_copy_shortcode = new ClipboardJS( '.efbl_copy_shortcode' );

		mif_copy_shortcode.on(
			'success',
			function(element) {

				const classes = element.trigger.classList;

				// check if "efbl_copy_default_shortcode" class is present
				if ( classes.contains( 'efbl_copy_default_shortcode' ) ) {

					// get shortcode from data attribute
					const shortcode_html = element.text;

					const data = {
						action: 'efbl_preload_feed',
						shortcode: shortcode_html,
						nonce: efbl.nonce,
					};

					jQuery.ajax(
						{
							url: efbl.ajax_url,
							type: 'post',
							data: data,
							dataType: 'json',
							success: function() {
								esfShowNotification( efbl.copied, 4000 );
							}
						}
					);
				} else {
					esfShowNotification( efbl.copied, 4000 );
				}
			}
		);

		mif_copy_shortcode.on(
			'error',
			function(e) {
				esfShowNotification( efbl.error, 1000 );
			}
		);

		/*
		* Hiding the create new button to make look and feel awesome.
		*/
		var mif_copy_shortcode = new ClipboardJS( '.efbl_likebox_copy_shortcode' );

		mif_copy_shortcode.on(
			'success',
			function(e) {
				esfShowNotification( efbl.copied, 4000 );
			}
		);

		mif_copy_shortcode.on(
			'error',
			function(e) {
				esfShowNotification( efbl.error, 1000 );
			}
		);

		jQuery( '.efbl_auto_popup_redirect' ).click(
			function($) {
				jQuery( '.efbl_tab_c_holder .efbl_tab_c' ).removeClass( 'active' );
				jQuery( '.efbl_tab_c_holder .efbl_tab_c' ).css( 'display', 'none' );
				jQuery( '.efbl_tab_c_holder #efbl-auto-popup' ).addClass( 'active' );
				jQuery( '.efbl_tab_c_holder #efbl-auto-popup' ).css( 'display', 'block' );

			}
		);

		var efbl_shortcode = jQuery( '#efbl_popup_shortcode' ).val();

		if (efbl_shortcode) {

			efbl_shortcode = efbl_shortcode.replace( /\\/g, '' );

			var efbl_shortcode = jQuery( '#efbl_popup_shortcode' ).val( efbl_shortcode );
		}

		jQuery( 'select#efbl_selected_layout' ).on(
			'change',
			function() {

				jQuery( '.modal.open' ).removeClass( 'open' );

				var selected_val = this.value;

				if (selected_val === 'free-grid' || selected_val === 'free-masonry' ||
				selected_val === 'free-carousel') {
					jQuery( '#efbl-' + selected_val + '-upgrade' ).addClass( 'open' );
				}

			}
		);

		/*
		* Copying Skin ID.
		*/

		/*
		* Hiding the create new button to make look and feel awesome.
		*/
		var skin_id = new ClipboardJS( '.efbl_copy_skin_id' );

		skin_id.on(
			'success',
			function(e) {
				esfShowNotification( efbl.copied, 1000 );
			}
		);

		skin_id.on(
			'error',
			function(e) {
				esfShowNotification( efbl.error, 4000 );
			}
		);

		

		function EFBLremoveURLParameter(url, parameter) {
			//prefer to use l.search if you have a location/link object
			var urlparts = url.split( '?' );
			if (urlparts.length >= 2) {

				var prefix = encodeURIComponent( parameter ) + '=';
				var pars   = urlparts[1].split( /[&;]/g );

				//reverse iteration as may be destructive
				for (var i = pars.length; i-- > 0;) {
					  //idiom for string.startsWith
					if (pars[i].lastIndexOf( prefix, 0 ) !== -1) {
						pars.splice( i, 1 );
					}
				}

				url = urlparts[0] + '?' + pars.join( '&' );
				return url;
			} else {
				return url;
			}
		}

	}
);

(function($) {
	$(
		function() {

			if ($( '#efbl_enable_if_login' ).is( ':checked' )) {
				$( '#efbl_enable_if_not_login' ).removeAttr( 'checked' );
				$( '#efbl_enable_if_not_login' ).attr( 'disabled', true );
			} else if ($( '#efbl_enable_if_login' ).is( ':checked' )) {
				$( '#efbl_enable_if_login' ).removeAttr( 'checked' );
				$( '#efbl_enable_if_login' ).attr( 'disabled', true );
			}

			$( '#efbl_enable_if_login' ).click(
				function() {

					if ($( this ).is( ':checked' )) {
						$( '#efbl_enable_if_not_login' ).removeAttr( 'checked' );
						$( '#efbl_enable_if_not_login' ).attr( 'disabled', true );

					} else {
						$( '#efbl_enable_if_not_login' ).removeAttr( 'disabled' );

					}

				}
			);

			$( '#efbl_enable_if_not_login' ).click(
				function() {

					if ($( this ).is( ':checked' )) {
						$( '#efbl_enable_if_login' ).removeAttr( 'checked' );
						$( '#efbl_enable_if_login' ).attr( 'disabled', true );

					} else {
						$( '#efbl_enable_if_login' ).removeAttr( 'disabled' );

					}

				}
			);

			$( '.efbl_open_collapisble' ).click(
				function() {
					var id = $( this ).data( 'id' );
					id     = '#' + id;

					var main_class   = '.efbl_shortcode_accord li' + id;
					var header_class = '.efbl_shortcode_accord li' + id +
					' .collapsible-header';
					var body_class   = '.efbl_shortcode_accord li' + id + ' .collapsible-body';

					jQuery( '.efbl_shortcode_accord li' ).removeClass( 'active' );
					jQuery( '.efbl_shortcode_accord li .collapsible-header' ).
					removeClass( 'active' );
					jQuery( '.efbl_shortcode_accord li .collapsible-body' ).slideUp( 'slow' );

					jQuery( main_class ).addClass( 'active' );
					jQuery( header_class ).addClass( 'active' );
					jQuery( body_class ).slideDown( 'slow' );

					$( [document.documentElement, document.body] ).animate(
						{
							scrollTop: $( id ).offset().top,
						},
						1000
					);
				}
			);

			$( '.efbl_open_likebox_collapisble' ).click(
				function() {
					var id = $( this ).data( 'id' );
					id     = '#' + id;

					var main_class   = '.efbl_likebox_shortcode_accord li' + id;
					var header_class = '.efbl_likebox_shortcode_accord li' + id +
					' .collapsible-header';
					var body_class   = '.efbl_likebox_shortcode_accord li' + id +
					' .collapsible-body';

					jQuery( '.efbl_likebox_shortcode_accord li' ).removeClass( 'active' );
					jQuery( '.efbl_likebox_shortcode_accord li .collapsible-header' ).
					removeClass( 'active' );
					jQuery( '.efbl_likebox_shortcode_accord li .collapsible-body' ).
					slideUp( 'slow' );

					jQuery( main_class ).addClass( 'active' );
					jQuery( header_class ).addClass( 'active' );
					jQuery( body_class ).slideDown( 'slow' );

					$( [document.documentElement, document.body] ).animate(
						{
							scrollTop: $( id ).offset().top,
						},
						1000
					);
				}
			);

			$( '.efbl_del_trans' ).click(
				function() {

					esfShowNotification( efbl.deleting, 50000000 );
					/*
					* Getting clicked option value.
					*/
					var efbl_option      = jQuery( this ).data( 'efbl_trans' );
					var collection_class = jQuery( this ).data( 'efbl_collection' );

					var data = {
						action: 'efbl_del_trans',
						efbl_option: efbl_option,
						nonce: efbl.nonce,
					};

					jQuery.ajax(
						{
							url: efbl.ajax_url,
							type: 'POST',
							dataType: 'json',
							data: data,
							success: function(response) {

								setTimeout(
									function() {
										esfShowNotification( response.data['0'], 300 );
										if (response.success) {

											jQuery( '#efbl-cached .collection-item.' + response.data['1'] ).
											slideUp( 'slow' );

											var slug = '#efbl-cached .' + collection_class +
											' .collection-item';

											if (jQuery( slug ).length == 0) {
												//console.log(slug);
												jQuery( '#efbl-cached .' + collection_class ).slideUp( 'slow' );
											}

											jQuery( '#toast-container' ).addClass( 'efbl_green' );
										} else {
											jQuery( '#toast-container' ).addClass( 'esf-failed-notification' );
										}

									},
									500
								);

							}

						}
					);/* Ajax func ends here. */

				}
			);

			$( '.clear-all-cache' ).click(
				function() {

					esfShowNotification( efbl.deleting, 50000000 );

					var data = {
						action: 'efbl_clear_all_cache',
						nonce: efbl.nonce,
					};

					jQuery.ajax(
						{
							url: efbl.ajax_url,
							type: 'POST',
							dataType: 'json',
							data: data,
							success: function(response) {
								esfShowNotification( response.data, 300 );
								if (response.success) {
									jQuery( '#efbl-cached .collection' ).slideUp( 'slow' );
									jQuery( '#efbl-cached .clear-all-cache' ).slideUp( 'slow' );
								} else {
									jQuery( '#toast-container' ).addClass( 'esf-failed-notification' );
								}
							}
						}
					);

				}
			);

		}
	);

}(jQuery));
