<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/bingo_generator/list_loader.js');
?>

<p>Debug page. Nothing to see here.</p><hr />

<?php

?>

<h3 style="margin-top:3em;">Input a comma-separated list of at least 24 values.</h3>
<p>Or choose from one of these:</p>
<select name="list_loader" id="list_loader_debug" multiple="multiple" size="8">
	<option value="empty">(empty)</option>
	<optgroup label="General fiction prompt lists">
		<option value="polti_dramatic_situations">Georges Polti's 19th-Century List of 36 Dramatic Situations</option>
	</optgroup>
	<optgroup label="An's idiosyncratic lists">
		<option value="an_favorite_fiction_kinks">(Some of) An's various and often undefined favorite fiction kinks</option>
	</optgroup>
</select>

<p>If one of your values really needs a comma, use the HTML code <strong>&amp;#44;</strong> in place of the comma within the value.</p>

<?php echo CHtml::beginForm( array('fun/bingo_generator'), 'post', array('id'=>'bingo_generator_debug') ); ?>
	<textarea id="bingo_list_debug" name="list" cols="94" rows="10"></textarea><br /><br />
	<input type="submit" value="Create a bingo card &raquo;" />
<?php echo CHtml::endForm(); ?>