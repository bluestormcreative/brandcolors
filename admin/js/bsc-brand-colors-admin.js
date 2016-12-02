(function( $ ) {
	'use strict';

	// Add Color Picker to all inputs that have 'color-field' class.
	$(function() {
		$('.color-field').wpColorPicker();
	});

	// Append another table row when Add Brand Color button clicked
	$('.bsc-add-button').on('click', function(){
		$('#bsc-brand-colors-editor').each( function() {
			var tds = '<tr>';
			$.each( $( 'tr:last td', this ), function() {
				tds += '<td>' + $( this ).html() + '</td>';
			});
			
			tds += '</tr>';

			if ( $('tbody', this ).length > 0 ) {
				$('tbody', this ).append( tds );
			} else {
				$(this).append( tds );
			}
		});
	});

})( jQuery );
