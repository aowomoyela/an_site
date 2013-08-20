<?php
	class SiteElement {
		/**************/
		/* NAVIGATION */
		/**************/

		public static function get_main_nav_array() {
			return array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'Web', 'url'=>array('/web/index')),
					array('label'=>'Fiction', 'url'=>array('/fiction/index')),
					array('label'=>'Free Serial Fiction', 'url'=>array('/fiction/index')),
					array('label'=>'Blog', 'url'=>'http://magistrate.dreamwidth.org/'),
					array('label'=>'About', 'url'=>array('/about/index',)),
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
	}
?>
