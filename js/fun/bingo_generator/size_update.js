$(function() {
	$("input[name=card_size]:radio").change(function() {
		// Get the dimensions.
		var card_size = $("input:radio[name=card_size]:checked").val();
		var num_elements = card_size*card_size;
		num_elements--; // Free space.
		// Update the instructions.
		$(".num_card_elements").html(num_elements);
	});
});
