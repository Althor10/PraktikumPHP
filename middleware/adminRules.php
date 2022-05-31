<?php
if(isset($_SESSION['user']))
{
    if($_SESSION['user']->role_id != 1 && $subpage == "servers")
    {
        logActionOrError("Tried To visit Servers page", true);
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "web-dev")
    {
        logActionOrError("Tried To visit Web-Dev Admin page", true);
        authorizeAdm();
    }
    if($_SESSION['user']->role_id != 1 && $subpage == "assignDev")
    {
        logActionOrError("Tried To visit Assign Dev Admin page", true);
        authorizeAdm();
    }
}
?>