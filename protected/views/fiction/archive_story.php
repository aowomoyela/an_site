<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/brushed_metal/fiction.css');

	echo '<h2 class="story_archive_title">'.$title.'</h2>';
	echo $story_text;
?>
