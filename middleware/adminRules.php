<?php
if(isset($_SESSION['user']))
{
    if($_SESSION['user']->role_id != 1 && $subpage == "servers")
    {
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "web-dev")
    {
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "assignDev")
    {
        authorizeAdm();
    }
}
?>