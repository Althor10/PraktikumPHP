<?php 
if(isset($_POST['btnSubmit']))
{
    session_start();
    include "../config/connection.php";
    include "../models/functions.php";
    authorizeAdm();

    $userId = $_POST['userId'];
    $oldStatus = $_POST['oldStatus'];
    $newStatus = $_POST['status'];
     
    $error = array();

    if($oldStatus == $newStatus)
    {
        array_push($error,"Cannot set the same status");
    }

    $changeStatus = changeUserStatus($userId,$newStatus);

    if($changeStatus)
    {
        logActionOrError("Changed the status of user with id ".$userId);
        $_SESSION['success'] = "Successfully changed the user status!";
        redirect("./index.php?page=admin&subpage=changeStatus&id=".$userId);
    }
    else
    {
        logActionOrError("chagne the status of user with id ".$userId,true);
        $_SESSION['error'] = "Failed to change the user status!";
        redirect("./index.php?page=admin&subpage=changeStatus&id=".$userId);
    }
    
}