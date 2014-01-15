<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/brushed_metal/fiction.css');
		 $cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<h2 class="story_archive_title">'.$title.'</h2>';
	echo $story_text;
?>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>