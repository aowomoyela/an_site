<?php
class AdminAuthFilter extends CFilter {

	protected function preFilter($filterChain) { // Logic applied before the action is run.
		// If the user is not an administrator, redirect them to somewhere safe.
		// Hacky, for now.  I'll expand this later.
		if ( Yii::app()->user->isGuest ) {
			// This user is not logged in.
			Yii::app()->request->redirect( Yii::app()->createUrl('site/login') );
		} elseif ( Yii::app()->user->authorization == 'admin' ) {
			// Everything is cool.  They're allowed in.
			return true;
		} else {
			// This user is logged in, but not an administrator.  Send them home.
			Yii::app()->request->redirect( Yii::app()->createUrl('site/index') );
		}
	}
	
	
}
?>
