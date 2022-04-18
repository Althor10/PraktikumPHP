<?php 
include "config/connection.php";
session_start();
$page = "";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if($page == 'admin'){
    include "view/admin/ahead.php";
    if(isset($_SESSION['user'])){
        include "view/admin/authnav.php";
        include "view/admin/dashboard.php";
    }else 
        {include "view/admin/aheader.php"; 
        include "view/admin/login.php";}
    include "view/admin/afooter.php";
}elseif($page=="logout"){
    include "models/logout.php";
}
else{
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