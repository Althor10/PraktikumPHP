<?php 
include "config/connection.php";
session_start();
$page = "";
$subpage = "";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if(isset($_GET['subpage'])){
    $subpage = $_GET['subpage'];
}

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
            case "accounts":
                include "view/pages/accounts.php";
                break;
            case "account":
                include "view/pages/account.php";
                break;
            case "serverStatus":
                include "view/pages/servStatus.php";
                break;
            case "serverDocumentation":
                include "view/pages/servDocumentation.php";
                break;
            case "serverExport":
                include "view/pages/servExport.php";
                break;
            case "serverImport":
                include "view/pages/serverImport.php";
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
include "view/head.php";
include "view/header.php";
include "view/nav.php";
switch($page){
    case "home":
        include "view/banner.php";
        include "view/services.php";
        include "view/ourWork.php";
        include "view/testimonials.php";
        break;
    case "login":
        include "view/login.php";
        break;
    case "digital-marketing":
        include "view/banner.php";
        include "view/digital-marketing.php";
        break;
    default:
        include "view/banner.php";
        include "view/services.php";
        include "view/ourWork.php";
        include "view/testimonials.php";
        break;
}
include "view/footer.php";
}
?>