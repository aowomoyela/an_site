<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/demographics_generator/demographics_handler.js');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/demographics_generator.css');
?>

<h2>Character Demographics Randomizer</h2>
<h3>Inspired by 
	<span style='white-space: nowrap;'><a href='http://alexconall.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/user.png' alt='[personal profile] ' width='17' height='17' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://alexconall.dreamwidth.org/'><b>alexconall</b></a></span>'s
	<a href="https://docs.google.com/document/d/1cVY6GD7RfL9ltZOUjp6wkGQcKzk-PImQd6YU4AAZTGE/edit?pli=1">Excel demographics generator</a>
</h3>

<div id="form_containter">
<?php echo CHtml::beginForm( array('fun/demographics_generator'), 'post', array('id'=>'demographics_generator') ); ?>
	<fieldset id="gender" class="demographic_category"><legend>Gender <a class="delete_category">[delete]</a></legend>
		<a class="add_option">[Add Option]</a>
		<div class="gender demographic_option">
			<label for="gender['male']">Male</label> <input name="gender['male']" type="text" class="option_weight" size="4" maxlength="4" value="45" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="gender demographic_option">
			<label for="gender['female']">Female</label> <input name="gender['female']" type="text" class="option_weight" size="4" maxlength="4" value="46" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="gender demographic_option">
			<label for="gender['agender']">Agender</label> <input name="gender['agender']" type="text" class="option_weight" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="gender demographic_option">
			<label for="gender['other_non_binary']">Other Non Binary</label> <input name="gender['other_non_binary']" type="text" class="option_weight" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="gender demographic_option">
			<label for="gender['genderfluid']">Genderfluid</label> <input name="gender['genderfluid']" type="text" class="option_weight" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
	</fieldset>
<?php echo CHtml::endForm(); ?>

<div style="margin-top:1em;"><a class="add_category">[Add Category]</a></div>

</div>
