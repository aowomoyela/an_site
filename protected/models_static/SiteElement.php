<?php
	class SiteElement {

		/**************/
		/* NAVIGATION */
		/**************/

		public static function get_main_nav_array() {
			return array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/home')),
					array('label'=>'Web', 'url'=>array('/web')),
					array('label'=>'Fiction', 'url'=>array('/fiction')),
					array('label'=>'Free Serial Fiction', 'url'=>array('/fiction/crowd')),
					array('label'=>'Blog', 'url'=>'http://magistrate.dreamwidth.org/'),
					array('label'=>'About', 'url'=>array('/site/about',)),
					array('label'=>'Resume', 'url'=>array('/web/resume')),
				),
			);
		} // END public static function get_nav_array()


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
			// Too lazy to make a full-on model for anecdotes right now. Maybe later. (Hey, at least I'm honest.)
			$connection = Yii::app()->db;
			$cmd = $connection->createCommand($query);
			$row = $cmd->queryRow();
			if ($row) {
				$return_value = $row['anecdote'];
				foreach ( $row as $column_name => $column_value ) { $return_value = $column_value; }
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
