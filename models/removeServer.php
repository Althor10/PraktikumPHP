<?php 
    include "../config/connection.php";
    session_start();
    include "functions.php";
    include "../middleware/adminRules.php";
    authorizeAdm();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $exists = getServer($id);

        if($exists)
        {
            $remove = removeServer($id);
            if($remove)
            {
                logActionOrError("Removed a server");
                redirect('../index.php?page=admin');
            }
            else
            {
                logActionOrError("Delete a server, but the web server broke, 500", true);
                $_SESSION['error'][] = "There was an issue when attempting to delet the server";
                redirect('../index.php?page=admin');
            }
        }
        else
        {
            logActionOrError("Delete a server that doesn't exist", true);
            $_SESSION['error'][] = "There is no such server with the sent ID";
            redirect('../index.php?page=admin');
        }
    }