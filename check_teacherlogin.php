<?php

SESSION_START();

// checks if there is a user logged in and if the user is a teacher
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    // User is not logged in -> show error and exit
    include("error.php");
    exit;
}

if (!isset($_SESSION["account_type"]) || $_SESSION["account_type"] != 2) {
    // User is not teacher -> show error and exit
    include("error.php");
    exit;
}

// Yes, user is logged in and teacher