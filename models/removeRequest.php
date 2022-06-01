<?php
    include "../config/connection.php";
    session_start();
    include "functions.php";
    include "../middleware/adminRules.php";
    authorizeAdm();
if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $exists = getRequest($id);

    if($exists)
    {
        $remove = removeRequest($id);
        if($remove)
        {
            logActionOrError("Removed a request");
            redirect('../index.php?page=admin');
        }
        else
        {
            logActionOrError("Delete a request, but the web server broke, 500", true);
            $_SESSION['error'][] = "There was an issue when attempting to delete the request";
            redirect('../index.php?page=admin');
        }
    }
    else
    {
        logActionOrError("Delete a request that doesn't exist", true);
        $_SESSION['error'][] = "There is no such request with the sent ID";
        redirect('../index.php?page=admin');
    }
}