<?php

//Redirect function
function redirect($url) {
    header("Location: " . $url);
}

//Authorize user. 
function authorize() {
    if(!$_SESSION["user"]) {
        redirect("index.php?page=login");
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