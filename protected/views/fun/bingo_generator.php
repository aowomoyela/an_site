<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
?>

<h2>Let's make you a bingo card!</h2>

<h3 style="margin-top:2em;">Input a comma-separated list of at least <span class="num_card_elements"><?php echo $num_card_elements; ?></span> values.</h3>

<p>If one of your values needs a comma, use the HTML code <strong>&amp;#44;</strong> in place of the comma <em>within</em> the value.</p>

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'bingo_generator') ); ?>
	<textarea id="bingo_list" name="list" cols="94" rows="10"><?php echo $list; ?></textarea><br /><br />
	<input type="checkbox" name="use_repeat_values" value="1" <?php if($use_repeat_values){ echo 'checked="checked"'; } ?> />
		Allow repeated values for lists with under <span class="num_card_elements"><?php echo $num_card_elements; ?></span> items?<br /><br />
	<input type="submit" value="Create a bingo card &raquo;" /><br /><br />
<?php echo CHtml::endForm(); ?>

<p><strong>Or choose one or more of these:</strong></p>
<p><select name="list_loader" id="list_loader" multiple="multiple" size="8">
	<option value="empty">(empty)</option>
	<optgroup label="Fiction-writing prompts">
		<option value="polti_dramatic_situations">Georges Polti's 19th-century list of 36 dramatic situations</option>
		<option value="robert_plutchik_emotion_list">Robert Plutchik's 1980 list of emotions</option>
	</optgroup>
	<optgroup label="Life, lifestyle and living resources">
		<option value="little_self-care_tasks">Little actions for self-care</option>
		<option value="little_housekeeping_tasks">Little housekeeping tasks</option>
	</optgroup>
</select></p>
<p>(You can also edit these lists in the editor above, after loading them.)</p>

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
			$html_string.= '<td style="border:1px solid #000; height:10em; width:10em; text-align:center;">';
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