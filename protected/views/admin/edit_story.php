<?php
	/****************/
	/* Load assets. */
	/****************/

	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/form.css');
	$cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css');
	$cs->registerScriptFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
	$cs->registerScriptFile($baseUrl.'/js/ckeditor/ckeditor.js');
	$cs->registerScriptFile($baseUrl.'/js/admin/datepicker.js');
	


	/**********************************/
	/* Error and result notification. */
	/**********************************/

	if ( isset($error) ) {
		echo "<div class='page_error'>$error</div>\r\n";
	}

	if ( isset($message) ) {
		echo "<div class='page_message'>$message</div>\r\n";
	}


	/**********************/
	/* Select-story view. */
	/**********************/

	if ( isset($stories) ) {

	}

	/********************/
	/* Edit-story view. */
	/********************/

	elseif ( isset($story) ) {
		echo "<h2>Edit Story Information</h2>";
		// Give us the WYSIWYG editing form.
		echo CHtml::beginForm( array('admin/edit_story'), 'post', array('id'=>'edit_story_form') );
		echo CHtml::activeHiddenField( $story, 'story_id' );
?>
	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'title'); ?>
		<?php echo CHtml::activeTextField($story, 'title'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'wordcount'); ?>
		<?php echo CHtml::activeTextField($story, 'wordcount'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'link'); ?>
		<?php echo CHtml::activeTextField($story, 'link'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'link_active'); ?>
		<?php echo CHtml::activeCheckBox($story, 'link_active'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'pullquote'); ?>
		<div class="wysiwyg"><?php echo CHtml::activeTextArea($story, 'pullquote', array("name"=>"pullquote")); ?></div>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'story_text'); ?>
		<div class="wysiwyg"><?php echo CHtml::activeTextArea($story, 'story_text', array("name"=>"story_text")); ?></div>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'published'); ?>
		<?php echo CHtml::activeCheckBox($story, 'published'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'publication_category_id'); ?>
		<?php echo CHtml::activeDropDownList($story, 'publication_category_id', $publication_categories, array(
			'options'=>array(
				#$story->get('publication_category_id') => array('selected'=>true),
			),
		)); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'publication_market_id'); ?>
		<?php echo CHtml::activeDropDownList($story, 'publication_market_id', $story_markets, array(
			'options' => array(
				 #$story->get('publication_market_id') => array('selected'=>true),
			),
			'empty' => '(none)',
		)); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'publication_date'); ?>
		<?php echo CHtml::activeTextField($story, 'publication_date', array("readonly"=>"readonly", "class"=>"datepicker")); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'available_in_archive'); ?>
		<?php echo CHtml::activeCheckBox($story, 'available_in_archive'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'archive_url_title'); ?>
		<?php echo CHtml::activeTextField($story, 'archive_url_title'); ?>
	</div>

	<div class="form_row">
		<input type="submit" value="save changes &raquo;" class="inline_sans_label form_submit">
	</div>


<?php
		echo CHtml::endForm();
	}
?>

<!-- Story link management -->

<h2>Edit Story Links</h2><a name="story_links"></a>

<h3>Current Links</h3>

<?php
	foreach ($story_links as $story_link) {
		
		echo CHtml::beginForm( array('admin/edit_story_links'), 'post', array('id'=>'edit_story_link_form_'.$story_link->get('link_id')) );
		echo CHtml::activeHiddenField( $story_link, 'link_id' );
		echo CHtml::activeHiddenField( $story_link, 'story_id' );
?>
	<div class="form_row">
		<?php echo CHtml::activeTextField($story_link, 'link_text', array("size"=>"75")); ?>
		&emsp;
		<?php echo CHtml::activeLabel($story_link, 'link_active'); ?>
		<?php echo CHtml::activeCheckBox($story_link, 'link_active'); ?>
		&emsp; &emsp;
		<input type="submit" value="save changes &raquo;" class="form_submit">
	</div>
		
<?php	
		echo CHtml::endForm();
		echo "<hr />";	
	} // END foreach ($story_links as $story_link)
?>

<h3>New Link</h3>
<?php
	$new_link = new StoryLink();
	$new_link->set_id_to_new();
	$new_link->set('link_active', '1');
	$new_link->set('story_id', $story->get('story_id'));
	echo CHtml::beginForm( array('admin/edit_story_links'), 'post', array('id'=>'edit_story_link_form_new') );
		echo CHtml::activeHiddenField( $new_link, 'link_id' );
		echo CHtml::activeHiddenField( $new_link, 'story_id' );
?>
	<div class="form_row">
		<?php echo CHtml::activeTextField($new_link, 'link_text', array("size"=>"75")); ?>
		&emsp;
		<?php echo CHtml::activeLabel($new_link, 'link_active'); ?>
		<?php echo CHtml::activeCheckBox($new_link, 'link_active'); ?>
		&emsp; &emsp;
		<input type="submit" value="add link &raquo;" class="form_submit">
	</div>
		
<?php	
		echo CHtml::endForm();	
?>


<script type="text/javascript">
	// See: http://docs.cksource.com/CKEditor_3.x/Developers_Guide/Toolbar

	CKEDITOR.replace( 'pullquote', {
		toolbar :
		[
			{ name: 'document', items : [ 'Source' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','Blockquote' ] },
			{ name: 'links', items : [ 'Link','Unlink' ] },
			{ name: 'tools', items : [ 'Maximize' ] }
		]
	} );

	CKEDITOR.replace( 'story_text', {
		toolbar :
		[
			{ name: 'document', items : [ 'Source','-','Preview' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker' ] },
			'/',
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
			{ name: 'insert', items : [ 'Image','HorizontalRule','SpecialChar' ] },
			{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'tools', items : [ 'Maximize' ] }
		]
	} );
</script>
