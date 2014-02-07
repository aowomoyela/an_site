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

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'bingo_generator') ); ?>
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
	<optgroup label="TVTropes">
		<option value="tvtropes/horror_tropes">Horror Tropes (fetched 8 January 2014)</option>
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
	
	</fieldset><br />
		
	<input type="submit" value="Create a bingo card &raquo;" /><br /><br />
<?php echo CHtml::endForm(); ?>


<h3 style="margin-top:3em;"><?php echo $message; ?></h3>
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
			if ($position == $free_space_square) {
				$html_string.= "FREE SPACE";
			} elseif ($position < $free_space_square) {
				$index = $position - 1;
				$html_string.= trim($bingo_squares[$index]);
			} else {
				$index = $position - 2;
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
<ul>
	<li>Commas inside values of pre-made lists always appear as delimiters when loaded, no matter how well-escaped they are.</li>
	<li>Custom text colors do not apply to linked text, such as the TV Tropes squares.</li>
</ul>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('web');
?>