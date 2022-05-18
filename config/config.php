<?php
define("ABSOLUTE_PATH","http://localhost/PraktikumPHP/");

$env = ABSOLUTE_PATH."/.env";

$envOpen = file($env);
$print = array();

for ($i = 0; $i<count($envOpen);$i++)
{
    $print[$i] = explode("=",$envOpen[$i]);
}

define(trim($print[0][0]),trim($print[0][1]));
define(trim($print[1][0]),trim($print[1][1]));
define(trim($print[2][0]),trim($print[2][1]));
define(trim($print[3][0]),trim($print[3][1]));