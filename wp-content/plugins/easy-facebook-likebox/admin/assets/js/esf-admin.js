/**
 * Show notification at the screen bottom
 * @since 6.2.8
 * @param text
 * @param delay
 */
function esfShowNotification(text, delay = 4000){

	if ( ! text) {

		text = fta.copied;
	}

	jQuery( ".esf-notification-holder" ).html( ' ' ).html( text ).css( 'opacity', 1 ).animate( {bottom: '0'} );

	setTimeout( function(){ jQuery( ".esf-notification-holder" ).animate( {bottom: '-=100%'} ) }, delay );
}
/**
 * Remove any notification at the screen bottom
 * @since 6.2.8
 */
function esfRemoveNotification(){

	jQuery( ".esf-notification-holder" ).animate( {bottom: '-=100%'} );
}

jQuery( document ).on(
	'click',
	'.collapsible-header',
	function() {
		jQuery( this ).toggleClass( 'active' );
		jQuery( this ).next( '.collapsible-body' ).slideToggle( 'fast' );
	}
);

/*
* Show/Hide modal
*/
function esfModal(id){

	const opened_modal = document.getElementsByClassName( "esf-modal open" );

	if ( opened_modal.length ) {
		opened_modal.style.display = "none";
	}

	const modal         = document.getElementById( id );
	modal.style.display = "block";
	modal.classList.add( "open" );

}

window.onclick = function(event) {
	let opened_modal_id = document.getElementsByClassName( "esf-modal open" );

	if ( opened_modal_id.length ) {
		opened_modal_id = document.getElementsByClassName( "esf-modal open" )[0].id;
	}
	const modal = document.getElementById( opened_modal_id );

	if (event.target === modal) {
		modal.style.display = "none";
		modal.classList.remove( "open" );
		var additionalData = {
			modal: modal,
			modalID: opened_modal_id
		};
		// Dispatch a custom event when the modal is closed
		var closeModalEvent = new CustomEvent('eiModalClosed', {
			detail: additionalData
		});
		document.dispatchEvent(closeModalEvent);
	}
}

/**
 * Strip the script tags from the code
 * @since 6.5.8
 * @param {*} code 
 * @returns 
 */
function esf_strip_js_code( code ) {
	return code.replace( /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '' );
}

jQuery( document ).ready(
	function($) {

		setInterval(
			function () {
				moveRight();
			},
			6000
		);

		var slideCount    = $( '#esf-carousel-wrap ul li' ).length;
		var slideWidth    = $( '#esf-carousel-wrap ul li' ).width();
		var slideHeight   = $( '#esf-carousel-wrap ul li' ).height();
		var sliderUlWidth = slideCount * slideWidth;

		$( '#esf-carousel-wrap' ).css( { width: slideWidth, height: slideHeight } );

		$( '#esf-carousel-wrap ul' ).css( { width: sliderUlWidth, marginLeft: - slideWidth } );

		$( '#esf-carousel-wrap ul li:last-child' ).prependTo( '#esf-carousel-wrap ul' );

		function moveRight() {
			$( '#esf-carousel-wrap ul' ).animate(
				{
					left: - slideWidth
				},
				600,
				function () {
					$( '#esf-carousel-wrap ul li:first-child' ).appendTo( '#esf-carousel-wrap ul' );
					$( '#esf-carousel-wrap ul' ).css( 'left', '' );
				}
			);
		}

		// Close modal
		jQuery( document ).on(
			'click',
			'.modal-close',
			function() {
				const modal = jQuery( this ).closest( '.esf-modal' );
				const modalID = modal.attr( 'id' );

				jQuery( this ).closest( '.esf-modal' ).removeClass( 'open' ).css( 'display', 'none' );

				var additionalData = {
					modal: modal,
					modalID: modalID
				};
				// Dispatch a custom event when the modal is closed
				var closeModalEvent = new CustomEvent('eiModalClosed', {
					detail: additionalData
				});
				document.dispatchEvent(closeModalEvent);
			}
		);

		jQuery( '.fta_wrap_outer' ).on(
			'click',
			'.esf-modal-trigger',
			function(e) {
				e.preventDefault();
				let id = jQuery( this ).attr( 'href' ).replace( '#', '' );

				if ( ! id) {
					id = jQuery( this ).attr( 'id' );
				}

				esfModal( id );
			}
		);

		jQuery( '.espf_HideblackFridayMsg' ).click(
			function() {
				var data = {'action': 'espf_black_friday_dismiss'};
				jQuery.ajax(
					{

						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						async: ! 0,
						success: function(e) {

							if (e === 'success') {
								jQuery( '.espf_black_friday_msg' ).slideUp( 'fast' );

							}
						},
					}
				);
			}
		);

		/*
		* Activate/deactivate the module.
		*/
		jQuery( '.fta_tab_c_holder .fta_all_plugs .card .fta_plug_activate' ).
		click(
			function(event) {

				event.preventDefault();

				var plugin = jQuery( this ).data( 'plug' );

				var status = jQuery( this ).data( 'status' );

				var toast_msg;

				if (status === 'activated') {
						toast_msg = 'Deactivating';
						status    = 'deactivated';
				} else {
						toast_msg = 'Activating';
						status    = 'activated';
				}
				esfShowNotification( toast_msg, 40000 );

				var data = {
					action: 'esf_change_module_status',
					plugin: plugin,
					status: status,
					nonce: fta.nonce,
				};

				jQuery.ajax(
					{
						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								window.location.href = window.location.href;
							} else {
								esfShowNotification( response.data, 4000 );
							}
						},
					}
				);
			}
		);/* mif_auth_sub func ends here. */

		jQuery( '.esf_HideRating' ).click(
			function() {

				var data = {'action': 'esf_hide_rating_notice'};

				jQuery.ajax(
					{

						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						async: ! 0,
						success: function(e) {

							if (e === 'success') {
								jQuery( '.fta_msg' ).slideUp( 'fast' );

							}
						},
					}
				);
			}
		);

		jQuery( '.esf-hide-free-sidebar' ).click(
			function() {

				const id   = jQuery( this ).data( 'id' );
				const data = {'action': 'esf_hide_free_sidebar', 'id' : id };
				jQuery.ajax(
					{
						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						nonce: fta.nonce,
						async: ! 0,
						success: function(response) {

							if (response.success) {
								jQuery( '.esf-hide-' + id ).slideUp( 'fast' );
							} else {
								esfShowNotification( response.data, 4000 );
							}
						},
					}
				);
			}
		);

		jQuery( '.esf_hide_updated_notice' ).click(
			function() {

				var data = {'action': 'esf_hide_updated_notice'};

				jQuery.ajax(
					{

						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						async: ! 0,
						success: function(e) {

							if (e === 'success') {
								jQuery( '.fta_upgraded_msg' ).slideUp( 'fast' );

							}
						},
					}
				);
			}
		);

		/*
		* Delete account or page the plugin.
		*/
		jQuery( document ).on(
			'click',
			'.efbl_delete_at_confirmed',
			function() {

				esfShowNotification( fta.deleting, 40000 );

				var data = {
					action: 'esf_remove_access_token',
					nonce: fta.nonce,
				};

				jQuery.ajax(
					{
						url: fta.ajax_url,
						type: 'post',
						data: data,
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								esfShowNotification( response.data, 4000 );
								jQuery( '.efbl_all_pages' ).slideUp( 'slow' ).remove();
								jQuery( '.fta_noti_holder' ).fadeIn( 'slow' );
							} else {
								esfShowNotification( response.data, 4000 );
							}
						},
					}
				);
			}
		);

		/*
		* Copying Page ID.
		*/

		/*
		* Hiding the create new button to make look and feel awesome.
		*/
		var page_id = new ClipboardJS( '.efbl_copy_id' );

		page_id.on(
			'success',
			function() {
				esfShowNotification( fta.copied, 4000 );
			}
		);
		page_id.on(
			'error',
			function() {
				esfShowNotification( fta.error, 4000 );
			}
		);

		function getUrlVars() {
			var vars   = [], hash;
			var hashes = window.location.href.slice(
				window.location.href.indexOf( '?' ) + 1
			).split( '&' );
			for (var i = 0; i < hashes.length; i++) {
				hash = hashes[i].split( '=' );
				vars.push( hash[0] );
				vars[hash[0]] = hash[1];
			}
			return vars;
		}

		var url_vars = getUrlVars();

		/*
		* Activate sub tab according to the URL
		*/
		if (url_vars['sub_tab']) {

			var sub_tab = url_vars['sub_tab'];

			var items = sub_tab.split( '#' );

			sub_tab = items['0'];

			jQuery( '.efbl-tabs-vertical .efbl_si_tabs_name_holder li a' ).
			removeClass( 'active' );

			jQuery(
				'.efbl-tabs-vertical .efbl_si_tabs_name_holder li a[href^="#' +
				sub_tab + '"]'
			).addClass( 'active' );

			jQuery( '.efbl-tabs-vertical .tab-content' ).removeClass( 'active' ).hide();

			jQuery( '.efbl-tabs-vertical #' + sub_tab ).addClass( 'active' ).fadeIn( 'slow' );

		}

	}
);
