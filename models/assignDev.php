<?php 
    include "../config/connection.php";
    include "functions.php";
    session_start();
    $taskId = $_GET['taskId'];
    $devId = $_GET['devId'];

    if($taskId && $devId)
    {
        $assign = assignTask($taskId,$devId);
        if($assign)
        {
            redirect("../index.php?page=admin&subpage=assignDev&id=$taskId");
        }
        else
        {
            logActionOrError("AssignDev was sent but hasn't been inserted into the database", true);
            $_SESSION['error'][] = "Unable to assign a developer. Check that the parameters were sent properly.";
        }

    }
    else
    {
        logActionOrError("500, taskId and devId for AssignDev wasn't sent", true);
        $_SESSION['error'][] = "Unable to assign a developer. Check that the parameters were sent properly.";
    }