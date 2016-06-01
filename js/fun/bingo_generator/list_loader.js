$(function() {
	// On load, count the number of items currently in the list.
	/*var current_items_in_list = $('#bingo_list').val().split(',').length-1;
	$('#current_items_listed').html(current_items_in_list);*/
	
	// When the list loader selection changes, update the lists loaded. As one would.
	$("#list_loader" ).change(function() {
		// Clear the list of any previous input or jQuery actions
		$("#bingo_list").html("");
		// Load all the values in the files requested, and list them into the input box.
		var files_to_load = $("#list_loader").val();
		var file_to_load;
		for (var i = 0; i < $("#list_loader").val().length; i++) {
			file_to_load = "/js/fun/bingo_generator/resources/"+files_to_load[i]+".csv";
			$.get( file_to_load, function(data){
				$("#bingo_list").append( data );
				if ( $("#list_loader").val().length > 1 && i != $("#list_loader").val().length-1 ) {
					// Add commas between lists.
					$("#bingo_list").append( ", " );
				}
			}, 'text' );
		}
		// Update the note about how many items are listed.
		/*var current_items_in_list = $('#bingo_list').val().split(',').length-1;
		var current_items_in_listdocument.getElementById("container").innerHTML
		$('#current_items_listed').html(current_items_in_list);*/
	});
});
