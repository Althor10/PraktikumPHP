<?php
define("ABSOLUTE_PATH","http://localhost/PraktikumPHP/");


define("MYSQL_HOST", env("MYSQL_HOST"));
define("MYSQL_DBNAME", env("MYSQL_DBNAME"));
define("MYSQL_USERNAME", env("MYSQL_USERNAME"));
define("MYSQL_PASSWORD", env("MYSQL_PASSWORD"));

function env($marker){
    $niz = file(__DIR__ . "/.env");
    $trazenaVrednost = "";

    foreach($niz as $red){
        $red = trim($red);

        list($identifikator, $vrednost) = explode("=", $red);

        if($identifikator == $marker){
            $trazenaVrednost = $vrednost;
            break;
        }
    }

    return $trazenaVrednost;
}