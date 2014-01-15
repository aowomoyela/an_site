<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		 $cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	foreach($stories as $story) {
		echo $story->get_catalog_block();
	}
?>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>