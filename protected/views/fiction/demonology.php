<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<blockquote>
	<p>
		Merigoa isn’t the America you’re used to. For one thing, New York is New Amsterdam, the FBI is the FIA, and you’re more likely to catch celebrities 
		singing at the World Series than the Superbowl. For another, there are demons.
	</p>
	
	<p>
		As one of Merigoa’s most respected, most feared, and most empowered law enforcement agencies, Demonology, Perfidy and Security is tasked with mitigating 
		the demonic threat and prosecuting those who collude with demons. But the job takes agents of the DPS into close contact with demons, themselves, and to 
		the ragged edges of law, propriety, and personal conviction.
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