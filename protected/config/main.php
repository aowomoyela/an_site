<?php
require(dirname(__FILE__).'/../../../../secure/an_site/site_constants.php');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'An Owomoyela',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models_static.*',
		'application.components.*',
		'ext.dBug.*',
		'ext.SiteSecurity.*',
		'ext.SiteUtility.*',
		'ext.UserIdentity.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>GII_PASS,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1', '::1', GII_IP),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
		),
		// enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'about' => 'site/about',
				'fiction' => 'fiction/index',
				'fiction/archive/<archive_url_title:\w+>'=>'fiction/archive',
				'fiction/shared_worlds/fundraisers'=>'fiction/shared_worlds_fundraisers',
				'fiction/shared_worlds/fundraisers/<fundraiser_title:\w+>'=>'fiction/shared_worlds_fundraisers',
				'fiction/shared_worlds/works/'=>'fiction/shared_worlds_works',
				'home' => 'site/index',
				'web' => 'web/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		// use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host='.DB_SERVER.';dbname='.DB_NAME,
			'emulatePrepare' => true,
			'username' => DB_USER,
			'password' => DB_PASS,
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'an@owomoyela.net',
		'bio_pictures_directory'=>dirname(__FILE__).'/../images/site/250_bio/',
	),
);
