<?php 
session_start();
include "config/connection.php";
include "models/functions.php";

$page = "";
$subpage = "";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if(isset($_GET['subpage'])){
    $subpage = $_GET['subpage'];
}
if(!isset($_GET['id']) && ($page == "buyServer" || $page == "order"))
{ 
    redirect('./index.php?page=home');
}

//Admin Rules
include "middleware/adminRules.php";


// Logika slicna WordPress-u gde ce biti ista stranica ($page) ali se menja sta se pokazuje ako je covek logovan ili ne
if($page == 'admin'){
    include "view/admin/ahead.php";
    if(isset($_SESSION['user']) && $subpage == "")
    {
        include "view/admin/authnav.php";
        include "view/admin/dashboard.php";
    }elseif(!isset($_SESSION['user']) && $subpage != "" )
    {
        include "view/admin/aheader.php"; 
     switch($subpage)
     {
         case "registration":
            include "view/admin/aregistration.php";
        //default: 
        //     include "view/admin/login.php";
     }   
    }elseif(isset($_SESSION['user']) && $subpage != "")
    {
        //Switch Case za sub stranice
        include "view/admin/authnav.php";
        switch($subpage)
        {
            case "account":
                include "view/admin/pages/account.php";
                break;
            case "serverStatus":
                include "view/admin/pages/serverStatus.php";
                break;
            case "serverDocumentation":
                include "view/admin/pages/servDocumentation.php";
                break;
            case "serverExport":
                include "view/admin/pages/servExport.php";
                break;
            case "serverImport":
                include "view/admin/pages/serverImport.php";
                break;
            case "servers":
                include "view/admin/pages/servers.php";
                break;
            case "web-dev":
                include "view/admin/pages/web-dev.php";
                break;
            case "assignDev":
                include "view/admin/pages/assignDev.php";
                break;
        }

    }else
    {
        include "view/admin/aheader.php"; 
        include "view/admin/login.php";
    }
    include "view/admin/afooter.php";
}elseif($page=="logout")
{
    include "models/logout.php";
}
else
{
    // U slucaju da nisu Admin stranice
include "view/head.php";
include "view/header.php";
include "view/nav.php";
if($page != "login")
{
    include "view/banner.php";
}
switch($page){
    case "home":
        include "view/services.php";
        include "view/ourWork.php";
        include "view/testimonials.php";
        break;
    case "digital-marketing":
        include "view/digital-marketing.php";
        break;
    case "web-dev":
        include "view/pages/web-dev.php";
        break;
    case "web-hosting":
        include "view/pages/web-hosting.php";
        break;
    case "getStarted":
        include "view/pages/get-Started.php";
        break;
    case "buyServer":
        include "view/pages/buyServer.php";
        break;
    case "order":
        include "view/pages/order.php";
        break;        
    default:
        include "view/services.php";
        include "view/ourWork.php";
        include "view/testimonials.php";
        break;
    
}
include "view/footer.php";
}
?>