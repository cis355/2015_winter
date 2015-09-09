<!DOCTYPE html>
<?php
// initialize $n to 0
$integerInput = 0;
class userInteger
{
	public $n;
	public $i;
	public $digi;
	// constructor
	function __construct(){}
		// pass the input value to protected variable

	// function for calling
	public function sumDigitis(){
		// get the sum of all digits
		for($this->i = 19; $this->i > 0; $this->i--){
			$this->digi = $this->digi + (integer)($this->n / (pow(10,$this->i)));
			$this->n =  $this->n % (pow(10,$this->i));
		}
		$this->digi += $this->n;
	}
}
if ( !empty($_POST)) {
	// pass the value of "number" to $n as integer
	$integerInput =$_POST['number'];
	// make a new userInteger class
	$newclass = new userInteger();
	// pass the input value to protected variable
	$newclass->n = $integerInput;
	// calling the function from the class
	$newclass->sumDigitis();
	$sum = $newclass->digi;
	echo "<p align=center>Sum of all digits of $integerInput is $newclass->digi, this result has successfully been added into database.</>";
}
    require 'database.php';
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO sumdigits4 (number,sum) values(?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($integerInput,$sum));
    Database::disconnect();
    // header("Location: sumdigits4.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<p align=center>
<a href="result.php" class="btn btn-success">Show Database</a>
<a class="btn" href="sumdigits4.html">Back</a>
</p>
</body>
</html>