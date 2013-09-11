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
					'phpinfo',
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
		$this->render('index');
	}
	
	
	public function actionDebug() {
		$this->render('debug');
	}


	public function actionPhpinfo() {
		phpinfo();
	}


	/* Editing and management. */

	public function actionEdit_story() {
	try {
		// Switch behavior based on whether or not this is a form submission.
		if ( Yii::app()->request->isPostRequest ) {
			// We're being asked to update a fiction record.
			#new dBug( $_POST );
			// Load the appropriate model.
			if ( $_POST['Story']['story_id'] == 'new' ) {
				// Create a new story record.
				$story = new Story();
			} else {
				// Find the existing record.
				$story_id = (int)$_POST['Story']['story_id']; 
				$story = Story::model()->findByPk( $story_id );
			}

			// If the story is successfully created or found, allow saving.
			if ( is_null($story) ) {
				throw new Exception('That story was not found in the database.');
			} else {
				foreach ( $_POST as $pkey => $pval ) {
					$story->set($pkey, $pval);
				}

				foreach ( $_POST['Story'] as $pskey => $psval ) {
					$story->set($pskey, $psval);					
				}

				$mode = "save";
				switch ($mode) {
					case "save":
						echo "Running in save() mode.<hr />";
						$story->save();
					break;

					case "update":
						echo "Running in update() mode.<hr />";
						// Hopefully-temporary workarounds to deal with save() not wanting to function.
						if ( $_POST['Story']['story_id'] == 'new' ) {
							$story->insert();
						} else {
							$story->update();
						}
					break;
				}

				// Return the admin to a meaningful page.
				# $this->layout = "main";
				# $this->render('admin/edit_story', array("story"=>$story, "message"=>"Story updated."));
				Yii::app()->redirect( array('admin/edit_story', 'story_id'=>(int)$_POST['Story']['story_id']) );
			}

		} elseif ( isset($_GET['story_id']) ) {
			// Allow users to load existing stories or create new ones.
			if ( $_GET['story_id'] == 'new' ) {
				$story = new Story();
			} else {
				// Find the story in the database.
				$story_id = (int)$_GET['story_id'];
				$story = Story::model()->find(array(
					'select'=>'*',
					'condition'=>'story_id=:story_id',
					'params'=>array(':story_id'=>$story_id),
				));
			}
		
			// If the story is found, allow editing.
			if ( is_null($story) ) {
				throw new Exception('That story was not found in the database.');
			} else {
				// Get publication categories for dropdown list.
				$publication_categories = StoryPublicationCategory::model()->findAll( array(
					'order'=>'title',
				) );
				$publication_categories = CHtml::listData( $publication_categories, 'publication_category_id', 'title' );
				// Get publication markets for dropdown list.
				$story_markets_query = 'select sm.market_id, sm.title, smt.type from story_market sm, story_market_type smt ';
				$story_markets_query.= 'where sm.market_type_id = smt.type_id order by smt.type, sm.title';
				$story_markets = StoryMarket::model()->findAllBySql($story_markets_query);
				$story_markets = CHtml::listData( $story_markets, 'market_id', 'title', 'type' );
				// Render the view with all the appropriate resources.
				$this->render('edit_story', array('story'=>$story, 'publication_categories'=>$publication_categories, 'story_markets'=>$story_markets));
			}
		} else {
			// Load up a list of stories.
		}
	} catch (Exception $e) {
		// Exception handling.
	} }
	
}
?>
