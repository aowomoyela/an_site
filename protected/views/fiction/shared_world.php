<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<blockquote class="license">
	<p>
		<?php echo SiteElement::get_license('shared_worlds'); ?>
	</p>
</blockquote>

<?php
	// Short stories.
	if ( count($short_stories)>0 ) {
		echo '<h2 class="right_header">Short Stories</h2>';
		foreach($short_stories as $story) { echo $story->get_catalog_block(); }
	}

	// Long stories.
	if ( count($long_stories)>0 ) {
		echo '<h2 class="right_header">Novels and Novellas</h2>';
		foreach($long_stories as $story) { echo $story->get_catalog_block(); }
	}

	// Prompt response stories.
	if ( count($prompt_stories)>0 ) {
		echo '<h2 class="right_header">Prompt Responses</h2>';
		foreach($prompt_stories as $story) { echo $story->get_catalog_block(); }
	}
?>


<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>
