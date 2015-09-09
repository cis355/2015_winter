<?php
class Database
{
    private static $dbName = 'gpcorser' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'gpcorser';
    private static $dbUserPassword = 'remember';

    private static $cont  = null;
    public function __construct() {
        die('Init function is not allowed');
    }
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}



$pdo = Database::connect();
                   $sql = 'SHOW CREATE TABLE customers';
                   foreach ($pdo->query($sql) as $row) { 
							echo $row['1'];				
                   }
                   Database::disconnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
 
<style>

</style>
</html>
