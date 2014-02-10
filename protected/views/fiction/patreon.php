<?php
	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<blockquote>
	Through Patreon, you can <a href="http://www.patreon.com/an_owomoyela">sign up to give me a certain amount of money for each thing I create and release</a>. 
	(If you want to make sure you don't go over-budget, you can set a maximum: say, you want to give me $5 per work, but don't want to spend more than $15 on 
	me per month. Set up a maximum, and even if I write ten things that month, you won't get overcharged.)  Then, I dance – er, write – for your amusement. 
	Although this fiction is <em>funded</em> through Patreon, it isn't restricted to Patreon sponsors – it will remain free for anyone to read online. 
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
?>
