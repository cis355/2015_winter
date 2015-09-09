<?php

# adapted from : https://sourcemaking.com/design_patterns/facade/php

class Payment {
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
  
  $car_price = 10000;
  $state_of_sale = 'MI';
  
  $totalFees = Payment::ComputeFees($car_price, $state_of_sale);
  echo "Car price: " . $car_price . "<br>"; 
  echo "State taxes and fees: " . $totalFees . "<br>"; 
  echo "Total overall cost: " . $car_price + $totalFees; 
  
?>
