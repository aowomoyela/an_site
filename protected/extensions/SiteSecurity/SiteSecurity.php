<?php
class SiteSecurity {
	/****************************************************/
        /* Actions for a password with a 64-character salt. */
        /* The salted hash is 128 characters long.          */
        /****************************************************/
	
        public static function generate_salt() {
            $pre_salt = hash('sha256', (string)microtime(), false);
            $salt_bits = str_split($pre_salt);
            $shuffled_salt_bits = shuffle($salt_bits);
            $salt = implode($shuffled_salt_bits);
            return $salt;
        }

        public static function generate_new_hash($user_password) {
                $salt = PGI_Security::generate_salt();
                $prehash = $salt.$user_password;
                $hash = hash('sha256', $prehash, false);
                $salted_hash = $salt.$hash;
                return $salted_hash;
        }
        
        public static function confirm_user_password($user_password, $target_password) {
                $salt = substr($target_password, 0, 64);
                $target_hash = substr($target_password, 64);
                $user_prehash = $salt.$user_password;
                $user_hash = hash('sha256', $user_prehash, false);
                if ($user_hash === $target_hash) {
                        return true;
                } else {
                        return false;
                }
        }
}
?>