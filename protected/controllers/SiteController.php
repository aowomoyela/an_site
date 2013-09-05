<?php

class SiteController extends Controller
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
		$this->render('index');
	}

	/**********************************************/
	/* Authentication and authorization handling. */
	/**********************************************/

	public function actionLogin() {
	try {
		// If the user is logged in, send them on their way.
		if (!Yii::app()->user->isGuest) {
			Yii::app()->request->redirect( Yii::app()->createUrl('site/index') );
		}
		
		// If this is a POST request, assume it's a login attempt.
		if(Yii::app()->request->isPostRequest) {
			if ( !isset($_POST['username']) || !isset($_POST['password']) ) {
				// Error.
				throw new Exception('Login credentials not supplied.');
			}
			// Handle the login.
			$loginhandler = new UserIdentity($_POST['username'], $_POST['password']);
			$auth = $loginhandler->authenticate();
			if ($auth === true) {
				// Log in the user.
				Yii::app()->user->login($loginhandler,0);
				if ( Yii::app()->user->authorization == 'admin' ) {
					Yii::app()->request->redirect( Yii::app()->createUrl('admin/index') );
				} else {
					Yii::app()->request->redirect( Yii::app()->createUrl('site/index') );
				}
			} else {
				// Display the login form.
				$this->render('login');
			}
		} else {
			// Display the login form.
			$this->layout = 'enter_blankface';
			$this->render('login');
		}
	} catch (Exception $e) {
		// Error handling.
		
	} }

	
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	/*********/
	/* Misc. */
	/*********/

	public function actionAbout() {
		#$page = Page::model()->findByAttributes(array('url_short_title' => 'about'));
                #$content = $page->content_html;
		#$this->render('display_only_content', array('content'=>$content));
		$this->render('about');
	}


	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionContact() {

	}

}
