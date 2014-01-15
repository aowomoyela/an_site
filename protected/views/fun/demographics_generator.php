<?php
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/fun/demographics_generator/demographics_handler.js');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/fun/demographics_generator.css');
	$cs->registerCssFile($baseUrl.'/css/brushed_metal/tipjar.css');
?>

<h2>Character Demographics Randomizer</h2>
<p><strong>Inspired by 
	<span style='white-space: nowrap;'><a href='http://alexconall.dreamwidth.org/profile'><img src='http://www.dreamwidth.org/img/silk/identity/user.png' alt='[personal profile] ' width='17' height='17' style='vertical-align: text-bottom; border: 0; padding-right: 1px;' /></a><a href='http://alexconall.dreamwidth.org/'><b>alexconall</b></a></span>'s
	<a href="https://docs.google.com/document/d/1cVY6GD7RfL9ltZOUjp6wkGQcKzk-PImQd6YU4AAZTGE/edit?pli=1">Excel demographics generator</a>.
</strong>  <em>Please note that this generator is still in alpha.</em></p>

<p>Play around using the following form, using the gender fields as an example. Categories might include things such as sexuality, nationality,
	ethnicity, temperament, age range, etc. The numbers after each option define the <em>ratios</em> of each individual option to the others
	in its category: if you want to use percents, just make sure they add up to 100.</p>
	
<p>Each of the options is randomized without taking into account the values of the others. That is, there will be a free association between
	options from each category. If you need to account for different variances in different populations – for example, the higher incidences of
	certain professions by gender – please run multiple generations.</p>
	
<p>Please note that this code has not been optimized yet, and may take a bit of time to run – a few seconds at 100 generations with four categories
	with 3-5 options each, and longer for more.</p>

<h3>Anyway, here's the form (JavaScript must be enabled):</h3>

<div id="form_containter">
<?php echo CHtml::beginForm( array('fun/demographics_generator'), 'post', array('id'=>'demographics_generator') ); ?>
	<fieldset id="options" class="meta_options"><legend>Options</legend>
		<div class="admin">
			<label for="number">Number to generate:</label> <input name="number" type="text" class="num_only" size="4" maxlength="4" value="10"/>
		</div>
		
		<div class="admin">
			<label for="number">Generate!</label> <input name="submit" type="submit" value="&raquo;"/>
		</div>
	</fieldset>

	<fieldset id="Gender" class="demographic_category"><legend>Gender <a class="delete_category">[delete]</a></legend>
		<a class="add_option">[Add Option]</a>
		<div class="Gender demographic_option">
			<label for="categories['Gender']['male']">Male</label> <input name="categories['Gender']['Male']" type="text" class="option_weight num_only" size="4" maxlength="4" value="45" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="Gender demographic_option">
			<label for="categories['Gender']['Female']">Female</label> <input name="categories['Gender']['Female']" type="text" class="option_weight num_only" size="4" maxlength="4" value="46" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="Gender demographic_option">
			<label for="categories['Gender']['Agender']">Agender</label> <input name="categories['Gender']['Agender']" type="text" class="option_weight num_only" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="Gender demographic_option">
			<label for="categories['Gender']['Other_non_binary']">Other Non Binary</label> <input name="categories['Gender']['Other_non_binary']" type="text" class="option_weight num_only" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
		<div class="Gender demographic_option">
			<label for="categories['Gender']['Genderfluid']">Genderfluid</label> <input name="categories['Gender']['Genderfluid']" type="text" class="option_weight num_only" size="4" maxlength="4" value="3" />
			<a class="delete_option">[delete]</a> 
		</div>
	</fieldset>
<?php echo CHtml::endForm(); ?>

<div style="margin-top:1em;"><a class="add_category">[Add Category]</a></div>

</div>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('web');
?>
