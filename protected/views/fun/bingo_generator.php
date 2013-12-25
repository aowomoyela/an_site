<h2><?php echo $message; ?></h2>
<?php
	$position = 1;
	$free_space_square = ceil( pow($card_size, 2)/2 );
	// Set up the HTML
	$html_string = '<table style="width:auto; display:inline; margin-left:auto; margin-right:auto;">'."\r\n\r\n";
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
				$html_string.= strip_tags(trim($bingo_squares[$index]));
			} else {
				$index = $position - 2;
				$html_string.= strip_tags(trim($bingo_squares[$index]));
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
	echo '<h3>And here is your code:<h3>';
	echo '<p><textarea cols="94" rows="25">'.$html_string.'</textarea></p>';
?>

<hr />

<h3>Input a comma-separated list of values:</h3>

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'bingo_generator') ); ?>
	<textarea name="list" cols="94" rows="25"></textarea><br /><br />
	<input type="submit" value="Create a bingo card &raquo;" />
<?php echo CHtml::endForm(); ?>	
</form>