<?php
if(isset($_POST['btnSubmit']))
{
try{
    session_start();
    include "../config/connection.php";
    include "../models/functions.php";
    authorize();

    $img = $_FILES['changeImg'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $error = array();
    $userId = $_POST['userId'];

    $regFirstName = "/^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/";
    $regLastName = "/^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/";

    if(!preg_match($regFirstName,$firstName))
    {
        array_push($error,"Wrong First name format");
    }
    
    if(!preg_match($regLastName,$lastName))
    {
        array_push($error,"Wrong Last name format");

    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        array_push($error,"Wrong email format");
    }

    if(count($error) == 0)
    {
    
    $imgName = time()."_".$img['name'];
    $imgPath = "../../assets/img-resize/$imgName";
    $tmp = $img['tmp_name'];

    move_uploaded_file($tmp, $imgPath);

    $dim = getimagesize($imgPath);
            // var_dump($dim);

            $width = $dim[0];
            $height = $dim[1];

            $newWidth = 80;
            $newHeight = $height  / ($width / $newWidth);

            $ext = pathinfo($imgPath, PATHINFO_EXTENSION);
            $uploadedImg = ($ext == "png") ? imagecreatefrompng($imgPath) : imagecreatefromjpeg($imgPath);

            $canvas = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled($canvas, $uploadedImg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $done = ($ext == "png") ? imagepng($canvas, "../../assets/img-resize/malaslika_".time().".png") : imagejpeg($canvas, "../../assets/img-resize/malaslika_".time().".jpg");


            if($done){
                $updateUser = updateUserData($userId,$firstName,$lastName,$email,$imgPath);
                if($updateUser)
                {

                }
            }
            else{
                $_SESSION["error"] = "There Was an issue with the image upload."; 
            }
        
    }
    else
    {
        logActionOrError("updating account with errors", true);
        $_SESSION['error'] = $error;
        redirect("../../index.php?page=admin&subpage=editUserData");
    }

        }
        catch(PDOException $exception){
            http_response_code(500);
        }
    }
    else{
        redirect("../../index.php?page=admin");
    }
    
?>