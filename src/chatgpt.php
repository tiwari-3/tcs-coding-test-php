<?php 
class cardDeck
{
    // Array of suits and cards
    private $suits = array('c', 'd', 'h', 's');
    private $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);

    // Array to store the deck of cards
    private $arrCards;

    // String to store HTML representation of cards
    private $str;

    // Array to store the drawn card hands
    private $cardHands = array();

    // Arrays to store the extracted card values and suits from the drawn hand
    private $handCard = array();
    private $handSuit = array();

    // Arrays to store processed card values for evaluation
    private $cardValue = array();
    private $createArrCards = array();

    // Constructor: Initialize the deck of cards
    public function __construct() {
        $this->arrCards = $this->initCardDeck();
    }

    // Initialize the deck of cards
    private function initCardDeck() {
        foreach($this->suits as $suit) {
            foreach ($this->cards as $card) {
                // Map numeric card values to corresponding letters
                if($card == 1){
                    $card = 'a'; 
                }else if($card == 11){
                    $card = 'j';
                }else if($card == 12){
                    $card = 'q';
                }else if($card == 13){
                    $card = 'k';
                }
                $this->createArrCards[] = $card.$suit; 
            }
        }
        return $this->createArrCards;
    }

    // Shuffle the deck of cards
    public function shuffleCards() {
        shuffle($this->arrCards);
    }

    // Get the list of cards in the deck
    public function listCards() {
        foreach($this->arrCards as $card) {
            $this->str .= '<img src="images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
            if($card == 'kc' || $card == 'kd' || $card == 'kh' || $card == 'ks'){
                $this->str .= '<br/><br/>';
            }
        }
        return $this->str;
    }

    // Get a hand of five cards from the deck
    public function getCardHand() {
        $i = 0;
        foreach($this->arrCards as $card) {
            $this->cardHands[] = $card;
            if($i == 4){
                break;
            }
            $i++;    
        }

        // Extract the card values and suits from the drawn hand
        foreach($this->cardHands as $value){
            $this->cardValue = array();
            $length = strlen($value);
            if($length == 2){
                $this->cardValue = str_split($value,1);
            }else{
                $this->cardValue = str_split($value,2);  
            }

            // Convert letter card values back to numeric form
            if($this->cardValue[0] == 'a'){
                $this->cardValue[0] = 1; 
            }else if($this->cardValue[0] == 'j'){
                $this->cardValue[0] = 11;
            }else if($this->cardValue[0] == 'q'){
                $this->cardValue[0] = 12;
            }else if($this->cardValue[0] == 'k'){
                $this->cardValue[0] = 13;
            }
            
            $this->handCard[] = $this->cardValue[0];
            $this->handSuit[] = $this->cardValue[1];
        }
        
        // Check if the hand is a straight, a flush, or neither
        $sResult = $this->isStraight($this->handCard);
        $fResult = $this->isFlush($this->handSuit);

        // Generate HTML representation of the drawn hand
        foreach($this->cardHands as $card) {
           $this->str .= '<img src="images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
        }

        $this->str .= '</br>';

        // Determine the type of hand based on straight and flush results
        if($sResult && $fResult){
            $this->str .= 'Hand is straight flush';
        }elseif($sResult){
            $this->str .= 'Hand is straight';
        }else{
            $this->str .= 'Drawn hand is neither straight nor straight flush. Please try again.';
        }
        return $this->str;
    }

    // Check if the card values form a straight sequence
    private function isStraight($handCard){
        sort($handCard);
        $prev = '0';
        $flag = true;
        foreach($handCard as $val){
            if(($val - $prev) != 1){
                $flag = false;
            }
            $prev = $val;
        }
        return $flag;
    }

    // Check if the card suits are all the same
    private function isFlush($handSuit){
        $uCount = count(array_unique($handSuit));
        if($uCount == 1){
            return true;
        }else{
            return false;
        }
    }
}

// Create an instance of the `cardDeck` class
$deck = new cardDeck();

// Shuffle the deck of cards
$deck->shuffleCards();

// Get the HTML representation of the list of cards in the deck
$listOfCards = $deck->listCards();

// Get a hand of five cards from the deck and check the type of hand
$handResult = $deck->getCardHand();