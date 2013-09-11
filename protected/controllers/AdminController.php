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

		// Switch behavior based on whether or not this is a form submission.
		if ( Yii::app()->request->isPostRequest ) {
			// We're being asked to update a fiction record.
			#new dBug( $_POST );
			#echo "<p>Post data loaded.</p>";
			// Load the appropriate model.
			if ( $_POST['Story']['story_id'] == 'new' ) {
				// Create a new story record.
				#echo "<p>About to create story object.</p>";
				$story = new Story();
				#echo "<p>Story object created.</p>";
			} elseif (is_numeric($_POST['Story']['story_id']) || is_int($_POST['Story']['story_id'])) {
				// Find the existing record.
				$story_id = (int)$_POST['Story']['story_id'];
				#echo "<p>Finding story by primary key.</p>";
				$story = Story::model()->findByPk( $story_id );
				#echo "<p>isNewRecord: "; new dBug($story->isNewRecord); echo "<p>";
			} else {
				throw new Exception("Invalid story_id.");
			}

			// If the story is successfully created or found, allow saving.
			if ( is_null($story) ) {
				throw new Exception('That story was not found in the database.');
			} else {
				#unset($_POST['Story']['story_id']);

				foreach ( $_POST as $pkey => $pval ) {
					$story->set($pkey, $pval);
				}

				foreach ( $_POST['Story'] as $pskey => $psval ) {
					$story->set($pskey, $psval);					
				}

				#echo "<p>Pre-saving for story ID '".$story->get('story_id')."'</p>";
				$story->save(); // Yii is trying to use INSERT on all save queries for some reason. >_<
				/*if ( $_POST['Story']['story_id'] == 'new' ) {
					$story->insert();
				} elseif( is_numeric($_POST['Story']['story_id']) || is_int($_POST['Story']['story_id']) ) {
					$story->update();
				} else {

				}*/
				#echo "<p>Saved, presumably...</p>";

				// Return the admin to a meaningful page.
				$this->layout = "main";
				$this->render('edit_story', array("story"=>$story, "message"=>"Story updated.", 'publication_categories'=>$publication_categories, 'story_markets'=>$story_markets));
			}

		} elseif ( isset($_GET['story_id']) ) {
			// Allow users to load existing stories or create new ones.
			if ( $_GET['story_id'] == 'new' ) {
				$story = new Story();
				$story->set_id_to_new();
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
				// Render the view with all the appropriate resources.
				$this->render('edit_story', array('story'=>$story, 'publication_categories'=>$publication_categories, 'story_markets'=>$story_markets));
			}
		} else {
			// Load up a list of stories.
		}
	} catch (Exception $e) {
		// Exception handling.
		echo "<p>".$e->getMessage()."</p>"; // Temporary.
	} }
	
}
?>
