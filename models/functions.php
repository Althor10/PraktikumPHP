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
        redirect("../index.php?page=admin");
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

//Random Generated IP address
function nextIPAdrress()
{
    $ip1 = rand(1,255);
    $ip2 = rand(1,255);
    $ip3 = rand(1,255);
    $ipAddress = $ip1.".".$ip2.".".$ip3;
    return $ipAddress;
}

//Ordering a new server
function newOrder($userId,$planId)
{
    global $conn;
    $ipAddress = nextIPAdrress();
    $domain = "http://myserver".$userId.".com";
    $insert = $conn->prepare("INSERT INTO pp_server VALUES('',(SELECT id FROM pp_users WHERE id = ?),(SELECT id FROM pp_plan WHERE id = ?),DEFAULT,?,?)");
    $result = $insert->execute([$userId,$planId,$domain,$ipAddress]);
    return $result;
}

//Getting server info for the selected user
function getSInfo($id)
{
    $query = "SELECT *,ps.id as psid FROM pp_server as ps INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id WHERE user_id = $id";
    $getSInfo = executeQuery($query);
    return $getSInfo;
}

//Fetching All Servers
function getAllServers()
{
    $query = "SELECT *,ps.id as psid FROM pp_server as ps INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id INNER JOIN pp_users as pu ON ps.user_id = pu.id";
    $getServers = executeQuery($query);
    return $getServers;
}

//Getting all Requests from users
function getAllRequests()
{
    $query = "SELECT *, ps.id as psid, pd.id as pdid FROM pp_devwork as pd inner join pp_server as ps ON pd.server_id=ps.id inner join pp_users as pu on ps.user_id=pu.id INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id";
    $getRequests = executeQuery($query);
    return $getRequests;
}

//Getting users Websites
function getUsersWebsites($id)
{
    $query = "SELECT *,ps.id as psid FROM pp_users as pu INNER JOIN pp_server as ps ON pu.id = ps.user_id WHERE pu.id = $id";
    $getServers = executeQuery($query);
    return $getServers;
}

//Get Assigned Devs
function getAssignedDev($id,$servId)
{
    $query = "SELECT *,pd.id as pdid from pp_users as pu INNER JOIN pp_devwork as pd on pu.id=pd.assign_id INNER JOIN pp_server as ps ON pd.server_id=ps.id WHERE pd.assign_id=$id AND ps.id = $servId";
    $getDev = executeQuery($query);
    return $getDev;
}

//Submitting a new request
function newRequest($serverId,$request)
{
    global $conn;
    $insert = $conn->prepare("INSERT INTO pp_devwork VALUES ('',(SELECT id FROM pp_server WHERE id = ?),?,DEFAULT)");
    $result = $insert->execute([$serverId,$request]);
    return $result;
}

//Get all Devs
function getDevelopers()
{
    $query = "SELECT * FROM pp_users WHERE dev = 1";
    $getDevs = executeQuery($query);
    return $getDevs;
}

//Get all devs with task
function devsWithTask($id)
{
    $query = "SELECT * FROM pp_users as pu INNER JOIN pp_devwork as pd ON pu.id = pd.assign_id WHERE pu.id = $id";
    $getTasks = executeQuery($query);
    return $getTasks;
}

// Asssign dev for the task
function assignTask($taskId,$devId)
{
    global $conn;
    $update = $conn->prepare("UPDATE pp_devwork as pd SET assign_id = (SELECT id FROM pp_users WHERE id = ?) WHERE pd.id = ?");
    $result = $update->execute([$devId,$taskId]);
    return $result;
}

//Get all users
function getUsers()
{
    $query = "SELECT * FROM pp_users WHERE NOT role_id= 1";
    $getTasks = executeQuery($query);
    return $getTasks;
}

// Get Author Img
function getImg($string)
{
    $query = "SELECT * FROM pp_images WHERE img_alt = '$string'";
    $getImg = executeQuery($query);
    return $getImg;
}

//Log Data from file
function getLogData()
{
    $fileName = "data/log.txt";
    $file = file($fileName);

    return $file;
}

//Error Log Fetch
function getErrorLogs()
{
    $fileName = "data/error.txt";
    $file = file($fileName);

    return $file;
}

//Getting Users and their images
function getUserAndImg($username)
{
    $query = "SELECT * FROM pp_users as pu INNER JOIN pp_user_img as pui ON pu.id = pui.user_id INNER JOIN pp_images as ppi ON pui.img_id = ppi.id WHERE pu.usernm = '$username'";
    $getUsrImg = executeQuery($query);
    return $getUsrImg;
}

//Get Devs tasks
function getDevTasks($id)
{
    $query = "SELECT *, ps.id as psid, pd.id as pdid FROM pp_devwork as pd inner join pp_server as ps ON pd.server_id=ps.id inner join pp_users as pu on ps.user_id=pu.id INNER JOIN pp_plan as pp on ps.plan_id=pp.id INNER JOIN pp_hostings as ph ON pp.hosting_id=ph.id WHERE pd.assign_id = $id";
    $getTasks = executeQuery($query);
    return $getTasks;
}

//Get One User
function getUser($id)
{
    $query = "SELECT * FROM pp_users WHERE id = $id";
    $getUser = executeQuery($query);
    return $getUser;
}

//Get User Data
function getUserData($id)
{
    $query = "SELECT * FROM pp_users as pu INNER JOIN pp_user_img as pui on pu.id=pui.user_id INNER JOIN pp_images as pis ON pui.img_id = pis.id WHERE pu.id = $id";
    $getUser = executeQuery($query);
    return $getUser;
}

//Get Requested Server
function getServer($id)
{
    $query = "SELECT * FROM pp_server WHERE id = $id";
    $getServers = executeQuery($query);
    return $getServers;
}

//Get Tasks by Server id 
function getServersDevTasks($id)
{
    $query = "SELECT * FROM pp_devwork WHERE server_id = $id";
    $getServers = executeQuery($query);
    return $getServers;
}


//Remove Devwork and Server
function removeServer($id)
{
    global $conn;
    $isThereDevWork = getServersDevTasks($id);
    if($isThereDevWork)
    {
        $deleteDevWork = $conn->prepare("UPDATE pp_devwork SET server_id = null WHERE server_id = ?");
        $deleteDevWork->execute([$id]);

        $deleteServer = $conn->prepare("DELETE FROM pp_server WHERE id = ?");
        $deleteServer->execute([$id]);

        if($deleteDevWork && $deleteServer)
        {
            return true;
        }
        else 
        {
            return false;
        }

    } else 
    {
        $deleteServer = $conn->prepare("DELETE FROM pp_server WHERE id = ?");
        $deleteServer->execute([$id]);

        if($deleteServer)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}
//Update Server Domain Name
function updateDomainName($id,$newName)
{
    global $conn;
    $updateName = $conn->prepare("UPDATE pp_server SET serverUrl = ? WHERE id = ?");
    $updateName->execute([$newName,$id]);
    return $updateName;
}

//Get One Request
function getRequest($id)
{
    $query = "SELECT * FROM pp_devwork WHERE id = $id";
    $getRequest = executeQuery($query);
    return $getRequest;
}

//Remove Request
function removeRequest($id)
{
    global $conn;
    $deleteRequest = $conn->prepare("DELETE FROM pp_devwork WHERE id = ?");
    $deleteRequest->execute([$id]);
    return $deleteRequest;
}

//Write XML for Server
function writeXML($ipAddress,$serverUrl,$occupied,$freeSpace,$fullSpace)
{
    $exUrl = explode("http://",$serverUrl);
    $domain = $exUrl[1];
    

    $xml = new DOMDocument("1.0");

    $root = $xml->createElement("exportedServer");
    $xml->appendChild($root);

    $url = $xml->createElement("serverUrl");
    $urlText = $xml->createTextNode($serverUrl);
    $url->appendChild($urlText);

    $ipsAddress = $xml->createElement("ipAddress");
    $ipAddressText = $xml->createTextNode($ipAddress);
    $ipsAddress->appendChild($ipAddressText);

    $occupiedSpace = $xml->createElement("occupiedSpace");
    $occupiedText = $xml->createTextNode($occupied);
    $occupiedSpace->appendChild($occupiedText);

    $freeSpaces = $xml->createElement("freeSpace");
    $freeText = $xml->createTextNode($freeSpace);
    $freeSpaces->appendChild($freeText);

    $fullSpaces = $xml->createElement("fullSpace");
    $fullText = $xml->createTextNode($fullSpace);
    $fullSpaces->appendChild($fullText);

    $server = $xml->createElement("server");
    $server->appendChild($url);
    $server->appendChild($ipsAddress);
    $server->appendChild($occupiedSpace);
    $server->appendChild($freeSpaces);
    $server->appendChild($fullSpaces);


    $root->appendChild($server);

    $xml->formatOutput = true;

    echo "<xmp>". $xml->saveXML() ."</xmp>";
    
    $xml->save("../../data/".$domain."server.xml") or die("Error");
    
    

}
