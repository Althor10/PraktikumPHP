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