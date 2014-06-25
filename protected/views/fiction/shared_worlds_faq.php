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

<h2>Frequently (or at least plausibly) Asked Questions for Shared Worlds</h2>

<h3>What is this? Why are you doing this?</h3>



<p>The Shared Worlds are sandbox stories with a focus on community engagement. Authors are encouraged to write works in these universes, as engaged fandoms 
	have done with various canons since time immemorial (or at least times pre-internet). However, the canons comprised by these works are released under a 
	Creative Commons + license which allows authors to publish and commercialize their transformative works, so long as they release the same rights to other 
	creators downstream.</p>
	
<p>For further information, see the <a href="<?php echo Yii::app()->createUrl('fiction/shared_worlds'); ?>">main Shared Worlds page</a>.</p>



<h3>The Shared Worlds licence requires attribution. How would you like to be attributed?</h3>

<p>A note saying that your work is "based on works in the Shared Worlds series by An Owomoyela" is sufficient.  If you'd like to link back to the
	<a href="<?php echo Yii::app()->createUrl('fiction/shared_worlds'); ?>">Shared Worlds page</a>, that'd be great.  If you feel like listing individual
	stories which inspired your work, that'd be awesome.</p>
	
<p>Make it clear that your work is your own but that it's inspired by Shared Worlds stuff, basically.</p>



<h3>The Shared Worlds licence is a noncommercial Creative Commons license, but it contains an exemption from the non-commercial clause.
	Can I resell your stories, as part of an anthology of other Shared Worlds works?</h3>

<p>No. At least, not without securing written permission from me. The exemption to the non-commercial clause is for derivative, transformative works – that is,
	works that you create based on the Shared Worlds characters, settings, plot events, etc.</p>
	
<p>Basically, you can sell fanfiction, fanart, and other fanworks, as long as you release them under the license that I've used – which allows others to create
	and sell fanworks based on <em>your</em> work.  You may not re-sell my work, just as people making fanworks of your work cannot re-sell <em>your</em> work.</p>
	
<p>(I am not allowed to re-sell your work either, if you're wondering.)</p>



<h3>Some of the prompt responses you've developed in these canons read like the first scenes in larger works. Can I use them as the first scenes of my work?</h3>

<p>No.  Your work must be your own.  You can quote salient dialogue, pieces of myth, etc., but you can't reproduce entire scenes of my prose whole-cloth.</p>



<h3>I want to explore one of the scenes you've written, but from a different perspective or with different underlying assumptions. Can I do that?</h3>

<p>Absolutely! <a href="http://fanlore.org/wiki/Remix">Remixes</a> are allowed and encouraged.</p>



<h3>I happen to know you're a sex-averse asexual. Can I still write sexy shippy smut with your characters?</h3>

<p>&bull;sigh&bull; Yes, though you shouldn't expect me to read it.  And if you do something like take an avowedly asexual character or an intimate platonic relationship
	I really adore and turn it into erotic fun times, I will probably grouse at my friends about it and mutter bitterly about amatonormativity, the conflation of
	intimacy and sex, and the lack of respect and credence for platonic and asexual relationships.</p>
	
<p>But you're perfectly within your rights to write it.</p>



<h3>I see that Shared Worlds is an ideological project for you. Why don't you release all of your work into the Shared Worlds canon?</h3>

<p>Sometimes ideology gets in fights with pragmatism.</p>

<p>Basically, I don't know to what extent traditional publishing markets will be open to Shared Worlds works. At novel lengths, especially, I imagine that a number of
	publishing houses would look askanse at publishing a universe whose brand identity they couldn't control.</p>
	
	
	
<h3>I wrote something in a Shared Worlds universe! Will you host it on your site?</h3>

<p>That sounds like an administrative headache. Maybe try <a href="https://archiveofourown.org/">Archive of Our Own</a>? It's a project by the 
	<a href="http://transformativeworks.org/">Organization for Transformative Works</a>, so you know it's good.</p>
	


<h3>What if I write something in one of the Shared Worlds universes, make a whole ton of money, and rocket to everlasting fame? Will I have to pay you royalties or something?</h3>

<p>No. You are under absolutely no obligation to pay me for your participation in the Shared Worlds project, no matter how much money you make from derivative works.</p>

<p>That said, if you do find yourself selling your works and you want to donate some money back to me, I'm hardly going to object.</p>



<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>