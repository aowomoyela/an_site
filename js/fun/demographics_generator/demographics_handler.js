// Event binding as per http://stackoverflow.com/questions/3686809/how-do-i-bind-appended-html-with-jquery :
function bindHandlers(root) {
		// Delete the selected category.
	$(".delete_category", root).click(function() {
		$(this).parents(".demographic_category").remove();
	});
	
	// Delete the selected option.
	$(".delete_option", root).click(function() {
		$(this).parents(".demographic_option").remove();
	});
	
	// Add a new category.
	$(".add_category", root).click(function() {
		// Prompt the user for the new category name.
		var category_name = prompt("New category title: ", "");
		// Trim, replace inner whitespace with underscores, and get rid of non-alpha chars
		category_name = category_name.trim().replace(/\s/g, "_").replace(/[^a-zA-Z_]/g, "");
		// Get the HTML for the category listing.
		var category_listing = "/js/fun/demographics_generator/resources/demographics_category.inc";
		$.get(category_listing, function(data){
			// Replace the appropriate values.
			var category_block = data.toString().replace(/{CATEGORY}/g, category_name);
			// Append the new fieldset to the form.
			$("#demographics_generator").append( category_block );
		}, 'text' );
		// Fix element binding.
		setTimeout(function(){
			$("*").unbind();
			bindHandlers(document);
		}, 500);
		
	});
	
	// Add a new option to the parent category.
	$(".add_option", root).click(function() {
		// Get the category name from the parent fieldset.
		var parent_fieldset = $(this).parents(".demographic_category");
		var category_name = parent_fieldset.attr('id');
		// Prompt the user for the new option name.
		var option_name = prompt("New option name: ", "");
		// Get the HTML for the option listing.	
		var option_listing = "/js/fun/demographics_generator/resources/demographics_option.inc";
		$.get(option_listing, function(data){
			// Replace the appropriate values.
			var option_block = data.toString().replace(/{CATEGORY}/g, category_name).replace(/{OPTION}/g, option_name);
			// Append the new fieldset to the form.
			parent_fieldset.append( option_block );
		}, 'text' );
		// Fix element binding.
		setTimeout(function(){
			$("*").unbind();
			bindHandlers(document);
		}, 500);
	});
	
	// Restrict weight and other inputs to numeric values.
	$(".num_only", root).change(function() {
		var value = $(this).val();
		value = value.replace(/[^0-9]/g, "");
		$(this).val(value);
		if ( $(this).val() == "" ) { $(this).val(0) }
	});
};

function import_comma_list() {
	var comma_list_label = $("#comma_list_label").val();
	var comma_delimited_list = $("#comma_delimited_list").val();
	var list_values = comma_delimited_list.split(",");
	
	/* Add the new category. */
	// Trim, replace inner whitespace with underscores, and get rid of non-alpha chars
	category_name = comma_list_label.trim().replace(/\s/g, "_").replace(/[^a-zA-Z_]/g, "");
	// Get the HTML for the category listing.
	var category_listing = "/js/fun/demographics_generator/resources/demographics_category.inc";
	$.get(category_listing, function(data){
		// Replace the appropriate values.
		var category_block = data.toString().replace(/{CATEGORY}/g, category_name);
		// Append the new fieldset to the form.
		$("#demographics_generator").append( category_block );
	}, 'text' );
	
	/* Fix element binding. */
	setTimeout(function(){
		$("*").unbind();
		bindHandlers(document);
	}, 100);
	
	/* Add the new options. */
	setTimeout(function(){
		// Get the category name from the category we've just created.
		var category_id = "#" + category_name;
		var parent_fieldset = $(category_id);
		// Get the HTML for the option listing.	
		var option_listing = "/js/fun/demographics_generator/resources/demographics_option.inc";
		// Get the basic HTML block.
		$.ajaxVars = {};
		$.ajax({
			async: false,
			type: 'GET',
			url: option_listing,
			success: function(data) {
				$.ajaxVars.optionBlock = data.toString();
			}
		});
		
		// Loop to create option listings.
		for (var i=0; i < list_values.length; i++) {
			// Grab the new option name.
			var option_name = list_values[i];
			// Append the new fieldset to the form.
			var option_block = $.ajaxVars.optionBlock.replace(/{CATEGORY}/g, category_name).replace(/{OPTION}/g, option_name);
			parent_fieldset.append( option_block );
		}
	}, 200);
}

$(function() {
	bindHandlers(document);
	
	$("#rebind").click(function(){
		bindHandlers(document);
	});
});