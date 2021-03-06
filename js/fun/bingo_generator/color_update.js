$(function() {
	
	// Set the Example TD to any color values carried over from previous card generations.
	var preloaded_bg_hex = $('#background_color').val();
	if (preloaded_bg_hex != "transparent") {
		$('#exmaple_color_td').css('backgroundColor', preloaded_bg_hex);
	}

	var preloaded_text_hex = $('#text_color').val();
	$('#exmaple_color_td').css('color', preloaded_text_hex);
	
	var preloaded_border_hex = $('#border_color').val();
	$('#exmaple_color_td').css('border', '1px solid ' + preloaded_border_hex);
	
	// Allow users to preview hex values
	$('.colorpicker_input').change(function(){
		// Note to future me: move all of this into a function; it's the same stuff we're doing above
		// Check to see if the colors are valid hex color codes here, probably
		var new_background_hex = $('#background_color').val();
		if (new_background_hex != "transparent") {
			$('#exmaple_color_td').css('backgroundColor', new_background_hex);
		} else {
			
		}

		var new_text_hex = $('#text_color').val();
		$('#exmaple_color_td').css('color', new_text_hex);
		
		var new_border_hex = $('#border_color').val();
		$('#exmaple_color_td').css('border', '1px solid ' + new_border_hex);
	});
	
	/*
	// // COLOR PICKER STUFF - LIBRARY REMOVED FOR SOME REASON? TAKING MONTHS-LONG BREAKS ON PROJECT DEVELOPMENT IS INCONVENIENT.
	// Change the background input value and Example TD background to reflect ColorPicker selections.
	$('#background_color').attr('readonly', true).ColorPicker({
		color: '#ffffff',
		onChange: function (hsb, hex, rgb) {
			$('#background_color').val('#' + hex);
			$('#exmaple_color_td').css('backgroundColor', '#' + hex);
			$('#transparent_background').attr('checked', false);
		}
	});
	
	// Change the text input value and Example TD text color to reflect ColorPicker selections.
	$('#text_color').attr('readonly', true).ColorPicker({
		color: '#000000',
		onChange: function (hsb, hex, rgb) {
			$('#text_color').val('#' + hex);
			$('#exmaple_color_td').css('color', '#' + hex);
		}
	});
	
	// Change the border input value and Example TD border color to reflect ColorPicker selections.
	$('#border_color').attr('readonly', true).ColorPicker({
		color: '#000000',
		onChange: function (hsb, hex, rgb) {
			$('#border_color').val('#' + hex);
			$('#exmaple_color_td').css('border', '1px solid #' + hex);
		}
	});
	
	// Handle transparency.
	$('#transparent_background').change(function(){
		if ($('#transparent_background').is(':checked')) {
			$('#background_color').val('transparent');
			$('#exmaple_color_td').css('backgroundColor', '');
		}
	});
	*/
});
