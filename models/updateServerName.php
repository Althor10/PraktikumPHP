<?php 

    session_start();
    include "../config/connection.php";
    include "../models/functions.php";
    authorize();

    if(isset($_POST['btnSubmit']))
    {
        $oldName = $_POST['oldName'];
        $newName = $_POST['newName'];
        $password = $_POST['password'];
        $id = $_POST['servId'];
        $error = array();

        $password = md5($password);

        $userPasswd = $_SESSION['user']->passwd;

        if($password != $userPasswd)
        {
            array_push($error,"The Passwords do not match");
        }

        if($oldName == $newName)
        {
            array_push($error,"Cannot Set The same domain name");
        }

        if(count($error)== 0)
        {
            $update = updateDomainName($id,$newName);

            if($update)
            {
                logActionOrError("Updated their Server name");
                $_SESSION['success'] = "You have Successfully updated your server Name";
                redirect("../index.php?page=admin&subpage=serverStatus");
            }
            else
            {
                logActionOrError("Update their Server name but failed",true);
                $_SESSION['error'] = "There Was ane error while trying to update the server name";
                redirect("../index.php?page=admin&subpage=changeServerDomain&id=$id");
            }
        }
        else
        {
            logActionOrError("Update their Server name");
            $_SESSION['error'] = $error;
            redirect("../index.php?page=admin&subpage=changeServerDomain&id=$id");
        }

        
    }
    else{
        redirect('./index.php?page=admin');
    }
?>