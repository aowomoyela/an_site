<h2 class="section">Fiction</h2>

<?php
	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $fiction_adm_nav);
	echo '</div>'."\r\n";
?><br />

<h2 class="section">Fun</h2>

<?php
	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $fun_adm_nav);
	echo '</div>'."\r\n";
?><br />

<p>I have no idea how to fill out the rest of this page, so here's a picture of the crescent sun.  Because <em>eclipse</em>.</p>

<img src="<?php echo Yii::app()->baseUrl; ?>/images/do_not_ask/crescent_sun.jpg" style="display:block; margin-left:auto; margin-right:auto;" />

