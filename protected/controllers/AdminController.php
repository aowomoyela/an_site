<?php
class AdminController extends Controller {
	/********************************************/
	/* Behavioral and administrative functions. */
	/********************************************/
	// Apply filters
	public function filters() {
		$filters = array();
		// Restrict access to administrators.
		$filters[] = array('application.filters.AdminAuthFilter');
		return $filters;
	}
	
	// Control access.
	public function accessRules() {
		return array(
			//Deny access to anonymous ('?') users
			array('deny',
				'users' => array('?'),
			),
			
			//Allow access to authenticated ('@') users
			array('allow',
				'actions' => array(
					'index',
					'debug',
					'edit_story',
				),
				'users' => array('@'),
			),
			
			//Restrict all access not otherwise specified
			array('deny',
				'users' => array('*'),
			),
		);

	}
	
	/**************************/
	/* Actions, at long last. */
	/**************************/
	
	/* General actions. */

	public function actionIndex() {
		// Landing page.
		#$this->layout = 'admin_default';
		$this->render('index');
	}
	
	
	public function actionDebug() {
		#$this->layout = 'admin_default';
		$this->render('debug');
	}

	/* Editing and management. */

	public function actionEdit_story() {
	try {
		// Switch behavior based on whether or not this is a form submission.
		if ( Yii::app()->request->isPostRequest ) {
			// We're being asked to update a fiction record.
		} elseif ( isset($_GET['story_id']) ) {
			// Load the editor for this particular story.
			$story_id = (int)$_GET['story_id'];
			$story = Story::model()->find(array(
				'select'=>'*',
				'condition'=>'story_id=:story_id',
				'params'=>array(':story_id'=>$story_id),
			));
		
			// If the story is found, allow editing.
			if ( is_null($story) ) {
				throw new Exception('That story was not found in the database.');
			} else {
				$this->render('edit_story', array('story'=>$story));
			} 
		} else {
			// Load up a list of stories.
		}
	} catch (Exception $e) {
		// Exception handling.
	} }
	
}
?>
