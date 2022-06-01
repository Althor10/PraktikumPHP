<?php
include "../config/connection.php";
include "../models/functions.php";
$statusCode = 200;
$response = "";
if(isset($_SESSION['errors']))
{
    unset($_SESSION['errors']);
}
if(isset($_POST["regSubmit"]))
{
    //Dohvatanje podataka i stavljanja u promenljive
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    //Niz za greske
    $errorsCount = 0;
    
    //Regularni Izrazi
    $regFirstName = "/^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/";
    $regLastName = "/^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/";
    $regUsername = "/^[A-Za-z][A-Za-z0-9]{5,31}$/";
    $regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&_-]).{8,}$/";

    if(!preg_match($regFirstName,$firstName))
    {
        $errorsCount++;
    }
    
    if(!preg_match($regLastName,$lastName))
    {
        $errorsCount++;
    }
    
    if(!preg_match($regUsername,$username))
    {
        $errorsCount++;
    }
    
    if(!preg_match($regPassword,$password))
    {
        $errorsCount++;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorsCount++;
    }
   
    if($errorsCount != 0)
    {
        $response = ["msg" => "Error while processing your data."];
    }
    else
    {
        try
        {
            $password = md5($password);
            $insertUser = insertUser($firstName,$lastName,$username,$password,$email);

            if($insertUser){
                $response = ["msg" => "Success! New User Created!" ];
                $statusCode = 201;
            }
            else
            {
                $response = ["msg" => "There was an error while inserting the user into database."];
                $statusCode = 500;
            }
            
        }
        catch (PDOException $e)
        {   
            $response = ["msg" => $e->getMessage()];
            $statusCode = 500;
        }
    }
    echo json_encode($response);
    http_response_code($statusCode);
}

?>