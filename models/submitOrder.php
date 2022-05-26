<?php
include "../config/connection.php";
include "../models/functions.php";
authorize();
if(isset($_POST['submitOrder']))
{
    $userId = $_POST['userId'];
    $planId = $_POST['planId'];
    // var_dump($userId);
    // var_dump($planId);
    $statusCode = 400;
    
    try
    {
        $newOrder = newOrder($userId,$planId);
        if($newOrder)
        {
            $response = ["msg" => "Success! New Order Created!" ];
            $statusCode = 201;
        }
    }
    catch (PDOException $e)
        {   
            $response = ["msg" => $e->getMessage()];
            $statusCode = 500;
        }
        echo json_encode($response);
        http_response_code($statusCode);
}