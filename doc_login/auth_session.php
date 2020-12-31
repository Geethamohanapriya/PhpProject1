<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location:doc_login/login.php");
        exit();
    }
?>
