<?php
	/**********************************/
	/* Error and result notification. */
	/**********************************/

	if ( isset($error) ) {
		echo "<div class='page_error'>$error</div>\r\n";
	}

	if ( isset($message) ) {
		echo "<div class='page_message'>$message</div>\r\n";
	}
	
	if ( isset($listing) ) {
		echo '<input type="text" name="listing" value="'.$listing.'" size="50"/>';
	}
	
	echo CHtml::beginForm( array('admin/manage_bingo_lists'), 'post', array('id'=>'edit_story_form') );
?>
	<h2>Create a new CSV file. (Adding to select dropdown NOT automated.)</h2>
	
	<label for="file_name">File name:</label> <input type="text" name="file_name" /><br /><br />
	<label for="list_title">List title:</label> <input type="text" name="list_title" /><br /><br />
	<textarea id="bingo_list" name="bingo_list" cols="94" rows="10"></textarea><br /><br />
	<input type="submit" value="Create CSV &raquo;" />

<?php
	echo CHtml::endForm();
?>