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
			<label for="number">Number to generate:</label> <input name="number" type="text" class="num_only" size="4" maxlength="4" value="<?php
				if ( isset($number) ) { echo $number; } else { echo "4"; }
			?>"/>
		</div>
		
		<div class="admin">
			<label for="number">Links not working?</label> <input id="rebind" name="rebind" type="button" value="fix buttons"/>
		</div>
		
		<div class="admin">
			<label for="number">Generate!</label> <input name="submit" type="submit" value="&raquo;"/>
		</div>
	</fieldset>
	
	<fieldset id="options" class="comma_value_loading"><legend>Options</legend>
		<h4>Add a new category manually...</h4>
		
		<div style="margin-top:1em;"><a class="add_category">[Add Category]</a></div><br />
		
		<h4>...or enter a comma-delimited list of values:</h4>

		<label for="comma_list_label">Category Name:</label> <input type="text" name="comma_list_label" id="comma_list_label" /><br /><br />
		
		<label for="comma_delimited_list">Comma-Delimited Options:</label> <textarea cols="60" rows="10" name="comma_delimited_list" id="comma_delimited_list"></textarea><br /><br />
		
		<button type="button" name="submit_comma_list" id="submit_comma_list" onclick="import_comma_list()">Generate category from values &raquo;</button>
	</fieldset>

<?php
if (isset($categories)) {
	// Generate fieldsets based on the last loaded options.
	foreach ($categories as $category_name => $category_values) {
			// Kludge to clean out extra 's until I work out what's causing them.
			$category_name = preg_replace("/^'/", "", $category_name);
			$category_name = preg_replace("/'$/", "", $category_name);
			$category_name = str_replace('_', ' ', $category_name);
			
			
		echo '<fieldset id="'.$category_name.'" class="demographic_category"><legend>'.$category_name.' <a class="delete_category">[delete]</a></legend>';
			echo '<a class="add_option">[Add Option]</a>';
			foreach ($category_values as $value_name => $value_weight) {
				$value_name = preg_replace("/^'/", "", $value_name);
				$value_name = preg_replace("/'$/", "", $value_name);
				$value_name = str_replace('_', ' ', $value_name);
				echo '<div class="'.$category_name.' demographic_option">';
				echo '<label for="categories[\''.$category_name.'\'][\''.$value_name.'\']">'.$value_name.'</label> <input name="categories[\''.$category_name.'\'][\''.$value_name.'\']" type="text" class="option_weight num_only" size="4" maxlength="4" value="'.$value_weight.'" />';
				echo '<a class="delete_option">[delete]</a> ';
				echo '</div>';
			}
		echo '</fieldset>';
	}
	
} else {
	// Give the users a default fieldset as an example.
?>
	<fieldset id="Gender" class="demographic_category"><legend>Gender <a class="delete_category">[delete]</a></legend>
		<a class="add_option">[Add Option]</a>
		&emsp; | &emsp; 
		<input type="checkbox" name="use_values_only_once['Gender']" id="use_values_only_once['{CATEGORY}']" value="true" /> 
		<label class="nostyle" for="use_values_only_once['Gender']">Use each option only once per generated set</label>
		<hr />
		
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
<?php } /* End default fieldset display. */ ?>
<?php echo CHtml::endForm(); ?>

</div>

<?php
	/***********************/
	/* PAGE FINAL - Tipjar */
	/***********************/
	
	SiteElement::get_tipjar('web');
?>
