<?php
$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
		 $cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');

	echo '<div id="submenu">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
?>

<h2 class="left_header"><a href="<?php echo Yii::app()->createUrl('fiction/demonology') ?>">Demonology</a></h2>

<p>
	Merigoa isn't the America you're used to. For one thing, New York is New Amsterdam, the FBI is the FIA, and you're more likely to catch celebrities singing at the 
	World Series than the Superbowl. For another, there are demons.
</p>

<p>
	As one of Merigoa's most respected, most feared, and most empowered law enforcement agencies, the department of Demonology, Perfidy and Security is tasked with mitigating the 
	demonic threat and prosecuting those who collude with demons. But the job takes agents of the DPS into close contact with demons, and to the ragged 
	edges of law, propriety, and personal conviction.
</p>

<h2 class="right_header"><a href="<?php echo Yii::app()->createUrl('fiction/patreon') ?>">Patreon (coming soon)</a></h2>

<p>
	<a href="http://patreon.com/">Patreon</a> is a crowdfunding service which connects creative types and their audiences.  Basically, members of the public (such as yourselves!)
	sign up to give me a certain amount of money for each thing I create and release. (If you wanted to make sure you didn't go over-budget, you could set a maximum: 
	say, you wanted to give me $5 per work, but didn't want to spend more than $15 on me per month. Set up a maximum, and even if I wrote ten things that month, you 
	wouldn't get overcharged.)  Then, I dance – er, write – for my sponsors' amusement.
</p>

<p>
	Putting out fiction through Patreon isn't something I see as replacing my work in traditional publishing. Instead, I see it as focused on a different writing niche – 
	for example, with Patreon, I can solicit prompts from people who like my work, and then write to those promps and release the finished works. I can also publish fiction 
	which doesn't run to the tastes of various editors, or which might exceed their length limits, or might be more experimental or junk-food reading in nature.
</p>

<p>
	Although this fiction is <em>funded</em> through Patreon, it isn't restricted to Patreon sponsors – it will remain free for anyone to read online. 
</p>

<!--p>To sponsor me, <a href="http://www.patreon.com/an_owomoyela">visit my Patreon page</a>!</p-->

<!--p>Many thanks go to <a href="<?php echo Yii::app()->createUrl('fiction/patreon_acknowledgements') ?>">my Patreon sponsors</a>.</p-->

<?php /*

<h2 class="left_header"><a href="<?php echo Yii::app()->createUrl('fiction/pixel') ?>">Pixel-Stained (coming soon)</a></h2>

<p>
	Back in 2007, then-Vice President of the <a href="http://www.sfwa.org/">Science Fiction &amp; Fantasy Writers of America (SFWA)</a> Howard V. Hendrix
	posted <a href="http://sfwa.livejournal.com/10039.html">an opinion on the increasing prevalence of online activities in professional spaces</a>, which
	included a critique on "webscabs, who post their creations on the net for free". He opined that " they're undercutting those of us who aren't giving [fiction]
	away for free and are trying to get publishers to pay a better wage for our hard work", and that "they are rotting our organization (SFWA) from within".
	And, in perhaps the most memorable line, with the phrase that rose to infamy, "[they are] converting the noble calling of Writer into the life of 
	Pixel-stained Technopeasant Wretch".
</p>

<p>
	In response, author Jo Walton <a href="http://papersky.livejournal.com/320453.html">posted a rebuttal</a> and created 
	<a href="http://papersky.livejournal.com/320114.html">International Pixel-Stained Technopeasant Day</a>, a day when content creators could share, if they
	so chose, their works for free online.  (Thus far, SFWA has not rotted away, nor the publishing industry collapsed, as a result of her actions.)
</p>

<p>
	I do my best to keep all my short fiction <a href="<?php echo Yii::app()->createUrl('fiction/index') ?>">free to read online</a>, as allowable by the
	contracts I sign with their first publication markets.  The Pixel-Stained section of this site is a repository for original fiction which has not been
	previously published, and which does not fall into an established crowd-funded universe.
</p>

 */ ?>
 
<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>