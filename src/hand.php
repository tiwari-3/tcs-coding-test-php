<?php
// Include class card deck once
include_once "cardDeck.php";

// Create an instance of the `cardDeck` class
$object = new cardDeck();

// Shuffle the deck of cards
$object->shuffleCards();

// Get a hand of five cards from the deck and check the type of hand
$cardHandOutput = $object->getCardHand();

echo $cardHandOutput;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Card Game</title>	
	<script type="text/javascript">
		// Get the five cards hand form the deck of 52 cards
		function getHand(){
			location.reload();
		}

		// Go Back to start from home page
		function back(){
			window.location.href="index.php";
		}

		// Shuffle the cards after page load
		function shuffle(){
			window.location.href = 'shuffle.php';
		}		
	</script>
</head>
<body>
</br>
<button onclick="getHand();">Try Again</button>
<button onclick="shuffle();">Shuffle</button>
<button onclick="back();">Back Home</button>	
</body>
</html>
