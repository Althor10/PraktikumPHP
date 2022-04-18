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