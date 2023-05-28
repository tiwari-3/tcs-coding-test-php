<?php
require __DIR__ . "/../src/cardDeck.php";

use PHPUnit\Framework\TestCase;

class CardDeckTest extends TestCase
{
    
    /* Purpose: Test case to verify that the deck is shuffled properly. */
    public function testShuffleCards()
    {
        $deck = new cardDeck();
        $originalDeck = $deck->listCards();

        $deck->shuffleCards();
        $shuffledDeck = $deck->listCards();

        // Assert that the deck is shuffled
        $this->assertNotEquals($originalDeck, $shuffledDeck);
    }

    /* Purpose: Test case to verify the functionality of drawing a hand of cards. */
    public function testGetCardHand()
    {
        $deck = new cardDeck();
        $deck->shuffleCards();

        $handResult = $deck->getCardHand();

        // Assert that the hand result is not empty
        $this->assertNotEmpty($handResult);

        // Assert that the hand result contains the expected output
        $this->assertStringContainsStringIgnoringCase('Hand is', $handResult);
    }

    /* Purpose: Test case to verify the functionality of checking a straight hand.*/
    public function testIsStraight()
    {
        $deck = new cardDeck();

        // Test case for a straight hand
        $hand = [1, 2, 3, 4, 5];
        $isStraight = $deck->isStraight($hand);
        $this->assertTrue($isStraight);

        // Test case for a non-straight hand
        $hand = [1, 2, 3, 4, 7];
        $isStraight = $deck->isStraight($hand);
        $this->assertFalse($isStraight);
    }

    /* Purpose: Test case to verify the functionality of checking a flush hand.*/
    public function testIsFlush()
    {
        $deck = new cardDeck();

        // Test case for a flush hand
        $hand = ['c', 'c', 'c', 'c', 'c'];
        $isFlush = $deck->isFlush($hand);
        $this->assertTrue($isFlush);

        // Test case for a non-flush hand
        $hand = ['c', 'c', 'd', 'c', 'c'];
        $isFlush = $deck->isFlush($hand);
        $this->assertFalse($isFlush);
    }
}
?>