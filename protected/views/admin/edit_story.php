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
	$cs->registerScriptFile($baseUrl.'/js/admin/edit_story.js');
	


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

<script type="text/javascript">
	CKEDITOR.replace( 'pullquote', {
		toolbar :
		[
			{ name: 'document', items : [ 'Source' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','Blockquote' ] },
			//{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
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
