<?php
	/****************/
	/* Load assets. */
	/****************/

	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/form.css');
	#$cs->registerScriptFile($baseUrl.'/js/tinymce/tinymce.min.js');
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
		echo CHtml::beginForm();
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
		<?php echo CHtml::activeTextField($story, 'publication_category_id'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'publication_market_id'); ?>
		<?php echo CHtml::activeTextField($story, 'publication_market_id'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'publication_date'); ?>
		<?php echo CHtml::activeTextField($story, 'publication_date'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'available_in_archive'); ?>
		<?php echo CHtml::activeCheckBox($story, 'available_in_archive'); ?>
	</div>

	<div class="form_row">
		<?php echo CHtml::activeLabel($story, 'archive_url_title'); ?>
		<?php echo CHtml::activeTextField($story, 'archive_url_title'); ?>
	</div>

<?php
		echo CHtml::endForm();
	}
?>

<script type="text/javascript">
	CKEDITOR.replace( 'pullquote', {
		toolbar :
		[
			{ name: 'basicstyles', items : [ 'Source','-','Bold','Italic' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize','-','About' ] }
		]
	});

	CKEDITOR.replace( 'story_text' );
</script>
