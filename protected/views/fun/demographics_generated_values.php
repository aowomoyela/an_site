<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/demographics_generator.css');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');
?>

<h2>Character Demographics Randomizer</h2>
<h3>Here are your results! (<a href="<?php echo Yii::app()->createUrl('fun/demographics_generator'); ?>">Generate more?</a>)</h3>

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