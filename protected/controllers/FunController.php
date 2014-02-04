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
		$background_color = 'background-color:#FFFFFF;';
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
			// Any mechanics that need to be handled get handled here.
			if ( $card_size%2 == 0 || $card_size > 7 ) {
				$card_size = 5;
			}
			if ( isset($_POST['use_repeat_values']) ) {
				$use_repeat_values = true;
			} else {
				$use_repeat_values = false;
			}
			// Some display stuff like background color.
			if ( $_POST['background'] == 'transparent' ) {
				$background_color = '';
			} elseif ( preg_match("/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/", $_POST['background']) ) {
				$background_color = 'background-color:#'.$_POST['background'].';';	
			} else {
				$background_color = 'background-color:#FFFFFF;';
			}
			// Now, handle the actual card elements.
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
			'background_color'=>$background_color,
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
		// See if this is a POST request or not.
		if ( Yii::app()->request->isPostRequest ) {
			#new dBug($_POST);
			// We'll have a number of random mixes to generate, and a superarray of the categories, their options, and the option weights.
			if ( !is_int($_POST['number']) && !is_numeric($_POST['number']) ) { $number = 10; } else { $number = $_POST['number']; }
			//Handle each category.
			$option_bounds = array();
			foreach ($_POST['categories'] as $category_name => $category) {
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
				foreach ($_POST['categories'] as $category_name => $category) {
					// ...and choose a random value from the weighted list. First, generate an index within the weight bounds...
					$random = rand(1, $option_bounds[$category_name]['total_weight']);
					// ...then look through the upper and lower bounds until you find a range that fits the number.
					foreach ($option_bounds[$category_name] as $option_name => $option) {
						if ( $random >= $option['low_bound'] && $random <= $option['high_bound'] ) {
							$results[$i][$category_name] = $option_name;
						}
					}
				}
			}
			
			// At this point, we should have $number combinations.  Render the page.
			#new dBug($results);
			$this->render('demographics_generated_values', array(
				'results'=>$results,
			));	
		} else {
			// Render the page.
			$this->render('demographics_generator', array(
				// Variables go here.
			));	
		}
		
	} catch (Exception $e) {
		
	}} // END public function actionDemographics_generator()

}

?>