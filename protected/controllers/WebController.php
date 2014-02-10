<?php

class WebController extends Controller
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
		$secondary_navigation = SiteElement::get_secondary_nav_array('web');
		$this->render('index', array(
			'secondary_navigation'=>$secondary_navigation,
		));
	}

	public function actionResume() {
		$page = Page::model()->findByAttributes(array('url_short_title' => 'resume'));
		$content = $page->content_html;
		$this->render('resume', array('content'=>$content));
	}

}
