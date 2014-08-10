<?php

class card
{
	public $suit;
	public $name;
	public $value;
	public $image;
	
	public function __construct($strSuit, $intValue, $strName){
		$this->suit = $strSuit;
		$this->name = $strName;
		$this->value = $intValue;
	}
}

class deck
{
	private $_arrSuits = array(
		"Hearts", 
		"Spades", 
		"Diamonds", 
		"Clubs");
	private $_arrValues = array(
		1 => "Ace",
		2 => "2",
		3 => "3",
		4 => "4",
		5 => "5",
		6 => "6",
		7 => "7",
		8 => "8",
		9 => "9",
		10 => "10",
		11 => "Jack",
		12 => "Queen",
		13 => "King");
	
	public $deck = array();
	
	public function __construct($blShuffled = TRUE){
		foreach ($this->_arrSuits as $strSuit){
			foreach ($this->_arrValues as $intValue => $strName){
				$deck[] = new card($strSuit, $intValue, $strName);
			}
		}
		if($blShuffled){
			$this->shuffle();
		}
	}
	
	public function shuffle(){
		$intDeckCount = count($this->deck);
		$intShuffleAmount = rand(104, 520);
		
		for($i = 0; $i < $intShuffleAmount; $i++){
			$intCardOne = rand(0, $intDeckCount);
			$intCardTwo = rand(0, $intDeckCount);
			
			$objCardOne = $this->deck[$intCardOne];
			$objCardTwo = $this->deck[$intCardTwo];
			
			$this->deck[$intCardOne] = $objCardTwo;
			$this->deck[$intCardTwo] = $objCardOne;
		}
	}
}
	
$myDeck = new deck();
var_dump($myDeck);
	

?>