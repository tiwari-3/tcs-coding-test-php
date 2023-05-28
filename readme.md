# PHP Card Game 

## Overview

All the code is written using PHP Object Oriented Programming. To create the deck of 52 cards and drawn the hand of five cards. Also, check whether the card is straight or straight flush 

## Getting Started

There is only one main single class used to create the application with name "cardDeck.php"

### cardDeck Class
This is a factory class that will generate, shuffle and deal a deck of 52 cards. Also, get the hand of five cards from these 52 deck of cards and check what kind of hand it is.

#### Instantiating the class:
	$object = new cardDeck();

#### Shuffling the deck:
	$object->shuffleCards();

#### Drawing a deck of cards:
	$object->listCards(); 

#### Drawing hand of five cards from the deck
	$object->getCardHand();

#### Showing output in browser 
	Index.php
	Shuffle.php
	Hand.php

## Requirements

PHP 7.4 or greater is required for the use of these libraries.
Install Composer and then install the PHPUnit package for unit testing and writing the test cases. 
PHPUnit(9) required for running tests (included in repository).

## How It Works
Library used to show the deck of cards which is 52 cards. After shuffling the cards get the hand of five cards.
Then check whether the hand is straight or straight flush based on the poker game terminology.

Straight: Five cards in numeric sequence from different suits.

Straight Flush: Five cards with same suit in consicutive numeric order

##### Cards

- Ace = 1(a)
- Two = 2
- Three = 3
- Four = 4
- Five = 5
- Six = 6
- Seven = 7
- Eight = 8
- Nine = 9
- Ten = 10
- Jack = 11(j)
- Queen = 12(q)
- King = 13(k) 

##### Suits

- Clubs = c
- Hearts = h
- Diamonds = d
- Spades = s