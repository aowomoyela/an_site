<?php

class FictionController extends Controller
{
	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	public function actionIndex() {
		$this->pageTitle = Yii::app()->name.' - Fiction';
		$stories = Story::model()->with('story_market', 'story_link', 'story_publication_category')->findAll( array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, story_market.title, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 1'
		));
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction');
		$this->render('index', array(
			'stories'=>$stories,
			'secondary_navigation'=>$secondary_navigation,
		));
	}

	/***********/
	/* ARCHIVE */
	/***********/

	public function actionArchive() {
		$this->pageTitle = Yii::app()->name.' - Fiction Archive';
		if ( isset($_GET['archive_url_title']) ) {
			// A title was specified; try to find it in the database.
			$story = Story::model()->with('story_publication_category')->find( array(
				'select'=>'title, wordcount, available_in_archive, story_text',
				'condition' => 'archive_url_title=:archive_url_title && available_in_archive = 1',
				'params' => array( ':archive_url_title' => $_GET['archive_url_title'] ),
			));
			$this->render('archive_story', array(
				'title' => $story->get('title'),
				'story_text'=>$story->get_archive_story_text(),
				'publication_category'=>$story->get('publication_category'),
			));
		} else {
			// If no URL title is set, list stories available in the archive.
			$stories = Story::model()->with('story_market', 'story_link', 'story_publication_category')->findAll( array(
				'select'=>'t.title, wordcount, link, link_active, pullquote, story_market.title, publication_date, available_in_archive, archive_url_title',
				'order'=>'t.title',
				'condition'=>'published = 1 && story_publication_category.publication_category_id = 1 && available_in_archive = 1',
			));
			$secondary_navigation = SiteElement::get_secondary_nav_array('fiction');
			$this->render('index', array(
				'stories'=>$stories,
				'secondary_navigation'=>$secondary_navigation,
			));
		}
	}


	/**********************/
	/* WEB ORIGINAL - HUB */
	/**********************/

	public function actionWeb_original() {
		$this->pageTitle = Yii::app()->name.' - Web Original Fiction';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_web_original');
		$this->render('web_original', array('secondary_navigation'=>$secondary_navigation));
	}

	/**************/
	/* DEMONOLOGY */
	/**************/

	public function actionDemonology() {
		$this->pageTitle = Yii::app()->name.' - Demonology';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_web_original');
		// Get the story lists for various types of fiction.
		$short_stories = Story::model()->findAllBySql("select story.title, story.wordcount, story.link, story.link_active, story.pullquote, story.publication_date,"
			. " story.available_in_archive, story.archive_url_title"
			. " from link_story_universe, story, link_story_publication_category "
			. " where link_story_universe.universe_id = '1' && link_story_universe.story_id = story.story_id && published = 1"
			. " && link_story_publication_category.publication_category_id = 5 && link_story_publication_category.story_id = story.story_id && available_in_archive = 1"
			. " order by story.title");
		$long_stories = Story::model()->findAllBySql("select story.title, story.wordcount, story.link, story.link_active, story.pullquote, story.publication_date,"
			. " story.available_in_archive, story.archive_url_title"
			. " from link_story_universe, story, link_story_publication_category "
			. " where link_story_universe.universe_id = '1' && link_story_universe.story_id = story.story_id && published = 1"
			. " && link_story_publication_category.publication_category_id = 6 && link_story_publication_category.story_id = story.story_id && available_in_archive = 1"
			. " order by story.title");
		$prompt_stories = Story::model()->findAllBySql("select story.title, story.wordcount, story.link, story.link_active, story.pullquote, story.publication_date,"
			. " story.available_in_archive, story.archive_url_title"
			. " from link_story_universe, story, link_story_publication_category "
			. " where link_story_universe.universe_id = '1' && link_story_universe.story_id = story.story_id && published = 1"
			. " && link_story_publication_category.publication_category_id = 7 && link_story_publication_category.story_id = story.story_id && available_in_archive = 1"
			. " order by story.title");
		// Render the view.
		$this->render('demonology', array(
			'secondary_navigation'=>$secondary_navigation,
			'short_stories'=>$short_stories,
			'prompt_stories'=>$prompt_stories,
			'long_stories'=>$long_stories,
		));
	}

	/***********/
	/* PATREON */
	/***********/

	public function actionPatreon() {
		$this->pageTitle = Yii::app()->name.' - Fiction via Patreon';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_web_original');
		// Get the story lists for various types of fiction.
		$short_stories = Story::model()->with('story_publication_category')->findAll(array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 8 && available_in_archive = 1',
		));
		$long_stories = Story::model()->with('story_publication_category')->findAll(array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 9 && available_in_archive = 1',
		));
		// Render the page.
		$this->render('patreon', array(
			'secondary_navigation'=>$secondary_navigation,
			'short_stories'=>$short_stories,
			'long_stories'=>$long_stories,
		));
	}
	
	public function actionPatreon_acknowledgements() {
		$this->pageTitle = Yii::app()->name.' - Patreon - An Thanks...';
		$this->render('patreon_acknowledgements', array());
	}
	
	
	/*****************/
	/* PIXEL-STAINED */
	/*****************/
	
	public function actionPixel() {
		$this->pageTitle = Yii::app()->name.' - Pixel-Stained Works';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_web_original');
		$this->render('pixel_stained', array('secondary_navigation'=>$secondary_navigation));
	}
	
	
	/****************/
	/* SHARED-WORLD */
	/****************/
	public function actionShared_worlds() {
		$this->pageTitle = Yii::app()->name.' - Shared Worlds fiction';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_shared_worlds');
		// Render the page.
		$this->render('shared_world', array(
			'secondary_navigation'=>$secondary_navigation,
		));
	}
	

	/* FUNDRAISERS */
	public function actionShared_worlds_fundraisers() {
		$this->pageTitle = Yii::app()->name.' - Shared Worlds fundraisers';
		$fundraiser = false;
		if ( isset($_GET['fundraiser_title']) ) {
			$fundraiser_title = $_GET['fundraiser_title'];
			// Display the requested fundraiser.
			switch ($fundraiser_title) {
				default:
					// Leave $fundraiser false so that the default information displays.
				break;
			}
		} else {
			// Display an explanation and a list of fundraisers.
		}
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_shared_worlds_fundraising');
		// Render the page.
		$this->render('shared_world_fundraiser', array(
			'secondary_navigation'=>$secondary_navigation,
			'fundraiser'=>$fundraiser,
		));
	}


	/* FAQ */
	public function actionShared_worlds_faq() {
		$this->pageTitle = Yii::app()->name.' - Shared Worlds FAQ';

		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_shared_worlds');
		// Render the page.
		$this->render('shared_worlds_faq', array(
			'secondary_navigation'=>$secondary_navigation,
		));
	}


	/* WORKS */
	public function actionShared_worlds_works() {
		$this->pageTitle = Yii::app()->name.' - Shared Worlds – Works';
		$secondary_navigation = SiteElement::get_secondary_nav_array('fiction_shared_worlds');
		// Get the story lists for various types of fiction.
		$short_stories = Story::model()->with('story_publication_category')->findAll(array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 10 && available_in_archive = 1',
		));
		$long_stories = Story::model()->with('story_publication_category')->findAll(array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 11 && available_in_archive = 1',
		));
		$prompt_stories = Story::model()->with('story_publication_category')->findAll(array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && story_publication_category.publication_category_id = 12 && available_in_archive = 1',
		));
		// Render the page.
		$this->render('shared_world_works', array(
			'secondary_navigation'=>$secondary_navigation,
			'short_stories'=>$short_stories,
			'long_stories'=>$long_stories,
			'prompt_stories'=>$prompt_stories,
		));
	}

	/*****************/
	/* MISCELLANEOUS */
	/*****************/
	
	public function actionStandard_disclaimer() {
		$page = Page::model()->findByAttributes(array('url_short_title' => 'standard_disclaimer'));
		$content = $page->content_html;
		$this->render('/site/page', array('content'=>$content));
	}

}
