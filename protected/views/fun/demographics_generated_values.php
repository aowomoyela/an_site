<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/demographics_generator.css');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');
?>

<h2>Character Demographics Randomizer</h2>
<h3>Your results are below!</h3>

<p>What would you like to do now?</p>

<?php echo CHtml::beginForm( array('fun/demographics_generator'), 'post', array('id'=>'reload_option_sets') ); ?>
	<fieldset><legend>Go back to your demographics options setup</legend>
		<textarea name="categories" style="display:none;"><?php echo json_encode($categories); ?></textarea>
		<input type="hidden" name="number" value="<?php echo $number; ?>" />
		<input type="hidden" name="reload_data" value="true" />
		<input type="submit" value="Re-load your option sets &raquo;">
	</fieldset>
<?php echo CHtml::endForm(); ?><br />

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'load_into_bingo') ); ?>
	<fieldset><legend>Load the generated option sets into the bingo card generator</legend>
		<?php
			$list_csv = '';
			foreach ($results as $result) {
				foreach ($result as $category_name => $category_value) {
					// Kludge to clean out extra 's until I work out what's causing them.
					$category_name = preg_replace("/^'/", "", $category_name);
					$category_name = preg_replace("/'$/", "", $category_name);
					$category_value = preg_replace("/^'/", "", $category_value);
					$category_value = preg_replace("/'$/", "", $category_value);
					// Underscores to spaces.
					$category_name = str_replace('_', ' ', $category_name);
					$category_value = str_replace('_', ' ', $category_value);
					// Commas to... something not-comma.
					$category_name = str_replace(',', '-', $category_name);
					$category_value = str_replace(',', '-', $category_value);
					$list_csv.=$category_name.': '.$category_value."\r\n";
				}
				$list_csv.= ', '."\r\n\r\n";
			}
		?>
		<textarea name="list" style="display:none;"><?php echo $list_csv; ?></textarea>
		<input type="submit" value="Port sets into bingo generator &raquo;">
	</fieldset>
<?php echo CHtml::endForm(); ?>

<ol>
<?php
	foreach ($results as $result) {
		echo "<li class=\"individual_listing\"><ul>\r\n";
		foreach ($result as $category_name => $category_value) {
			// Kludge to clean out extra 's until I work out what's causing them.
			$category_name = preg_replace("/^'/", "", $category_name);
			$category_name = preg_replace("/'$/", "", $category_name);
			$category_value = preg_replace("/^'/", "", $category_value);
			$category_value = preg_replace("/'$/", "", $category_value);
			$category_name = str_replace('_', ' ', $category_name);
			$category_value = str_replace('_', ' ', $category_value);
			echo "<li><strong>$category_name:</strong> $category_value</li>\r\n";
		}
		echo "</ul></li>\r\n\r\n";
	}
?>
</ol>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('web');
?>