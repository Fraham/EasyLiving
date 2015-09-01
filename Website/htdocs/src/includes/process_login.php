<?php
include_once "../connect.php";
include_once 'functions.php';

//sec_session_start();
	session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['p'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['p']; // The hashed password.
    $returnAddress = $_POST['returnAddress'];

    if (login($email, $password, $conn) == true) {
        // Login success
        header("Location: ../../" . $returnAddress);
        exit();
    } else {
        // Login failed
        header('Location: ../../login/index.php?error=1');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page.
    header('Location: ../error.php?err=Could not process login');
    exit();
}
