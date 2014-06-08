<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
?>

<p>Debug page. Nothing to see here.</p><hr />

<?php
	
	$i = 1;
	$last_number = 0;
	while ($i <= 25) {
		do {
			$this_number = rand(1, 9)*50;
		} while ($this_number == $last_number);
		
		echo $this_number . "<br />";
		
		$last_number = $this_number;
		
		$i++;
	}

?>