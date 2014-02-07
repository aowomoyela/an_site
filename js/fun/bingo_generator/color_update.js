$(function() {
	// Set the Example TD to any color values carried over from previous card generations.
	var preloaded_bg_hex = $('#background_color').val();
	if (preloaded_bg_hex != "transparent") {
		$('#exmaple_color_td').css('backgroundColor', preloaded_bg_hex);
	}

	var preloaded_text_hex = $('#text_color').val();
	$('#exmaple_color_td').css('color', preloaded_text_hex);
	
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
	
	// Handle transparency.
	$('#transparent_background').change(function(){
		if ($('#transparent_background').is(':checked')) {
			$('#background_color').val('transparent');
			$('#exmaple_color_td').css('backgroundColor', '');
		}
	});
	
});
