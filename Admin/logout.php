<?php
    session_start();
    unset($_SESSION['name_email']);
    header('location: Login.php');
?>