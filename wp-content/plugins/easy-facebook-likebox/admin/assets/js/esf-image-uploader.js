jQuery(function($){
	// Set all variables to be used in scope
	var frame,
			addImgLink = $('.esf_image_upload'),
			imgIdInput = $('.esf_image_uploaded_url');
			imgtag     = $('.esf-uploaded-image');

	// ADD IMAGE LINK
	addImgLink.on( 'click', function( event ){

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}

		// Create a new media frame
		frame = wp.media({
			title: esf_image_uploader.title,
			button: {
				text: esf_image_uploader.btn_text
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});


		// When an image is selected in the media frame...
		frame.on( 'select', function() {

			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();

			// Send the attachment id to our input field
			imgIdInput.val( attachment.url ).trigger('change');

			imgtag.attr( 'src', attachment.url ).slideDown('slow');

		});

		// Finally, open the modal on click
		frame.open();
	});

});