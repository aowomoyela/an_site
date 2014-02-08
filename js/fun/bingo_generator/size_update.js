$(function() {
	$("input[name=card_size]:radio, input[name=center_space]:radio").change(function() {
		// Get the dimensions.
		var card_size = $("input:radio[name=card_size]:checked").val();
		var center_space = $("input:radio[name=center_space]:checked").val();
		var num_elements = card_size*card_size;
		if ( center_space == "free" || center_space == "wild" || center_space == "other" ) { num_elements--; } // Free space.
		// Update the instructions.
		$(".num_card_elements").html(num_elements);
	});
});
