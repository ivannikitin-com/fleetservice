( function( $ ) {
	$( function() {
		$( 'select.wc-taxonomy-term-search' ).attr( 'data-minimum_input_length', '1' );
		$( 'select.wc-taxonomy-term-search' ).select2.defaults.set( { 'minimumInputLength', '1' } );
		/*$( 'select.wc-taxonomy-term-search' ).select2( {
			minimumInputLength: 1
		} );*/
	} );
} )( jQuery );