<?php

//Redirect function
function redirect($url) {
    header("Location: " . $url);
}

//Authorize user. 
function authorize() {
    if(!$_SESSION["user"]) {
        redirect("index.php?page=admin");
    }
}

function authorizeAdm()
{
    if($_SESSION['user']->role_id != 1) {
        redirect("index.php?page=admin");
    }
}

// Show Errors
function error($errors, $name) {
    if(isset($errors[$name])) {
        echo "<div class='alert alert-danger'>" . $errors[$name]  .  "</div>";
    } else {
        echo "";
    }
}

//Insert user for Registration.
function insertUser($first,$last,$username,$password,$email){
    global $conn;
    $insert = $conn->prepare("INSERT INTO pp_users VALUES('',?,?,?,?,DEFAULT,?,CURRENT_TIMESTAMP )");
    $result = $insert->execute([$first,$last,$password,$username,$email]);
    return $result;
}

// Get All images from database.
function getImages()
{
    $query = "SELECT * FROM pp_images WHERE img_alt = 'site-logo1'";
    $execQuery = executeQuery($query);
    return $execQuery;
}

// Get All Social Network links from database.
function allSocial()
{
    $query = "SELECT * FROM pp_social";
    $allSocial = executeQuery($query);
    return $allSocial;
}

//Mobile logo
function mobileLogo()
{
    $logoIMGQuery = "SELECT * FROM pp_images WHERE img_alt = 'mobile_logo'";
    $resLIQ = executeQuery($logoIMGQuery);
    return $resLIQ;
}

//Navigation
function getNav()
{
    $queryNav = "SELECT * FROM pp_nav";
    $resNav = executeQuery($queryNav);
    return $resNav;
}

//Sponsor Images
function getSponsorImages()
{
    $oneImageQuery = "SELECT * FROM pp_images WHERE img_alt = 'Sponser'";
    $resOIQ = executeQuery($oneImageQuery);

    return $resOIQ;
}

//Get Sponsors
function getSponsors()
{
    $queryServices = "SELECT * FROM pp_sponsors AS sp INNER JOIN pp_images AS im ON sp.img_id=im.id;";
    $resServices = executeQuery($queryServices);
    return $resServices;
}

//Get Service images
function getServiceImages()
{
    $queryServices = "SELECT * FROM pp_services AS s INNER JOIN pp_images AS i on s.img_id=i.id";
    $resServices = executeQuery($queryServices);
    return $resServices;
}

//Get Testimonials
function getTestimonials()
{
    $queryTestimonails = "Select * From pp_testimonials";
    $resTestimonials = executeQuery($queryTestimonails);
    return $resTestimonials;
}

//Admin Nav
function getAdminNav()
{
    $query= "SELECT * FROM pp_nav WHERE adm = 1";
    $navs = executeQuery($query);
    return $navs;
}

//Get Plans
function getPlans()
{
    $query = "SELECT *,pp.id as ppId FROM pp_plan as pp INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id";
    $plans = executeQuery($query);
    return $plans;
}

//Get Plan
function getPlan($id)
{
    if(isset($id)){
        $id = $_GET['id'];
    } 
    else 
    {
        $_SESSION['error'] = "No id Sent!";
        return $_SESSION['error'];
    }
    $query = "SELECT *,pp.id as ppId, ph.id as phId FROM pp_plan as pp INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id WHERE pp.id = $id";
    $plan = executeQuery($query);
    return $plan;
}

function nextIPAdrress()
{
    $ip1 = rand(1,255);
    $ip2 = rand(1,255);
    $ip3 = rand(1,255);
    $ipAddress = $ip1.".".$ip2.".".$ip3;
    return $ipAddress;
}

function newOrder($userId,$planId)
{
    global $conn;
    $ipAddress = nextIPAdrress();
    $domain = "http://myserver".$userId.".com";
    $insert = $conn->prepare("INSERT INTO pp_server VALUES('',(SELECT id FROM pp_users WHERE id = ?),(SELECT id FROM pp_plan WHERE id = ?),DEFAULT,?,?)");
    $result = $insert->execute([$userId,$planId,$domain,$ipAddress]);
    return $result;
}

function getSInfo($id)
{
    $query = "SELECT * FROM pp_server as ps INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id WHERE user_id = $id";
    $getSInfo = executeQuery($query);
    return $getSInfo;
}

function getAllServers()
{
    $query = "SELECT *,ps.id as psid FROM pp_server as ps INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id INNER JOIN pp_users as pu ON ps.user_id = pu.id";
    $getServers = executeQuery($query);
    return $getServers;
}

function getAllRequests()
{
    $query = "SELECT * FROM pp_devwork as pd inner join pp_server as ps ON pd.server_id=ps.id inner join pp_users as pu on ps.user_id=pu.id INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id";
    $getRequests = executeQuery($query);
    return $getRequests;
}

function getUsersWebsites($id)
{
    $query = "SELECT *,ps.id as psid FROM pp_users as pu INNER JOIN pp_server as ps ON pu.id = ps.user_id WHERE pu.id = $id";
    $getServers = executeQuery($query);
    return $getServers;
}

function getAssignedDev($id)
{
    $query = "SELECT * from pp_users as pu INNER JOIN pp_devwork as pd on pu.id=pd.assign_id WHERE pd.assign_id=$id";
    $getDev = executeQuery($query);
    return $getDev;
}