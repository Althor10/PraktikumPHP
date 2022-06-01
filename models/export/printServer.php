<?php
session_start();
    include "../../config/connection.php";
    include "../functions.php";
    authorize();

    if(isset($_POST['printReport']))
    {
    
    $ipAddress  = $_POST['ipAddress'];
    $serverUrl = $_POST['serverUrl'];
    $occupied = $_POST['storageSpace'];
    $freeSpace = $_POST['freeSpace'];
    $fullSpace = $_POST['fullSpace'];

    $exUrl = explode("http://",$serverUrl);
    $domain = $exUrl[1];
    
    $writeServerToXML = writeXML($ipAddress,$serverUrl,$occupied,$freeSpace,$fullSpace);

        if($writeServerToXML)
        {
            logActionOrError("Printed the Server Data");
            $_SESSION['success'] = "Successfully added student";
            redirect(" ../../index.php?page=admin&subpage=serverStatus");
        }
        else{
            logActionOrError("to print the data to XML but failed, 500", true);
            $_SESSION['error'] = "The student is not added.";
            redirect("../../index.php?page=admin&subpage=serverStatus");
        }
    
    }
    else
    {
        logActionOrError("Access the print the server page without POST method", true);
        $_SESSION['error'][] = "Cannot Access the page without the POST method";
        redirect('../index.php?page=admin');
    }