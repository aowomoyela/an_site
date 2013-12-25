$(function() {
	$("#list_loader" ).change(function() {
		//alert( "Bear with me; I'm still debugging this." );
		var file_to_load = $("#list_loader").val();
        $("#bingo_list").load("/js/fun/bingo_generator/resources/"+file_to_load+".csv");
	});
});
