$(function() {
	
	
	$('#background_color').attr('readonly', true).ColorPicker({
		color: '#ffffff',
		onChange: function (hsb, hex, rgb) {
			$('#background_color').val('#' + hex);
			$('#exmaple_color_td').css('backgroundColor', '#' + hex);
			$('#transparent_background').attr('checked', false);
		}
	});
	
	$('#text_color').attr('readonly', true).ColorPicker({
		color: '#000000',
		onChange: function (hsb, hex, rgb) {
			$('#text_color').val('#' + hex);
			$('#exmaple_color_td').css('color', '#' + hex);
		}
	});
	
	$('#transparent_background').change(function(){
		if ($('#transparent_background').is(':checked')) {
			$('#background_color').val('transparent');
			$('#exmaple_color_td').css('backgroundColor', '');
		}
	});
	
});
