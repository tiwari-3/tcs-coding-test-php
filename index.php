<?php
include_once "CardDeck.php";

$object = new CardDeck();
//$object->listCards(); 
$object->shuffleCards();

$object->getCardHand(); 


?>