$(function() {
	// On load, grey out center size options if the card size is even x even.
	var start_card_size = $("input:radio[name=card_size]:checked").val();
	if (start_card_size == 1 || start_card_size % 2 == 0) {
			$("#center_space_handling").css("color", "#CCC");
			$("input:radio[name=center_space]").attr('disabled','disabled');
		}
	
	// Check everything again when card size or free space options are changed.
	$("input[name=card_size]:radio, input[name=center_space]:radio").change(function() {
		// Get the dimensions.
		var card_size = $("input:radio[name=card_size]:checked").val();
		var center_space = $("input:radio[name=center_space]:checked").val();
		var num_elements = card_size*card_size;
		// If the card has an even number of elements per side, or is a 1x1 block, we don't need the center space options.
		if (card_size == 1 || card_size % 2 == 0) {
			$("#center_space_handling").css("color", "#CCC");
			$("#center_space_normal").prop("checked","checked");
			$("input:radio[name=center_space]").attr('disabled','disabled');
		} else {
			$("#center_space_handling").css("color","#000");
			$("input:radio[name=center_space]").removeAttr('disabled');
		}
		// Update the number of elements we direct the user to enter, based on the size of the card.
		if (
			(center_space == "free" || center_space == "wild" || center_space == "other")
			&& card_size % 2 == 1 && card_size != 1
		) { num_elements--; } // Free space.
		// Update the instructions.
		$(".num_card_elements").html(num_elements);
	});
});
