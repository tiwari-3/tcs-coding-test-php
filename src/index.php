<?php
require_once '../vendor/autoload.php';

// Create card deck using card deck factory class
$cardDeck = CardDeckFactory::createCardDeck();

// Get card deck array
$cardList = $cardDeck->getCards();

// HTML representation of the list of cards in the deck
foreach($cardList as $card) {
	echo '<img src="../images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
    if($card == '13c' || $card == '13d' || $card == '13h' || $card == '13s'){
    	echo '<br/><br/>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Card Game</title>	
	<script type="text/javascript">
		// Shuffle the cards after page load
		function shuffle(){
			window.location.href = 'shuffle.php';
		}

		// Get the five cards hand form the deck of 52 cards
		function getHand(){
			window.location.href = 'hand.php';	
		}
	</script>
</head>
<body>
<button onclick="shuffle();">Shuffle</button>
<button onclick="getHand();">Get Hand</button>	
</body>
</html>
