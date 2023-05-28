<?php
// Include class card deck once
include_once "cardDeck.php";

// Create an instance of the `cardDeck` class
$object = new cardDeck();

// Shuffle the deck of cards
$object->shuffleCards();

// Get the HTML representation of the list of cards in the deck
$listOutput = $object->listCards();

echo $listOutput;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Card Game</title>	
	<script type="text/javascript">
		// Shuffle the cards after page load
		function shuffle(){
			location.reload();
		}

		// Get the five cards hand form the deck of 52 cards
		function getHand(){
			window.location.href = 'hand.php';	
		}
	</script>
</head>
<body>
</br>
<button onclick="shuffle();">Shuffle</button>
<button onclick="getHand();">Get Hand</button>	
</body>
</html>