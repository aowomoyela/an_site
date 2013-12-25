<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
?>

<h2>Let's make you a bingo card!</h2>

<h3 style="margin-top:3em;">Input a comma-separated list of at least <?php echo $num_card_elements; ?> values.</h3>
<p>(Or choose from one of these: <select name="list_loader" id="list_loader">
	<option value="empty">(empty)</option>
	<optgroup label="Premade lists">
		<option value="polti_dramatic_situations">Georges Polti's 19th-Century List of 36 Dramatic Situations</option>
	</optgroup>
</select>)</p>

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'bingo_generator') ); ?>
	<textarea id="bingo_list" name="list" cols="94" rows="10"><?php echo $list; ?></textarea><br /><br />
	<input type="submit" value="Create a bingo card &raquo;" />
<?php echo CHtml::endForm(); ?>	
</form>

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
				//$html_string.=count($bingo_squares);
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

