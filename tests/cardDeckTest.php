<?php

use PHPUnit\Framework\TestCase;

class CardDeckTest extends TestCase
{
    public function testShuffleAndDrawHand()
    {
        // Create instances of the necessary classes
        $cardDeck = CardDeckFactory::createCardDeck();
        $shuffler = CardDeckFactory::createShuffler();
        $handDrawer = CardDeckFactory::createHandDrawer();

        // Shuffle the deck
        $shuffledCards = $shuffler->shuffle($cardDeck->getCards());

        // Draw a hand
        $handSize = 5;
        $hand = $handDrawer->drawHand($shuffledCards, $handSize);

        // Assert that the deck has been shuffled correctly
        $this->assertCount(52, $cardDeck->getCards());
        $this->assertNotEquals($cardDeck->getCards(), $shuffledCards);

        // Assert that the correct number of cards has been drawn
        $this->assertCount($handSize, $hand);
    }

    public function testEvaluateHand()
    {
        // Create instances of the necessary classes
        $handEvaluator = CardDeckFactory::createHandEvaluator();

        // Prepare a hand for evaluation
        $hand = ['2c', '3c', '4c', '5c', '6c'];

        // Evaluate the hand type
        $handType = $handEvaluator->evaluateHand($hand);

        // Assert the evaluated hand type
        $this->assertEquals('Straight', $handType);
    }
}
?>