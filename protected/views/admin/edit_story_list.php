<?php
	/****************/
	/* Load assets. */
	/****************/

	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/form.css');
?>

<div id="header_forms">
	<form method="get" name="new_story" action="<?php Yii::app()->createUrl('admin/edit_story') ?>">
		<input type="hidden" name="story_id" value="new" />
		<input type="submit" class="form_submit" value="New Story" />
	</form>

	&emsp; | &emsp;

	Select publication category:
	<form method="get" name="select_publication_category" action="<?php Yii::app()->createUrl('admin/edit_story') ?>">
		<select name="publication_category_id" onchange="this.form.submit()">
		<?php
			$selected = '';
			foreach ($publication_categories as $category) {
				if ($category['publication_category_id'] == $publication_category_id) { $selected = ' selected="selected"'; } else { $selected = ''; }
				echo '<option value="'.$category['publication_category_id'].'"'.$selected.'>'.$category['title'].'</option>';
			}
		?>
		</select>
		<input type="submit" value="&raquo;" />
	</form>
</div>
<?php
	foreach ($stories as $story) {
		echo '<div class="story_listing">'."\n";
			echo '<a href="'.Yii::app()->createUrl('admin/edit_story', array('story_id'=>$story->get('story_id'))).'"><strong>'.$story->get('title').'</strong></a>';
		echo '<div>'."\n\n";
	}

	if (count($stories) == 0) {
		echo "<p>No stories to display in this publication category.</p>";
	}
?>
