( function( $ ) {
	$(document).ready(function() {

		/*refresh all forms*/
		// $( 'input:checked' ).removeAttr( 'checked' );
		// $( 'input:file' ).val( '' );

		// trvlplnt theme slider ---------------
		if ( $( this ).find( '.trvlplnt-slider' ) ) {
			var isTimeToSlide = true; // freeze slider until the animation
			var sliderBox = 0;
			var sliderChild = $( '.trvlplnt-slider' ).children(); 
			// run the currently selected effect
			var callbackSlide = function( elem ) {
				sliderBox = elem;
			}

			// Set navigation
			$( '.trvlplnt-slider-to-right' ).click(function() {
				if ( isTimeToSlide ) {
					sliderMove( 'right' );
				}
				return false;
			} );
			$( '.trvlplnt-slider-to-left' ).click(function() {
				if ( isTimeToSlide ) {
					sliderMove( 'left' );
				}
				return false;
			} );

			// Set slider
			function sliderMove( leftRight ) {
				isTimeToSlide = false;  
				var slide;
				if ( leftRight == 'right') { 
					slide = sliderBox - 1; 
					if ( slide < 0 ) {
						slide = sliderChild.length - 1;
					}
				} else { 
					slide = sliderBox + 1; 
					if ( slide >= sliderChild.length ) {
						slide = 0;
					}
				}
				// Show sliderBox navigation
				sliderChild.eq( slide ).show();

				// Show sliderBox effects
				sliderChild.eq( sliderBox ).effect( 'drop', 
					{
						direction: leftRight == 'left' ? 'right' : 'left' 
					},
					800, 
					callbackSlide( slide )
				);

				setTimeout( function() {
					isTimeToSlide = true; 
				}, 900); 
			};

		} // trvlplnt theme slider


		// trvlplnt theme checkboxes  -----------------------------------------------------
		if ( $( this ).find( 'input[type="checkbox"]' ) ) {
			var fakeContainerCheck = $( '<div class="trvlplnt-fake-checkbox-container" />' ),
			fakeCheckbox = $( '<div class="trvlplnt-fake-checkbox" />' ),
			contCheckboxItem = $( '<div class="trvlplnt-checkbox-item-container" />' );
			$( this ).each(function( k, v ){
				$( v ).find( '.checkbox' ).removeClass( 'checkbox' ).addClass( 'trvlplnt-checkbox-custom' );
				$( v ).find( 'input[type="checkbox"]' ).wrap( fakeContainerCheck );
				$( v ).find( '.trvlplnt-fake-checkbox-container' ).wrap( contCheckboxItem );
				$( v ).find( '.trvlplnt-checkbox-item-container' ).each(function() { /* separate label for each checkbox */
					var cont = this;
					$( cont ).next().each(function() {
						if ( $( this ).attr( 'for' ) ==  $( cont ).find( 'input' ).attr( 'id' ) ) {
							$( cont ).append( $( this ) );
						}
					});
				});
				$( v ).find( '.trvlplnt-fake-checkbox-container' ).append( fakeCheckbox );
				/* if checkbox was selected */
				$( v ).find( 'input[type=checkbox]:checked' ).next().addClass( 'selected' );
				/* if checkbox is disabled */
				$( v ).find( 'input[type=checkbox]' ).each(function() {
					if ( $( this ).attr( 'disabled' ) ) {
						$( this ).next().addClass( 'disabled' );
					}
				});
				/* events handlers */
				$( v ).find( 'input[type="checkbox"]' ).on( 'click', function(){
					var fCh = $( this ).parent().find( '.trvlplnt-fake-checkbox' );
					if ( fCh.hasClass( 'selected' ) ) {
						fCh.removeClass( 'selected' );
						$( this ).attr( 'checked', false );
					} else {
						fCh.addClass( 'selected' );
						$( this ).attr( 'checked', true );
					}
				});
				$( v ).find( '.trvlplnt-fake-checkbox' ).on( 'click', function(){
					if ( ! $( this ).prev().attr( 'disabled' ) ) {
						$( this ).prev().trigger( 'click' );
					}
				});
			});
		} // trvlplnt theme checkboxes


		// trvlplnt theme radio  -----------------------------------------------------------
		if ( $( this ).find( 'input[type="radio"]' ) ) {
			var fakeRagio = $( '<div class="trvlplnt-fake-radio-container" />' ),
			fakeRadio = $( '<div class="trvlplnt-fake-radio" />' ),
			contRadioItem = $( '<div class="trvlplnt-radio-item-container" />' );
			$( this ).each(function( k, v ){
				$( v ).find( '.radio' ).removeClass( 'radio' ).addClass( 'trvlplnt-radio-custom' );
				$( v ).find( 'input[type="radio"]' ).wrap( fakeRagio );
			
				var label = $( v ).find( '.trvlplnt-fake-radio-container' ).next().detach(); /* remove all labels and save in variable */
				$( v ).find( '.trvlplnt-fake-radio-container' ).wrap( contRadioItem );
				$( v ).find( '.trvlplnt-radio-item-container' ).each( function() { /* separate label for each radio */
					var cont = this;
					$( label ).each(function() {
						if ( $( this ).attr( 'for' ) ==  $( cont ).find( 'input' ).attr( 'id' ) ) {
							$( cont ).append( $( this ) );
						}
					});
				});
				$( v ).find( '.trvlplnt-fake-radio-container' ).append( fakeRadio );
				/* if radio was selected */
				$( v ).find( 'input[type=radio]:checked' ).next().addClass( 'selected' );
				/* if radio is disabled */
				$( v ).find( 'input[type=radio]' ).each( function() {
					if ( $( this ).attr( 'disabled' ) ) {
						$( this ).next().addClass( 'disabled' );
					}
				});


				/* events handlers */
				$( v ).find( 'input[type="radio"]' ).on( 'click', function(){
					$( v ).find( 'input[name="' + $( this ).attr( 'name' ) + '"]' ).next().removeClass( 'selected' );
					$( v ).find( 'input[name="' + $( this ).attr( 'name' ) + '"]' ).attr( 'checked', false );
					$( this ).parent().find( '.trvlplnt-fake-radio' ).addClass( 'selected' );
					$( this ).attr( 'checked', true );

				});

				$( v ).find( '.trvlplnt-fake-radio' ).on( 'click', function(){
					if ( ! $( this ).prev().attr( 'disabled' ) ) {
						$( this ).prev().trigger( 'click' );				
					}
				});
			});
		} // trvlplnt theme radio

		// trvlplnt scroll to top -------------------------------------------------------
		$( 'a[href="#wrapper"]' ).on( 'click', function( e ) {
			e.preventDefault();
			//html - IE, FF, body - Chrome, Safari
			$( 'html, body' ).animate({
				scrollTop: $( '#wrapper' ).offset().top
			}, 600);
		});


		// trvlplnt theme select --------------------------------------------------------

		/*select section restyle*/
		var test = $( 'select' ).size();
		for ( var k = 0; k < test; k++ ) {
			$( 'select' ).eq( k ).css( 'display', 'none' );
			$( 'select' ).eq( k ).after( create_select( k ) );
		}
		/*functional of new select*/
		$( '.trvlplnt-select' ).click( function () {
			if ( $( this ).find( '.trvlplnt-options' ).css( 'display' ) == 'none' ) {
				$( this ).css( 'z-index', '100' );
				$( this ).find( '.trvlplnt-options' ).css( {
					'display': 'block'
				});
			} else {
				$( this ).css( 'z-index', '10' );
				$( this ).find( '.trvlplnt-options' ).css( {
					'display': 'none'
				});
			}
		});
		$( '.trvlplnt-select' ).find( '.trvlplnt-option' ).click( function () {
			$( this ).closest( '.trvlplnt-select' ).find( '.trvlplnt-option' ).removeClass( 'trvlplnt-option-selected' );
			$( this ).addClass( 'trvlplnt-option-selected' );
			/*write text to active opt*/
			$( this ).parent().parent().find( '.trvlplnt-active-opt' ).find( 'div:first' ).text( $( this ).text() );
			/*remove active option from init select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
			/*add atrr selected to select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
		});


		// // trvlplnt theme file loader --------------------------------------------------------
		if ( $( this ).find( 'input[type="file"]' ) ) {
			$( this ).find( 'input[type="file"]' ).each(function() {
				/* create fake trvlplnt-upload-file instument */
				var th = this;
				$( th ).hide();
				$( th ).after( '<div class="trvlplnt-fileload" name="' + $( th ).attr( 'name' ) + '">\
					<div class="trvlplnt-fileload-input" />\
					<div class="trvlplnt-fileload-status" /></div>' );
				var inp = $( th ).next().find( '.trvlplnt-fileload-input' );
				var st = $( th ).next().find( '.trvlplnt-fileload-status' );
				$( inp ).text( trvlplnt_localization.choose_file );
				$( st ).text( $( th ).val() == '' ? trvlplnt_localization.file_is_not_selected : $( th ).val() );

				$( th ).on( 'change', function() {
					var t = this;
					/* contain text of file path to fake trvlplnt-upload-file intrument */
					$( st ).text( $( this ).val() == '' ? trvlplnt_localization.file_is_not_selected : function(){
						var str = $( t ).val().split( '\\' ).pop();
						if ( str.length > 26 ) {
							return str.substring( 0, 15 ) + '...' + str.substring( str.length - 8, str.length );
						} else {
							return str;
						}
					});
				});
				$( inp.parent() ).on( 'mousedown', function() {
					$( th ).trigger( 'click' );
				});
			});
		};// trvlplnt theme file loader


		// trvlplnt theme reset button ---------------------------------------------------
		$( this ).find( 'input[type="reset"]' ).click( function() {
			var forms = $( this ).parents( 'form' ).first();
			forms.find( '.trvlplnt-select-block' ).find( '.trvlplnt-option.index-0' ).click();
			forms.find( '.trvlplnt-fake-radio, .trvlplnt-fake-checkbox' ).removeClass( 'selected' );
			$( forms )[0].reset();
			forms.find( 'input[type="file"]' ).change();
			e.preventDefault;
		});// trvlplnt theme reset button

	});
} )( jQuery );


// trvlplnt theme placeholder script -------------------------------------------------
function setClear( elem ) {
    if (elem.value == elem.defaultValue) {
        elem.value = '';
    } 
}

function setDefault( elem ) {
    if ( ! elem.value) {
        elem.value = elem.defaultValue;
    } 
}

/*function for custom select*/
function create_select( k ) {
	/*create select division*/
	var sel = document.createElement( 'div' );
	( function ( $ ) {
		$( sel ).addClass( 'trvlplnt-select' );
		/*create active-option division*/
		var active_opt = document.createElement( 'div' );
		$( active_opt ).addClass( 'trvlplnt-active-opt' );
		$( active_opt ).append( '<div></div>' );
		$( active_opt ).append( '<div class="trvlplnt-select-button"></div>' );
		$( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option' ).first().text() );
		/*create options division*/
		var option_array = document.createElement( 'div' );
		$( option_array ).addClass( 'trvlplnt-options' );
		/*create array of optgroups*/
		var count = $( 'select' ).eq( k ).find( 'optgroup' ).size();
		var optgroups = [];
		/*create options division*/
		if ( count ) {
			var z = 0;
			for ( var i = 0; i < count; i++ ) {
				optgroups[i] = document.createElement( 'div' );
				$( optgroups[i] ).addClass( 'trvlplnt-optgroup' );
				$( optgroups[i] )
					.text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).attr( 'label' ) );
			};
			for ( var i = 0; i < count; i++ ) {
				$( option_array ).append( optgroups[i] );
				for ( var j = 0; j < $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().size(); j++ ) {
					var opt = document.createElement( 'div' );
					$( opt ).addClass( 'trvlplnt-option' );
					$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).attr( 'value' ) );
					$( opt ).text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).text() );
					$( opt ).attr( 'name', z );
					z++;
					$( option_array ).append( opt );
				};
			};
		} else {
			for ( var i = 0; i < $( 'select' ).eq( k ).find( 'option' ).size(); i++ ) {
				var opt = document.createElement( 'div' );
				$( opt ).addClass( 'trvlplnt-option' );
				$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'option' ).eq( i ).attr( 'value' ) );
				$( opt ).attr( 'name', i );
				$( opt ).text( $( 'select' ).eq( k ).find( 'option' ).eq( i ).text() );
				$( option_array ).append( opt );
			};
		};
		$( sel ).append( active_opt );
		$( sel ).append( option_array );
	} )( jQuery );
	return sel;
}