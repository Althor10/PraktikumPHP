<?php 

    include "../config/connection.php";
    include "functions.php";
    authorizeAdm();
    session_start();

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $user = getUser($id);

    if($user)
    {
        $usersDevWork = getDevTasks($id);
        if($usersDevWork)
        {
            $removeDevwork = removeDevwork($id);

            if($removeDevwork)
            {
                $hasServer = getSInfo($id);

            if($hasServer)
            {
                $removeServer = removeServerUser($id);

                if($removeServer)
                {
                    $removeUser = removeUser($id);

                    if($removeUser)
                    {
                        logActionOrError("Removed the user with the id of ".$id);
                        $_SESSION['success'][] = "Removed the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                    else
                    {
                        logActionOrError("remove the user but failed",true);
                        $_SESSION['error'][] = "Failed to remove the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                }
                else
                {
                    logActionOrError("remove the users server but failed",true);
                    $_SESSION['error'][] = "Failed to remove the server thus failing to remove user";
                    redirect('./index.php?page=admin&subpage=account');
                }
            }
            else 
            {
                $removeUser = removeUser($id);

                    if($removeUser)
                    {
                        logActionOrError("Removed the user with the id of ".$id);
                        $_SESSION['success'][] = "Removed the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                    else
                    {
                        logActionOrError("remove the user but failed",true);
                        $_SESSION['error'][] = "Failed to remove the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
            }
            }
            else
            {
                logActionOrError("remove the devwork for the requested user but failed",true);
                $_SESSION['error'][] = "Failed to remove the devwork from the wanted user";
                redirect('./index.php?page=admin&subpage=account');
            }
        }
        else
        {
            $hasServer = getSInfo($id);

            if($hasServer)
            {
                $removeServer = removeServerUser($id);

                if($removeServer)
                {
                    $removeUser = removeUser($id);

                    if($removeUser)
                    {
                        logActionOrError("Removed the user with the id of ".$id);
                        $_SESSION['success'][] = "Removed the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                    else
                    {
                        logActionOrError("remove the user but failed",true);
                        $_SESSION['error'][] = "Failed to remove the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                }
                else
                {
                    logActionOrError("remove the users server but failed",true);
                    $_SESSION['error'][] = "Failed to remove the server thus failing to remove user";
                    redirect('./index.php?page=admin&subpage=account');
                }
            }
            else 
            {
                $removeUser = removeUser($id);

                    if($removeUser)
                    {
                        logActionOrError("Removed the user with the id of ".$id);
                        $_SESSION['success'][] = "Removed the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
                    else
                    {
                        logActionOrError("remove the user but failed",true);
                        $_SESSION['error'][] = "Failed to remove the user";
                        redirect('./index.php?page=admin&subpage=account');
                    }
            }
        }
    }
    else 
    {
        logActionOrError("remove the user that doesn't exist",true);
        $_SESSION['error'] = "You're trying to remove an user that doesn't exist";
        redirect('./index.php?page=admin&subpage=account');
    }
}