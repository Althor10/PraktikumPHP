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
            $_SESSION['error'][] = "Unable to assign a developer. Check that the parameters were sent properly.";
        }

    }
    else
    {
        $_SESSION['error'][] = "Unable to assign a developer. Check that the parameters were sent properly.";
    }