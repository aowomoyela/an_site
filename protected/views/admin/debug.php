<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
?>

<p>Debug page. Nothing to see here.</p><hr />

<?php
#	phpinfo();
#	$story = Story::model()->findByPk(27);
#
#	new dBug( $story->get('publication_category') );
?>
