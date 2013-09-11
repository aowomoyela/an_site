<?php
class UserIdentity extends CUserIdentity {

 	/*******************************************************/
 	/* Actions for user authentication & authorization.    */
 	/* authenticate() must be implemented or CUserIdentity */
 	/* will throw an exception.                            */
 	/*******************************************************/

	// Authentication verifies that the user is who they say they are.
	public function authenticate() {
		$username = $this->username;
        	$password = $this->password;
		
		if ( $username != SITE_ADMIN_USER ) {
			$this->errorMessage = 'Unknown username.';
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			return false;
		} elseif ( !SiteSecurity::confirm_user_password($password, SITE_ADMIN_HASH) ) {
			$this->errorMessage = 'Incorrect password.';
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			return false;
		} else {
			// The correct admin credentials have been provided. Log them in.
			#$this->setState('model', $user);
			$this->setState('authorization', 'admin' );
			// Return with no errors and a confirmation.
                        $this->errorCode==self::ERROR_NONE;
                        return true;
		}

    	}

}
?>
