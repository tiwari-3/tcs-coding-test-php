<?php
class CardDeck
{      
    // Predefine array of suit and card 
    private $suits = array('c', 'd', 'h', 's');
    private $cards = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
    private $arrCards; 

    // Purpose: Call when the class object is called
    public function __construct() {
        $this->arrCards = $this->initCardDeck();
    }

    // Purpose: To suffle the cards
    public function shuffleCards() {
        shuffle($this->arrCards);
    }

    // Purpose: To get the list of cards
    public function listCards() {
        foreach($this->arrCards as $card) {
            echo '<img src="images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
            if($card == 'kc' || $card == 'kd' || $card == 'kh' || $card == 'ks'){
                echo '<br/><br/>';
            }
        }
    }

    // Purpose: To get the Drawn hand with five cards 
    public function getCardHand() {
        $cardHands = array();
        $i = 0;
        foreach($this->arrCards as $card) {
            $cardHands[] = $card;
            if($i == 4){
                break;
            }
            $i++;    
        }
        
        $handCard = array();
        $handSuit = array();
        foreach($cardHands as $value){
            $cardValue = array();
            $length = strlen($value);
            if($length == 2){
                $cardValue = str_split($value,1);
            }else{
                $cardValue = str_split($value,2);  
            }

            if($cardValue[0] == 'a'){
                $cardValue[0] = 1; 
            }else if($cardValue[0] == 'j'){
                $cardValue[0] = 11;
            }else if($cardValue[0] == 'q'){
                $cardValue[0] = 12;
            }else if($cardValue[0] == 'k'){
                $cardValue[0] = 13;
            }
            
            $handCard[] = $cardValue[0];
            $handSuit[] = $cardValue[1];
        }
        
        $sResult = $this->isStraight($handCard);
        $fResult = $this->isFlush($handSuit);

        foreach($cardHands as $card) {
            echo '<img src="images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
        }

        if($sResult && $fResult){
            echo 'Hand is straight flush';
        }elseif($sResult){
            echo 'Hand is straight';
        }else{
            echo 'try again.';
        }
    }

    // Purpose: To check the card value in numeric sequence
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

    // Purpose: To check the card value in same suit
    public function isFlush($handSuit){
        $uCount = count(array_unique($handSuit));
        if($uCount == 1){
            return true;
        }else{
            return false;
        }
    }

    // Purpose: To create deck for 52 cards
    public function initCardDeck() {
        $arrCards = array();

        foreach($this->suits as $suit) {
            foreach ($this->cards as $card) {
                if($card == 1){
                    $card = 'a'; 
                }else if($card == 11){
                    $card = 'j';
                }else if($card == 12){
                    $card = 'q';
                }else if($card == 13){
                    $card = 'k';
                }
                $arrCards[] = $card.$suit; 
            }
        }
        return $arrCards;
    }
}
?>