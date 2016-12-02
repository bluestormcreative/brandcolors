(function( $ ) {
	'use strict';

	// Add Color Picker to all inputs that have 'color-field' class.
	$(function() {
		$('.color-field').wpColorPicker();
	});


	// Append another table row when Add Brand Color button clicked
	$('.bsc-add-button').on('click', function( event ){

		event.preventDefault();

		var count = $('#bsc-brand-colors-editor tbody').children('tr').length;

		if ( count > 0 ) {

			$('#bsc-brand-colors-editor').each( function() {
				var tds = '<tr>';
				$.each( $( 'tr:last td', this ), function() {

					var markup = $( this ).html();

					console.log(markup);

					tds += '<td>' + markup + '</td>';
				});

				tds += '</tr>';

				if ( $( 'tbody', this ).length > 0 ) {
					$( 'tbody', this ).append( tds );
				} else {
					$( this ).append( tds );
				}
			});
		} else {
			//$('#bsc-brand-colors-editor tbody').append( rowMarkup );
		}
	});

	// Delete table row when delete clicked.
	$('#bsc-brand-colors-editor').on( 'click', '.btnDelete', function( event ){

		event.preventDefault();

		$( this ).closest( 'tr' ).remove();

	});

})( jQuery );
