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


	public function actionBingo_generator() {
	try {
		$this->pageTitle = Yii::app()->name.' - Bingo Generator';
		// Create a bingo card!  First, set up our mechanics. These can be overridden later if we want to make the form all fancy.
		$card_size = 5;
		$num_card_elements = pow($card_size, 2)-1; // A square with a free space in the middle.
		$delimiter = ',';
		$list = '';
		$use_repeat_values = true;
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
		));
	} catch(Exception $e) {
		// Stuff goes here, you know the drill
	}
	} // END public function actionBingo_generator()

}

?>