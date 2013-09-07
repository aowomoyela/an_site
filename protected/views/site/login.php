<?php
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/form.css');
?>
<div class="form">
<form name="login" action="<?php echo $this->createUrl('site/login'); ?>" method="post">
	<div class="form_row">
		<label for="username">Name:</label>
		<input type="text" name="username" />
	</div>
	
	<div class="form_row">
		<label for="password">Code:</label>
		<input type="password" name="password" />
	</div>	

	<div class="form_row">	
		<input type="submit" value="log in &raquo;" class="inline_sans_label form_submit">
	</div>
</form>
</div>
