<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<div id="submenu">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<h2 class="right_header">Short Stories</h2>
<?php
	if ( count($short_stories)>0 ) {
		foreach($short_stories as $story) { echo $story->get_catalog_block(); }
	} else {
		echo "<p>No stories found in category.</p>";
	}
?>


<h2 class="right_header">Novels and Novellas</h2>
<?php
	if ( count($long_stories)>0 ) {
		foreach($long_stories as $story) { echo $story->get_catalog_block(); }
	} else {
		echo "<p>No stories found in category.</p>";
	}
?>


<h2 class="right_header">Prompt Responses</h2>
<?php
	if ( count($prompt_stories)>0 ) {
		foreach($prompt_stories as $story) { echo $story->get_catalog_block(); }
	} else {
		echo "<p>No stories found in category.</p>";
	}
?>


<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>