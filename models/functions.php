<?php

session_start();

function redirect($url) {
    header("Location: " . $url);
}

function authorize() {
    if(!$_SESSION["user"]) {
        redirect("login.php");
    }
}

function error($errors, $name) {
    if(isset($errors[$name])) {
        echo "<div class='alert alert-danger'>" . $errors[$name]  .  "</div>";
    } else {
        echo "";
    }
}

function insertUser($first,$last,$username,$password,$email){
    global $conn;
    $insert = $conn->prepare("INSERT INTO pp_users VALUES('',?,?,?,?,DEFAULT,?,CURRENT_TIMESTAMP )");
    $result = $insert->execute([$first,$last,$password,$username,$email]);
    return $result;
}