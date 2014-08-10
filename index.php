<?php

class card
{
	public $suit;
	public $name;
	public $value;
	public $image;
	public $location;
	
	public function __construct($strSuit, $intValue, $strName){
		$this->suit = $strSuit;
		$this->name = $strName;
		$this->value = $intValue;
	}
	
	public function fullName(){
		return $this->name." of ".$this->suit;
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
				$this->deck[] = new card($strSuit, $intValue, $strName);
			}
		}
		if($blShuffled){
			$this->shuffle();
		}
	}
	
	public function shuffle(){
		$intDeckCount = count($this->deck) - 1;
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
	
	public function shift(){
		return array_shift($this->deck);
	}
	
	public function viewCard(){
		return $this->deck[0];
	}
}

class pyramid 
{
	public $deck;
	
	//public $table = array_fill(0, 7, array_fill(0, 13, null));
	public $table = array(
		array(7 => 1),
		array(6 => 1, 8 => 1),
		array(5 => 1, 7 => 1, 9 => 1),
		array(4 => 1, 6 => 1, 8 => 1, 10 => 1),
		array(3 => 1, 5 => 1, 7 => 1, 9 => 1, 11 => 1),
		array(2 => 1, 4 => 1, 6 => 1, 8 => 1, 10 => 1, 12 => 1),
		array(1 => 1, 3 => 1, 5 => 1, 7 => 1, 9 => 1, 11 => 1, 13 => 1));
		
	public function __construct($deck){
		$this->deck = $deck;
		foreach($this->table as $rKey => $row){
			foreach($row as $cKey => $column){
				$card = $this->deck->shift();
				$card->location = array($rKey, $cKey);
				$this->table[$rKey][$cKey] = $card;
			}
		}
	}
	
	public function getPlayableCards(){
		$result=array();
		foreach($this->table as $rKey => $row){
			foreach($row as $cKey => $card){
				if(!isset($this->table[$rKey + 1]) && !(isset($this->table[$rKey + 1][$cKey - 1]) && isset($this->table[$rKey + 1][$cKey + 1]))){
					if($card->value == 13){
						echo "Play Out ".$card->fullName()."<br>";
						unset($this->table[$card->location[0]][$card->location[1]]);
						return false;
					} else {
						$result[] = $card;
					}
				}
			}
		}
		return $result;
	}
	
	public function getPossibilities($arrCards){
		$result = array();
		for($i = 0; $i < (count($arrCards) - 1); $i++){
			for($j = $i; $j < (count($arrCards) - 1); $j++){
				if($arrCards[$i]->value + $arrCards[$j]->value == 13){
					$result[$i][] = $j;
				}
			}
		}
		return $result;
	}
	
	public function autoSolve($currPyramid = null){
		if($currPyramid == null){
			$currPyramid = $this;
		}
		$tableCards = $currPyramid->getPlayableCards();
		
		if(!$tableCards){
			$currPyramid->autoSolve($currPyramid);
		} else {
			$stackCard = $currPyramid->deck->viewCard();
			
			if($stackCard->value == 13){
				echo "Play Out ".$stackCard->fullName()."<br>";
				$currPyramid->deck->shift();
				$stackCard = $currPyramid->deck->viewCard();
			}
			
			$stackCard->location = "Stack";
			
			$allCards = $tableCards;
			$allCards[] = $stackCard;
			
			foreach($allCards as $card){
				echo $card->fullName()." - ";
			}
			echo "<br>";
			
			$possibilities = $currPyramid->getPossibilities($allCards);

			foreach($possibilities as $index1 => $arrIndex){
				foreach($arrIndex as $index2){
					$newPyramid = $currPyramid;
					$newPyramid->table
				}
			}
		}
	}
}
	
//$myDeck = new deck(FALSE);
$myDeck = new deck(TRUE);
$newDeck = array();

$newDeck[] = $myDeck->deck[44];
$newDeck[] = $myDeck->deck[43];
$newDeck[] = $myDeck->deck[23];
$newDeck[] = $myDeck->deck[22];
$newDeck[] = $myDeck->deck[41];
$newDeck[] = $myDeck->deck[8];
$newDeck[] = $myDeck->deck[40];
$newDeck[] = $myDeck->deck[51];
$newDeck[] = $myDeck->deck[0];
$newDeck[] = $myDeck->deck[5];
$newDeck[] = $myDeck->deck[28];
$newDeck[] = $myDeck->deck[12];
$newDeck[] = $myDeck->deck[6];
$newDeck[] = $myDeck->deck[50];
$newDeck[] = $myDeck->deck[18];
$newDeck[] = $myDeck->deck[14];
$newDeck[] = $myDeck->deck[4];
$newDeck[] = $myDeck->deck[2];
$newDeck[] = $myDeck->deck[17];
$newDeck[] = $myDeck->deck[16];
$newDeck[] = $myDeck->deck[48];
$newDeck[] = $myDeck->deck[46];
$newDeck[] = $myDeck->deck[1];
$newDeck[] = $myDeck->deck[35];
$newDeck[] = $myDeck->deck[32];
$newDeck[] = $myDeck->deck[19];
$newDeck[] = $myDeck->deck[47];
$newDeck[] = $myDeck->deck[33];

$newDeck[] = $myDeck->deck[9];
$newDeck[] = $myDeck->deck[11];
$newDeck[] = $myDeck->deck[26];
$newDeck[] = $myDeck->deck[39];
$newDeck[] = $myDeck->deck[27];
$newDeck[] = $myDeck->deck[3];
$newDeck[] = $myDeck->deck[24];
$newDeck[] = $myDeck->deck[42];
$newDeck[] = $myDeck->deck[15];
$newDeck[] = $myDeck->deck[34];
$newDeck[] = $myDeck->deck[21];
$newDeck[] = $myDeck->deck[31];
$newDeck[] = $myDeck->deck[49];
$newDeck[] = $myDeck->deck[30];
$newDeck[] = $myDeck->deck[13];
$newDeck[] = $myDeck->deck[25];
$newDeck[] = $myDeck->deck[12];
$newDeck[] = $myDeck->deck[20];
$newDeck[] = $myDeck->deck[45];
$newDeck[] = $myDeck->deck[36]; 
$newDeck[] = $myDeck->deck[29];
$newDeck[] = $myDeck->deck[38];
$newDeck[] = $myDeck->deck[37];
$newDeck[] = $myDeck->deck[10];

//$myDeck->deck = $newDeck;

$myPyramid = new pyramid($myDeck);
$myPyramid->autoSolve();

?>