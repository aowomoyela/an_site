<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/colorpicker/js/colorpicker.js');
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/color_update.js');
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/size_update.js');
	$cs->registerCssFile($baseUrl.'/js/colorpicker/css/colorpicker.css');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/bingo_generator.css');
?>

<h2>Let's make you a bingo card!</h2>

<h3 style="margin-top:2em;">Input a comma-separated list of at least <span class="num_card_elements"><?php echo $num_card_elements; ?></span> values.</h3>

<p>If one of your values needs a comma, use the HTML code <strong>&amp;#44;</strong> in place of the comma <em>within</em> the value.</p>

<?php echo CHtml::beginForm( array('fun/bingo_generator', '#'=>'generated_card'), 'post', array('id'=>'bingo_generator') ); ?>
	<textarea id="bingo_list" name="list" cols="94" rows="10"><?php echo $list; ?></textarea><br /><br />
	

<fieldset><legend>Or choose one or more of these:</legend>
<p>(You can also edit these lists in the editor above, after loading them.)</p>
<p><select name="list_loader" id="list_loader" multiple="multiple" size="10">
	<option value="empty">(empty)</option>
	<optgroup label="Historical fiction-writing prompts">
		<option value="aarne-thompson_fairytale_classification_1">Aarne-Thompson fairytale classification (with numbers &amp; examples)</option>
		<option value="polti_dramatic_situations">Georges Polti's 19th-century list of 36 dramatic situations</option>
		<option value="robert_plutchik_emotion_list">Robert Plutchik's 1980 list of emotions</option>
	</optgroup>
	<optgroup label="Hurt/Comfort Bingo community prompts">
		<option value="hurt_comfort_bingo_round_01">H/C Bingo (round one, 2010)</option>
		<option value="hurt_comfort_bingo_round_02">H/C Bingo (round two, 2011)</option>
		<option value="hurt_comfort_bingo_round_03">H/C Bingo (round three, 2012)</option>
		<option value="hurt_comfort_bingo_round_04">H/C Bingo (round four, 2013)</option>
	</optgroup>
	<optgroup label="Tarot Cards">
		<option value="tarot_rider-waite-smith_major_arcana">Rider-Waite-Smith (major arcana)</option>
		<option value="tarot_rider-waite-smith">Rider-Waite-Smith (complete deck)</option>
		<option value="tarot_wildwood_major_arcana">Wildwood Tarot - Matthews, Ryan, &amp; Worthington (major arcana)</option>
		<option value="tarot_wildwood">Wildwood Tarot - Matthews, Ryan, &amp; Worthington (complete deck)</option>
	</optgroup>
	<optgroup label="TVTropes">
		<option value="tvtropes/horror_tropes">Horror Tropes (fetched 8 January 2014)</option>
	</optgroup>
	<optgroup label="Worlds Without End speculative genre classifications">
		<option value="worlds_without_end_fantasy">Fantasy subgenres</option>
		<option value="worlds_without_end_horror">Horror gubgenres</option>
		<option value="worlds_without_end_sf">Science Fiction subgenres</option>
	</optgroup>
	<optgroup label="Ysabetwordsmith's miscellaneous prompts">
		<option value="ysabetwordsmith/art_media">Art Media</option>
		<option value="ysabetwordsmith/asexuality_and_demisexuality">Asexuality &amp; Demisexuality</option>
		<option value="ysabetwordsmith/characterization_tropes">Characterization Tropes</option>
		<option value="ysabetwordsmith/childhood_experiences">Childhood Experiences</option>
		<option value="ysabetwordsmith/chromatic_character">Chromatic Characters</option>
		<option value="ysabetwordsmith/death">Death</option>
		<option value="ysabetwordsmith/desperate_situations">Desperate Situations</option>
		<option value="ysabetwordsmith/emotions">Emotions</option>
		<option value="ysabetwordsmith/end_of_the_world">End of the World</option>
		<option value="ysabetwordsmith/ethnic_groups">Ethnic Groups</option>
		<option value="ysabetwordsmith/famous_movie_quotes">Famous Movie Quotes</option>
		<option value="ysabetwordsmith/food">Food</option>
		<option value="ysabetwordsmith/genres">Genres</option>
		<option value="ysabetwordsmith/gentle_fiction">Gentle Fiction (No Sex, Violence, or Foul Language)</option>
		<option value="ysabetwordsmith/governments">Governments</option>
		<option value="ysabetwordsmith/handicaps">Handicaps</option>
		<option value="ysabetwordsmith/holidays">Holidays</option>
		<option value="ysabetwordsmith/kinks">Kinks</option>
		<option value="ysabetwordsmith/motif_tropes">Motif Tropes</option>
		<option value="ysabetwordsmith/music">Music</option>
		<option value="ysabetwordsmith/negative_coping_techniques">Negative Coping Techniques</option>
		<option value="ysabetwordsmith/disabilities">People with Disabilities</option>
		<option value="ysabetwordsmith/plot_tropes">Plot Tropes</option>
		<option value="ysabetwordsmith/poetic_forms">Poetic Forms</option>
		<option value="ysabetwordsmith/poetic_terms_and_techniques">Poetic Terms &amp; Techniques</option>
		<option value="ysabetwordsmith/positive_coping_techniques">Positive Coping Techniques</option>
		<option value="ysabetwordsmith/setting_tropes">Setting Tropes</option>
		<option value="ysabetwordsmith/sex_and_romance">Sex &amp; Romance</option>
		<option value="ysabetwordsmith/superpowers">Superpowers</option>
		<option value="ysabetwordsmith/swadesh_basic_list">Swadesh Basic List</option>
		<option value="ysabetwordsmith/themes">Themes</option>
		<option value="ysabetwordsmith/time_periods">Time Periods</option>
		<option value="ysabetwordsmith/types_of_family">Types of Family</option>
		<option value="ysabetwordsmith/worldbuilding">Worldbuilding</option>
	</optgroup>
	<optgroup label="Life, lifestyle and living resources">
		<option value="little_self-care_tasks">Little actions for self-care</option>
		<option value="little_housekeeping_tasks">Little housekeeping tasks</option>
	</optgroup>
</select></p>
</fieldset>
	
	
	<fieldset><legend>Configuration Options</legend>
	
	<input type="checkbox" name="use_repeat_values" value="1" <?php if($use_repeat_values){ echo 'checked="checked"'; } ?> />
		Allow repeated values for lists with fewer than <span class="num_card_elements"><?php echo $num_card_elements; ?></span> items?<br /><br />
	
	<table style="width:auto; display:inline; float:left; clear:left;"><tr>
		<td id="exmaple_color_td" style="border:1px solid #000; height:7.1em; width:7.1em; text-align:center;">EXAMPLE</td>
	</tr></table>
		
	<p>
		<label class="color_config" for="background">Background color:</label> 
		<input type="text" name="background" size="8" id="background_color" class="colorpicker_input" value="<?php echo $background_hex; ?>"/>
		(Or choose transparent: <input type="checkbox" name="transparent" value="transparent" id="transparent_background" <?php
			if ($background_hex == "transparent") { echo ' checked="checked"'; }
		?> />)
	</p>
	
	<p>
		<label class="color_config" for="text_color">Text color:</label> 
		<input type="text" name="color" size="8" id="text_color" class="colorpicker_input" value="<?php echo $text_hex; ?>"/>
	</p>
	
	<p>
		<label class="color_config" for="border_color">Border color:</label> 
		<input type="text" name="border_color" size="8" id="border_color" class="colorpicker_input" value="<?php echo $border_hex; ?>"/>
	</p>
	
	<p style="clear:both;">
		<label for="card_size">Card size:</label>
		<input type="radio" name="card_size" class="card_size" id="card_size_3" value="3"<?php if ($card_size == 3) {echo ' checked="checked"';} ?> /> <span>3x3</span> &emsp;&emsp;
		<input type="radio" name="card_size" class="card_size" id="card_size_5" value="5"<?php if ($card_size == 5) {echo ' checked="checked"';} ?> /> <span>5x5</span> &emsp;&emsp;
		<input type="radio" name="card_size" class="card_size" id="card_size_7" value="7"<?php if ($card_size == 7) {echo ' checked="checked"';} ?> /> <span>7x7</span>
	</p>
	
	<p>
		<label for="center_space">Center space:</label>
		<input type="radio" name="center_space" class="center_space" id="center_space_free" value="free"<?php
			if ($center_space == "free") {echo ' checked="checked"';}
			?> /> <span>FREE SPACE</span> &emsp;&emsp;
		<input type="radio" name="center_space" class="center_space" id="center_space_wild" value="wild"<?php
			if ($center_space == "wild") {echo ' checked="checked"';}
			?> /> <span>WILD CARD</span> &emsp;&emsp;
		<input type="radio" name="center_space" class="center_space" id="center_space_normal" value="normal"<?php
			if ($center_space == "normal") {echo ' checked="checked"';}
			?> /> <span>(Normal prompt)</span> &emsp;&emsp;
		<input type="radio" name="center_space" class="center_space" id="center_space_other" value="other"<?php
			if ($center_space == "other") {echo ' checked="checked"';}
			?> /> <span>(Other):</span> <input type="text" id="center_space_other" name="center_space_other" value="<?php echo $center_space_other; ?>">
	</p>
	
	</fieldset><br />
		
	<input type="submit" value="Create a bingo card &raquo;" /><br /><br />
<?php echo CHtml::endForm(); ?>


<h3 style="margin-top:3em;"><a name="generated_card"></a><?php echo $message; ?> (Scroll down for the HTML.)</h3>
<?php
	$position = 1;
	$free_space_square = ceil( pow($card_size, 2)/2 );
	// Set up the HTML
	$html_string = '<table style="width:auto; display:inline;">'."\r\n\r\n";
	for ($y=1; $y<=$card_size; $y++) {
		$html_string.= '<tr>'."\r\n";
		for ($x=1; $x<=$card_size; $x++) {
			// X-positioning
			$html_string.= '<td style="'.$border_color.' height:'.$cell_size.'; width:'.$cell_size.'; text-align:center; '.$background_color.' '.$text_color.'">';
			
			if ( in_array ($center_space, array('free', 'wild', 'other')) ) {
				// Handle TD generation for cards with special center squares.
				if ($position == $free_space_square) {
					$html_string.= $center_space_text;
				} elseif ($position < $free_space_square) {
					$index = $position - 1;
					$html_string.= trim($bingo_squares[$index]);
				} else {
					$index = $position - 2;
					$html_string.= trim($bingo_squares[$index]);
				}
			} else {
				//These cards have normal prompts as their center squares.
				$index = $position - 1;
				$html_string.= trim($bingo_squares[$index]);
			}
			
			$position++;
			$html_string.= '</td>'."\r\n";
		}
		$html_string.= '</tr>'."\r\n\r\n";
	}
	$html_string.= '</table>'."\r\n";

	// Display the table.
	echo $html_string;
	
	// Display the HTML to copy and paste.
	echo '<h3 style="margin-top:3em;">And here is the code:<h3>';
	echo '<p><textarea cols="94" rows="25">'.$html_string.'</textarea></p>';
?>

<h2 class="section" style="margin-top:3em;">Got lists?  Additions?  Bugs?</h2>

<p>If you have some good general-use lists that you want to see added, leave me a note (or the full comma-separated list) at 
<a href="http://magistrate.dreamwidth.org/34518.html">my DreamWidth post</a>!  (Note that, at the moment, there's a bug where any commas – 
even the HTML-entity escaped ones (and even ones which escape the ampersand on that entity!) are loading as commas, so commas within values of
pre-made lists don't work. I've been replacing them with slashes, dashes, and ellipses until I can get the bugs worked out.)</p>

<p>I may not take all lists, but I'll do my best to add ones that it seems like many people will find a use for.</p>

<p>If you have suggestions for additions to existing lists, or there are features you'd like to see, feel free to comment on that post as well! 
Again, I can't guarantee that all suggestions will be implemented, but I'll do my best to make this a usable resource.</p>

<p>Bug reports, unsurprisingly, should also go there.</p>

<h3>Known bugs:</h3>
<ul id="bugs_list">
	<li>Commas inside values of pre-made lists always appear as delimiters when loaded, no matter how well-escaped they are.</li>
	<li>Custom text colors do not apply to linked text, such as the TV Tropes squares.</li>
</ul>

<h2 class="section" style="margin-top:3em;">Acknowledgements</h2>

<p>Thanks are owed to the following people, websites, and entities, among others:</p>

<ul id="acknowledgements_list">
	<li>Wikipedia, for a number of lists, including the <a href="http://en.wikipedia.org/wiki/Aarne%E2%80%93Thompson_classification_system">Aarne-Thompson</a>.</li>
	<li>Worlds Without End, for <a href="https://www.worldswithoutend.com/resources_sub-genres.asp">their speculative subgenre lists</a>.</li>
	<li><span style='white-space: nowrap;'><a href='http://ysabetwordsmith.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/user.png' alt='[personal profile] ' width='17' height='17' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://ysabetwordsmith.dreamwidth.org/'><b>ysabetwordsmith</b></a></span>,
		for compiling a ton of lists, for promoting this page to a lot of people, and for creating the community 
		<span style='white-space: nowrap;'><a href='http://allbingo.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/community.png' alt='[community profile] ' width='16' height='16' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://allbingo.dreamwidth.org/'><b>allbingo</b></a></span>
		to support creative uses of bingo tables.
	</li>
	<li>The moderators of the <img class="i-ljuser-userhead ContextualPopup ContextualPopup" src="http://l-stat.livejournal.com/img/community.gif?v=556?v=111.8"></a><a href="http://hc-bingo.livejournal.com/" class="i-ljuser-username"><b>hc_bingo</b> /
		<span style='white-space: nowrap;'><a href='http://hc-bingo.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/community.png' alt='[community profile] ' width='16' height='16' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://hc-bingo.dreamwidth.org/'><b>hc_bingo</b></a></span>
		community, who have kindly given permission for their lists to be reprinted here.
		
	</li>
	<li><span style='white-space: nowrap;'><a href='http://sashataakheru.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/user.png' alt='[personal profile] ' width='17' height='17' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://sashataakheru.dreamwidth.org/'><b>sashataakheru</b></a></span>,
		for compiling the Rider-Waite-Smith and Wildwood Tarot lists.	
	</li>
	<li>All the people who have pointed out bugs, suggested improvements, donated, and expressed enthusiasm for what was originally just a fun little project
		to burn some time one evening. This page would have stopped at a 5x5, load-your-own-lists, no-customization widget if not for the infectious excitement
		of creative folks. &hearts;
	</li>
</ul>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('web');
?>