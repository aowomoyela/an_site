<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/brushed_metal/fiction.css');
		 $cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<h2 class="story_archive_title">'.$title.'</h2>';
	echo $story_text;
?>

<?php
	/***********************************/
	/* PAGE FINAL - Tipjars & Licenses */
	/***********************************/
	#new dBug($publication_category);
	$check_for_shared_worlds = array_intersect($publication_category, array(10, 11, 12, '10', '11', '12'));
	if ( count($check_for_shared_worlds) > 0 ) {
		echo '<hr style = "width:100%; border:1px solid #0F4CC9; margin: 3em 0;" />';
		echo SiteElement::get_license('shared_worlds');
	}
	
	SiteElement::get_tipjar('fiction');
?>