<?php
require_once "config.php";

try {
    $conn = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME."", MYSQL_USERNAME, MYSQL_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    
   // echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

function executeQuery($upit){
    global $conn;

    $rezultat = $conn->query($upit)->fetchAll();

    return $rezultat;
}

function logActionOrError($message, $error = false){

    if(isset($_SESSION['user']))
    {
        if($error){
            $file = fopen(dirname(__DIR__, 1) . '/data/error.txt', "a+");
        } else {
            $file = fopen(dirname(__DIR__, 1) . '/data/log.txt', "a+");
        }
        
        $korisnik = $_SESSION["user"]->usernm;
        $ip = $_SERVER['REMOTE_ADDR'];
        $datum = date('Y-m-d H:i:s');
        
        
        $upis = "$korisnik \t $ip \t $datum \t $message \n";
        fwrite($file, $upis);
        fclose($file);
    }
    else
    {
    $file = fopen(dirname(__DIR__, 1) . '/data/log.txt', "a+");
    $ip = $_SERVER['REMOTE_ADDR'];
	$datum = date('Y-m-d H:i:s');
	
	
	$upis = "NotAUser \t $ip \t $datum \t $message \n";
	fwrite($file, $upis);
	fclose($file);
    }
	
	
}
