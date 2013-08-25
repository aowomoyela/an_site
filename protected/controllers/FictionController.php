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
		$stories = Story::model()->with('story_market', 'story_link')->findAll( array(
			'select'=>'t.title, wordcount, link, link_active, pullquote, story_market.title, publication_date, available_in_archive, archive_url_title',
			'order'=>'t.title',
			'condition'=>'published = 1 && publication_category_id = 1'
		));
		$this->render('index', array('stories'=>$stories));
	}


	public function actionArchive() {
		if ( isset($_GET['archive_url_title']) ) {
			// A title was specified; try to find it in the database.
			$story = Story::model()->find( array(
				'select' => 'title, wordcount, available_in_archive, story_text',
				'condition' => 'archive_url_title=:archive_url_title && available_in_archive = 1',
				'params' => array( ':archive_url_title' => $_GET['archive_url_title'] ),
			));
			$this->render('archive_story', array( 'title' => $story->get('title'), 'story_text'=>$story->get_archive_story_text() ));
		} else {
			// If no URL title is set, list stories available in the archive.
			$stories = Story::model()->with('story_market', 'story_link')->findAll( array(
				'select'=>'t.title, wordcount, link, link_active, pullquote, story_market.title, publication_date, available_in_archive, archive_url_title',
				'order'=>'t.title',
				'condition'=>'published = 1 && publication_category_id = 1 && available_in_archive = 1'
			));
			$this->render('index', array('stories'=>$stories));
		}
	}

}
