<?php
session_start();
if (isset($_POST['submit'])) {
    unset($_SESSION['error']);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = [];
    $regPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&_-]).{8,}$/";
    //Minimum eight characters, at least one letter, one number and one special character

    $regUsrname = '/^[A-Za-z][A-Za-z0-9]{5,31}$/';

    if (preg_match($regUsrname, $username ) === false) {
        $errors[] = "Username is in wrong format!";
        $errors[] = "1. Must start with letter";
        $errors[] = "2. 6-32 characters";
        $errors[] = "3. Letters and numbers only";
    }

    if (preg_match($regPass, $password) === false) {
        $errors[] = "Password format is wrong.";
    }

    if (count($errors) > 0) {
        $_SESSION['error'] = $errors;
        header("Location: ../index.php?page=admin");

    } else {

            require_once "connection.php";
            $md5Password = md5($password);

            $query = "SELECT u.id as uid, email,passwd,role_id,role_name,usernm FROM pp_users u INNER JOIN pp_role r ON u.role_id=r.id WHERE u.usernm = :username AND u.passwd = :password;";


            $stmt = $conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $md5Password);

            $stmt->execute();
            $user = $stmt->fetch(); // Dohvatanje samo jednog korisnika

        if ($user) {
            $_SESSION['user'] =  $user; //Pravljenje sesije koja kao sadrzaj ima rezultat rada baze podataka
            header("Location: ../index.php?page=admin");

        } else {
            $errors[] = "No user with such username and password found!";
            $_SESSION['error'] = $errors;
            header("Location: ../index.php?page=admin");
          
        }
    }
}