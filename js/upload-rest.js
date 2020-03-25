jQuery( document ).ready( function() {
	jQuery( '#exb_submit_btn_id' ).click( function( event ) {

		event.preventDefault();

		// var title = jQuery( '#uploader-title' ).val();
		// if ( ! title.length ) {
		// 	alert( 'Please enter a title!' );
		// }
		// var caption = jQuery( '#uploader-caption' ).val();
		// if ( ! caption.length ) {
		// 	alert( 'Please enter a caption!' );
		// }
		// Check, if a file is selected.
		if ( 'undefined' === typeof( jQuery( '#exb_file_upload_id' )[0].files[0] ) ) {
			alert( 'Select a file!' );
			return;
		}
		// Grab the file from the input.
		var file = jQuery( '#exb_file_upload_id' )[0].files[0];
		var formData = new FormData();
		formData.append( 'file', file );
		// formData.append( 'title', title );
		// formData.append( 'caption', caption );

		// Fire the request.
		jQuery.ajax( {
            url: RestVars.endpoint,
            method: 'POST',
			processData: false,
			contentType: false,
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', RestVars.nonce );
			},
			data: formData
		} ).success( function ( response ) {
			console.log( response.id )
            console.log( response )
            console.log( RestVars.endpoint )
            var responseUrl = response.guid.rendered;
        } ).error( function( response ) {
			console.log( 'error' );
			console.log( response );
		});
	} );
});