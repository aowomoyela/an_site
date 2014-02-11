<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<div id="submenu">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<?php
	if ( $fundraiser ) { include( dirname(__FILE__).'/shared_world_fundraiser_pages/'.$fundraiser.'.php' ); } else {
?>
	<h2>Shared Worlds Fiction Fundraising</h2>
	
	<p>These are opportunities for me to raise money for a cause (or causes) I care about, and for you to get some fiction playing off your specifications 
		under a license which encourages interaction with the text. Here’s how it works:</p>
	
	<h3>The Goods</h3>

	<p>I provide a table of prompts.  Each prompt is something I find narratively interesting – it may be a character archetype, a subgenre, a predicament, 
		a title seed, a quote, an aspect of worldbuilding... you get the idea.</p>
		
	<p>When you buy a prompt, you get to make a suggestion for how you want to see that prompt written. For example, if the prompt is "Dystopias", you could add 
		"I'd really like to see a story which focuses on how people manufacture moments of love, levity, community, or joy in a dystopian setting."  
		I will then write at least 1000* words of that story, using your specifications** as a jumping-off point.</p>
	
	<p>These 1000 words may not comprise an entire, polished story, with a plot arc and a strong beginning, middle, and end.  In fact, they probably won't.  They'll 
		probably be scenes; little glimpses into a world.  However, all of the works I produce through these fundraisers will be released in my Shared Worlds series,
		which allows anyone to hop into the sandbox, write their own stories set in these worlds, and do what they want with them – including selling those works 
		commercially.  (See the license information below for more information.)</p>
	
	<p>Essentially, I hope that these fundraisers will contribute to the creation of a number of sandbox worlds, which will support creative engagement in a fandom-like 
		format, and which will support people who prefer engaging with works in a fandom-like setting.</p>
	
	<p>Because these fundraisers will feed into those Shared Worlds, I'll happily accept prompts which have me writing in the world of a previous Shared Worlds story.  
		However, I won't write works in worlds which are not published in the Shared Worlds series – you can't ask me for a sequel to 
		"<a href="http://expandedhorizons.net/magazine/?page_id=2328">God in the Sky</a>", for example.</p>
		
	<p>The number of prompts in each round of fundraising will be limited, to avoid totally snowing me in.  Once they're gone, they're gone.</p>
	
	<p class="asterisked">* As counted by my text-editing program, which will probably be either <a href="http://www.bean-osx.com/">Bean</a> 
		or <a href="http://www.literatureandlatte.com/scrivener.php">Scrivener</a>.  I may write more than 1000 words – I may write <em>significantly</em> more than 
		1000 words – but 1000 minimum is the guarantee.</p>
	
	<p class="asterisked">** I reserve the right to completely ignore your additional prompt if I find it objectionable, which includes (but is not limited to) 
		sexist, racist, transphobic, fatphobic, xenophobic, and ableist material.  I also reserve the right to incorporate your prompt in a way which only makes sense 
		to me, though I'll try to at least preserve the chain of mental logic that led to its implementation.  For example: my story 
		"<a href="http://www.fantasy-magazine.com/fiction/abandonware/">Abandonware</a>" began life from a prompt which asked me to adapt 
		"<a href="http://www.classicshorts.com/stories/rockwinr.html">The Rocking Horse Winner</a>" 
		using modern video games as the divinatory medium.  ("Modern video games" somehow became "Zork", which somehow became "a text-only interface".)  I will try 
		to honor your prompt, but when I say I'll use the prompt as a jumping-off point, I really do mean that that's how I'll <em>start thinking about the story</em>, 
		but the story may develop organically along other lines.</p>
		
		
	<h3>The Fine Print</h3>

	<p>Creative work takes time. I earnestly hope that I'll be able to crank out every story within a couple weeks of payment, at most, but life may intervene; 
		if I haven't written your story within two months of purchase, please pester me via email.  If I haven't written your story within four months from date 
		of purchase, I'll refund your money, no questions.</p>
		
	<h3>The License</h3>
	
<?php
	}
?>

<blockquote class="license">
	<p>
		<?php echo SiteElement::get_license('shared_worlds'); ?>
	</p>
</blockquote>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	// SiteElement::get_tipjar('fiction');
?>
