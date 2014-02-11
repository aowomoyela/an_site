$(function() {
	$("#list_loader" ).change(function() {
		// Clear the list of any previous input or jQuery actions
		$("#bingo_list").html("");
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
	});
});
