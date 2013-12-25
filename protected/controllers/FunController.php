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
		// Make a random array of numbers 1-75 as filler.
		$bingo_squares = array();
		while ( count($bingo_squares) <= $num_card_elements) {
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
			// Now, handle the actual card elements.
			$list = $_POST['list'];
			$list_items = explode(',', $list);
			if ( count($list_items >= $num_card_elements) ) {
				// There are enough items to fill a card.
				shuffle($list_items);
				$bingo_squares = array_slice($list_items, 0, $num_card_elements);
				$message = "There you go.";
				$card_ready = true;	
			} else {
				// There aren't enough items to fill a card!
				$message = "Not enough items in list to fill a $card_size x $card_size grid.";
				$card_ready = false;
			}
		} else {
			// Display the form to create a bingo card.
			$message = "Let's make you a card!";
			$card_ready = false;
		}
		// Render the page.
		$this->render('bingo_generator', array(
			'bingo_squares'=>$bingo_squares,
			'message'=>$message,
			'list'=>$list,
			'card_ready'=>$card_ready,
			'card_size'=>$card_size,
		));
	} catch(Exception $e) {
		// Stuff goes here, you know the drill
	}
	} // END public function actionBingo_generator()

}

?>