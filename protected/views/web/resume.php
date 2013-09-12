<?php 
	$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/brushed_metal/resume.css');

	echo $content;
?>
