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
    private $straightArray = array();

    // Constructor: Initialize the deck of cards
    public function __construct() {
        $this->arrCards = $this->initCardDeck();
    }

    // Purpose:: Initialize the deck of cards
    private function initCardDeck() {
        shuffle($this->suits);
        foreach($this->suits as $suit) {
            foreach ($this->cards as $card) {
                $this->createArrCards[] = $card.$suit; 
            }
        }
        return $this->createArrCards;
    }

    // Purpose:: Shuffle the deck of cards
    public function shuffleCards() {
        shuffle($this->arrCards);
    }

    // Purpose:: Get the list of cards in the deck
    public function listCards() {
        foreach($this->arrCards as $card) {
            $this->str .= '<img src="../images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
            if($card == '13c' || $card == '13d' || $card == '13h' || $card == '13s'){
                $this->str .= '<br/><br/>';
            }
        }
        return $this->str;
    }

    // Purpose:: Get a hand of five cards from the deck
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
            $length = strlen($value);
            if($length == 2){
                $this->cardValue = str_split($value,1);
            }else{
                $this->cardValue = str_split($value,2);  
            }

            $this->handCard[] = $this->cardValue[0];
            $this->handSuit[] = $this->cardValue[1];
        }
        
        // Check if the hand is a straight, a flush, or neither
        $sResult = $this->isStraight($this->handCard);
        $fResult = $this->isFlush($this->handSuit);

        for($i=0; $i < count($this->cardHands); $i++){
            $this->straightArray[$this->handSuit[$i]] = $this->handCard[$i];
        }  

        // Determine the type of hand based on straight and flush results
        if($sResult && $fResult){
            sort($this->handCard);
            if(in_array('13', $this->handCard) && in_array('1', $this->handCard)){
                $firstValue = array_shift($this->handCard); 
                array_push($this->handCard, $firstValue);        
            }
            for($i=0; $i < count($this->cardHands); $i++){
                $this->cardHands[$i] = $this->handCard[$i].$this->handSuit[$i];
            }
            $this->str .= 'Hand is straight flush';
        }elseif($sResult){
            asort($this->straightArray);
            if(in_array('13', $this->handCard) && in_array('1', $this->handCard)){
                $firstValue = array_shift($this->handCard); 
                array_push($this->handCard, $firstValue);        
            }
            $i = 0;
            foreach($this->straightArray as $key => $val){
                $this->cardHands[$i] = $val.$key;
                $i++;
            }
            $this->str .= 'Hand is straight';
        }else{
            $this->str .= 'Drawn hand is neither straight nor straight flush. Please try again.';
        }

        $this->str .= '</br>';

        // Generate HTML representation of the drawn hand
        foreach($this->cardHands as $card) {
           $this->str .= '<img src="../images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
        }

        return $this->str;
    }

    // Purpose:: Check if the card values form a straight sequence
    public function isStraight($handCard){
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

    // Purpose:: Check if the card suits are all the same
    public function isFlush($handSuit){
        $uCount = count(array_unique($handSuit));
        if($uCount == 1){
            return true;
        }else{
            return false;
        }
    }
}
?>