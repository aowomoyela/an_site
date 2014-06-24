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
	if ( in_array($publication_category_id, array(10, 11, 12, '10', '11', '12')) ) {
		echo '<hr style = "width:100%; border:1px solid #0F4CC9; margin: 3em 0;" />';
		echo SiteElement::get_license('shared_worlds');
	}
	
	SiteElement::get_tipjar('fiction');
?>