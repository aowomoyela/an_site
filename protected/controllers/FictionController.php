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
		$stories = Story::model()->findAll( array(
			'select'=>'title, wordcount, link, link_active, pullquote, publication_date, available_in_archive, archive_url_title',
			'order'=>'title',
		));
		$this->render('index', array('stories'=>$stories));
	}


	public function actionContact() {

	}

}
