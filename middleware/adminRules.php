<?php
if(isset($_SESSION['user']))
{
    if($_SESSION['user']->role_id != 1 && $subpage == "servers")
    {
        logActionOrError("Visit Servers page", true);
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "web-dev")
    {
        logActionOrError("Visit Web-Dev Admin page", true);
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "assignDev")
    {
        logActionOrError("Visit Assign Dev Admin page", true);
        authorizeAdm();
    }
    
}
?>