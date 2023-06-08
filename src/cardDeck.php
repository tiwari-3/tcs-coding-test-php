<?php

// Include the classes and code here...

/**
 * CardDeck class represents the deck of cards.
 */
class CardDeck
{
    private $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function getCards(): array
    {
        return $this->cards;
    }
}

/**
 * Shuffler class is responsible for shuffling the deck.
 */
class Shuffler
{
    public function shuffle(array $cards): array
    {
        $shuffledCards = $cards;
        shuffle($shuffledCards);
        return $shuffledCards;
    }
}

/**
 * HandDrawer class is responsible for drawing a hand from the deck.
 */
class HandDrawer
{
    public function drawHand(array $cards, int $handSize): array
    {
        $hand = array_slice($cards, 0, $handSize);
        return $hand;
    }
}

/**
 * HandEvaluator class is responsible for evaluating the hand type.
 */
class HandEvaluator
{
    public function evaluateHand(array $hand): string
    {
        // Perform hand evaluation logic and return the hand type as a string
        // Example logic to check for a straight or flush:
        // Extract the card values and suits from the drawn hand
        foreach($hand as $value){
            $length = strlen($value);
            if($length == 2){
                $cardValue = str_split($value,1);
            }else{
                $cardValue = str_split($value,2);  
            }

            $handCard[] = $cardValue[0];
            $handSuit[] = $cardValue[1];
        }
        
        // Check if the hand is a straight, a flush, or neither
        $sResult = $this->isStraight($handCard);
        $fResult = $this->isFlush($handSuit);
        $str = '';

        for($i=0; $i < count($hand); $i++){
            $straightArray[$handSuit[$i]] = $handCard[$i];
        }  

        // Determine the type of hand based on straight and flush results
        if($sResult && $fResult){
            sort($handCard);
            if(in_array('13', $handCard) && in_array('1', $handCard)){
                $firstValue = array_shift($handCard); 
                array_push($handCard, $firstValue);        
            }
            for($i=0; $i < count($hand); $i++){
                $hand[$i] = $handCard[$i].$handSuit[$i];
            }
            $str .= 'Hand is straight flush';
        }elseif($sResult){
            asort($straightArray);
            if(in_array('13', $handCard) && in_array('1', $handCard)){
                $firstValue = array_shift($handCard); 
                array_push($handCard, $firstValue);        
            }
            $i = 0;
            foreach($straightArray as $key => $val){
                $hand[$i] = $val.$key;
                $i++;
            }
            $str .= 'Hand is straight';
        }else{
            $str .= 'Drawn hand is neither straight nor straight flush. Please try again.';
        }

        $str .= '</br>';

        // Generate HTML representation of the drawn hand
        foreach($hand as $card) {
           $str .= '<img src="../images/'.$card.'.jpg" height="80" width="80"/>&nbsp;';
        }

        return $str;
    }

    // Purpose:: Check if the card values form a straight sequence
    public function isStraight(array $handCard): bool
    {
        sort($handCard);
        if(in_array('13',$handCard) && in_array('1', $handCard)){
            array_shift($handCard); 
        }
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
    public function isFlush(array $handSuit): bool
    {
        $uCount = count(array_unique($handSuit));
        if($uCount == 1){
            return true;
        }else{
            return false;
        }
    }
}

/**
 * CardDeckFactory class is responsible for creating instances of related classes.
 */
class CardDeckFactory
{
    public static function createCardDeck(): CardDeck
    {
        // Initialize the deck of cards
        $suits = ['c', 'd', 'h', 's'];
        $cards = range(1, 13);

        $arrCards = [];
        foreach ($suits as $suit) {
            foreach ($cards as $card) {
                $arrCards[] = $card . $suit;
            }
        }

        $cardDeck = new CardDeck($arrCards);
        return $cardDeck;
    }

    public static function createShuffler(): Shuffler
    {
        return new Shuffler();
    }

    public static function createHandDrawer(): HandDrawer
    {
        return new HandDrawer();
    }

    public static function createHandEvaluator(): HandEvaluator
    {
        return new HandEvaluator();
    }
}
?>

