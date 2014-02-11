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

<h2>Why shared worlds?</h2>

<p>I grew up as an author in fandom spaces.</p>

<p>This is relevant, I promise.</p>

<p>The first communities which provided me a framework in which to write – an audience, a known set of genres and conventions, and a spirit of constructive criticism 
	– were fandom spaces. Because there was a sense of shared love for the source canon and a common investment in our own works, it became a close-knit creative 
	community. It let me get a lot of my million words of crap out in an environment where technical talent was nurtured but genuine engagement was just as important, 
	and it gave all of us a place of common interests and a common vocabulary through which to examine new ideas.</p>

<p>And wow, did we examine new ideas. Fanfiction – at least, in the fandom spaces I hung out in – was a medium which was constantly, thoughtfully in dialogue with itself 
	and with the canons of original work from which it derived. It was a way to look critically at the originals and test them, a way to swap out demographic representation 
	or interrogate assumptions, to say "What if <em>x</em> instead of <em>y</em>?"  We started with a known set of variables – characters who behaved in certain ways, 
	worlds which operated on certain principles – and could alter them and hold up those results to scrutiny.</p>

<p>Even on a formal level, the risks of writing in a new or experimental style were mitigated by the fact that you wouldn't have to sell people on characters, world, 
	and style all at once – you could focus in on one area of craft and observe its effect on the text and on readers.  You could control the variables of your 
	experimentation.</p>

<p>And while I often talk about the importance of fandom spaces as a learning environment for me, it's not their only or primary purpose. Fandom has produced works which 
	are sweeping in scope, incisive in commentary, and beautiful in terms of craft, just as original fiction has. Writers of fanfiction are writers, and often proceed 
	along parallel trajectories as writers of works which go on to be published; the difference is what they choose to focus their writing skills on.</p>

<p>Fandom spaces operate in shared worlds, derived from fictional worlds whose copyright is controlled. Because of this, fanfiction is a largely noncommercial endeavor, 
	which protects the original creator's intellectual property rights but fails to provide any recognition for the work that goes into crafting a piece of transformative 
	art.  In creating these shared worlds, I want to provide a space where intellectual property rights are preserved, but transformative prose and art works can be sold 
	by their creators.</p>

<p>I will maintain no official canon. All works set in these shared universes represent an author (or authors) playing with ideas.  People are free to establish their 
	own personal canons – those works which ring most true to them, or please them best – but the shared worlds are networks of flashes of inspiration and responses to 
	them, questions and myriad answers, drabbles and epics, AUs and genderswaps and racebends and remixes.</p>

<p>I have no illusions that this will become as large as the great fandoms out there – the Harry Potters and Supernaturals and Star Treks.  But if I can create a 
	space where an engaged community can come together, which can compensate authors for their work within the community, and if I can perhaps encourage others to 
	engage in experiments like this on their own...</p>

<p>That'll duly answer the <em>why</em> of <em>Why shared worlds?</em></p>


<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('fiction');
?>
