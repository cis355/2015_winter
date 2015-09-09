<?php

# adapted from : https://sourcemaking.com/design_patterns/facade/php

class Payment {
/*
    private $tax;
	private $title;
	private $fee;
	function __construct($tax_in, $title_in, $fee_in) {
	    $this->tax    = $tax_in;
        $this->title  = $title_in;
        $this->fee    = $fee_in;
	}
	function getTax() {
        return $this->tax;
    }
    function getTitle() {
        return $this->title;
    }
    function getFee() {
        return $this->fee;
    }
	function getTotal() {
        return $this->getTax() + $this->getTitle() + $this->getFee();
    }
*/
	private static $state_array = 
        array('MI', 'OH', 'IN');
    private static $tax_array = 
        array(.06, .0575, .07);
    private static $title_array = 
        array(100, 50, 150);
    private static $fee_array = 
        array(75, 0, 150);
    public static function ComputeFees($priceIn, $state) {
	    // initialize sum to zero
		$sum_out = 0;
		// find index number of state in the array
		// note that you must use "self::" because these are STATIC
		// class variables not instance variables (which use "this")
		$index = array_search($state, self::$state_array);
		// add up values according to proper state
		$sum_out = $priceIn * self::$tax_array[$index] 
		    + self::$title_array[$index] 
			+ self::$fee_array[$index];
		return $sum_out;
    }
}

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
        return $this->getTitle().' by '.$this->getAuthor();
    }
}

class CaseReverseFacade {
    # wait... 
    public static function reverseStringCase($stringIn) {
        $arrayFromString = ArrayStringFunctions::stringToArray($stringIn);
        $reversedCaseArray = ArrayCaseReverse::reverseCase($arrayFromString);
        $reversedCaseString = ArrayStringFunctions::arrayToString($reversedCaseArray);
        return $reversedCaseString;
    }
}

class ArrayCaseReverse {
    private static $uppercase_array = 
        array('A', 'B', 'C', 'D', 'E', 'F',
              'G', 'H', 'I', 'J', 'K', 'L',
              'M', 'N', 'O', 'P', 'Q', 'R',
              'S', 'T', 'U', 'V', 'W', 'X',
              'Y', 'Z');
    private static $lowercase_array = 
        array('a', 'b', 'c', 'd', 'e', 'f',
              'g', 'h', 'i', 'j', 'k', 'l',
              'm', 'n', 'o', 'p', 'q', 'r',
              's', 't', 'u', 'v', 'w', 'x',
              'y', 'z');
    public static function reverseCase($arrayIn) {
        $array_out = array();
        for ($x = 0; $x < count($arrayIn); $x++) {
         if (in_array($arrayIn[$x], self::$uppercase_array)) {
                 $key = array_search($arrayIn[$x], self::$uppercase_array);
         $array_out[$x] = self::$lowercase_array[$key];
         } elseif (in_array($arrayIn[$x], self::$lowercase_array)) {
                 $key = array_search($arrayIn[$x], self::$lowercase_array);
         $array_out[$x] = self::$uppercase_array[$key];
             } else {
         $array_out[$x] = $arrayIn[$x];
             }
        }
    return $array_out;
    }
}

class ArrayStringFunctions {
    public static function arrayToString($arrayIn) {
      $string_out = NULL;
      foreach ($arrayIn as $oneChar) {
        $string_out .= $oneChar;
      }
      return $string_out;
    }
    public static function stringToArray($stringIn) {
      return str_split($stringIn);
    }
}

  echo 'BEGIN TESTING FACADE PATTERN <br>' ;
  $book = new Book('Design Patterns', 'Gamma, Helm, Johnson, and Vlissides');
  echo 'Original book title: '.$book->getTitle() . '<br>';
  echo '';
  $bookTitleReversed = CaseReverseFacade::reverseStringCase($book->getTitle());  
  echo 'Reversed book title: '.$bookTitleReversed  . '<br>';
  echo '' ;
  echo 'END TESTING FACADE PATTERN <br><br><br>' ;
  
  # ----- new code ---
  
  
  $car_price = 10000;
  $state_of_sale = 'MI';
  
  $totalFees = Payment::ComputeFees($car_price, $state_of_sale);
  echo "Car price: " . $car_price . "<br>"; 
  echo "State taxes and fees: " . $totalFees . "<br>"; 
  echo "Total overall cost: " . $car_price + $totalFees; 
  
?>
