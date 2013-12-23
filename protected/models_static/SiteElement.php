<?php
	class SiteElement {

		/**************/
		/* NAVIGATION */
		/**************/

		public static function get_main_nav_array() {
			
			$navigation_array = array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/home')),
					array('label'=>'Web', 'url'=>array('/web/index')),
					array('label'=>'Fiction', 'url'=>array('/fiction/index')),
					array('label'=>'Web Original Fiction', 'url'=>array('/fiction/web_original')),
					array('label'=>'Blog', 'url'=>'http://magistrate.dreamwidth.org/'),
					array('label'=>'About', 'url'=>array('/site/about',)),
					array('label'=>'Resume', 'url'=>array('/web/resume')),
					array('label'=>'GitHub', 'url'=>'https://github.com/aowomoyela'),
				),
			);
			
			
			//Determine whether or not to display the admin link button
			if ( Yii::app()->user->isGuest ) {
				// This user is not logged in.
			} elseif ( Yii::app()->user->authorization == 'admin' ) {
				// This user is an admin; show them the link.
				$navigation_array["items"][] = array('label'=>'Admin', 'url'=>array('/admin/index'));
				$navigation_array["items"][] = array('label'=>'Log Out', 'url'=>array('/site/logout'));
			} else {
				// This user is logged in, but not an administrator.
				$navigation_arrayn_array["items"][] = array('label'=>'Log Out', 'url'=>array('/site/logout'));
			}
			
			return $navigation_array;
		} // END public static function get_main_nav_array()


		public static function get_secondary_nav_array($section) {
			switch ($section) {
				case 'web_original_fiction':
					return array(
						'items'=>array(
							array( 'label'=>'Demonology', 'url'=>array('/fiction/demonology') ),
							//array( 'label'=>'Pixel-Stained', 'url'=>array('/fiction/pixel') ),
							array( 'label'=>'Patreon', 'url'=>array('/fiction/patreon') ),
						),
					);
				break;
				
				case 'admin':
					return array(
						'items'=>array(
							array( 'label'=>'Edit Stories', 'url'=>array('/admin/edit_story') ),
							array( 'label'=>'Manage Submissions', 'url'=>array('/admin/manage_submissions') ),
							//array( 'label'=>'Patreon', 'url'=>array('/fiction/patreon') ),
						),
					);
				break;
				
				case 'admin_submissions':
					return array(
						'items'=>array(
							array( 'label'=>'Manage Submissions', 'url'=>array('/admin/manage_submissions') ),
							//array( 'label'=>'Patreon', 'url'=>array('/fiction/patreon') ),
						),
					);
				break;
			}
		} //END public static function get_secondary_nav_array()


		/*********************/
		/* UNIVERSAL CONTENT */
		/*********************/

		public static function get_site_footer() {
			return 'Site content &copy; An Owomoyela 2005 - '.date('Y'). ' unless otherwise noted';
		}


		/****************************************/
		/* WACKY, PROBABLY ONE-OFF CONTENT BITS */
		/****************************************/

		public static function get_random_anecdote() {
			// Get a random anecdote from the table. Order by rand() isn't terribly efficient, but I anticipate small table sizes & low traffic.
			$query = 'select anecdote_text from anecdote order by rand() limit 1';
			$anecdote = Anecdote::model()->findBySql( $query );
			if ( !is_null($anecdote) ) {
				$return_value = $anecdote->get('anecdote_text');
			} else { $return_value = 'No anecdotes found. The database must not be feeling chatty.'; }
			return $return_value;
		}


		public static function get_random_bio_picture() {
			$pictures = glob( 'images/site/250_bio/*.*' );
			$key = rand( 0, count($pictures)-1 );
			$file = $pictures[$key];
			return $file;
		}
	}
?>
