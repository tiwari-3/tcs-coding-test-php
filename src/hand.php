<?php
require_once '../vendor/autoload.php';

$cardDeck = CardDeckFactory::createCardDeck();
$shuffler = CardDeckFactory::createShuffler();
$handDrawer = CardDeckFactory::createHandDrawer();
$handEvaluator = CardDeckFactory::createHandEvaluator();

// Shuffle the deck
$shuffledCards = $shuffler->shuffle($cardDeck->getCards());

// Draw a hand
$handSize = 5;
$hand = $handDrawer->drawHand($shuffledCards, $handSize);

// Evaluate the hand type
$handType = $handEvaluator->evaluateHand($hand);

// Display the hand and its type
echo "Hand: " . implode(", ", $hand) . "<br>";
echo "Hand Type: " . $handType;

// Generate HTML representation of the drawn hand
$str = '';
foreach($hand as $card) {
   $str .= '<img src="../images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
}

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
