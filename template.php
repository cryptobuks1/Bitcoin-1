<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div style="text-align: center" >
        <h1><a href="index.php"><img src="./pictures/bitcoin.png" alt="icon">
            Bitcoin explorer</a>
        </h1>
        <p>&nbsp;</p>
        <form style="float: left;margin-left:10%;" method="post" action="transaction.php">
        <h4 style="display: inline-block;">Search for transaction</h4>
        <input type="text" placeholder="transaction hash" name="transaction" required/>
        <input class="btn btn-primary" type="submit" value="Search"/>
        </form>
        <form style="float: right;margin-right:10%;" method="post" action="block.php">
        <h4 style="display: inline-block;">Search for block</h4>
        <input type="text" placeholder="block hash or height" name="block" required/>
        <input class="btn btn-primary" type="submit" value="Search"/>
        </form>
        
  <link rel="stylesheet" href="style.css" type="text/css">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php 
require 'vendor/autoload.php';
use Denpa\Bitcoin\Client as BitcoinClient;
ini_set('display_errors',0);

$bitcoind = new BitcoinClient([
    'host'          => '*****',          
    'port'          => 8332,                  
    'user'          => '****',              
    'password'      => '*****',          
]);


?>