<?php

class FunController extends Controller
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
		$this->pageTitle = Yii::app()->name.' - Fun!';
		$this->render('index');
	}


	/************************************************************************************/
	/* Bingo cards generator – initially for writing prompts, but use your imagination! */
	/************************************************************************************/
	public function actionBingo_generator() {
	try {
		$this->pageTitle = Yii::app()->name.' - Bingo Generator';
		// Create a bingo card!  First, set up our mechanics. These can be overridden later if we want to make the form all fancy.
		$card_size = 5;
		$num_card_elements = pow($card_size, 2)-1; // A square with a free space in the middle.
		$delimiter = ',';
		$list = '';
		$use_repeat_values = true;
		// Mechanics done.  Let's look at some aesthetics.
		$cell_size = '10em';
		$center_space = 'free';
		$center_space_other = '';
		$center_space_text = 'FREE SPACE';
		$background_color = 'background-color:#FFFFFF;';
		$background_hex = '#FFFFFF';
		$text_color = 'color:#000000;';
		$text_hex = '#000000';
		$border_color = 'border:1px solid #000000;';
		$border_hex = '#000000';
		// Make a random array of numbers 1-75 as filler.
		$bingo_squares = array();
		while ( count($bingo_squares) < $num_card_elements) {
			$new_square = rand(1, 75);
			if ( !in_array($new_square, $bingo_squares) ) {
				$bingo_squares[] = $new_square;
			}
		}
		// See if this is a POST request or not.
		if ( Yii::app()->request->isPostRequest ) {
			// Any mechanics that need to be handled get handled here. Such as... center space text! (Impacts number of elements.)
			if ( isset($_POST['center_space']) ) {
				if ( in_array($_POST['center_space'], array('free', 'wild', 'normal', 'other')) ) {
					$center_space = $_POST['center_space'];
				}
			}
			switch ($center_space) {
				case 'wild': $center_space_text = "WILD CARD"; break;
				case 'other':
					$center_space_text = strip_tags($_POST['center_space_other'], '<a><i><em><strong><b><u><strike>');
					$center_space_other = $center_space_text;
					break;
				case 'free': default: $center_space_text = "FREE SPACE"; break;
			}
			// Card size / number of elements!
			// // Validate for allowed card sizes.
			if ( isset($_POST['card_size']) ) {
				if ( in_array($_POST['card_size'], array(1,2,3,4,5,6,7)) ) {
					$card_size = $_POST['card_size'];
				}
			}
			// // If the card has even-numbered element sizes, there's no center space.
			if ( $card_size%2 == 0 || $card_size == 1 ) {
				$center_space = 'normal';
			}
			// // Reduce cell size for gigantic cards.
			if ( $card_size == 6 ) { $cell_size = '9em'; }
			if ( $card_size == 7 ) { $cell_size = '8em'; }
			// // Determine how many elements are needed.
			if ($center_space == 'normal') {
				$num_card_elements = pow($card_size, 2);
			} else {
				$num_card_elements = pow($card_size, 2)-1; // One of the spaces is already provided.
			}
			if ( isset($_POST['use_repeat_values']) ) {
				$use_repeat_values = true;
			} else {
				$use_repeat_values = false;
			}
			// Background color!
			if ( isset($_POST['background']) ) {
				if ( preg_match("/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/", $_POST['background']) ) {
					$background_color = 'background-color:'.$_POST['background'].';';
					$background_hex = $_POST['background'];
				}
			
				// Background transparency and CSS attribute!
				if ( $_POST['background'] == 'transparent' ) {
					$background_color = '';
					$background_hex = 'transparent';
				} else {
					$background_color = 'background-color:'.$background_hex.';';
				}
			}
			// Text color!
			if ( isset($_POST['color']) ) {
				if ( preg_match("/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/", $_POST['color']) ) {
					$text_hex = $_POST['color'];
					$text_color = 'color:'.$_POST['color'].';';
				}
				$text_color = 'color:'.$text_hex.';';
			}
			// Border color!
			if ( isset($_POST['border_color']) ) {
				if ( $_POST['border_color'] ) {
					if ( preg_match("/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/", $_POST['border_color']) ) {
						$border_hex = $_POST['border_color'];
						$border_color = 'border:1px solid '.$_POST['border_color'].';';
					}
					$border_color = 'border:1px solid '.$border_hex.';';
				}
			}
			// Now, we FINALLY handle the actual card elements.
			$list = strip_tags($_POST['list'], '<a><i><em><strong><b><u><strike>');
			$list_items = explode(',', $list);
			$list_items = array_filter(array_map('trim', $list_items));
			if ( count($list_items) >= $num_card_elements ) {
				// There are enough items to fill a card.
				shuffle($list_items);
				$bingo_squares = array_slice($list_items, 0, $num_card_elements);
				$message = "Here you go!";
				$card_ready = true;	
			} else {
				if (count($list_items) == 0 || !$use_repeat_values) {
					// The user just submitted a blank form, or doesn't want repeated values.
					$message = "There aren't enough items in your list to fill a $card_size x $card_size grid. Have a default card instead!";
					$card_ready = false;
				} else {
					// There aren't enough items to fill a card... but the user wants us to generate a card anyway. Repeat the values.
					$original_list_count = count($list_items);
					while (count($list_items) < $num_card_elements) {
						$list_items = array_merge($list_items, $list_items);
					}
					shuffle($list_items);
					$bingo_squares = array_slice($list_items, 0, $num_card_elements);
					$message = "Here you go! You only provided $original_list_count values, so some will repeat.";
					$card_ready = true;
				}
			}
		} else {
			// Display the form to create a bingo card.
			$message = "Here's a default card to show you what it'll look like.";
			$card_ready = false;
		}
		// Render the page.
		$this->render('bingo_generator', array(
			'bingo_squares'=>$bingo_squares,
			'message'=>$message,
			'list'=>$list,
			'card_ready'=>$card_ready,
			'card_size'=>$card_size,
			'num_card_elements'=>$num_card_elements,
			'use_repeat_values'=>$use_repeat_values,
			'cell_size'=>$cell_size,
			'background_color'=>$background_color,
			'text_color'=>$text_color,
			'border_color'=>$border_color,
			'background_hex'=>$background_hex,
			'text_hex'=>$text_hex,
			'border_hex'=>$border_hex,
			'center_space'=>$center_space,
			'center_space_text'=>$center_space_text,
			'center_space_other'=>$center_space_other,
		));
	} catch(Exception $e) {
		// Stuff goes here, you know the drill
	}
	} // END public function actionBingo_generator()
	
	
	/************************************************************************************************/
	/* Demographics randomizer, probably for minor characters, but potentially for challenges, etc. */
	/* Inspired by Alex Conall's Excel demographics generator, which can be found in Google Docs:   */
	/* https://docs.google.com/document/d/1cVY6GD7RfL9ltZOUjp6wkGQcKzk-PImQd6YU4AAZTGE/edit?pli=1   */
	/************************************************************************************************/
	public function actionDemographics_generator() {
	try {
		$this->pageTitle = Yii::app()->name.' - Demographics (Random Sets) Generator';
		// See if this is a POST request or not.
		if ( Yii::app()->request->isPostRequest ) {
			// Are we re-loading data from an earlier generation?
			if ( !isset($_POST['reload_data']) ) { $_POST['reload_data'] = false; }
			if ( $_POST['reload_data'] ) {
				// Here, we just need to display the form with the pre-loaded data lists.
				// Validate the number.
				if ( !is_int($_POST['number']) && !is_numeric($_POST['number']) ) { $number = 10; } else { $number = $_POST['number']; }
				// Get the JSON category string into a usable shape.
				$categories = json_decode($_POST['categories']);
				// Render the page.
				$this->render('demographics_generator', array(
					'categories'=>$categories,
					'number'=>$number,
				));	
			} else {
				// Here, we're actually generating the randomized sets.
				#new dBug($_POST);
				// We'll have a number of random mixes to generate, and a superarray of the categories, their options, and the option weights.
				if ( !is_int($_POST['number']) && !is_numeric($_POST['number']) ) { $number = 10; } else { $number = $_POST['number']; }
				//Handle each category.
				$option_bounds = array();
				$categories = $_POST['categories'];
				foreach ($categories as $category_name => $category) {
					// Work out what the total weight is.
					$total_weight = 0;
					$weight_pointer = 1;
					foreach ($category as $option => $weight) {
						$total_weight += $weight;
						// Work up an array we can compare against an RNG later.
						$option_bounds[$category_name][$option]['low_bound'] = $weight_pointer;
						$weight_pointer += $weight-1;
						$option_bounds[$category_name][$option]['high_bound'] = $weight_pointer;
						$weight_pointer++;
					}
					// Make a note of the total weight. We'll need it to set the bounds of the RNG.
					$option_bounds[$category_name]['total_weight'] = $total_weight;
				}
				#new dBug($option_bounds);
				
				// Now, let's get on with generating $number combinations.
				$results = array();
				for ( $i = 0; $i < $number; $i++ ) {
					// Look at each category...
					foreach ($categories as $category_name => $category) {
						// ...and choose a random value from the weighted list. First, generate an index within the weight bounds...
						$random = rand(1, $option_bounds[$category_name]['total_weight']);
						// ...then look through the upper and lower bounds until you find a range that fits the number.
						foreach ($option_bounds[$category_name] as $option_name => $option) {
							if ( $random >= $option['low_bound'] && $random <= $option['high_bound'] ) {
								$results[$i][$category_name] = $option_name;
								break;
							}
						}
						
						// If the category is set to only use values from it once, we need to take this into account.
						// TODO: Make this less kludgetacular.
						if ( array_key_exists($category_name, $_POST['use_values_only_once']) ) {
							// Get rid of the selected value so it can't be selected later.
							unset($categories[$category_name][$option_name]);
							// If there are no more options left, generate a dummy option.
							if (count($categories[$category_name]) == 0) {
								$categories[$category_name]['(no unique options remaining)'] = 1;
							}
							// Regenerate the weighting. First, get rid of the old weighting.
							unset($option_bounds[$category_name]);
							// Work out what the total weight is.
							$total_weight = 0;
							$weight_pointer = 1;
							foreach ($categories[$category_name] as $option => $weight) {
								$total_weight += $weight;
								// Work up an array we can compare against an RNG later.
								$option_bounds[$category_name][$option]['low_bound'] = $weight_pointer;
								$weight_pointer += $weight-1;
								$option_bounds[$category_name][$option]['high_bound'] = $weight_pointer;
								$weight_pointer++;
							}
							// Make a note of the total weight. We'll need it to set the bounds of the RNG.
							$option_bounds[$category_name]['total_weight'] = $total_weight;
						}
					}
				}
				
				// At this point, we should have $number combinations.  Render the page.
				$this->render('demographics_generated_values', array(
					'results'=>$results,
					'number'=>$number,
					'categories'=>$categories,
				));	
			} // End handling for option set generation.
		} else {
			// Render the page.
			$this->render('demographics_generator', array(
				// Variables go here.
			));	
		}
		
	} catch (Exception $e) {
		
	}} // END public function actionDemographics_generator()
	
	
	/* Handle porting over randomized values from the demographics generator into the bingo card generator. */
	public function actionBingo_demographics_handler() {
	try {
		
		// Render the page.
		$this->render('bingo_generator', array(
			/*'bingo_squares'=>$bingo_squares,
			'message'=>$message,
			'list'=>$list,
			'card_ready'=>$card_ready,
			'card_size'=>$card_size,
			'num_card_elements'=>$num_card_elements,
			'use_repeat_values'=>$use_repeat_values,
			'cell_size'=>$cell_size,
			'background_color'=>$background_color,
			'text_color'=>$text_color,
			'border_color'=>$border_color,
			'background_hex'=>$background_hex,
			'text_hex'=>$text_hex,
			'border_hex'=>$border_hex,
			'center_space'=>$center_space,
			'center_space_text'=>$center_space_text,
			'center_space_other'=>$center_space_other,*/
		));
	
	} catch (Exception $e) {
		
	}} // END public function actionBingo_demographics_handler()

}

?>