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
					'manage_submissions',
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
		$fiction_adm_nav = SiteElement::get_secondary_nav_array('admin_fiction');
		$fun_adm_nav = SiteElement::get_secondary_nav_array('admin_fun');
		$this->render('index', array(
			'fiction_adm_nav'=>$fiction_adm_nav,
			'fun_adm_nav'=>$fun_adm_nav,
		));
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
			// Load the appropriate model.
			if ( $_POST['Story']['story_id'] == 'new' ) {
				// Create a new story record.
				$story = new Story();
			} elseif (is_numeric($_POST['Story']['story_id']) || is_int($_POST['Story']['story_id'])) {
				// Find the existing record.
				$story_id = (int)$_POST['Story']['story_id'];
				$story = Story::model()->findByPk( $story_id );
			} else {
				throw new Exception("Invalid story_id.");
			}

			// If the story is successfully created or found, allow saving.
			if ( is_null($story) ) {
				throw new Exception('That story was not found in the database.');
			} else {
				// Set everything in the Story model.
				foreach ( $_POST as $pkey => $pval ) {
					$story->set($pkey, $pval);
				}

				foreach ( $_POST['Story'] as $pskey => $psval ) {
					if ($psval == '' || is_null($psval)) {
						$story->set($pskey, new CDbExpression('NULL'));
					} else {
						$story->set($pskey, $psval);
					}
				}

				$story->save(false); // Yii is trying to use INSERT on all save queries for some reason. >_<
				$story_id = $story->getPrimaryKey();
			
				// Handle the publication categories.
				if ( isset($_POST['Story']['publication_categories']) ) {
					// Remove all the old publication categories from the database.
					$clear_categories_query = "delete from link_story_publication_category where story_id = '$story_id'";
					SiteUtility::queryDo($clear_categories_query);
					// Add all the current publication categories to the database.
					$set_categories_query = "insert into link_story_publication_category (story_id, publication_category_id) values ";
					$set_categories_order = 1; // Track if we need a comma.
					foreach ($_POST['Story']['publication_categories'] as $category_id) {
						if ($set_categories_order > 1) { $set_categories_query.= ', '; }
						$set_categories_query.= "('$story_id', '$category_id')";
						$set_categories_order++;
					}
					SiteUtility::queryDo($set_categories_query);
				}

				// Return the admin to a meaningful page.
				// // First, we have to make sure the story object has actual null values, not CDbExpression null objects.
				$cdbnull = new CDbExpression('NULL');
				foreach($story as $property => $value) {
					if ($value == $cdbnull) { $story->set($property, null); }
				}
				// // Then, we have to provide story links so the page won't throw an error on rendering.
				$story_links = StoryLink::model()->findAll(array(
					'select'=>'*',
					'condition'=>'story_id=:story_id',
					'params'=>array(':story_id'=>$story_id),
				));
				// // Then we can actually render the page.
				$this->layout = "main";
				$this->render('edit_story', array(
					"story"=>$story, 
					"message"=>"Story updated.", 
					'publication_categories'=>$publication_categories, 
					'story_markets'=>$story_markets, 
					'story_links'=>$story_links
				));
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
			} elseif ( $story->get('story_id') != 'new') {
				// Get a list of the story's links.
				$story_links = StoryLink::model()->findAll(array(
					'select'=>'*',
					'condition'=>'story_id=:story_id',
					'params'=>array(':story_id'=>$story_id),
				));
			} else {
				$story_links = array();
			}
			// Render the view with all the appropriate resources.
			$this->render('edit_story', array(
				'story'=>$story,
				'publication_categories'=>$publication_categories,
				'story_markets'=>$story_markets,
				'story_links'=>$story_links,
			));
		} else {
			// Determine category ID.
			if ( !isset( $_GET["publication_category_id"] ) ) {
				$publication_category_id = '1';
			} else {
				if ( is_numeric($_GET["publication_category_id"]) || is_int($_GET["publication_category_id"]) ) {
					$publication_category_id = (int)$_GET["publication_category_id"];
				} else {
					$publication_category_id = '1';
				}
			}
			// Load up a list of stories.
			/*$stories = Story::model()->with('story_publication_category')->findAllByAttributes(
				array('publication_category_id'=>$publication_category_id), 
				array('order'=>'title')
			);*/
			$stories = Story::model()->with('story_market', 'story_link', 'story_publication_category')->findAll( array(
				#'select'=>'t.title, wordcount, link, link_active, pullquote, story_market.title, publication_date, available_in_archive, archive_url_title',
				'order'=>'t.title',
				'condition'=>'story_publication_category.publication_category_id = '.$publication_category_id,
			));
			// Grab a list of publication categories.
			$pub_cat_query = "select publication_category_id, title from story_publication_category order by title";
			$publication_categories = SiteUtility::queryFull($pub_cat_query);
			$this->render('edit_story_list', array('stories'=>$stories, 'publication_categories'=>$publication_categories, 'publication_category_id'=>$publication_category_id));
		}
	} catch (Exception $e) {
		// Exception handling.
		echo "<p>".$e->getMessage()."</p>"; // Temporary.
	} } // END public function actionEdit_story()


	public function actionEdit_story_links() {
	try {
		// This is just a processing page. We need POST data in order to do anything.
		if ( !Yii::app()->request->isPostRequest ) { throw new Exception("No data sent."); }
		if ( !isset( $_POST["StoryLink"] ) ) { throw new Exception("No StoryLink data sent."); }
		// Okay, we've got POST data.  Let's... do... stuff.
		// Is this a new link or an update to an existing link?
		if ( $_POST["StoryLink"]['link_id'] == 'new' || $_POST["StoryLink"]['link_id'] == '' || is_null($_POST["StoryLink"]['link_id']) ) {
			// New link.  Create a new StoryLink object for it.
			$story_link = new StoryLink();
		} else {
			// Existing link. Find it in the database.
			$story_link = StoryLink::model()->findByPk( $_POST["StoryLink"]['link_id'] );
		}
		
		foreach ( $_POST['StoryLink'] as $pslkey => $pslval ) {
			if ($pslval == '' || is_null($pslval)) {
				$story_link->set($pslkey, new CDbExpression('NULL'));
			} else {
				$story_link->set($pslkey, $pslval);
			}
		}

		$story_link->save();
		
		// Once that's done, we can go back to the edit_story page.
		$this->redirect( array('admin/edit_story', 'story_id'=>$story_link->get('story_id'), '#'=>'story_links') );
		
		
	} catch (Exception $e) {
			
	} } // END 	public function actionEdit_story_links()


	public function actionManage_submissions() {
	try {
		// Provide secondary navigation.
		$secondary_navigation = SiteElement::get_secondary_nav_array('admin_submissions');
		// Get stories for dropdown list.
		$stories_query = 'select s.story_id, s.title, lspc.publication_category_id, spc.title as category_type ';
		$stories_query.= 'from story s, story_publication_category spc, link_story_publication_category lspc '; 
		$stories_query.= 'where lspc.publication_category_id = spc.publication_category_id && s.story_id = lspc.story_id ';
		$stories_query.= 'order by lspc.publication_category_id, s.title';
		$stories = Story::model()->findAllBySql($stories_query);
		$stories = CHtml::listData( $stories, 'story_id', 'title', 'category_type' );
		// Get publication markets for dropdown list.
		$story_markets_query = 'select sm.market_id, sm.title, smt.type from story_market sm, story_market_type smt ';
		$story_markets_query.= 'where sm.market_type_id = smt.type_id order by smt.type, sm.title';
		$story_markets = StoryMarket::model()->findAllBySql($story_markets_query);
		$story_markets = CHtml::listData( $story_markets, 'market_id', 'title', 'type' );
		// Get possible responses for dropdown.
		$submission_responses = StorySubmissionResponse::model()->findAll();
		$submission_responses = CHtml::listData( $submission_responses, 'response_id', 'response');
		// Get possible responses for dropdown.
		// Get list of submissions.
		if (isset($_GET['story_id'])) {
			$story_id = (int)$_GET['story_id'];
			$where = "`story`.`story_id` = '".$story_id."'";
		} elseif (isset($_GET['market_id'])) {
			$market_id = (int)$_GET['market_id'];
			$where = "story_market.market_id = '".$market_id."'";
		} else {
			$where = '1=1';
		}
		$submissions = StorySubmission::model()->with('story','story_submission_response','story_market')->findAll( array(
			'condition'=>$where,
			'order'=>'submitted DESC',
		) );
		
		
		// Switch behaviors based on whether or not this is a form submission.
		if ( Yii::app()->request->isPostRequest ) {
			// We're being asked to create a new submission or update an existing record.
			// See if there's a submission ID set. If not, it's probably a new submission.
			if ( isset($_POST['StorySubmission']['submission_id']) ) {
				// There is a submission_id.  Try to update the record.
				$submission_record = StorySubmission::model()->findByPk( $_POST['StorySubmission']['submission_id'] );
				foreach ($_POST['StorySubmission'] as $key => $val ) {
					$submission_record->set($key, $val);
				}
				$submission_record->save();
			} else {
				// No submission_id.  Create a new record.
				$new_submission = new StorySubmission;
				foreach ($_POST['StorySubmission'] as $key => $val ) {
					$new_submission->set($key, $val);
				}
				$new_submission->save();
			}
			// Get updated list of submissions.
			$submissions = StorySubmission::model()->with('story','story_submission_response','story_market')->findAll( array(
				'order'=>'submitted DESC',
			) );
			// Create a new story to stock the page's form with.
			$new_submission = new StorySubmission();
			// Render the updated page if there have been no errors.
			$this->render('story_submissions', array(
				'message'=>'Submission logged.',
				'submissions'=>$submissions, 
				'secondary_navigation'=>$secondary_navigation, 
				'new_submission'=>$new_submission,
				'stories'=>$stories,
				'story_markets'=>$story_markets,
				'submission_responses'=>$submission_responses,
			));
		} else {
			// Just show the submissions info page.  Provide an empty 'new' submission in case we want to add a record.
			$new_submission = new StorySubmission();
			// Render the page.
			$this->render('story_submissions', array(
				'submissions'=>$submissions, 
				'secondary_navigation'=>$secondary_navigation, 
				'new_submission'=>$new_submission,
				'stories'=>$stories,
				'story_markets'=>$story_markets,
				'submission_responses'=>$submission_responses,
			));
		}
	} catch  (Exception $e) {
		// Exception handling.
		echo "<p>".$e->getMessage()."</p>"; // Temporary.
	} } // END public function actionManage_submissions()
	
	
	
	public function actionManage_bingo_lists() {
	try {
		// Switch behaviors based on whether or not this is a form submission.
		if ( Yii::app()->request->isPostRequest ) {
			// Handle POST data.
			$resource_path = Yii::app()->basePath.'/..'.'/js/fun/bingo_generator/resources/';
			if (true) { //TO-DO: add validation! While not exhausted.
				$file_name = $_POST['file_name'];
				$file_path = $file_name.'.csv';
			}
			if (true) {
				$file_contents = $_POST['bingo_list'];
			}
			if (true) {
				$list_title = $_POST['list_title'];
			}
			// File functions.
			$new_file_location = $resource_path.$file_path;
			$new_file = fopen($new_file_location,"w");
			fwrite($new_file, $file_contents);
			fclose($new_file);
			// Generate the select option.
			$listing = htmlspecialchars('<option value="'.$file_name.'">'.$list_title.'</option>');
			// Render the page.
			$this->render('bingo_csv_management', array(
				"listing" => $listing,
			));
		} else {
			// Display forms page.
			$this->render('bingo_csv_management', array(
			));
		}
	} catch  (Exception $e) {
		// Exception handling.
		echo "<p>".$e->getMessage()."</p>"; // Temporary.
	} } // END public function actionManageBingoList()
	
}

/***************************/
/* Miscellaneous Functions */
/***************************/

	function days_out($submitted, $returned) {
		/* Takes a date-submitted in the form YYYY-MM-DD and returns difference in days, from current date */
		$sub_bits = explode('-', $submitted);
		if ($returned == '' || $returned == NULL || $returned == '0000-00-00' ) {
			$today = date('d');
			$tomonth = date('m');
			$toyear = date('Y');		
		} else {
			$ret_bits = explode('-', $returned);
			$today = $ret_bits[2];
			$tomonth = $ret_bits[1];
			$toyear = $ret_bits[0];	
		}
		$now_stamp = mktime(0, 0, 0, $tomonth, $today, $toyear);
		$sub_stamp = mktime(0, 0, 0, $sub_bits[1], $sub_bits[2], $sub_bits[0]);
		$difference = $now_stamp - $sub_stamp;
		$days = $difference / 86400;
		return round($days);
	}

?>
