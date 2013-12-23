<?php
	/****************/
	/* Load assets. */
	/****************/
	
	$baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/brushed_metal/submissions.css');
		$cs->registerCssFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css');
		$cs->registerScriptFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
	$cs->registerScriptFile($baseUrl.'/js/admin/datepicker.js');

	echo '<div id="submenu_horizontal">'."\r\n";
		$this->widget('zii.widgets.CMenu', $secondary_navigation);
	echo '</div>'."\r\n";
	
	/**********************************/
	/* Error and result notification. */
	/**********************************/

	if ( isset($error) ) {
		echo "<div class='page_error'>$error</div>\r\n";
	}

	if ( isset($message) ) {
		echo "<div class='page_message'>$message</div>\r\n";
	}

?>

<h3 style="margin-top:2em;">New Submission</h3>

<table>
	<tr>
		<th>&nbsp;</th>
		<th>Story</th>
		<th>Draft</th>
		<th>Market</th>
		<th>Submitted</th>
		<th>&nbsp;</th>
	</tr>
	
	<tr>
	<?php
		echo CHtml::beginForm( array('admin/manage_submissions'), 'post', array('id'=>'new_submission_form') );
	?>
	<td>NEW</td>
		<td>
		<?php echo CHtml::activeDropDownList($new_submission, 'story_id', $stories, array(
			'options' => array(
				 #$sub->get('market_id') => array('selected'=>true),
			),
			'empty' => '(none)',
		)); ?>
	</td>
	<td><?php echo CHtml::activeTextField($new_submission, 'draft_number', array("size"=>"1")); ?></td>
	<td>
		<?php echo CHtml::activeDropDownList($new_submission, 'market_id', $story_markets, array(
			'options' => array(
				 #$sub->get('market_id') => array('selected'=>true),
			),
			'empty' => '(none)',
		)); ?>
	</td>
	<td><?php 
		echo CHtml::activeTextField($new_submission, 'submitted', array("readonly"=>"readonly", "class"=>"datepicker", "size"=>"10"));
	?></td>
	<td><input type="submit" value="&raquo;"></td>
	<?php echo CHtml::endForm(); ?>
</tr>
</table>

<h3 style="margin-top:2em;">Past Submissions</h3>

<table>
	<tr>
		<th>ID</th>
		<th>Story</th>
		<th>Draft</th>
		<th>Market</th>
		<th>Submitted</th>
		<th>Returned</th>
		<th>Response</th>
		<th>Days</th>
	</tr>

<?php

	foreach ($submissions as $sub) {
		// Determine display options.
		if ( isset($sub->story_submission_response) ) {
			if ( in_array( $sub->story_submission_response->get('response_id'), array(1, 5, 6)) ) {
				// Happy things! Acceptances, requests, etc.
				$tr_class = "acceptance";
			} else {
				$tr_class = "normal";
			}
		} else {
			$tr_class = "waiting";
		}
		// Print out the row.
		echo '<tr class="'.$tr_class.'">';
		if ( !isset($sub->story_submission_response) ) {
			echo CHtml::beginForm( array('admin/edit_submission'), 'post', array('id'=>'edit_submission_form'.$sub->get('submission_id')) );
			echo CHtml::activeHiddenField( $sub, 'submission_id' );
		}
		echo '<td>'.$sub->get('submission_id').'</td>';
		echo '<td>'.$sub->story->get('title').'</td>';
		echo '<td>'.$sub->get('draft_number').'</td>';
		echo '<td>'.$sub->story_market->get('title').'</td>';
		echo '<td>'.$sub->get('submitted').'</td>';
		echo '<td>';
			if ( isset($sub->story_submission_response) ) { echo $sub->get('returned'); }
			else {
				echo CHtml::activeTextField($sub, 'returned', array("readonly"=>"readonly", "class"=>"datepicker", "size"=>"10"));
			}
		echo '</td>';
		echo '<td>';
			if ( isset($sub->story_submission_response) ) { echo $sub->story_submission_response->get("response"); }
			else {
				echo "(Response dropdown)";
			}
		echo '</td>';
		echo '<td>'.days_out($sub->get('submitted'), $sub->get('returned')).'</td>';
		if ( !isset($sub->story_submission_response) ) {
			echo CHtml::endForm();
		}
		echo '</tr>';
	}

?>

</table>