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
					array('label'=>'Fun', 'url'=>array('/fun/index')),
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
				
				case 'admin_fiction':
					return array(
						'items'=>array(
							array( 'label'=>'Edit Stories', 'url'=>array('/admin/edit_story') ),
							array( 'label'=>'Manage Submissions', 'url'=>array('/admin/manage_submissions') ),
						),
					);
				break;
				
				case 'admin_fun':
					return array(
						'items'=>array(
							array( 'label'=>'Edit Stories', 'url'=>array('/admin/manage_bingo_lists') ),
						),
					);
				break;
				
				case 'admin_submissions':
					return array(
						'items'=>array(
							array( 'label'=>'Manage Submissions', 'url'=>array('/admin/manage_submissions') ),
							array( 'label'=>'Add New Story', 'url'=>array('/admin/edit_story', 'story_id'=>'new') ),
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
		

		/***********************************/
		/* SLIGHTLY LESS UNIVERSAL CONTENT */
		/***********************************/

		public static function get_tipjar($type = fiction) {
			$tipjar_block  = '';
			
			switch($type) {
				case 'web':
$tipjar_block = <<<EOT
	<div id="tipjar">
		<div id="tipjar_button">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="CRATNJLA4EVPN">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
		
		<div id="tipjar_text">
			My web work comes out of my free time and self-taught skills. If you appreciate it and want to support my work, consider buying me a virtual cup of tea!
			Contributions enable me to spend more of my time creating content for you to enjoy, and I deeply appreciate every one.
		</div>
	</div>
EOT;
				break;
				
				case 'fiction':
				default:
$tipjar_block = <<<EOT
	<div id="tipjar">
		<div id="tipjar_button">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="A56H7GS5TYK3Q">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
		
		<div id="tipjar_text">
			I do my best to keep my fiction freely available online. If you appreciate it and want to support my work, consider buying me a virtual cup of tea!
			Contributions enable me to spend more of my time creating content for you to enjoy, and I deeply appreciate every one.
		</div>
	</div>
EOT;
				break;
			}

			echo $tipjar_block;
		} // END public static function get_tipjar($type = fiction)
		
		
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
