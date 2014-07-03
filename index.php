<?php
#require(dirname(__FILE__).'/../../secure/an_site/site_constants.php');
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii/framework/yii.php';

switch ( $_SERVER['HTTP_HOST'] ) {
	case 'an.owomoyela.net':
		/* PRODUCTION - LIVE */
		$config=dirname(__FILE__).'/protected/config/main.php';
	break;

	case 'ano.owomoyela.net':
		/* DEVELOPMENT */
		$config=dirname(__FILE__).'/protected/config/dev.php';
		// remove the following lines when in production mode
		defined('YII_DEBUG') or define('YII_DEBUG',true);
		// specify how many levels of call stack should be shown in each log message
		defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
	break;

	default:
		die("The config file for this server is not set.");
	break;
}

require_once($yii);
Yii::createWebApplication($config)->run();
